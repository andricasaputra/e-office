<?php

namespace App\Models\Operasional;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\TanggalController as Tanggal;

class EksporKh extends Model implements ModelInterface
{
    protected $table 	= 'ekspor_kh', 
    		  $guarded 	= ['id'],
 			  $hidden 	= ['id', 'user_id', 'wilker_id', 'role_id', 'no', 'created_at', 'updated_at'];

 	public function getBulanAttribute($value)
    {
        return Tanggal::bulanTahun($value);
    }
}
