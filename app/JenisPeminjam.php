<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPeminjam extends Model
{
    protected $table = 'jenis_peminjam';

    protected $fillable = ['nama_jenis_peminjam'];

    public function peminjam(){
        return $this->hasMany(Peminjam::class, 'id_jenis_peminjam');
    }
}