<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengurus extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'pengurus';

    // protected $guarded = ['id'], $table = 'pengurus';
}
