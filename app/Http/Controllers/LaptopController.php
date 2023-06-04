<?php

namespace App\Http\Controllers;

use App\Models\Dur;
use App\Models\Ecran;
use App\Models\Laptop;
use App\Models\Marque;
use App\Models\Processeur;
use App\Models\Ram;
use Illuminate\Http\Request;

class LaptopController extends Controller
{
    public function adminIsValide() {
        $adminValide = session('adminValide');
        if($adminValide) {
            return 1;
        }
        return 0;
    }

    public function addLaptopPage() {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        $marques = Marque::all();
        $processeurs = Processeur::all();
        $durs = Dur::all();
        $ecrans = Ecran::all();
        $rams = Ram::all();
        $data = compact('marques','processeurs','durs','ecrans','rams');
        return view('admin.addLaptopPage', $data);
    }

    public function addLaptop(Request $req) {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        Laptop::saveLaptop($req->id_marque, $req->modele, $req->id_processeur,$req->id_ram,$req->id_ecran,$req->id_dur,$req->prix);
        return redirect()->route('addLaptopPage');
    }

    public function listLaptops() {
        if($this->adminIsValide()==0) {
            return redirect()->route("index");
        }
        $laptops = Laptop::getAll();
        return view('admin.laptops', compact('laptops'));
    }

}
