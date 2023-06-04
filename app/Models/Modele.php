<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Modele extends Model
{
    use HasFactory;

    protected $table = 'modele';
    protected $fillable=[
        'id_modele',
        'id_marque',
        'modele'
    ];

    protected $primaryKey = 'id_modele';
    public $timestamps = false;

    /*-----------------------------------------*/

    public static function v_modele() {
        return DB::table('v_modele');
    }

    /*-----------------------------------------**/

    public static function saveModele($id_marque, $modele): void {
        $res = new Modele();
        $res->id_marque = $id_marque;
        $res->modele = $modele;
        $res->save();
    }

    public static function getByMarqMod($id_marque, $modele) {
        $res = self::where('id_marque', $id_marque)
            ->where('modele',$modele)
            ->first();
        return $res;
    }
}
