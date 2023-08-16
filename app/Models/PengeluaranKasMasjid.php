<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\PemasukanKasMasjidKasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengeluaranKasMasjid extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pemasukanKas()
    {
        return $this->belongsTo(PemasukanKasMasjid::class, 'pemasukan_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
