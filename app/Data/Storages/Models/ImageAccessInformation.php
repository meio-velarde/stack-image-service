<?php

namespace App\Data\Storages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageAccessInformation extends Model {
    use HasFactory;
    protected $table = 'image_access_information';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'url',
        'index'
    ];
}