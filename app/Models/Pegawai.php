<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $fillable=[
        'nik',
        'full_name',
        'email',
        'mobile_number',
        'address'
    ];
    protected $table ='pegawai';
}
