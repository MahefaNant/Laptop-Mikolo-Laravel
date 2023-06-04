<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StockMagasin extends Model
{
    use HasFactory;

    protected $table = 'stockmagasin';
    protected $fillable=[
        'id_stockmagasin',
        'id_laptop',
        'quantiter',
        'date_entree',
        'date_sortie',
        'prixdachat'
    ];

    protected $primaryKey = 'id_stockmagasin';
    public $timestamps = false;

    public static function v_lapstockmag() {
        return DB::table('v_lapstockmag');
    }

    public static function addEntree($id_laptop,$quantiter,$date_entree,$prixdachat) {
        $res = new StockMagasin();
        $res->id_laptop = $id_laptop;
        $res->quantiter = $quantiter;
        $res->date_entree = $date_entree;
        $res->prixdachat = $prixdachat;
        $res->save();
    }

    public static function addSortie($id_laptop,$quantiter,$date_sortie) {
        $res = new StockMagasin();
        $res->id_laptop = $id_laptop;
        $res->quantiter = $quantiter;
        $res->date_sortie = $date_sortie;
        $res->save();
    }

}
