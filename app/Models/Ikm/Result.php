<?php

namespace App\Models\Ikm;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'ikm_result';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function ikm()
    {
    	return $this->belongsTo(SettingIkm::class);
    }

    public function responden()
    {
    	return $this->belongsTo(Responden::class);
    }

    public function question()
    {
    	return $this->belongsTo(Question::class);
    }

    public function answer()
    {
    	return $this->belongsTo(Answer::class);
    }

    public function layanan()
    {
    	return $this->belongsTo(Answer::class);
    }
}
