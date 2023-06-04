<?php

namespace App\function;

use Carbon\Carbon;

class Functions
{
    public static function listeMois() {
        $mois [] = 'janvier';
        $mois [] = 'fevrier';
        $mois [] = 'mars';
        $mois [] = 'Avril';
        $mois [] = 'Mai';
        $mois [] = 'Juin';
        $mois [] = 'Juillet';
        $mois [] = 'Aout';
        $mois [] = 'Septembre';
        $mois [] = 'Octobre';
        $mois [] = 'Novembre';
        $mois [] = 'Decembre';
        return $mois;
    }

    public static function getMois(int $mois) {
        return self::listeMois()[$mois];
    }

    public static function formDate($date) {
        $date = Carbon::parse($date);
        return $date->format('d F Y \à H:i');
    }
}
