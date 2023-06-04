<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dur extends Model
{
    use HasFactory;

    protected $table = 'dur';
    protected $fillable=[
        'id_dur',
        'dur',
        'description'
    ];

    protected $primaryKey = 'id_dur';
    public $timestamps = false;

    public static function addDur($dure,$description):void {
        $dur = new Dur();
        $dur->dur = $dure;
        $dur->description = $description;
        $dur->save();
    }

    public static function getAll() {
        $res =  self::orderBy('dur')
            ->paginate(10);
        return $res;
    }

    public static function editDur($id,$dur, $description):void {
        DB::table('dur')
            ->where('id_dur', $id)
            ->update([
                'dur'=>$dur,
                'description'=>$description
            ]);
    }

    public static function removeDur($id): void {
        DB::table('dur')
            ->where('id_dur', $id)
            ->delete();
    }
}
