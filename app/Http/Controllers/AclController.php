<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Acl;
use App\Models\AclRolesModel;
use App\Models\AclPermissionsModel;
use App\Models\AclRolesPermissionsModel;
use Gate;

class AclController extends Controller
{
    public function roles () {

        if (Gate::denies('visualizar_perfis'))
            //return redirect()->back();
            abort(403, "Not Permission View Roles");

    	$acl_roles = AclRolesModel::paginate(10);;

    	return view('acl.roles.index', ['acl_roles' => $acl_roles]);
    }

    public function create_roles () {
        $tabs = AclPermissionsModel::selectRaw('count(id), `group`')->groupBy('group')->get();
        $Acl = new Acl();
        return view('acl.roles.create-edit', ['tabs' => $tabs, 'Acl' => $Acl]);
    }

    public function edit_roles ($id_role) {
        $tabs = AclPermissionsModel::selectRaw('count(id), `group`')->groupBy('group')->get();
        $Acl = new Acl();
        $roles = AclRolesModel::find($id_role);
        return view('acl.roles.create-edit', ['tabs' => $tabs, 'Acl' => $Acl, 'roles' => $roles]);
    }

    public function store_roles (Request $request) {
    	if ($request->id_role) {
            $id_role = self::update_role($request);
        } else {
            $id_role = self::insert_role($request);
        }

        $old_permissions = AclRolesPermissionsModel::where('role_id', $id_role);
        $old_permissions->delete();

        $permissions = $request->permissions;
        if (is_array($permissions)) {
            foreach ($permissions as $key => $permission_id) {
                $AclRolesPermission = new AclRolesPermissionsModel();
                $AclRolesPermission->role_id = $id_role;
                $AclRolesPermission->permission_id = $permission_id;
                $AclRolesPermission->save();
            }
        }
        
    	return redirect('/roles');
    }

    public function destroy_roles ($id_role) {
        AclRolesModel::find($id_role)->delete();

        return redirect('/roles');
    }

    private static function insert_role (Request $request) {
        $AclRole = new AclRolesModel();
        $AclRole->name = $request->name;
        $AclRole->label = $request->label;
        $AclRole->save();
        return $AclRole->id;
    }

    private static function update_role (Request $request) {
        $AclRole = AclRolesModel::find($request->id_role);
        $AclRole->name = $request->name;
        $AclRole->label = $request->label;
        $AclRole->save();
        return $AclRole->id;
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
