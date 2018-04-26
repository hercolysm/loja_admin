<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AclPermissionsModel extends Model
{
    /**
     * The table associated with the Model.
     *
     * @var string
     */
    protected $table = 'acl_permissions';

    /**
     * Primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Retorna roles
     *
     *
     */
    public function roles ()
    {
        return $this->belongsToMany(\App\Models\AclRolesModel::class, 'acl_roles_permissions', 'role_id', 'permission_id');
    }
}
