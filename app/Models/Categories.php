<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
	protected $table = "Categories";

	public static function insertData($post = null)
    {
        return self::created($post);
    }
}
