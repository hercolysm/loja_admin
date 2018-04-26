<?php

namespace App;

use Illuminate\Support\Facades\DB;
use App\Models\AclPermissionsModel;
use App\Models\AclRolesPermissionsModel;
use App\Models\AclUsersRolesModel;

class Acl {

	/**
	 * Retorna um grupo de permissões
	 *
	 * @param string $grupo
	 * @return object
	 */
	public static function getPermissionsGroup(string $grupo)
	{
		return AclPermissionsModel::where('group', $grupo)->get();
	}

	/**
	 * Verifica se usuáŕio tem uma permissão
	 *
	 * @param int $id_usuario
	 * @param int $id_acl_acao
	 * @return boolean true or false
	 */
	public static function verifyPermission(int $role_id, int $permission_id)
	{
		$verify = AclRolesPermissionsModel::where([
			['role_id', $role_id],
			['permission_id', $permission_id]
		])->count();
		return ($verify == 1) ? true : false;
	}

	public static function getRole ($id_user, $col = 'label') {
        $roles = DB::table('acl_users_roles')
					->join('acl_roles', 'acl_users_roles.role_id', '=', 'acl_roles.id')
					->select('acl_users_roles.user_id', 'acl_users_roles.role_id', 'acl_roles.name', 'acl_roles.label')
					->where('acl_users_roles.user_id', $id_user)
					->first();
		return isset($roles->$col) ? $roles->$col : '';
    }
    
}
