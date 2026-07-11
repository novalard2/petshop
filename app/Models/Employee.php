<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'tgl_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'jabatan'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
