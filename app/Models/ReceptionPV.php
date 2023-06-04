<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceptionPV extends Model
{
    use HasFactory;

    protected $table = 'receptionpv';
    protected $fillable=[
        'id_receptionpv',
        'id_laptop',
        'id_pointdevente',
        'quantiter',
        'datereception',
        'id_utilisateur'
    ];

    protected $primaryKey = 'id_receptionpv';
    public $timestamps = false;

    public static function saveRecPV($id_laptop,$id_pointdevente,$quantiter,$datereception,$id_utilisateur): void {
        $res = new ReceptionPV();
        $res->id_laptop = $id_laptop;
        $res->id_pointdevente = $id_pointdevente;
        $res->quantiter = $quantiter;
        $res->datereception = $datereception;
        $res->id_utilisateur = $id_utilisateur;
        $res->save();
    }
}
