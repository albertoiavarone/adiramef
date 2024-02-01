<?php

namespace App\Http\Controllers\User\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Models\User;
use App\Models\Role\Role;
use App\Helpers\Files;
use App\Classes\Users;


class UserController extends Controller
{

    public function __construct(){
        $this->middleware('permission:users_r')->only('index');
        $this->middleware('permission:users_c')->only('create');
        $this->middleware('permission:users_c')->only('store');
        $this->middleware('permission:users_r')->only('show');
        $this->middleware('permission:users_u')->only('edit');
        $this->middleware('permission:users_u')->only('update');
        $this->middleware('permission:users_d')->only('delete');
        $this->file = new Files();
        $this->users = new Users();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columnConfig = [];
        $columnConfig[] = ['data' => 'id', 'orderable'=>true];
        $columnConfig[] = ['data' => 'name', 'orderable'=>true,'searchable'=>false];
        $columnConfig[] = ['data' => 'role', 'orderable'=>false];
        $columnConfig[] = ['data' => 'lang', 'orderable'=>false];
        $columnConfig[] = ['data' => 'timezone', 'orderable'=>true,'searchable'=>false];
        $columnConfig[] = ['data' => 'created_at', 'orderable'=>true];
        $columnConfig[] = ['data' => 'buttons', 'orderable'=>false];
        return view('users.index', compact('columnConfig'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rows_roles = Role::orderBy('rank')->get();
        $roles[''] = __('general.select');
        foreach($rows_roles as $role){
            if($role->name == 'superadmin') continue;
            $roles[$role->id] = $role->name;
        }
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'role_id' => 'required|exists:roles,id',
        ]);
        $role = Role::find($request->role_id);
        $unique_code = checkUniqueCode('App\Models\User' ,'code',8);

        $user = User::create ([
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => Hash::make('Admin_123'),
                'code' => $unique_code
            ])->assignRole($role->name);

        if($user) {
            return redirect()->route('users.index')->with('success', __('general.success'));
        } else {
            return redirect()->route('users.index')->with('error',__('general.error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $user = User::where('uuid',$uuid)->firstOrFail();
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $user = User::where('uuid',$uuid)->firstOrFail();
        $roles = Role::where('name', 'NOT LIKE', 'superadmin')->orderBy('rank')->get();
        return view('users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {

        $user = User::where('uuid',$uuid)->firstOrFail();

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role_id' => 'required|exists:roles,id',
            'language' => 'string|max:3',
            'timezone' => 'string|exists:timezones,name',
        ]);

        $role = Role::find($request->role_id);

        $user->update( [
            'name' => $request->name,
            'email' => $request->email,
            'language' => $request->language,
            'timezone' => $request->timezone,
            'email_verified_at' => $user->email != $request['email'] ? null : $user->email_verified_at,
        ]);

        if( is_null($user->email_verified_at) ){
          $user->sendEmailVerificationNotification();
        }

        $user->details()->update([
          'email' => $request['email'],
        ]);

        foreach($user->getRoleNames() as $value){
            $user->removeRole($value);
        }
        $user->assignRole($role->name);

        if($user) {
            return redirect()->route('users.index')->with('success',__('general.success'));
        } else {
            return redirect()->route('users.index')->with('error',__('general.error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {

        $delete = User::where('uuid',$uuid)->delete();
        if($delete) {
            return redirect()->route('users.index')->with('success',__('general.success'));
        } else {
            return redirect()->route('users.index')->with('error',__('general.error'));
        }
    }
    /*
    * list for datatable server side
    */
    public function allUsers(Request $request)
    {

        $columns = array(
                            0 =>'id',
                            1 =>'name',
                            2 => 'role',
                            3 => 'lang',
                            4 => 'timezone',
                            6 => 'created_at',
                            7 => 'buttons',
                        );

        //dd($request);

        $query = User::query();

        $user_role = $this->users->getRole(auth()->user());
        $rank_start = $user_role->rank;
        $query->whereHas('roles', function($q) use ($rank_start){
            return $q->where('roles.rank','>=',$rank_start);
        });

        $totalData = $query->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $users = $query->offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            /*
            $search = $request->input('search.value');

            $users =  $query->where('name', 'LIKE',"%{$search}%")
                            ->orWhere('code', 'LIKE',"%{$search}%")
                            ->orWhere('email', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();


            $totalFiltered = $query->where('name', 'LIKE',"%{$search}%")
                            ->orWhere('code', 'LIKE',"%{$search}%")
                            ->orWhere('email', 'LIKE',"%{$search}%")
                             ->count();
            */
        }

        $data = array();
        if(!empty($users))
        {
            foreach ($users as $user)
            {

                $show =  route('users.show',$user->id);
                $edit =  route('users.edit',$user->id);

                $check_rank = false;
                if( $rank_start < $this->users->getRole($user)->rank){
                  $check_rank = true;
                }

                $nestedData['id'] = $user->id;
                $nestedData['name'] = view('users.shared.name',['user'=>$user])->render();
                $nestedData['role'] = $user->getRoleNames()[0] ;
                $nestedData['lang'] = $user->language;
                $nestedData['timezone'] = $user->timezone;
                $nestedData['created_at'] = convertToLocal($user->created_at);
                $nestedData['buttons'] = $check_rank ? view('users.tds.buttons',['user'=>$user , 'check_rank' => $check_rank])->render() : '';
                $data[] = $nestedData;

            }
        }

        $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );

        echo json_encode($json_data);

    }

    /**
     * Update user profile image
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUserImage(Request $request)
    {
        $request->validate([
            'uploaded_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $user = auth()->user();
        $fileName = $this->file->uploadImage( $request->file('uploaded_file'),
                                    $path='users/'.$user->uuid,
                                    $filename = date('YmdHis'),
                                    $resize=true,
                                    $w=150,
                                    $h=150);

        $update = $user->update( [
                    'image' => $fileName,
                ]);
        if($update) {
            return redirect()->route('profile.edit')->with('success',__('general.success'));
        } else {
            return redirect()->route('profile.edit')->with('error',__('general.error'));
        }
    }

}
