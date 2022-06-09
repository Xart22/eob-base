<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Company extends Model
{
    use HasFactory;
    protected $table = 'company';
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->uuid = Uuid::uuid4()->toString();
        });
    }
}
