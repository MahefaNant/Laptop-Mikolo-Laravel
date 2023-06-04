<?php

namespace App\Models;

use App\function\Functions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MagasinCentrale extends Model
{
    use HasFactory;

    protected $table = 'magasincentrale';
    protected $fillable=[
        'id_magasincentrale',
        'lieu',
        'mail',
        'code'
    ];

    protected $primaryKey = 'id_magasincentrale';
    public $timestamps = false;
    protected $hidden = [
        'code',
        'remember_token',
    ];

    public static function v_beneficeparmoisparans() {
        return DB::table('v_beneficeparmoisparans');
    }

    public static function adminAuthentification($mail,$code) {
        $res = self::where('mail', $mail)
            ->where('code',md5($code))
            ->first();
        return $res;
    }

    public static function beneficeparmoisparans($annee) {
        $benefices = self::v_beneficeparmoisparans()->orderBy('month');

        if($annee) {
            $benefices = self::v_beneficeparmoisparans()->where('year',$annee)
                ->orderBy('month');
        }

        $benefices = $benefices->get();

//        $comms = Commission::commissionPointDeVente()
        $res = array();
        $total_quant = 0;
        $total_prix = 0;
        $comms = Commission::commissionGLobal();
        foreach ($benefices as $ben) {
            $mo = $ben->month;
            $ben->month = Functions::getMois($ben->month);
            $total_quant += $ben->diff_total_quantiter;
            $total_prix += $ben->diff_total_value;
            $ben->val_com = 0;

            for($i=0;$i< count($comms[0]);$i++) {
                if(intval($mo)==intval($comms[1][$i]) ) {
                    $ben->val_com+= $comms[0][$i];
                    break;
                }
            }
        }
        $res[0] = $benefices; $res[1] = $total_quant; $res[2] = $total_prix;
        return $res;
    }

    public static function beneficeToArray($annee) {
        $res = array();
        $benefices = self::v_beneficeparmoisparans()->orderBy('month');
        if($annee) {
            $benefices = self::v_beneficeparmoisparans()->where('year',$annee)
                ->orderBy('month');
        }

        $benefices = $benefices->get();
        $mois = array();
        $prix = array();
        foreach ($benefices as $ben) {
            $mois []= Functions::getMois($ben->month);
            $prix [] = $ben->diff_total_value;
        }
        $res[0] = $mois;
        $res[1] = $prix;
        return $res;
    }

}
