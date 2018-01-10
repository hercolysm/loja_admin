<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AclRolesModel;

class AclController extends Controller
{
    public function index () {
    	$acl_roles = AclRolesModel::get();;

    	return view('acl.roles.index', ['acl_roles' => $acl_roles]);
    }

    public function create () {
    	return view('acl.roles.create-edit');
    }
}
