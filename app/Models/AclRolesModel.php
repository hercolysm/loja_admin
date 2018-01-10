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
}
