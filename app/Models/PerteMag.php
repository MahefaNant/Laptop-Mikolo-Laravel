<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PerteMag extends Model
{
    use HasFactory;

    protected $table = 'pertemag';
    protected $fillable=[
        'id_pertemag',
        'id_laptop',
        'quantiter',
        'datereception',
        'id_pointdevente',
        'id_utilisateur'
    ];

    protected $primaryKey = 'id_pertemag';
    public $timestamps = false;

    public static function addPerte($id_laptop, $quantiter,$datereception,$id_pointdevente,$id_utilisateur): void {
        $res = new PerteMag();
        $res->id_laptop = $id_laptop;
        $res->quantiter = $quantiter;
        $res->datereception = $datereception;
        $res->id_pointdevente = $id_pointdevente;
        $res->id_utilisateur = $id_utilisateur;
        $res->save();
    }
}
