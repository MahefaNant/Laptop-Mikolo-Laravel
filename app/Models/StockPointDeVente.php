<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StockPointDeVente extends Model
{
    use HasFactory;

    protected $table = 'stockpoindevente';
    protected $fillable=[
        'id_stockpointdevente',
        'id_laptop',
        'quantiter',
        'date_entree',
        'date_sortie',
        'id_pointdevente'
    ];

    protected $primaryKey = 'id_stockpointdevente';
    public $timestamps = false;

   /* public static function v_lapstockpv() {
        return DB::table('v_lapstockpv');
    }*/

    public static function v_lapstockpvmanquant() {
        return DB::table("v_lapstockpvmanquant");
    }

    public static function v_lapstockpv($idPointDeVente) {
        $res = DB::table('stockpoindevente AS st')
            ->select(
                'st.id_laptop',
                DB::raw('SUM(CASE WHEN st.date_entree IS NOT NULL THEN st.quantiter ELSE 0 END) - SUM(CASE WHEN st.date_sortie IS NOT NULL THEN st.quantiter ELSE 0 END) AS stock_actuel'),
                'v_lap.marque','v_lap.modele','v_lap.processeur','v_lap.proc_desc', 'v_lap.dur','v_lap.dur_desc','v_lap.pouce','v_lap.ecran_desc','v_lap.ram','v_lap.ram_desc','v_lap.prix'
            )
            ->join('v_laptop AS v_lap', 'st.id_laptop', '=', 'v_lap.id_laptop')
            ->where('st.id_pointdevente', $idPointDeVente)
            ->groupBy('st.id_laptop', 'v_lap.marque','v_lap.modele','v_lap.processeur','v_lap.proc_desc', 'v_lap.dur','v_lap.dur_desc','v_lap.pouce','v_lap.ecran_desc','v_lap.ram','v_lap.ram_desc','prix');
        return $res;
    }

    public static function addEntree($id_laptop,$quantiter,$date_entree,$id_pointdevente) {
        $res = new StockPointDeVente();
        $res->id_laptop = $id_laptop;
        $res->quantiter = $quantiter;
        $res->date_entree = $date_entree;
        $res->id_pointdevente = $id_pointdevente;
        $res->save();
    }

    public static function addSortie($id_laptop,$quantiter,$date_sortie,$id_pointdevente) {
        $res = new StockPointDeVente();
        $res->id_laptop = $id_laptop;
        $res->quantiter = $quantiter;
        $res->date_sortie = $date_sortie;
        $res->id_pointdevente = $id_pointdevente;
        $res->save();
    }
}
