<?php

namespace App\Http\Controllers;

use App\Charts\SampleChart;
use App\Exports\SampleExport;
use App\Models\Commission;
use App\Models\Laptop;
use App\Models\Perte;
use App\Models\PointDeVente;
use App\Models\ReceptionPV;
use App\Models\Renvoi;
use App\Models\StockPointDeVente;
use App\Models\TransfertToPV;
use App\Models\User;
use App\Models\Utilisateur;
use App\Models\Vente;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use ConsoleTVs\Charts;


class GlobalController extends Controller
{
    public function index() {
        if(Cache::has('utilisateur')) {
            $pointdevente=Cache::get('pointdevente');
            $user=Cache::get('utilisateur');
            if($pointdevente) {
                $pointdevente = json_decode($pointdevente);
                if(!session('utilisateur')) {
                    session()->put('utilisateur', $user);
                    session()->put('pointdevente', $pointdevente);
                }
                return redirect()->route('userHomePage');
            }
        }
        return view('index');
    }

    public function signUpPage() {
        return view('user.sign-up');
    }

    public function signUp(Request $req) {
        if($req->code==$req->rcode) {
            if(Utilisateur::isMailUnique($req->mail)==1) {
                Utilisateur::saveUser($req->nom,$req->prenom,$req->mail,$req->code);
                return  redirect()->route('index');
            }
        }
        return redirect()->route('signUpPage');
    }

    public function login(Request $req) {
        $affect = Utilisateur::login($req->mail, $req->code);
        if($affect) {
            $user = Utilisateur::getById($affect->id_utilisateur);
            $pointdevente = PointDeVente::getById($affect->id_pointdevente);
            session()->put('utilisateur',$user);
            session()->put('pointdevente',$pointdevente);
            if($req->remember_me) {
                $user_json = json_encode($user);
                $pv_json = json_encode($pointdevente);
                Cache::put('utilisateur',$user, 3600);
                Cache::put('pointdevente',$pv_json, 3600);
//                Storage::put('chauffeur.json', $chauffeur_json);
            }
            return redirect()->route('userHomePage');
        }
        return redirect()->route('index');
    }

    /*---------------------------------------------------------*/

    public function userHomePage() {
        if(Cache::has('utilisateur')) {
            $user = session('utilisateur');
            return view('user.userHome', compact('user'));
        }
        return redirect()->route('index');
    }

    public function notification() {
        $user = session('utilisateur');
        $pointdevente = session('pointdevente');
        $transferts = TransfertToPV::getNotif($pointdevente->id_pointdevente);
//        $transferts = StockPointDeVente::v_lapstockpv($pointdevente->id_pointdevente)->get();
        return view('user.notification', compact('user', 'pointdevente', 'transferts'));
    }

    public function saveReception(Request $req) {
        $user = session('utilisateur');

        if($req->quantiterDeb >= $req->quantiter ) {
            ReceptionPV::saveRecPV($req->id_laptop,$req->id_pointdevente,$req->quantiter,$req->datereception,$user->id_utilisateur);
            TransfertToPV::setEtat0($req->id_transfert_to_pv);
            /* $datenow = new DateTime();
             $datenow = $datenow->format("Y-m-d H:i:s");*/
            StockPointDeVente::addEntree($req->id_laptop,$req->quantiter,$req->datereception, $req->id_pointdevente);
            if($req->quantiterDeb!=$req->quantiter) {
                Perte::addPerte($req->id_laptop,$req->id_pointdevente,$req->quantiterDeb - $req->quantiter,$req->datereception,$user->id_utilisateur);
            }
        }
        return redirect()->route('notification');
    }

    public function stock() {
        $user = session('utilisateur');
        $pointdevente = session('pointdevente');
        $laptops = StockPointDeVente::v_lapstockpv($pointdevente->id_pointdevente)->get();
        return view('user.stock', compact('laptops','user'));
    }

    public function renvoie(Request $req) {
        $user = session('utilisateur');
        $pointdevente = session('pointdevente');
        Renvoi::saveRevoie($req->id_laptop,$pointdevente->id_pointdevente,$req->quantiter,$req->daterenvoi,$user->id_utilisateur);
        StockPointDeVente::addSortie($req->id_laptop,$req->quantiter,$req->daterenvoi,$pointdevente->id_pointdevente);
        return redirect()->route('stockPointDeVente');
    }

    public function saveVente(Request $req) {
        $user = session('utilisateur');
        $pointdevente = session('pointdevente');
        Vente::saveVente($req->id_laptop,$req->quantiter,$pointdevente->id_pointdevente,$req->datevente,$user->id_utilisateur);
        StockPointDeVente::addSortie($req->id_laptop,$req->quantiter,$req->datevente,$pointdevente->id_pointdevente);
        return redirect()->route('stockPointDeVente');
    }

    public function ventesEffectuee(Request $req) {
        $user = session('utilisateur');
        $pointdevente = session('pointdevente');
        $prixmin = $req->input('prixmin');
        $prixmax = $req->input('prixmax');
        $reference = $req->input('reference');
        $ventesEffectuee  = Vente::ventesEffectuee($pointdevente->id_pointdevente,$prixmin,$prixmax,$reference);
        return view('user.venteEffectuee', compact('ventesEffectuee', 'user', 'prixmin','prixmax','reference'));
    }


    /*---------------------------------------------------------*/

    public function logOut() {
        session()->remove('utilisateur');
        session()->remove('pointdevente');
//        Storage::delete('chauffeur.json');
        Cache::forget('utilisateur');
        Cache::forget('pointdevente');
        Cache::flush();
        return redirect()->route('index');
    }

    public function test() {
        $ve = Commission::commissionPointDeVente(1);
        dd($ve);
    }
}
