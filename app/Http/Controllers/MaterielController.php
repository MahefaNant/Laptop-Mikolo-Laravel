<?php

namespace App\Http\Controllers;

use App\Models\Dur;
use App\Models\Ecran;
use App\Models\Processeur;
use App\Models\Ram;
use Illuminate\Http\Request;

class MaterielController extends Controller
{

    public function adminIsValide() {
        $adminValide = session('adminValide');
        if($adminValide) {
            return 1;
        }
        return 0;
    }

    /*--------------page----------------------*/
    public function processeur(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        $processeurs = Processeur::getAll();
        return view('admin.processeur', compact('processeurs'));
    }

    public function dur(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        $durs = Dur::getAll();
        return view('admin.dur', compact('durs'));

    }
    public function ecran(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        $ecrans = Ecran::getAll();
        return view('admin.ecran', compact('ecrans'));
    }

    public function ram(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        $rams = Ram::getAll();
        return view('admin.ram', compact('rams'));
    }

    /*--------------ADD----------------------*/
    public function addProcesseur(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        Processeur::addProc($req->processeur,$req->description);
        $success = "Ajout avec succes";
        return redirect()->route("processeur", compact('success'));
    }

    public function addDur(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        Dur::addDur($req->dur,$req->description);
        $success = "Ajout avec succes";
        return redirect()->route("dur", compact('success'));
    }

    public function addEcran(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        Ecran::addEcran($req->pouce,$req->description);
        $success = "Ajout avec succes";
        return redirect()->route("ecran", compact('success'));
    }

    public function addRam(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        Ram::addRam($req->ram,$req->description);
        $success = "Ajout avec succes";
        return redirect()->route("ram", compact('success'));
    }

    /*--------------EDIT----------------------*/
    public function editProcesseur(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        Processeur::editProc($req->id_processeur,$req->processeur,$req->description);
        return redirect()->route("processeur");
    }

    public function editDur(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        Dur::editDur($req->id_dur,$req->dur,$req->description);
        return redirect()->route("dur");
    }

    public function editEcran(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        Ecran::editEcran($req->id_ecran,$req->pouce,$req->description);
        return redirect()->route("ecran");
    }

    public function editRam(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        Ram::editRam($req->id_ram,$req->ram,$req->description);
        return redirect()->route("ram");
    }
    /*--------------REMOVE----------------------*/
    public function removeProcesseur(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        Processeur::removeProc($req->id_processeur);
        return redirect()->route("processeur");
    }

    public function removeDur(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        Dur::removeDur($req->id_dur);
        return redirect()->route("dur");
    }

    public function removeEcran(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        Ecran::removeEcran($req->id_ecran);
        return redirect()->route("ecran");
    }

    public function removeRam(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        Ram::removeRam($req->id_ram);
        return redirect()->route("ram");
    }
}
