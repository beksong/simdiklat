<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;
use DataTables;
use App\Http\Requests\LaratrustRequest;

class SuperadminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id= $request->get('user_id');
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('message','Berhasil Menghapus data');
    }

    public function getusers()
    {
        $users=User::all();
        return DataTables::of($users)
        ->addColumn('action',function($user){
            return view('users.tbbutton',compact('user'));
        })->toJson();
    }

    /** roles start here */
    public function roles()
    {
        return view('roles.index');
    }

    public function getroles()
    {
        $roles = Role::all();
        return DataTables::of($roles)
        ->addColumn('action',function($role){
            return view('roles.tbbutton',compact('role'));
        })->toJson();
    }

    public function store_role(LaratrustRequest $request)
    {
        $role = new Role(array(
            'name' => $request->get('name'),
            'display_name' => $request->get('display_name'),
            'description' => $request->get('description')
        ));
        $role->save();

        return redirect()->back()->with('message','Success');
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_role(LaratrustRequest $request)
    {
        $role = Role::find($request->get('role_id'));
        $role->update([
            'name' => $request->get('name'),
            'display_name' => $request->get('display_name'),
            'description' => $request->get('description')
        ]);
        return redirect()->back()->with('message','Success');
    }

    public function delete_role(Request $request)
    {
        $role = Role::find($request->get('role_id'));
        $role->delete();
        return redirect()->back()->with('message','Success');
    }

    /**permission start here lets rock boy */
    public function permissions()
    {
        return view('permission.index');
    }

    public function getpermissions()
    {
        $permissions=Permission::all();
        return DataTables::of($permissions)
        ->addColumn('action',function($permission){
            return view('permission.tbbutton',compact('permission'));
        })->toJson();
    }

    public function store_permission(LaratrustRequest $request)
    {
        $permission = new Permission(array(
            'name' => $request->get('name'),
            'display_name' => $request->get('display_name'),
            'description' => $request->get('description')
        ));
        $permission->save();

        return redirect()->back()->with('message','Success');
    }

    public function update_permission(LaratrustRequest $request)
    {
        $permission = Permission::find($request->get('permission_id'));
        $permission->update([
            'name' => $request->get('name'),
            'display_name' => $request->get('display_name'),
            'description' => $request->get('description')
        ]);
        return redirect()->back()->with('message','Success');
    }

    public function delete_permission(Request $request)
    {
        $permission = Permission::find($request->get('permission_id'));
        $permission->delete();
        return redirect()->back()->with('message','Success');
    }

    /**
     * relation between permission and roles are described below
     * lets rock
     */

    public function permission_roles()
    {
        return view('permissionroles.index');
    }

    public function getpermissionroles()
    {
        $roles = Role::all();
        $permission=array();
        return DataTables::of($roles)
        ->addColumn('permissions',function($role){
            $permissions = $role->permissions;
            $array=array();
            foreach($permissions as $key=>$data){
                array_push($array,$data->display_name);
            }
            return $array;
        })
        ->addColumn('action',function($role){
            return '<a href="" class="badge bg-orange"><i class="fa fa-cog"></i></a>';
        })->rawColumns(['permission','action'])->toJson();
    }
}
