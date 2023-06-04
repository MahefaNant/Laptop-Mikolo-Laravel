<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    use HasFactory;

    protected $table = 'marque';
    protected $fillable=[
        'id_marque',
        'marque'
    ];

    protected $primaryKey = 'id_marque';
    public $timestamps = false;
}
