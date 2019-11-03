<?php

namespace App\Models\Operasional;

use App\Models\Wilker;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use App\Contracts\Operasional\ModelOperasionalInterface;
=======
use App\Contracts\ModelOperasionalInterface;
>>>>>>> 67c29aeccc0c7a28f91b3071026904c840692a41

class ImporKh extends Model implements ModelOperasionalInterface
{
    use QueryScopeKhTrait;
    
    protected $table 	= 'impor_kh'; 
    protected $guarded  = ['id', 'created_at', 'updated_at'];
    protected $hidden   = ['id', 'user_id', 'wilker_id', 'no', 'created_at', 'updated_at'];

    /**
     * Untuk alias dari jenis permohonan untuk set parameter route
     * digunakan pada class UploadController untuk set notifikasi property
     *
     * @var string
     */
    public $alias       = 'impor';

    /**
     * Untuk alias dari jenis permohonan
     * digunakan pada class UploadController untuk set notifikasi property
     *
     * @var string
     */
    public $permohonan  = 'impor';

    /**
     * Untuk alias dari jenis karantina
     * digunakan pada class UploadController untuk set notifikasi property
     *
     * @var string
     */
    public $karantina   = 'Karantina Hewan';

    /**
     * Custom nama bulan
     *
     * @return string
     */
 	public function getBulanAttribute($value)
    {
        return bulan_tahun($value);
    }

    /**
     * One to many relations
     *
     * @return void
     */
    public function wilker()
    {
    	return $this->belongsTo(Wilker::class);
    }

}
