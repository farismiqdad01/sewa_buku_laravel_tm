<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    protected $table = 'peminjam';

    public function telepon(){
        return $this->hasOne('App\Telepon', 'id_peminjam');
    }
    
    public function jenis_peminjam(){
        return $this->hasMany(JenisPeminjam::class, 'id','id_jenis_peminjam');
    }
}
