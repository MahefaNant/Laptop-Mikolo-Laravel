<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Affectation extends Model
{
    use HasFactory;

    protected $table = 'affectation';
    protected $fillable=[
        'id_affectation',
        'id_pointdevente',
        'id_utilisateur',
        'dateaffectation',
        'etat'
    ];

    protected $primaryKey = 'id_affectation';
    public $timestamps = false;

    public static function v_affectation() {
        return DB::table("v_affectation");
    }

    public static function affectationUtilisateur($id_pointdevente,$id_utilisateur) {
        $res = new Affectation();
        $res->id_pointdevente = $id_pointdevente;
        $res->id_utilisateur = $id_utilisateur;
        $res->save();
    }

    public static function getAll() {
        $res = self::v_affectation()
            ->orderByDesc('dateaffectation')
            ->where('etat','!=', 0)
            ->paginate(10);

        return $res;
    }
}
