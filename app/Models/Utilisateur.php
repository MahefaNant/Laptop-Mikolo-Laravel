<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Utilisateur extends Model
{
    use HasFactory;

    protected $table = 'utilisateur';
    protected $fillable=[
        'id_utilisateur',
        'nom',
        'prenom',
        'mail',
        'code'
    ];

    protected $primaryKey = 'id_utilisateur';
    public $timestamps = false;
    protected $hidden = ['code', 'remember_token'];


    public static function isMailUnique($mail): int {
        $res = DB::table("utilisateur")
            ->where('mail',$mail)
            ->get();
        if(count($res)>0) return 0;
        return 1;
    }
    public static function saveUser($nom,$prenom,$mail,$code): void {
        $res = new Utilisateur();
        $res->nom = $nom;
        $res->prenom = $prenom;
        $res->mail = $mail;
        $res->code = md5($code);
        $res->save();
    }

    public static function login(string $mail, string $code) {
        $res = DB::table('v_affectation')
            ->where('mail',$mail)
            ->where('code',md5($code))
            ->first();
        return $res;
    }

    public static function utilisateurLibre() {
        $res = DB::table("utilisateur as ut")
            ->select('ut.*')
            ->leftJoin('affectation as af', 'ut.id_utilisateur','=','af.id_utilisateur')
            ->where('af.etat', '=', 0)
            ->orWhereNull('af.id_utilisateur')
            ->get();
        return $res;
    }

    public static function getById($id) {
        $res = DB::table('utilisateur')
            ->where('id_utilisateur', $id)
            ->first();
        return $res;
    }

}
