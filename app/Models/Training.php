<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama_training',
        'tanggal_mulai',
        'tanggal_selesai',
        'kode',
        'konten',
        'cover',
        'tahun',
    ];

    public $timestamps = true;
    public $incrementing = false; // Non-aktifkan auto-increment
    protected $keyType = 'string'; // Tentukan tipe ID sebagai string (UUID)

    // Fungsi boot untuk generate UUID otomatis saat membuat data baru
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) { // Cek apakah id kosong
                $model->id = (string) Str::uuid(); // Generate UUID sebagai id
            }
        });
    }

    // Relasi ke tabel sertifikat
    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class, 'id_training', 'id');
    }

    // Menghapus gambar (cover) yang terkait dengan model ini
    public function deleteImage()
    {
        $imagePath = public_path('images/training/' . $this->cover); // Perbaiki path
        if ($this->cover && file_exists($imagePath)) {
            return unlink($imagePath);
        }
        return false;
    }
}
