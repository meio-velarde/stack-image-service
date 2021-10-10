<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageAccessInformation extends Model {
    use HasFactory;
    protected $table = 'image_access_information';
    protected $primaryKey = 'url';
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'url',
        'index'
    ];
}   