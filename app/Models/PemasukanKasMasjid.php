<?php

namespace App\Models;

use App\Models\PengeluaranKasMasjid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\DashboardPengeluaranController;

class PemasukanKasMasjid extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pengeluaran_kas()
    {
        return $this->hasMany(PengeluaranKasMasjid::class, 'id', 'pemasukan_id');
    }
}
