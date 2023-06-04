<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Laptop extends Model
{
    use HasFactory;

    protected $table = 'laptop';
    protected $fillable=[
        'id_laptop',
        'id_modele',
        'id_processeur',
        'id_ram',
        'id_ecran',
        'id_dur',
        'prix'
    ];

    protected $primaryKey = 'id_laptop';
    public $timestamps = false;

    /*-----------------------------------------------*/

    public static function v_laptop() {
        return DB::table("v_laptop");
    }

    /*-----------------------------------------------*/

    public static function saveLaptop($id_marque, $modele, $id_processeur,$id_ram,$id_ecran,$id_dur,$prix) {
        Modele::saveModele($id_marque,$modele);
        $MOD = Modele::getByMarqMod($id_marque,$modele);
        $res = new Laptop();
        $res->id_modele = $MOD->id_modele;
        $res->id_processeur = $id_processeur;
        $res->id_ram = $id_ram;
        $res->id_ecran = $id_ecran;
        $res->id_dur = $id_dur;
        $res->prix = $prix;
        $res->save();
    }

    public static function getAll() {
        $res = Laptop::v_laptop()->paginate(10);
        return $res;
    }

}
