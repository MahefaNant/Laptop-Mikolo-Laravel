<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Achat extends Model
{
    use HasFactory;

    protected $table = 'achat';
    protected $fillable=[
        'id_achat',
        'id_laptop',
        'quantiter',
        'date_entree',
        'prixdachat'
    ];

    protected $primaryKey = 'id_achat';
    public $timestamps = false;

    public static function v_achat() {
        return DB::table('v_achat');
    }

    public static function v_stock() {
        return DB::table('v_stock');
    }

    public static function v_lapstock() {
        return DB::table('v_lapstock');
    }

    public static function saveAchat($id_laptop,$quantiter,$prixdachat) {
        $res = new Achat();
        $res->id_laptop = $id_laptop;
        $res->quantiter = $quantiter;
        $res->prixdachat = $prixdachat;
        $res->save();
    }
}
