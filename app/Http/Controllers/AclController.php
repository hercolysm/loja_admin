<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Acl;
use App\Models\AclRolesModel;
use App\Models\AclPermissionsModel;
use App\Models\AclRolesPermissionsModel;

class AclController extends Controller
{
    public function roles () {
    	$acl_roles = AclRolesModel::paginate(10);;

    	return view('acl.roles.index', ['acl_roles' => $acl_roles]);
    }

    public function create_roles () {
        $tabs = ['perfis' => 'Perfis', 'produtos' => 'Produtos', 'usuarios' => 'Usuários'];
        $Acl = new Acl();
        return view('acl.roles.create-edit', ['tabs' => $tabs, 'Acl' => $Acl]);
    }

    public function edit_roles ($id_role) {
        $tabs = ['perfis' => 'Perfis', 'produtos' => 'Produtos', 'usuarios' => 'Usuários'];
        $Acl = new Acl();
        $roles = AclRolesModel::find($id_role);
        return view('acl.roles.create-edit', ['tabs' => $tabs, 'Acl' => $Acl, 'roles' => $roles]);
    }

    public function store_roles (Request $request) {
    	$AclRole = new AclRolesModel();
    	$AclRole->name = $request->name;
    	$AclRole->label = $request->label;
    	$AclRole->save();

        $permissions = $request->permissions;
        if (is_array($permissions)) {
            foreach ($permissions as $key => $permission_id) {
                $AclRolesPermission = new AclRolesPermissionsModel();
                $AclRolesPermission->role_id = $AclRole->id;
                $AclRolesPermission->permission_id = $permission_id;
                $AclRolesPermission->save();
            }
        }
        
    	return redirect('/roles');
    }

    public function permissions () {
        $acl_permissions = AclPermissionsModel::orderBy('group')->orderBy('name')->paginate(10);

        return view('acl.permissions.index', ['acl_permissions' => $acl_permissions]);
    }

    public function create_permissions () {
        $grupos = AclPermissionsModel::selectRaw('count(id), `group`')->groupBy('group')->get();
        return view('acl.permissions.create-edit', ['grupos' => $grupos]);
    }

    public function store_permissions (Request $request) {
        $AclPermission = new AclPermissionsModel();
        $AclPermission->name = $request->name;
        $AclPermission->label = $request->label;
        $AclPermission->group = $request->group;
        $AclPermission->save();
        return redirect('/permissions');
    }
}
