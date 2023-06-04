<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ram extends Model
{
    use HasFactory;

    protected $table = 'ram';
    protected $fillable=[
        'id_ram',
        'ram',
        'description'
    ];

    protected $primaryKey = 'id_ram';
    public $timestamps = false;

    public static function addRam($ram,$description):void {
        $res = new Ram();
        $res->ram = $ram;
        $res->description = $description;
        $res->save();
    }

    public static function getAll() {
        $res =  self::orderBy('ram')
            ->paginate(10);
        return $res;
    }

    public static function editRam($id,$ram, $description):void {
        DB::table('ram')
            ->where('id_ram', $id)
            ->update([
                'ram'=>$ram,
                'description'=>$description
            ]);
    }

    public static function removeRam($id): void {
        DB::table('ram')
            ->where('id_ram', $id)
            ->delete();
    }
}
