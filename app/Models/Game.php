<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Game extends Model
{
    use HasFactory;
    protected $table = 'game';
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->uuid = Uuid::uuid4()->toString();
        });
    }
}
