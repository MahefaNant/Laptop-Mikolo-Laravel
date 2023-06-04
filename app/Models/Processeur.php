<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Processeur extends Model
{
    use HasFactory;

    protected $table = 'processeur';
    protected $fillable=[
        'id_processeur',
        'processeur',
        'description'
    ];

    protected $primaryKey = 'id_processeur';
    public $timestamps = false;

    public static function addProc($processeur,$description):void {
        $res = new Processeur();
        $res->processeur = $processeur;
        $res->description = $description;
        $res->save();
    }

    public static function getAll() {
        $res =  self::orderBy('processeur')
            ->paginate(10);
        return $res;
    }

    public static function editProc($id,$processeur, $description):void {
        DB::table('processeur')
            ->where('id_processeur', $id)
            ->update([
                'processeur'=>$processeur,
                'description'=>$description
            ]);
    }

    public static function removeProc($id): void {
        DB::table('processeur')
            ->where('id_processeur', $id)
            ->delete();
    }
}
