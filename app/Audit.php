<?php

namespace App;

use App\Models\AuditModel;
use Illuminate\Support\Facades\Auth;

class Audit {

	public static function add($tag, $screen, $description, $details, $changes=null)
	{
		$Audit = new AuditModel();
		$Audit->ip = $_SERVER["REMOTE_ADDR"];
		$Audit->user_id = Auth::id();
		$Audit->tag = $tag;
		$Audit->screen = $screen;
		$Audit->description = $description;
		$Audit->details = $details;
		$Audit->changes = $changes;
        $Audit->save();
	}

	public static function insert($screen, $description, $details)
	{
		$details = json_encode($details->attributesToArray());

		self::add("adicionar", $screen, $description, $details);
	}

	public static function update($screen, $description, $details, $model)
	{
		$details = json_encode($details);
		$changes = ($model) ? json_encode($model->getChanges()) : null;

		if (!empty($model->getChanges())) {
			self::add("editar", $screen, $description, $details, $changes);
		}
	}

	public static function delete($screen, $description, $details)
	{
		$details = json_encode($details->attributesToArray());

		self::add("excluir", $screen, $description, $details);
	}

}
