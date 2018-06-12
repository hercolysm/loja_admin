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
use Gate;

class UsersController extends Controller
{
    public function users () 
    {
        if (Gate::denies('visualizar_usuarios'))
            //abort(403, "Not Permission View Users");
            return redirect('/');

    	$users = UsersModel::where('admin', 0)->paginate(10);;
    	$roles = AclRolesModel::get();
        $Acl = new Acl();

    	return view('auth.users', ['users' => $users, 'roles' => $roles, 'Acl' => $Acl]);
    }

    public function create () 
    {
    	$roles = AclRolesModel::get();
        return view('auth.register', ['user_roles' => [], 'roles' => $roles]);
    }

    public function edit ($id_user) 
    {
        $user = UsersModel::find($id_user);
        $user_roles = Acl::getRoles($id_user, 'role_id');
        $user_roles = explode(',', $user_roles);
        $roles = AclRolesModel::get();
        return view('auth.register', ['user' => $user, 'user_roles' => $user_roles, 'roles' => $roles]);
    }

    public function store (Request $request) 
    {
    	if ($request->id_user) {
    		$id_user = self::update_user($request);
    	} else {
    		$id_user = self::insert_user($request);
    	}

        $old_roles = AclUsersRolesModel::where('user_id', $id_user);
        $old_roles->delete();
        
        $new_roles = isset($request->roles) ? array_filter($request->roles) : null;

        if (!empty($new_roles)) {

            foreach ($new_roles as $role_id) {

                $AclUsersRoles = new AclUsersRolesModel();
                $AclUsersRoles->user_id = $id_user;
                $AclUsersRoles->role_id = $role_id;
                $AclUsersRoles->save();
            }
        }

        return redirect('/users');
    }

    private static function insert_user (Request $request) 
    {
    	$user = new UsersModel();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return $user->id;
    }

    private static function update_user (Request $request) 
    {
    	$user = UsersModel::find($request->id_user);
    	$user->name = $request->name;
    	$user->email = $request->email;
    	if ($request->password) {
    		$user->password = bcrypt($request->password);
    	}
    	$user->save();
        return $user->id;
    }

    public function destroy ($id_user) 
    {
    	$user = UsersModel::find($id_user);
        $user->delete();

        return redirect('/users');
    }
}
