<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AclUsersRolesModel extends Model
{
    /**
     * The table associated with the Model.
     *
     * @var string
     */
    protected $table = 'acl_users_roles';

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
}
