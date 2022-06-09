<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Ebook extends Model
{
    use HasFactory;
    protected $table = 'ebook';
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->uuid = Uuid::uuid4()->toString();
        });
    }
}
