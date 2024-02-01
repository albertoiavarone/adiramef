<?php

namespace App\Http\Controllers\Role\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


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
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('name')->get();
        return $roles;
    }
    /**
     * show the resource.
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        return $role;
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
            'guard_name' => 'required|string',
            'default' =>'nullable|boolean',
        ]);
        $default = ($request->has('default') && $request->default==1) ? 1: 0;
        $role = Role::create($request->all());
        if($default == 1){
            Role::where('id','<>',$role->id)->update(['default'=>0]);
        }
        if($role) {
            return response()->json($role, 200);
        } else {
            return response()->json("errore", 200);
        }     
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
            'guard_name' => 'required|string',
            'default' =>'nullable|boolean',
        ]);
        $default = ($request->has('default') && $request->default==1) ? 1: 0;
    
        $role = Role::find($id);
        $role->name = $request->name;
        $role->guard_name = $request->guard_name;
        $role->default = $default;
        $role->save();
        if($default == 1){
            Role::where('id','<>',$id)->update(['default'=>0]);
        }
        if($role) {
            return response()->json($role, 200);
        } else {
            return response()->json("errore", 200);
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
        $delete = Role::findOrFail($id)->delete();
        if($delete) {
            return response()->json("ID $id eliminato", 200);
        } else {
            return response()->json("errore", 200);
        }     
    }



}
