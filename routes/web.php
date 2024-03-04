<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\CourrierController;
use App\Http\Controllers\RecueController;
use App\Http\Controllers\DepartController;
use App\Http\Controllers\InterneController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GestionnaireController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\DemandeurController;
use App\Http\Controllers\IndividuelleController;
use App\Http\Controllers\FindividuelleController;
use App\Http\Controllers\CollectiveController;
use App\Http\Controllers\PchargeController;
use App\Http\Controllers\FcollectiveController;
use App\Http\Controllers\BeneficiaireController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SecteurController;
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\NiveauxController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\OperateurController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\NineaController;
use App\Http\Controllers\IngenieurController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\FacturedafController;
use App\Http\Controllers\EtatController;
use App\Http\Controllers\EtatspreviController;
use App\Http\Controllers\BanqueController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\BordereauController;
use App\Http\Controllers\ListeController;
use App\Http\Controllers\TresorController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ArrondissementController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\FilierespecialiteController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\ScolariteController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\AgerouteController;
use App\Http\Controllers\AgeroutelocaliteController;
use App\Http\Controllers\AgeroutezoneController;
use App\Http\Controllers\AgeroutemoduleController;
use App\Http\Controllers\AgerouteindividuelleController;
use App\Http\Controllers\AgerouteformationController;
use App\Http\Controllers\FonctionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TypedirectionController;
use App\Http\Controllers\AntenneController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\IndividuellemotifController;
use App\Http\Controllers\IndividuellerangController;
use App\Http\Controllers\IndividuellenoteController;
use App\Http\Controllers\AgerouteretenuController;
use App\Http\Controllers\AgeroutelisteattenteController;

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

Route::get('/index', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/users/list', [UserController::class, 'list'])->name('users.list');


    Route::get('/profiles/{user}', [ProfileController::class, 'show'])->name('profiles.show');
    Route::get('/profiles/{user}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::patch('/profiles/{user}', [ProfileController::class, 'update'])->name('profiles.update');
    Route::get('/postes/create', [PosteController::class, 'create'])->name('postes.create');
    Route::post('/postes', [PosteController::class, 'store'])->name('postes.store');
    Route::get('/postes/{poste}', [PosteController::class, 'show'])->name('postes.show');
    Route::get('/showFromNotification/{courrier}/{notification}', [CourrierController::class, 'showFromNotification'])->name('courriers.showFromNotification');
    Route::get('/directions.selectemployees', function () {
        return view('directions.selectemployees');
    })->name('directions.selectemployees');
    Route::get('/findividuelles.selectingenieurs', function () {
        return view('findividuelles.selectingenieurs');
    })->name('findividuelles.selectingenieurs');
    Route::get('/courriers/list', [CourrierController::class, 'list'])->name('courriers.list');
    Route::get('/roles/list', [RoleController::class, 'list'])->name('roles.list');
    Route::get('/permissions/list', [PermissionController::class, 'list'])->name('permissions.list');
    Route::get('/recues/list', [RecueController::class, 'list'])->name('recues.list');
    Route::get('/departs/list', [DepartController::class, 'list'])->name('departs.list');
    Route::get('/internes/list', [InterneController::class, 'list'])->name('internes.list');
    Route::get('/administrateurs/list', [AdministrateurController::class, 'list'])->name('administrateurs.list');
    Route::get('/formations/list', [FormationController::class, 'list'])->name('formations.list');
    Route::get('/users/list', [UserController::class, 'list'])->name('users.list');
    Route::get('/employees/list', [EmployeeController::class, 'list'])->name('employees.list');
    Route::get('/gestionnaires/list', [GestionnaireController::class, 'list'])->name('gestionnaires.list');
    Route::get('/directions/list', [DirectionController::class, 'list'])->name('directions.list');
    Route::get('/demandeurs/list', [DemandeurController::class, 'list'])->name('demandeurs.list');
    Route::get('/individuelles/list', [IndividuelleController::class, 'list'])->name('individuelles.list');
    Route::get('/findividuelles/list', [FindividuelleController::class, 'list'])->name('findividuelles.list');
    Route::get('/selectdindividuelles/{id_commune}/{id_module}/{id_form}', [FindividuelleController::class, 'selectdindividuelles'])->name('findividuelles.selectdindividuelles');
    Route::get('adddindividuelles/{id_ind}/{id_form}', [FindividuelleController::class, 'adddindividuelles'])->name('adddindividuelles');
    Route::get('deleteindividuelles/{id_ind}/{id_form}', [FindividuelleController::class, 'deleteindividuelles'])->name('deleteindividuelles');
    Route::get('/collectives/list', [CollectiveController::class, 'list'])->name('collectives.list');
    Route::get('/pcharges/list', [PchargeController::class, 'list'])->name('pcharges.list');
    Route::get('/etablissements/list', [EtablissementController::class, 'list'])->name('etablissements.list');
    Route::get('/fcollectives/list', [FcollectiveController::class, 'list'])->name('fcollectives.list');
    Route::get('/beneficiaires/list', [BeneficiaireController::class, 'list'])->name('beneficiaires.list');
    Route::get('/domaines/list', [DomaineController::class, 'list'])->name('domaines.list');
    Route::get('/diplomes/list', [DiplomeController::class, 'list'])->name('diplomes.list');
    Route::get('/modules/list', [ModuleController::class, 'list'])->name('modules.list');
    Route::get('/secteurs/list', [SecteurController::class, 'list'])->name('secteurs.list');
    Route::get('/activites/list', [ActiviteController::class, 'list'])->name('activites.list');
    Route::get('/projets/list', [ProjetController::class, 'list'])->name('projets.list');
    Route::get('/depenses/list', [DepenseController::class, 'list'])->name('depenses.list');
    Route::get('/niveauxs/list', [NiveauxController::class, 'list'])->name('niveauxs.list');
    Route::get('/options/list', [OptionController::class, 'list'])->name('options.list');
    Route::get('/operateurs/list', [OperateurController::class, 'list'])->name('operateurs.list');
    Route::get('/programmes/list', [ProgrammeController::class, 'list'])->name('programmes.list');
    Route::get('/nineas/list', [NineaController::class, 'list'])->name('nineas.list');
    Route::get('/ingenieurs/list', [IngenieurController::class, 'list'])->name('ingenieurs.list');
    Route::get('/factures/list', [FactureController::class, 'list'])->name('factures.list');
    Route::get('/facturesdafs/list', [FacturedafController::class, 'list'])->name('facturesdafs.list');
    Route::get('/etats/list', [EtatController::class, 'list'])->name('etats.list');
    Route::get('/previsions/list', [EtatspreviController::class, 'list'])->name('previsions.list');
    Route::get('/banques/list', [BanqueController::class, 'list'])->name('banques.list');
    Route::get('/missions/list', [MissionController::class, 'list'])->name('missions.list');
    Route::get('/bordereaus/list', [BordereauController::class, 'list'])->name('bordereaus.list');
    Route::get('/listes/list', [ListeController::class, 'list'])->name('listes.list');
    Route::get('/tresors/list', [TresorController::class, 'list'])->name('tresors.list');
    Route::get('/presentations/list', [PresentationController::class, 'list'])->name('presentations.list');
    Route::get('/departements/list', [DepartementController::class, 'list'])->name('departements.list');
    Route::get('/regions/list', [RegionController::class, 'list'])->name('regions.list');
    Route::get('/arrondissements/list', [ArrondissementController::class, 'list'])->name('arrondissements.list');
    Route::get('/communes/list', [CommuneController::class, 'list'])->name('communes.list');
    Route::get('countscolarite/{annee}', [ScolariteController::class, 'countscolarite'])->name('countscolarite');
    Route::get('countype/{type}/{annee}/{effectif}', [ScolariteController::class, 'countype'])->name('countype');
    Route::get('accord/{pcharge}/{statut}/{avis_dg}', [ScolariteController::class, 'accord'])->name('accord');
    Route::get('nonaccord/{pcharge}/{statut}', [ScolariteController::class, 'nonaccord'])->name('nonaccord');
    Route::get('termine/{pcharge}/{statut}', [PchargeController::class, 'termine'])->name('termine');
    Route::get('countpcharge/{etablissement}', [EtablissementController::class, 'countpcharge'])->name('countpcharge');
    Route::get('etabcountype/{type}/{etablissement}/{effectif}', [EtablissementController::class, 'etabcountype'])->name('etabcountype');
    Route::get('countscolaritenbre/{cin}', [PchargeController::class, 'countscolaritenbre'])->name('countscolaritenbre');
    Route::get('diffage/{age}/{id}', [PchargeController::class, 'diffage'])->name('diffage');
    Route::get('indetails/{id}', [IndividuelleController::class, 'details'])->name('indetails');
    Route::get('coldetails/{id}', [CollectiveController::class, 'details'])->name('coldetails');
    Route::get('pdetails/{id}/{pcharge}', [PchargeController::class, 'details'])->name('pdetails');
    Route::get('attente/{statut}', [PchargeController::class, 'attente'])->name('attente');
    Route::get('terminer/{statut}', [PchargeController::class, 'terminer'])->name('terminer');
    Route::get('rejeter/{statut}', [PchargeController::class, 'rejeter'])->name('rejeter');
    Route::get('accorder/{statut}', [PchargeController::class, 'accorder'])->name('accorder');
    Route::get('/ageroutes/list', [AgerouteController::class, 'list'])->name('ageroutes.list');
    Route::get('/ageroutelocalites/list', [AgeroutelocaliteController::class, 'list'])->name('ageroutelocalites.list');
    Route::get('/ageroutezones/list', [AgeroutezoneController::class, 'list'])->name('ageroutezones.list');
    Route::get('/ageroutemodules/list', [AgeroutemoduleController::class, 'list'])->name('ageroutemodules.list');
    Route::get('/agerouteindividuelles/list', [AgerouteindividuelleController::class, 'list'])->name('agerouteindividuelles.list');
    Route::get('listerparlocalite/{projet}/{localite}', [AgeroutelocaliteController::class, 'listerparlocalite'])->name('listerparlocalite');
    Route::get('listerparzone/{projet}/{zone}', [AgeroutezoneController::class, 'listerparzone'])->name('listerparzone');
    Route::get('listerparmodulelocalite/{projet}/{localite}/{module}', [AgerouteindividuelleController::class, 'listerparmodulelocalite'])->name('listerparmodulelocalite');
    Route::get('listerparmodulelocalites/{projet}/{localite}/{module}', [AgerouteindividuelleController::class, 'listerparmodulelocalites'])->name('listerparmodulelocalites');
    Route::get('listerparmodulelocalitesaccepter/{projet}/{localite}/{module}', [AgerouteindividuelleController::class, 'listerparmodulelocalitesaccepter'])->name('listerparmodulelocalitesaccepter');
    Route::get('listerparmodulezone/{projet}/{zone}/{module}', [AgerouteindividuelleController::class, 'listerparmodulezone'])->name('listerparmodulezone');
    Route::get('listerparmodulezoneretenues/{projet}/{zone}/{module}', [AgerouteindividuelleController::class, 'listerparmodulezoneretenues'])->name('listerparmodulezoneretenues');
    Route::get('listercandidatzonevalidesexes/{projet}/{zone}/{module}/{civilite}', [AgerouteindividuelleController::class, 'listercandidatzonevalidesexes'])->name('listercandidatzonevalidesexes');
    Route::get('listercandidatlocalitevalidesexes/{projet}/{zone}/{module}/{civilite}', [AgerouteindividuelleController::class, 'listercandidatlocalitevalidesexes'])->name('listercandidatlocalitevalidesexes');
    Route::get('listercandidatzonevalidepmr/{projet}/{zone}/{module}/{pmr}', [AgerouteindividuelleController::class, 'listercandidatzonevalidepmr'])->name('listercandidatzonevalidepmr');
    Route::get('listercandidatzonevalidevictimesocial/{projet}/{zone}/{module}/{victimesocial}', [AgerouteindividuelleController::class, 'listercandidatzonevalidevictimesocial'])->name('listercandidatzonevalidevictimesocial');
    Route::get('candidatlocalite/{projet}/{localite}', [AgeroutelocaliteController::class, 'candidatlocalite'])->name('candidatlocalite');
    Route::get('candidatlocalitevalides/{projet}/{localite}', [AgeroutelocaliteController::class, 'candidatlocalitevalides'])->name('candidatlocalitevalides');
    Route::get('candidatlocalitevalidesattente/{projet}/{localite}', [AgeroutelocaliteController::class, 'candidatlocalitevalidesattente'])->name('candidatlocalitevalidesattente');
    Route::get('candidatzonevalidesattente/{projet}/{zone}', [AgeroutezoneController::class, 'candidatzonevalidesattente'])->name('candidatzonevalidesattente');
    Route::get('candidatzonevalides/{projet}/{zone}', [AgeroutelocaliteController::class, 'candidatzonevalides'])->name('candidatzonevalides');
    Route::get('candidatmodule/{projet}/{module}', [AgeroutemoduleController::class, 'candidatmodule'])->name('candidatmodule');
    Route::get('candidatmoduleaccepter/{projet}/{module}', [AgeroutemoduleController::class, 'candidatmoduleaccepter'])->name('candidatmoduleaccepter');
    Route::get('candidatmoduleattente/{projet}/{module}', [AgeroutemoduleController::class, 'candidatmoduleattente'])->name('candidatmoduleattente');
    Route::get('candidatmodulerejeter/{projet}/{module}', [AgeroutemoduleController::class, 'candidatmodulerejeter'])->name('candidatmodulerejeter');
    Route::get('candidatmodulelisteattente/{projet}/{module}', [AgeroutemoduleController::class, 'candidatmodulelisteattente'])->name('candidatmodulelisteattente');
    Route::get('candidatzone/{projet}/{localite}', [AgeroutezoneController::class, 'candidatzone'])->name('candidatzone');
    Route::get('agerouteattente/{individuelles}/{statut}/{module}', [AgerouteindividuelleController::class, 'agerouteattente'])->name('agerouteattente');
    Route::get('ageroutelisteattente/{individuelles}/{statut}/{module}', [AgerouteindividuelleController::class, 'ageroutelisteattente'])->name('ageroutelisteattente');
    Route::get('agerouteencours/{individuelles}/{statut}/{module}', [AgerouteindividuelleController::class, 'agerouteencours'])->name('agerouteencours');
    Route::get('agerouterejeter/{individuelles}/{statut}/{module}', [AgerouteindividuelleController::class, 'agerouterejeter'])->name('agerouterejeter');
    Route::get('agerouteretenues/{individuelles}/{statut}/{module}', [AgerouteindividuelleController::class, 'agerouteretenues'])->name('agerouteretenues');
    Route::get('agerouteterminer/{individuelles}/{statut}/{module}', [AgerouteindividuelleController::class, 'agerouteterminer'])->name('agerouteterminer');
    Route::get('ageroutepresel/{module}/{statut}/{individuelle}', [AgerouteindividuelleController::class, 'ageroutepresel'])->name('ageroutepresel');
    Route::get('moduleindividuelle/{projet}/{individuelle}', [AgerouteindividuelleController::class, 'moduleindividuelle'])->name('moduleindividuelle');
    Route::get('/agerouteformations/list', [AgerouteformationController::class, 'list'])->name('formations.list');
    Route::get('/agerouteformations.selectoperateurs', function () {
        return view('agerouteformations.selectoperateurs');
    })->name('agerouteformations.selectoperateurs');

    Route::get('formationcandidats/{module}/{projet}/{programme}/{findividuelle}', [AgerouteformationController::class, 'formationcandidats'])->name('formationcandidats');
    Route::get('formationcandidatsadd/{individuelle}/{findividuelle}', [AgerouteformationController::class, 'formationcandidatsadd'])->name('formationcandidatsadd');
    Route::get('formationcandidatsdelete/{individuelle}/{findividuelle}', [AgerouteformationController::class, 'formationcandidatsdelete'])->name('formationcandidatsdelete');
    Route::get('individuelleformations/{individuelle}', [AgerouteformationController::class, 'individuelleformations'])->name('individuelleformations');
    Route::get('individuelleformationsenlever/{individuelle}', [AgerouteformationController::class, 'individuelleformationsenlever'])->name('individuelleformationsenlever');
    Route::get('candidatspmr/{localite}/{projet}/{handicap}', [AgerouteindividuelleController::class, 'candidatspmr'])->name('candidatspmr');
    Route::get('candidatspmrs/{localite}/{projet}/{handicap}/{module}/{sexe}', [AgerouteindividuelleController::class, 'candidatspmrs'])->name('candidatspmrs');
    Route::get('candidatsvs/{localite}/{projet}/{victimes}', [AgerouteindividuelleController::class, 'candidatsvs'])->name('candidatsvs');
    Route::get('candidatsvss/{localite}/{projet}/{handicap}/{module}/{sexe}/{victime}', [AgerouteindividuelleController::class, 'candidatsvss'])->name('candidatsvss');
    Route::get('candidatses/{localite}/{projet}/{handicap}/{module}/{sexe}/{victime}/{situation_eco}', [AgerouteindividuelleController::class, 'candidatses'])->name('candidatses');
    Route::get('diplomes/{localite}/{projet}/{handicap}/{module}/{sexe}/{victime}/{situation_eco}/{diplomes}', [AgerouteindividuelleController::class, 'diplomes'])->name('diplomes');
    Route::get('diplomespros/{localite}/{projet}/{handicap}/{module}/{sexe}/{victime}/{situation_eco}/{diplomespros}', [AgerouteindividuelleController::class, 'diplomespros'])->name('diplomespros');
    Route::get('candidatse/{localite}/{projet}/{situation_eco}', [AgerouteindividuelleController::class, 'candidatse'])->name('candidatse');
    Route::get('statutageroute/{localite}/{projet}/{statut}', [AgerouteindividuelleController::class, 'statutageroute'])->name('statutageroute');
    Route::get('statut_ageroute/{localite}/{projet}/{statut}', [AgerouteindividuelleController::class, 'statut_ageroute'])->name('statut_ageroute');
    Route::get('statutageroutepmr/{localite}/{projet}/{statut}/{pmr}', [AgerouteindividuelleController::class, 'statutageroutepmr'])->name('statutageroutepmr');
    Route::get('statutageroutesvs/{localite}/{projet}/{statut}/{svs}', [AgerouteindividuelleController::class, 'statutageroutesvs'])->name('statutageroutesvs');
    Route::get('ageroutesexe/{sexe}/{localite}/{projet}', [AgerouteindividuelleController::class, 'ageroutesexe'])->name('ageroutesexe');
    Route::get('ageroutesexes/{sexe}/{localite}/{projet}/{module}', [AgerouteindividuelleController::class, 'ageroutesexes'])->name('ageroutesexes');
    Route::get('formationsannee/{findividuelle}/{annee}', [AgerouteformationController::class, 'formationsannee'])->name('formationsannee');
    Route::get('formationsattestations/{findividuelle}/{attestation}', [AgerouteformationController::class, 'formationsattestations'])->name('formationsattestations');
    Route::get('formationsstatut/{findividuelle}/{statut}', [AgerouteformationController::class, 'formationsstatut'])->name('formationsstatut');
    Route::get('createdby/{createdby}', [AgerouteindividuelleController::class, 'createdby'])->name('createdby');

    Route::get('fichesuivieval/{module}/{projet}/{programme}/{findividuelle}', [AgerouteformationController::class, 'fichesuivieval'])->name('fichesuivieval');
    Route::get('listecandidatacceptes/{projet}/{localite}/{module}', [AgerouteformationController::class, 'listecandidatacceptes'])->name('listecandidatacceptes');
    Route::get('listecandidatretenus/{projet}/{zone}/{module}', [AgerouteformationController::class, 'listecandidatretenus'])->name('listecandidatretenus');
    Route::get('pvevaluation/{module}/{projet}/{programme}/{findividuelle}', [FindividuelleController::class, 'pvevaluation'])->name('pvevaluation');

    Route::get('ajouternote/{individuelle}/{findividuelle}', [AgerouteformationController::class, 'ajouternote'])->name('ajouternote');
    Route::get('feuille/{id}', [ListeController::class, 'feuille'])->name('feuille');

    Route::get('create-pdf-file', [PchargeController::class, 'index'])->name('create-pdf-file');

    Route::get('/filieres/list', [FiliereController::class, 'list'])->name('filieres.list');
    Route::get('/filierespecialites/list', [FilierespecialiteController::class, 'list'])->name('filierespecialites.list');
    Route::get('/specialites/list', [SpecialiteController::class, 'list'])->name('specialites.list');
    Route::post('/comments/{courrier}', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/commentReply/{comment}', [CommentController::class, 'storeCommentReply'])->name('comments.storeReply');

    Route::get('/pcharges.selectetablissements', function () {
        return view('pcharges.selectetablissements');
    })->name('pcharges.selectetablissements');
    Route::get('/etablissements.selectefilieres', function () {
        return view('etablissements.selectefilieres');
    })->name('etablissements.selectefilieres');

    Route::get('recuimputations/{id}', [RecueController::class, 'recuimputations'])->name('recuimputations');
    Route::get('departimputations/{id}', [DepartController::class, 'departimputations'])->name('departimputations');
    Route::post('/arrive/fetch', [RecueController::class, 'fetch'])->name('arrive.fetch');
    Route::post('/fonction/fetch', [FonctionController::class, 'fetch'])->name('fonction.fetch');
    Route::post('/employe/fetch', [EmployeeController::class, 'fetch'])->name('employe.fetch');
    Route::post('/commune/fetch', [OperateurController::class, 'fetch'])->name('commune.fetch');
    Route::get('recufactures/{id}', [RecueController::class, 'recufactures'])->name('recufactures');
    Route::get('departfactures/{id}', [DepartController::class, 'departfactures'])->name('departfactures');
    Route::get('courrierimputations/{type}/{id}', [CourrierController::class, 'courrierimputations'])->name('courrierimputations');
    Route::post('/courrier/fetch', [CourrierController::class, 'fetch'])->name('courrier.fetch');


    Route::get('moduleoperateurs/{id}', [OperateurController::class, 'moduleoperateurs'])->name('moduleoperateurs');
    Route::post('/moduleoperateur/fetche', [OperateurController::class, 'fetche'])->name('moduleoperateur.fetche');
    Route::get('suivieval/{module}/{projet}/{programme}/{findividuelle}', [FindividuelleController::class, 'suivieval'])->name('suivieval');

    Route::get('beneficiairesformation/{module}/{projet}/{programme}/{findividuelle}', [FindividuelleController::class, 'beneficiairesformation'])->name('beneficiairesformation');

    Route::get('preview', [PDFController::class,  'preview']);
    Route::get('download', [PDFController::class, 'download'])->name('download');
    Route::get('contrat/{pcharges}', [PchargeController::class, 'contrat'])->name('contrat');
    Route::get('lettre/{pcharges}', [PchargeController::class, 'lettre'])->name('lettre');



    Route::resources([
        'courriers'                     =>      CourrierController::class,
        'recues'                        =>      RecueController::class,
        'departs'                       =>      DepartController::class,
        'internes'                      =>      InterneController::class,
        'administrateurs'               =>      AdministrateurController::class,
        'formations'                    =>      FormationController::class,
        'users'                         =>      UserController::class,
        'employees'                     =>      EmployeeController::class,
        'gestionnaires'                 =>      GestionnaireController::class,
        'directions'                    =>      DirectionController::class,
        'services'                      =>      ServiceController::class,
        'demandeurs'                    =>      DemandeurController::class,
        'individuelles'                 =>      IndividuelleController::class,
        'findividuelles'                =>      FindividuelleController::class,
        'collectives'                   =>      CollectiveController::class,
        'pcharges'                      =>      PchargeController::class,
        'fcollectives'                  =>      FcollectiveController::class,
        'domaines'                      =>      DomaineController::class,
        'diplomes'                      =>      DiplomeController::class,
        'modules'                       =>      ModuleController::class,
        'secteurs'                      =>      SecteurController::class,
        'activites'                     =>      ActiviteController::class,
        'projets'                       =>      ProjetController::class,
        'depenses'                      =>      DepenseController::class,
        'niveauxs'                      =>      NiveauxController::class,
        'options'                       =>      OptionController::class,
        'operateurs'                    =>      OperateurController::class,
        'programmes'                    =>      ProgrammeController::class,
        'nineas'                        =>      NineaController::class,
        'ingenieurs'                    =>      IngenieurController::class,
        'factures'                      =>      FactureController::class,
        'facturesdafs'                  =>      FacturedafController::class,
        'etats'                         =>      EtatController::class,
        'etatsprivis'                   =>      EtatspreviController::class,
        'banques'                       =>      BanqueController::class,
        'missions'                      =>      MissionController::class,
        'bordereaus'                    =>      BordereauController::class,
        'listes'                        =>      ListeController::class,
        'tresors'                       =>      TresorController::class,
        'departements'                  =>      DepartementController::class,
        'regions'                       =>      RegionController::class,
        'arrondissements'               =>      ArrondissementController::class,
        'communes'                      =>      CommuneController::class,
        'roles'                         =>      RoleController::class,
        'categories'                    =>      CategoryController::class,
        'typedirections'                =>      TypedirectionController::class,
        'fonctions'                     =>      FonctionController::class,
        'permissions'                   =>      PermissionController::class,
        'etablissements'                =>      EtablissementController::class,
        'filieres'                      =>      FiliereController::class,
        'filierespecialites'            =>      FilierespecialiteController::class,
        'specialites'                   =>      SpecialiteController::class,
        'scolarites'                    =>      ScolariteController::class,
        'antennes'                      =>      AntenneController::class,
        'ageroutes'                     =>      AgerouteController::class,
        'ageroutelocalites'             =>      AgeroutelocaliteController::class,
        'ageroutezones'                 =>      AgeroutezoneController::class,
        'ageroutemodules'               =>      AgeroutemoduleController::class,
        'agerouteindividuelles'         =>      AgerouteindividuelleController::class,
        'agerouteindividuellesmotif'    =>      IndividuellemotifController::class,
        'agerouteindividuellesrang'     =>      IndividuellerangController::class,
        'agerouteformations'            =>      AgerouteformationController::class,
        'individuellenotes'             =>      IndividuellenoteController::class,
        'individuelleretenus'           =>      AgerouteretenuController::class,
        'individuelleattentes'          =>      AgeroutelisteattenteController::class,
    ]);
});




require __DIR__ . '/auth.php';
