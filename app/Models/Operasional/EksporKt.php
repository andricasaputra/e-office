<?php

namespace App\Models\Operasional;

use Illuminate\Database\Eloquent\Model;

class EksporKt extends Model
{
    protected $table = 'ekspor_kt', 
    		  $guarded = ['id'],
    		  $hidden = ['id', 'user_id', 'wilker_id', 'role_id', 'no', 'created_at', 'updated_at'];

}
