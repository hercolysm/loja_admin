<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Acl;
use App\User;
use App\Models\AclRolesModel;
use App\Models\AclPermissionsModel;
use App\Models\AclRolesPermissionsModel;
use App\Models\AclUsersRolesModel;
use App\Models\UsersModel;


class UsersController extends Controller
{
    public function users () {
    	$users = UsersModel::where('admin', 0)->paginate(10);;
    	$roles = AclRolesModel::get();
        $Acl = new Acl();
    	return view('auth.users', ['users' => $users, 'roles' => $roles, 'Acl' => $Acl]);
    }

    public function create () {
    	$roles = AclRolesModel::get();
        return view('auth.register', ['roles' => $roles]);
    }

    public function edit ($id_user) {
        $user = UsersModel::find($id_user);
        $role_id = Acl::getRole($id_user, 'role_id');
        $roles = AclRolesModel::get();
        return view('auth.register', ['user' => $user, 'role_id' => $role_id, 'roles' => $roles]);
    }

    public function store (Request $request) {
    	if ($request->id_user) {
    		$id_user = self::update_user($request);
    	} else {
    		$id_user = self::insert_user($request);
    	}

        $old_roles = AclUsersRolesModel::where('user_id', $id_user);
        $old_roles->delete();

        if ($request->roles) {
            $AclUsersRoles = new AclUsersRolesModel();
            $AclUsersRoles->user_id = $id_user;
            $AclUsersRoles->role_id = $request->roles;
            $AclUsersRoles->save();
        }

        return redirect('/users');
    }

    private static function insert_user (Request $request) {
    	$user = new UsersModel();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return $user->id;
    }

    private static function update_user (Request $request) {
    	$user = UsersModel::find($request->id_user);
    	$user->name = $request->name;
    	$user->email = $request->email;
    	if ($request->password) {
    		$user->password = bcrypt($request->password);
    	}
    	$user->save();
        return $user->id;
    }

    public function destroy ($id_user) {
    	$user = UsersModel::find($id_user);
        $user->delete();

        return redirect('/users');
    }
}
