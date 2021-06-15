<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function insert()
    {
        $result = DB::insert('insert into mahasiswas (npm, nama_mahasiswa, tempat_lahir, 
        tanggal_lahir, alamat, created_at) values (?, ?, ?, ?, ?, ?)', ['1923240085', 
        'Irene Kezia', 'Palembang', '2007-11-23', 'BSD', now()]);
        dump($result);
    }
    public function update()
    {
        $result = DB::update('update mahasiswas set nama_mahasiswa = "Irene Kezia Christiana", 
        alamat = "Bumi Sako Damai", updated_at = now() where npm = ?', ['1923240059']);
        dump($result);
    }
    public function delete()
    {
        $result = DB::delete('delete from mahasiswas where npm = ?', ['1923240059']);
        dump($result);
    }
    public function select()
    {
        $kampus = "Universitas Multi Data Palembang";
        $result = DB::select('select * from mahasiswas');
        // dump($result);
        return view('mahasiswa.index', ['allmahasiswa' => $result, 'kampus' => $kampus]);
    }
    public function insertQb()
    {
        $result = DB::table('mahasiswas')->insert(
            [
                'npm' => '1923240001',
                'nama_mahasiswa' => 'Hanagaki Takemichi',
                'tempat_lahir' => 'Tokyo',
                'tanggal_lahir' => '2003-01-01',
                'alamat' => 'Shinjuku',
                'created_at' => now()
            ]
        );
        dump($result);
    }
    public function updateQb()
    {
        $result = DB::table('mahasiswas')
            ->where('npm', '1923240001')
            ->update(
                [
                    'nama_mahasiswa' => 'Sano Manjirou',
                    'updated_at' => now()
                ]
            );
        dump($result);
    }
    public function deleteQb()
    {
        $result = DB::table('mahasiswas')
            ->where('npm', '=', '1923240001')
            ->delete();
        dump($result);
    }
    public function selectQb()
    {
        $kampus = "Universitas Multi Data Palembang";
        $result = DB::table('mahasiswas')->get();
        // dump($result);
        return view('mahasiswa.index', ['allmahasiswa' => $result, 'kampus' => $kampus]);
    }
    public function insertElq()
    {
        $mahasiswa = new Mahasiswa; // instansiasi class mahasiswa
        $mahasiswa->npm = '1923240010'; // isi property
        $mahasiswa->nama_mahasiswa = 'Chifuyu Matsuno';
        $mahasiswa->tempat_lahir = 'Hokkaido';
        $mahasiswa->tanggal_lahir = '2000-11-11';
        $mahasiswa->alamat = 'Osaka';
        $mahasiswa->save(); // menyimpan data ke tabel mahasiswa
        dump($mahasiswa); // melihat isi $mahasiswa
    }
    public function updateElq()
    {
        $mahasiswa = Mahasiswa::where('npm', '1923240010')->first(); // cari data berdasarkan npm
        $mahasiswa->nama_mahasiswa = 'Ryuguji Ken';
        $mahasiswa->save(); // save data
        dump($mahasiswa); // show data
    }
    public function deleteElq()
    {
        $mahasiswa = Mahasiswa::where('npm', '1923240010')->first(); // cari data berdasarkan npm
        $mahasiswa->delete(); // delete data npm tsb
        dump($mahasiswa); // show data
    }
    public function selectElq()
    {
        $kampus = "Universitas Multi Data Palembang";
        $mahasiswa = Mahasiswa::all();
        // dump($allmahasiswa);
        return view('mahasiswa.index', ['allmahasiswa' => $mahasiswa, 'kampus' => $kampus]);
    }
    public function allJoinElq()
    {
        $kampus = "Universitas Multi Data Palembang";
        $mahasiswas = Mahasiswa::has('prodi')->get();
        return view('mahasiswa.index', ['allmahasiswa' => $mahasiswas, 'kampus' => $kampus]);
    }
}
