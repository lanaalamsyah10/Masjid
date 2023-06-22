<?php

namespace App\Models;

use App\Models\PemasukanKasMasjid;
use App\Models\PengeluaranKasMasjid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rekap extends Model
{
    protected $table = "rekap";
    protected $guarded = [''];
    use HasFactory;

    public function pemasukan()
    {
        return $this->belongsTo(PemasukanKasMasjid::class, 'id_pemasukan');
    }

    public function pengeluaran()
    {
        return $this->belongsTo(PengeluaranKasMasjid::class, 'id_pengeluaran');
    }
}
