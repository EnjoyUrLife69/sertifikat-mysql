<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sertifikat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_penerima',
        'id_training',
        'email',
        'status',
        'nomor_sertifikat',
    ];

    public $timestamps = true;
    public $incrementing = false; // Non-aktifkan auto-increment
    protected $keyType = 'string'; // Tentukan tipe ID sebagai string (UUID)

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) { // Cek apakah id kosong
                $model->id = (string) Str::uuid(); // Generate UUID sebagai id
            }
        });
    }

    // Relasi ke tabel training
    public function training()
    {
        return $this->belongsTo(Training::class, 'id_training', 'id');
    }
}
