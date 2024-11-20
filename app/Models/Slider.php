<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'judul',
        'deskripsi',
        'status'
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

    public function deleteImage()
    {
        $imagePath = public_path('images/slider/' . $this->image); // Perbaiki path
        if ($this->image && file_exists($imagePath)) {
            return unlink($imagePath);
        }
        return false;
    }

}
