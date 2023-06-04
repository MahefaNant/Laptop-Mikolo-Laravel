<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Commission extends Model
{
    use HasFactory;

    protected $table = 'commission';
    protected $fillable=[
        'id_commission',
        'total_min',
        'total_max',
        'id_pointdevente',
        'commission'
    ];

    protected $primaryKey = 'id_vente';
    public $timestamps = false;

    public static function getAll() {
        $res = DB::table('commission')
            ->orderBy('total_min')
            ->get();
        return $res;
    }

    public static function getBetween($valeur) {
        $res =DB::table('commission')
            ->where('total_max', '<=', $valeur)
            ->orWhere('total_min', '<=', $valeur)
            ->orderByDesc('total_min')
            ->get();
        return $res;
    }



    public static function commissionPointDeVente(int $id_pointdevente) {

        $ventes = Vente::venteByIdPV($id_pointdevente);

        for($i=0;$i< $ventes->count();$i++) {
            $commissions = self::getBetween($id_pointdevente);
            $total_quantiter = floatval($ventes->get($i)->total_value) ;
            $ventes->get($i)->val_com = 0;
            $ecart = 0;
            for($j=0;$j<$commissions->count();$j++) {

                $total_min = floatval($commissions->get($j)->total_min) ;
                $total_max = floatval($commissions->get($j)->total_max) ;
                $com = floatval($commissions->get($j)->commission);
                if($j==0) {
                    if($total_quantiter > $total_max) {
                        $ventes->get($i)->val_com +=$total_max*($com/100);
                        $ecart = $total_quantiter- $total_max;
                    } else {
                        $ventes->get($i)->val_com +=$total_quantiter*($com/100);
                    }

                } else {
                    if($ecart > $total_max) {
                        $ventes->get($i)->val_com += $ecart*($com/100);
                    }
                }
            }
        }
        return $ventes;
    }

    public static function commissionGLobal() {
        $commsValue = array();
        $months = array();
        $ventes = Vente::v_venteparmoisparans()->orderBy('month')->get();
        $i=0;
        foreach ($ventes as $v) {
            $commsValue[]=0;
            $months[] = $v->month;
        }

        foreach ($ventes as $v) {
            $comms = Commission::commissionPointDeVente($v->id_pointdevente);
            foreach ($comms as $c) {
                $commsValue[$i] += $c->val_com;
            }
            $i++;
        }
        $res = array();
        $res [] = $commsValue;
        $res [] = $months;
        return $res;
    }


}
