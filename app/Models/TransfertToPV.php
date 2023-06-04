<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransfertToPV extends Model
{
    use HasFactory;

    protected $table = 'transfert_to_pv';
    protected $fillable=[
        'id_transfert_to_pv',
        'id_laptop',
        'id_pointdevente',
        'quantiter',
        'datetransfert',
        'etat'
    ];

    protected $primaryKey = 'id_transfert_to_pv';
    public $timestamps = false;

    public static function v_laptpv() {
        return DB::table('v_laptpv');
    }

    public static function v_lapmanquant() {
        return DB::table('v_lapmanquant');
    }

//    public static function
    public static function saveTtoPV($id_laptop, $id_pointdevente,$quantiter,$datetransfert) {
        $res = new TransfertToPV();
        $res->id_laptop = $id_laptop;
        $res->id_pointdevente = $id_pointdevente;
        $res->quantiter = $quantiter;
        $res->datetransfert = $datetransfert;
        $res->save();
    }

    public static function getNotif($id_pointdevente) {
        $res = self::v_laptpv()
            ->where('etat',0)
            ->where('id_pointdevente',$id_pointdevente)
            ->orderByDesc('datetransfert')
            ->get();
        return $res;
    }

    public static function setEtat0($id_transfert_to_pv): void {
        DB::table('transfert_to_pv')
            ->where('id_transfert_to_pv', $id_transfert_to_pv)
            ->update([
                'etat'=>1
            ]);
    }

}
