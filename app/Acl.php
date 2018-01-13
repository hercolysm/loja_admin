<?php

namespace App;

use App\Models\AclPermissionsModel;
use App\Models\AclRolesPermissionsModel;

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
}
