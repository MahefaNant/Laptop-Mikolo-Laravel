<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceptionMag extends Model
{
    use HasFactory;

    protected $table = 'receptionmag';
    protected $fillable=[
        'id_receptionmag',
        'id_laptop',
        'quantiter',
        'id_pointdevente',
        'datereception',
        'id_utilisateur'
    ];

    protected $primaryKey = 'id_receptionmag';
    public $timestamps = false;

    public static function saveRecMag($id_laptop,$id_pointdevente,$quantiter,$datereception,$id_utilisateur): void {
        $res = new ReceptionMag();
        $res->id_laptop = $id_laptop;
        $res->id_pointdevente = $id_pointdevente;
        $res->quantiter = $quantiter;
        $res->datereception = $datereception;
        $res->id_utilisateur = $id_utilisateur;
        $res->save();
    }
}
