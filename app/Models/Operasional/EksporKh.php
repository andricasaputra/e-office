<?php

namespace App\Models\Operasional;

use Illuminate\Database\Eloquent\Model;

class EksporKh extends Model
{
    protected $table = 'ekspor_kh', 
    		  $guarded = ['id'],
 			  $hidden = ['id', 'user_id', 'wilker_id', 'role_id', 'no', 'created_at', 'updated_at'];

 	/*public function user()
 	{
 		return $this->belongsTo('App\User');
 	}*/
}
