<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peminjam;

use App\Models\Telepon;

use App\Models\JenisPeminjam;

class PeminjamController extends Controller
{
    public function lihat_data_peminjam(){
        $peminjam = ['Budiman',
                        'Maryono',
                        'Dina',
                        'Rusli'
                    ];
        return view('peminjams/lihat_data_peminjam', compact('peminjam'));
    }

    public function index(){
        $data_peminjam = Peminjam::all()->sortBy('nama_peminjam');
        $jumlah_peminjam = $data_peminjam->count();
        return view('peminjams.index', compact('data_peminjam','jumlah_peminjam'));
    }

    public function create(){
        $list_jenis_peminjam = JenisPeminjam::pluck('nama_jenis_peminjam','id_jenis_peminjam');
        return view('peminjams.create', compact('list_jenis_peminjam'));
    }

    public function store(Request $request){
        $peminjam = new Peminjam;
        $peminjam->kode_peminjam = $request->kode_peminjam;
        $peminjam->nama_peminjam = $request->nama_peminjam;
        $peminjam->tgl_lahir = $request->tgl_lahir;
        $peminjam->alamat = $request->alamat;
        $peminjam->id_jenis_peminjam= $request->id_jenis_peminjam;
        $peminjam->save();

        $telepon = new Telepon;
        $telepon->nomor_telepon = $request->telepon;
        $peminjam->telepon()->save($telepon);
        return redirect('peminjam');
    }

    public function edit($id){
        $peminjam = Peminjam::find($id);
        if(!empty($peminjam->telepon->nomor_telepon)){
            $peminjam->nomor_telepon = $peminjam->telepon->nomor_telepon;
        }
        $list_jenis_peminjam = JenisPeminjam::pluck('nama_jenis_peminjam','id_jenis_peminjam');
        return view('peminjams.edit', compact('peminjam','list_jenis_peminjam'));
    }

    public function update(Request $request, $id){
        $peminjam = Peminjam::find($id);
        $peminjam->kode_peminjam = $request->kode_peminjam;
        $peminjam->nama_peminjam = $request->nama_peminjam;
        $peminjam->tgl_lahir = $request->tgl_lahir;
        $peminjam->alamat = $request->alamat;
        $peminjam->id_jenis_peminjam= $request->id_jenis_peminjam;
        $peminjam->update();

        //update nomor telepon, jika sebelumnya sudah ada nomor telepon
        if($peminjam->telepon){
            //jika telepon diisi, maka update
            if($request->filled('nomor_telepon')){
                $telepon = $peminjam->telepon;
                $telepon->nomor_telepon = $request->input('nomor_telepon');
                $peminjam->telepon()->save($telepon);
            }
            else{
                $peminjam->telepon()->delete();
            }
        }
        //buat entry baru, jika sebelumnya tidak ada nomor telepon
        else{
            if($request->filled('nomor_telepon')){
                $telepon = new Telepon;
                $telepon->nomor_telepon = $request->nomor_telepon;
                $peminjam->telepon()->save($telepon);
            }
        }
        return redirect('peminjam');
    }

    public function destroy($id){
        $peminjam = Peminjam::find($id);
        $telepon = Telepon::find($id);
        $peminjam->delete();
        $telepon->delete();
        return redirect('peminjam');
    }

    public function CobaCollection(){
        $daftar = ['Budi Pranoto',
                    'Amy Delia',
                    'Cakra Lukman',
                    'Dewi Nova',
                    'Kartini Indah'
                ];
        $collection = collect($daftar)->map(function($nama){
            return ucwords($nama);
        });
        return $collection;
    }

    public function collection_first(){
        $collection = Peminjam::all()->first();
        return $collection;
    }

    public function collection_last(){
        $collection = Peminjam::all()->last();
        return $collection;
    }

    public function collection_count(){
        $collection = Peminjam::all();
        $jumlah = $collection->count();
        return 'Jumlah peminjam : '.$jumlah;
    }

    public function collection_take(){
        $collection = Peminjam::all()->take(4);
        return $collection;
    }

    public function collection_pluck(){
        $collection = Peminjam::all()->pluck('nama_peminjam');
        return $collection;
    }

    public function collection_where(){
        $collection = Peminjam::all()->where('kode_peminjam', 'P0004');
        return $collection;
    }

    public function collection_wherein(){
        $collection = Peminjam::all()->whereIn('kode_peminjam', ['P0004', 'P0002', 'P0003']);
        return $collection;
    }

    public function collection_toarray(){
        $collection = Peminjam::select('kode_peminjam', 'nama_peminjam')->take(4)->get();
        $koleksi = $collection->toArray();
        foreach($koleksi as $peminjam){
            echo $peminjam['kode_peminjam'].' - '.$peminjam['nama_peminjam'].'<br>';
        }
    }

    public function collection_tojson(){
        $data = [
            ['kode_peminjam'=> 'P0001', 'nama_peminjam' => 'Karina'],
            ['kode_peminjam'=> 'P0002', 'nama_peminjam' => 'Joko'],
            ['kode_peminjam'=> 'P0003', 'nama_peminjam' => 'Zainal'],
            ['kode_peminjam'=> 'P0004', 'nama_peminjam' => 'Lupita'],
        ];
        $collection = collect($data)->toJson();
        return $collection;
    }
}
