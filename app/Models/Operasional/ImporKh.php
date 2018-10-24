<?php

namespace App\Models\Operasional;

use Illuminate\Database\Eloquent\Model;

class ImporKh extends Model
{
    protected $table = 'impor_kh', 
    		  $guarded = ['id'],
 			  $hidden = ['id', 'user_id', 'wilker_id', 'role_id', 'no', 'created_at', 'updated_at'];

 	/*public function user()
 	{
 		return $this->belongsTo('App\User');
 	}*/
}
