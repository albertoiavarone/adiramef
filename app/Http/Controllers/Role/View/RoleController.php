<?php

namespace App\Http\Controllers\Role\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Classes\Users;

class RoleController extends Controller
{

    public function __construct(){
        $this->middleware('permission:roles_r')->only('index');
        $this->middleware('permission:roles_c')->only('create');
        $this->middleware('permission:roles_c')->only('store');
        $this->middleware('permission:roles_r')->only('show');
        $this->middleware('permission:roles_u')->only('edit');
        $this->middleware('permission:roles_u')->only('update');
        $this->middleware('permission:roles_d')->only('delete');
        $this->users = new Users();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = Role::orderBy('rank')->get();
        $roles = $this->users->getLowerRankRole(auth()->user());
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('group')->get();
        return view('roles.create',compact('permissions'));
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
            'rank' =>'required|numeric|between:1,10',
            'guard_name' => 'required|string',
            'default' =>'nullable|boolean',
            'permissions*' =>'nullable|exists:permissions,id'
        ]);

        $default = ($request->has('default') && $request->default==1) ? 1: 0;

        $role = Role::create($request->all());

        if($request->has('permissions') && count($request->permissions)>0){
            $role->givePermissionTo($request->permissions);
        }

        if($default == 1){
            Role::where('id','<>',$role->id)->update(['default'=>0]);
        }

        if($role) {
            return redirect()->route('roles.index')->with('success', __('general.success'));
        } else {
            return redirect()->route('roles.index')->with('error',__('general.error'));
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
        $role = Role::find($id);
        return view('roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::orderBy('group')->get();
        $perm_assigned = [];
        foreach($role->permissions as $p){
            $perm_assigned[] = $p->id;
        }

        return view('roles.edit',compact('role','permissions','perm_assigned'));
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
        $request->validate([
            'name' => 'required|string',
            'rank' =>'required|numeric|between:1,10',
            'guard_name' => 'required|string',
            'default' =>'nullable|boolean',
            'permissions*' =>'nullable|exists:permissions,id'
        ]);
        $default = ($request->has('default') && $request->default==1) ? 1: 0;

        $role = Role::find($id);
        $role->name = $request->name;
        $role->guard_name = $request->guard_name;
        $role->default = $default;
        $role->save();
        $role->syncPermissions($request->permissions);

        if($default == 1){
            Role::where('id','<>',$id)->update(['default'=>0]);
        }
        if($role) {
            return redirect()->route('roles.edit', $id)->with('success',__('general.success'));
        } else {
            return redirect()->route('roles.edit', $id)->with('error',__('general.error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Role::find($id)->delete();
        if($delete) {
            return redirect()->route('roles.index')->with('success',__('general.success'));
        } else {
            return redirect()->route('roles.index')->with('error',__('general.error'));
        }
    }

}
