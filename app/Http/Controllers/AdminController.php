<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Affectation;
use App\Models\Commission;
use App\Models\Laptop;
use App\Models\MagasinCentrale;
use App\Models\Marque;
use App\Models\Materiel;
use App\Models\Perte;
use App\Models\PerteMag;
use App\Models\PointDeVente;
use App\Models\Processeur;
use App\Models\ReceptionMag;
use App\Models\ReceptionPV;
use App\Models\Renvoi;
use App\Models\StockMagasin;
use App\Models\StockPointDeVente;
use App\Models\TransfertToPV;
use App\Models\TypeMateriel;
use App\Models\Utilisateur;
use App\Models\Vente;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{


    public function adminAuthentification(Request $req) {
        $admin = MagasinCentrale::adminAuthentification($req->mail,$req->code);
        if($admin) {
            session()->put('adminValide','true');
            return redirect()->route('adminHome');
        }
        return redirect()->route('index');
    }

    public function adminIsValide() {
        $adminValide = session('adminValide');
        if($adminValide) {
            return 1;
        }
        return 0;
    }



    /*----------------------------------------------------------*/
    public function adminHome(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        $annee = null;
        if($req->annee) $annee = $req->annee;
        $benefices = MagasinCentrale::beneficeparmoisparans($annee);
        $beneficesToArray = MagasinCentrale::beneficeToArray($annee);
        return view('admin.adminHome', compact('benefices','beneficesToArray'));
    }

    public function addPointVentePage() {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        $pointdeventes = PointDeVente::getAll();
        return view('admin.addPointVente', compact('pointdeventes'));
    }

    public function addPointVente(Request $req) {
        if($req->code!=$req->rcode) {
            return redirect()->route('addPointVentePage');
        }
        $verif = PointDeVente::isUnique($req->adresse);
        if(!$verif) return redirect()->route('addPointVentePage');
        PointDeVente::savePointVente($req->adresse);
        return redirect()->route('addPointVentePage');
    }

    public function editPV(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        PointDeVente::editPV($req->id_pointdevente,$req->adresse);
        return redirect()->route('addPointVentePage');
    }

    public function removePV(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        PointDeVente::removePV($req->id_pointdevente);
        return redirect()->route('addPointVentePage');
    }

    public function affectationUser() {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        $utilisateurLibres = Utilisateur::utilisateurLibre();
        $pointdeventes = PointDeVente::all();
        $affectations = Affectation::getAll();
        return view('admin.affectation',compact('utilisateurLibres','pointdeventes', 'affectations'));
    }

    public function affecter(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        Affectation::affectationUtilisateur($req->id_pointdevente,$req->id_utilisateur);
        return redirect()->route('affectationPage');
    }

    public function achatPage() {
        $laptops = Laptop::v_laptop()->get();
        return view ("admin.achat", compact('laptops'));
    }

    public function achat(Request $req) {
        Achat::saveAchat($req->id_laptop,$req->quantiter,$req->prix);
        $datenow = new DateTime();
        $datenow = $datenow->format("Y-m-d H:i:s");
        StockMagasin::addEntree($req->id_laptop,$req->quantiter,$datenow,$req->prix);
        return redirect()->route("achatPage");
    }

    public function transfertPage() {
//        $laptops = Achat::v_lapstock()->where('stock_restant','!=',0)->get();
        $laptops = StockMagasin::v_lapstockmag()->where('stock_actuel','!=',0)->get();
        $pointedeventes = PointDeVente::all();
        return view('admin.transfert', compact('laptops','pointedeventes'));
    }

    public function transfert(Request $req) {
        TransfertToPV::saveTtoPV($req->id_laptop,$req->id_pointdevente,$req->quantiter,$req->datetransfert);
        /*$datenow = new DateTime();
        $datenow = $datenow->format("Y-m-d H:i:s");*/
        StockMagasin::addSortie($req->id_laptop,$req->quantiter,$req->datetransfert);
        return redirect()->route("transfertPage");
    }

    public function notificationMag() {
        $renvois = Renvoi::getNotif();
//        $transferts = StockPointDeVente::v_lapstockpv($pointdevente->id_pointdevente)->get();
        return view('admin.notification', compact( 'renvois'));
    }

    public function saveReceptionMag(Request $req)
    {
        if ($req->quantiterDeb >= $req->quantiter) {
            ReceptionMag::saveRecMag($req->id_laptop, $req->id_pointdevente, $req->quantiter, $req->datereception,$req->id_utilisateur);
            Renvoi::setEtat0($req->id_renvoi);
            /* $datenow = new DateTime();
             $datenow = $datenow->format("Y-m-d H:i:s");*/
            StockMagasin::addEntree($req->id_laptop, $req->quantiter, $req->datereception, 0);
            if ($req->quantiterDeb!=$req->quantiter) {
                PerteMag::addPerte($req->id_laptop, $req->quantiterDeb - $req->quantiter, $req->datereception,$req->id_pointdevente,$req->id_utilisateur);
            }
        }
        return redirect()->route('notificationMag');
    }

    public function venteParMois(Request $req) {
        $annee = null;
        if($req->annee) $annee = $req->annee;
        $ventes = Vente::venteparmoisparans($annee);
        $ventesG = Vente::venteparmoisparansGlobal($annee);
        return view('admin.venteParMois', compact('ventes', 'ventesG'));
    }

    public function ventesPDF(Request $req)
    {
        $annee = null;
        if($req->annee) $annee = $req->annee;
        $ventes = Vente::venteparmoisparans($annee);
        $pdf = PDF::loadView('admin.pdf.ventesPDF', compact('ventes'));
        return $pdf->stream();
    }

    public function ventesPDFGlobal(Request $req) {
        $annee = null;
        if($req->annee) $annee = $req->annee;
        $ventesG = Vente::venteparmoisparansGlobal($annee);
        $pdf = PDF::loadView('admin.pdf.ventesPDFGlobal', compact('ventesG'));
        return $pdf->stream();
    }

    public  function beneficePDF(Request $req) {
        $annee = null;
        if($req->annee) $annee = $req->annee;
        $benefices = MagasinCentrale::beneficeparmoisparans($annee);
        $pdf = PDF::loadView('admin.pdf.beneficePDF', compact('benefices'));
        return $pdf->stream();
    }

    public function commissionPointDeVente(Request $req) {
        $comms = Commission::commissionPointDeVente($req->id_pointdevente);
        return view('admin.commission', compact('comms'));
    }

    /*----------------------------------------------------------*/

    public function logOut(){
        session()->remove('adminValide');
        Cache::flush();
        return redirect()->route('index');
    }
}
