<?php

namespace App\Models;

use App\function\Functions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vente extends Model
{
    use HasFactory;

    protected $table = 'vente';
    protected $fillable=[
        'id_vente',
        'id_laptop',
        'quantiter',
        'id_pointdevente',
        'datevente',
        'id_utilisateur'
    ];

    protected $primaryKey = 'id_vente';
    public $timestamps = false;

    public static function v_ventelap() {
        return DB::table("v_ventelap");
    }

    public static function v_venteparmoisparans() {
        return DB::table('v_venteparmoisparans');
    }

    public static function v_global_venteparmoisparans() {
        return DB::table('v_global_venteparmoisparans');
    }

    public static function saveVente($id_laptop,$quantiter,$id_pointdevente,$datevente,$id_utilisateur): void {
        $res = new Vente();
        $res->id_laptop = $id_laptop;
        $res->quantiter = $quantiter;
        $res->id_pointdevente = $id_pointdevente;
        $res->datevente = $datevente;
        $res->id_utilisateur = $id_utilisateur;
        $res->save();
    }

    public static function venteparmoisparans($annee) {

        $ventes = Vente::v_venteparmoisparans()->orderBy('month');
        if($annee) {
            $ventes = Vente::v_venteparmoisparans()
                ->where('year', $annee)
                ->orderBy('month');
        }

        $ventes= $ventes->get();

        $res = array();
        $totalVente = 0;
        $totalPrix = 0;
        foreach ($ventes as $v) {
            $pv = PointDeVente::getById($v->id_pointdevente);
            $v->adresse = $pv->adresse;
            $v->month = Functions::getMois($v->month);
            $totalVente += $v->total_quantiter;
            $totalPrix += $v->total_value;
        }
        $res[0] = $ventes;
        $res[1] = $totalVente;
        $res[2] = $totalPrix;
        return $res;
    }

    public static function venteparmoisparansGlobal($annee) {
        $ventes = Vente::v_global_venteparmoisparans()->orderBy('month');
        if($annee) {
            $ventes = Vente::v_global_venteparmoisparans()
                ->where('year', $annee)
                ->orderBy('month');
        }
        $ventes= $ventes->get();
        $res = array();
        $totalVente = 0;
        $totalPrix = 0;
        foreach ($ventes as $v) {
            $v->month = Functions::getMois($v->month);
            $totalVente += $v->total_quantiter;
            $totalPrix += $v->total_value;
        }
        $res[0] = $ventes;
        $res[1] = $totalVente;
        $res[2] = $totalPrix;
        return $res;
    }

    public static function ventesEffectuee($id_pointdevente, $prixmin,$prixmax, $reference) {
        $res = self::v_ventelap()
            ->where('id_pointdevente', $id_pointdevente);
        if($prixmin) $res->where('prix','>=',$prixmin);
        if($prixmax) $res->where('prix', '<=', $prixmax);
        if($reference) $res->where('modele','like',"%".$reference."%");
        $res = $res
            ->orderBy('datevente')
            ->paginate(7);
        return $res;
    }

    public static function venteByIdPV($id_pointdevente) {
        $res = self::v_venteparmoisparans()
            ->where('id_pointdevente', $id_pointdevente)
            ->orderBy('month')
            ->get();
        return $res;
    }

}
