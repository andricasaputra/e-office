<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
	protected $connection   = 'usersDB';
    protected $table 	= 'jabatan';
    protected $guarded 	= ['id', 'created_at', 'updated_at'];
}
