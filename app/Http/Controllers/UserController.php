<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|string
     */
    public function index()
    {


        DB::connection()->enableQueryLog();

        $user = User::findOrFail(1);

//        $user->removeRole('Admin'); //删除角色
//        $user->assignRole("User"); //赋予角色
//        $user->syncRoles(['Admin', 'Staff']); //同步角色
//        $user->givePermissionTo(['role-create','role-list']); //赋予权限
//        $user->revokePermissionTo(['role-create','role-list']); //删除权限
//        $user->syncPermissions(['role-create','role-list']); //同步权限
//        $user->hasPermissionTo('role-list'); //检查用户是否具有权限



//        $r = Role::where('id', '=',3)->firstOrFail(); //搜索role[Admin User Staff]
//        $p= Permission::where('name', '=', 1)->first(); //搜索Permission[role-list role-create]
//        $r->givePermissionTo($p);

        $permissions = $user->permissions;
        $roles = $user->roles;

        //$permissions = Permission::pluck('id','id')->all();

        //$hashmaker=Hash::make('admin');


        //$role = Role::create(['name' =>'Admin']);
        //$role->syncPermissions(['role-edit','role-list','role-delete']); //同步权限


        $success = User::with('profile', 'addresses')
            //->findOrFail(1)
            ->where('id', 1) //获取userID=1的数据，如果没有这个条件就获取全部数据
            ->get();

        return response()->json(['success' => $success, 'roles' => $roles, 'permissions' => $permissions, 'DB' => DB::getQueryLog()], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        return "ok";

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return User|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password)
        ]);

        $user->assignRole("Staff");
        $user->givePermissionTo(['role-create','role-list']);

        //$role = Role::create(['name' => 'Staff']);

        //$permissions = Permission::pluck('id','id')->all();

        //$role->syncPermissions($permissions);

        // $user->assignRole([$role->id]);
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
