<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AclRolesModel extends Model
{
    /**
     * The table associated with the Model.
     *
     * @var string
     */
    protected $table = 'acl_roles';

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
     * Retorna permissions
     *
     *
     */
    public function permissions()
    {
        return $this->belongsToMany(\App\Models\AclPermissionsModel::class, 'acl_roles_permissions', 'role_id', 'permission_id');
    }
}
