<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PointDeVente extends Model
{
    use HasFactory;

    protected $table = 'pointdevente';
    protected $fillable=[
        'id_pointdevente',
        'adresse'
    ];

    protected $primaryKey = 'id_pointdevente';
    public $timestamps = false;

    public static function savePointVente(string $adresse):void {
        $PV = new PointDeVente();
        $PV->adresse = $adresse;
        $PV->save();
    }

    public static function getAll() {
        $res = PointDeVente::orderBy('adresse')
            ->paginate(10);
        return $res;
    }

    public static function editPV($id,$adresse):void {
        DB::table('pointdevente')
            ->where('id_pointdevente', $id)
            ->update([
                'adresse'=>$adresse
            ]);
    }

    public static function removePV($id): void {
        DB::table('pointdevente')
            ->where('id_pointdevente', $id)
            ->delete();
    }

    public static function isUnique(string $adresse): bool {
        $res = self::where('adresse',$adresse)
            ->first();
        if($res) return false;
        return true;
    }

    public static function getById($id) {
        $res = DB::table('pointdevente')
            ->where('id_pointdevente', $id)
            ->first();
        return $res;
    }

    /*public static function login(string $mail, string $code) {
        $res = self::where('mail',$mail)
            ->where('code',md5($code))
            ->first();
        return $res;
    }*/

    /*---------------------------------------------------------*/

    public function getAdresse() {
        return $this->adresse;
    }


}
