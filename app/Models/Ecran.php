<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ecran extends Model
{
    use HasFactory;

    protected $table = 'ecran';
    protected $fillable=[
        'id_ecran',
        'pouce',
        'description'
    ];

    protected $primaryKey = 'id_ecran';
    public $timestamps = false;

    public static function addEcran($pouce,$description):void {
        $res = new self();
        $res->pouce = $pouce;
        $res->description = $description;
        $res->save();
    }

    public static function getAll() {
        $res =  self::orderBy('pouce')
            ->paginate(10);
        return $res;
    }

    public static function editEcran($id,$pouce, $description):void {
        DB::table('ecran')
            ->where('id_ecran', $id)
            ->update([
                'pouce'=>$pouce,
                'description'=>$description
            ]);
    }

    public static function removeEcran($id): void {
        DB::table('ecran')
            ->where('id_ecran', $id)
            ->delete();
    }
}
