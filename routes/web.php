<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\MaterielController;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\View;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

#-----------------------------------------------#
#-------------------ADMIN-----------------------#
#-----------------------------------------------#

Route::get('/', [GlobalController::class,'index'])->name('index');

Route::prefix('/admin')->group(function () {

    Route::post('/login',[AdminController::class,'adminAuthentification'])->name('adminAuthentification');

    Route::get('/home', [AdminController::class,'adminHome'])->name('adminHome');
    Route::get('/addPointVentePage', [AdminController::class,'addPointVentePage'])->name('addPointVentePage');
    Route::post('addPointVente',[AdminController::class,'addPointVente'])->name('addPointVente');
    Route::post('/editPV-{id_pointdevente}', [AdminController::class,'editPV'])->name('editPV');
    Route::get('/removePV-{id_pointdevente}', [AdminController::class,'removePV'])->name('removePV');

    Route::prefix('/dur') ->group(function () {
        Route::get('/', [MaterielController::class,'dur'])->name('dur');
        Route::post('/save', [MaterielController::class,'addDur'])->name('addDur');
        Route::post('/edit-{id_dur}', [MaterielController::class,'editDur'])->name('editDur');
        Route::get('/remove-{id_dur}', [MaterielController::class,'removeDur'])->name('removeDur');
    });

    Route::prefix('/ecran') ->group(function () {
        Route::get('/', [MaterielController::class,'ecran'])->name('ecran');
        Route::post('/save', [MaterielController::class,'addEcran'])->name('addEcran');
        Route::post('/edit-{id_ecran}', [MaterielController::class,'editEcran'])->name('editEcran');
        Route::get('/remove-{id_ecran}', [MaterielController::class,'removeEcran'])->name('removeEcran');
    });

    Route::prefix('/processeur') ->group(function () {
        Route::get('/', [MaterielController::class,'processeur'])->name('processeur');
        Route::post('/save', [MaterielController::class,'addProcesseur'])->name('addProcesseur');
        Route::post('/edit-{id_processeur}', [MaterielController::class,'editProcesseur'])->name('editProcesseur');
        Route::get('/remove-{id_processeur}', [MaterielController::class,'removeProcesseur'])->name('removeProcesseur');
    });

    Route::prefix('/ram') ->group(function () {
        Route::get('/', [MaterielController::class,'ram'])->name('ram');
        Route::post('/save', [MaterielController::class,'addRam'])->name('addRam');
        Route::post('/edit-{id_ram}', [MaterielController::class,'editRam'])->name('editRam');
        Route::get('/remove-{id_ram}', [MaterielController::class,'removeRam'])->name('removeRam');
    });


    Route::get('addLaptopPage', [LaptopController::class,'addLaptopPage'])->name('addLaptopPage');
    Route::post('addLaptop', [LaptopController::class,'addLaptop'])->name('addLaptop');
    Route::get('laptops',[LaptopController::class,'listLaptops'])->name('laptops');

    Route::get('affectationPage', [AdminController::class,'affectationUser'])->name('affectationPage');
    Route::post('affecter', [AdminController::class,'affecter'])->name('affecter');

    Route::get('achatPage', [AdminController::class,'achatPage'])->name('achatPage');
    Route::post('achat', [AdminController::class,'achat'])->name('achat');

    Route::get('transfertPage', [AdminController::class, 'transfertPage'])->name('transfertPage');
    Route::post('transfert-{id_laptop}', [AdminController::class, 'transfert'])->name('transfert');

    Route::get('notificationMag', [AdminController::class,'notificationMag'])->name('notificationMag');
    Route::post('saveReceptionMag-{id_laptop}-{id_pointdevente}-{id_renvoi}', [AdminController::class,'saveReceptionMag'])->name('saveReceptionMag');

    Route::get('venteParMois',[AdminController::class,'venteParMois'])->name("venteParMois");
    Route::get('ventesPDF', [AdminController::class,'ventesPDF'])->name('ventesPDFStream');
    Route::get('ventesPDFGlobal', [AdminController::class,'ventesPDFGlobal'])->name('ventesPDFGlobalStream');
    Route::get('beneficePDF', [AdminController::class,'beneficePDF'])->name('beneficePDF');

    Route::get('commissionPointDeVente-{id_pointdevente}' , [AdminController::class,'commissionPointDeVente'])->name('commissionPointDeVente');

    Route::get('/logOut',[AdminController::class,'logOut'])->name('adminlogOut');

});

#-----------------------------------------------#
#-------------------USERS-----------------------#
#-----------------------------------------------#

Route::get('/signupPage', [GlobalController::class,'signUpPage'])->name('signUpPage');

Route::prefix('/pointdevente')->group(function () {

    Route::post('/login', [GlobalController::class,'login'])->name('loginUser');
    Route::post('/signUp', [GlobalController::class,'signUp'])->name('signUp');

    Route::get('/home',[GlobalController::class,'userHomePage'])->name('userHomePage');
    Route::get('notification', [GlobalController::class,'notification'])->name('notification');

    Route::post('reception-{id_laptop}-{id_pointdevente}-{id_transfert_to_pv}', [GlobalController::class,'saveReception'])->name('saveReception');

    Route::get('stock', [GlobalController::class,'stock'])->name('stockPointDeVente');
    Route::post('renvoi-{id_laptop}', [GlobalController::class, 'renvoie'])->name('renvoi');

    Route::post('vendre-{id_laptop}', [GlobalController::class,'saveVente'])->name('saveVente');

    Route::get('ventesEffectuee',[GlobalController::class,'ventesEffectuee'])->name('ventesEffectuee');

    Route::get('/logOut',[GlobalController::class,'logOut'])->name('userlogOut');

});

Route::get('test', [GlobalController::class,'test']);






