<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false; // Karena NIM itu string, bukan auto-increment
    protected $keyType = 'string';
    
    protected $fillable = ['nim', 'nama', 'id_jurusan', 'password', 'role'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }

    // Ini fungsi SAKTI untuk mengambil KRS dari tabel pivot
    public function matakuliah()
    {
        return $this->belongsToMany(Matakuliah::class, 'krs', 'mahasiswa_nim', 'matakuliah_id');
    }
}