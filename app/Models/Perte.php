<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Perte extends Model
{
    use HasFactory;

    protected $table = 'perte';
    protected $fillable=[
        'id_perte',
        'id_laptop',
        'id_pointdevente',
        'quantiter',
        'datereception',
        'id_utilisateur'
    ];

    protected $primaryKey = 'id_perte';
    public $timestamps = false;

    public static function v_perteparmoisparans() {
        return DB::table('v_perteparmoisparans');
    }

    public static function addPerte($id_laptop,$id_pointdevente, $quantiter,$datereception,$id_utilisateur): void {
        $res = new Perte();
        $res->id_laptop = $id_laptop;
        $res->id_pointdevente = $id_pointdevente;
        $res->quantiter = $quantiter;
        $res->datereception = $datereception;
        $res->id_utilisateur = $id_utilisateur;
        $res->save();
    }


}
