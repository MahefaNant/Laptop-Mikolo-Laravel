<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Renvoi extends Model
{
    use HasFactory;

    protected $table = 'renvoi';
    protected $fillable=[
        'id_renvoi',
        'id_laptop',
        'id_pointdevente',
        'quantiter',
        'daterenvoi',
        'etat',
        'id_utilisateur'
    ];

    protected $primaryKey = 'id_renvoi';
    public $timestamps = false;

    public static function v_laprenvoi() {
        return DB::table('v_laprenvoi');
    }

    public static function saveRevoie($id_laptop, $id_pointdevente,$quantiter,$daterenvoi,$id_utilisateur) {
        $res = new Renvoi();
        $res->id_laptop = $id_laptop;
        $res->id_pointdevente = $id_pointdevente;
        $res->quantiter = $quantiter;
        $res->daterenvoi = $daterenvoi;
        $res->id_utilisateur = $id_utilisateur;
        $res->save();
    }

    public static function getNotif() {
        $res = self::v_laprenvoi()
            ->where('etat',0)
            ->orderByDesc('daterenvoi')
            ->get();
        return $res;
    }

    public static function setEtat0($id_renvoi): void {
        DB::table('renvoi')
            ->where('id_renvoi', $id_renvoi)
            ->update([
                'etat'=>1
            ]);
    }
}
