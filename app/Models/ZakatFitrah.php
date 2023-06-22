<?php

namespace App\Models;

use App\Models\JenisZakat;
use App\Models\IsiZakatFitrah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ZakatFitrah extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'zakat_fitrah';

    // public function jenis_zakat()
    // {
    //     return $this->belongsTo(JenisZakat::class, 'kode_jenis_zakat', "id");
    // }

}
