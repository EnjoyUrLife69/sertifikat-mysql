<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Counter extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'count'];

    public $incrementing = false; // Non-incremental primary key
    protected $keyType = 'string'; // Primary key tipe string

    // Gunakan UUID saat membuat record baru
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}


