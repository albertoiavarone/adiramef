<?php

namespace App\Http\Controllers\Permission\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    
    public function __construct(){
        $this->middleware('permission:permissions_r')->only('index');
        $this->middleware('permission:permissions_c')->only('create');
        $this->middleware('permission:permissions_c')->only('store');
        $this->middleware('permission:permissions_r')->only('show');
        $this->middleware('permission:permissions_u')->only('edit');
        $this->middleware('permission:permissions_u')->only('update');
        $this->middleware('permission:permissions_d')->only('delete');
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderBy('name')->get();
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'group' => 'required|string',
            'name' => 'required|string',
            'crud' => 'nullable|integer|between:0,1',
            'description' => 'required|string',
            'guard_name' => 'required|string',
        ]);
        
        $types = [  '_c' => ' create', 
                    '_r' => ' read',
                    '_u' => ' update' ,
                    '_d' => ' delete' 
                ];
        $role = Role::where('name','superadmin')->first();

        if($request->has('crud') && $request->crud){
            $permissions = [];
            foreach($types as $key=>$type){
                $permission = Permission::create([ 'group'=>$request->group,
                                'name'=>$request->group.$key,
                                'description'=>$request->description.' - '.$type,
                                'guard_name'=>$request->guard_name
                            ]);
                $permissions[] = $permission;
            }
            $role->givePermissionTo($permissions);
        } else {
            $permission = Permission::create([ 'group'=>$request->group,
                            'name'=>$request->name,
                            'description'=>$request->description,
                            'guard_name'=>$request->guard_name
                        ]);
            $role->givePermissionTo($permission);
        }
        
        if($permission) {
            return redirect()->route('permissions.index')->with('success', __('general.success'));
        } else {
            return redirect()->route('permissions.index')->with('error',__('general.error'));
        }     
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);
        return view('permissions.show',compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);
        $ruoli = $permission->getRoleNames();
        foreach ($ruoli as $ruolo){
            $permission->removeRole($ruolo);
        }
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', __('general.success'));
    }
}
