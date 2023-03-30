<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\candidatExport;
use App\Exports\exportEtudiant;
use App\Exports\exportNotes;
use App\Exports\exportProf;
use Illuminate\Support\Facades\Hash;
use App\Imports\ImportEtudiant;
use App\Models\note;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin');
    }

    public function exportCandidats(Request  $request) 
    {   $export = new candidatExport;
        return Excel::download($export, 'candidats.xlsx');
    }

    public function exportProfs(Request $request)
    {
        $export = new exportProf;
        return Excel::download($export, 'profs.xlsx');
    }

    public function exportEtudiants(Request $request)
    {
        $export = new exportEtudiant;
        return Excel::download($export, 'etudiants.xlsx');
    }

    public function exportNotes(Request $request)
    {
        $filiere = $request->input('filiere');
        $semestre = $request->input('semestre');
        if($semestre == 'semestre')
            return redirect()->back()->with('alert-notes', 'votre choix invalides');

        $matieres = config('matieres');
        switch ($filiere) {
            case 'SRI':
                if ($semestre == 1 || $semestre == 2) {
                    $subjects = $matieres['Sri1Coffs'];
                } else {
                    $subjects = $matieres['Sri2Coffs'];
                }
                break;
            case 'MT':
                if ($semestre == 1 || $semestre == 2) {
                    $subjects = $matieres['Mt1Coffs'];
                } else {
                    $subjects = $matieres['Mt2Coffs'];
                }
                break;
            case 'MCW':
                if ($semestre == 1 || $semestre == 2) {
                    $subjects = $matieres['Mcw1Coffs'];
                } else {
                    $subjects = $matieres['Mcw2Coffs'];
                }
                break;
            default: return redirect()->back()->with('alert-notes', 'votre choix invalides');
        }
        $titles[0] = 'nom';
        $titles[1] = 'prenom'; 
        $titles[2] = 'cne';
        foreach($subjects as $mat => $val) {
            for($i = 1; $i <= 2; $i++) {
                $mats[] = $mat.$i.$semestre;
                $titles[] = $mat.$i.$semestre;
            }
        }
        $points = DB::table('notes')->join('users', 'etudiant_id', '=', 'cne')->select(['name', 'prenom','etudiant_id', ...$mats])->get();
        $points->prepend($titles);
        $notes = new exportNotes($points);
        return Excel::download($notes, 'notes.xlsx');
    }

    public function importEtudiants(Request $request)
    {
        $request->validate([
            'filiere' => 'required',
            'annee' => 'required',
            'etudiant' =>'required|mimes:xlsx,xls',
        ]);
        $rows = Excel::toArray(new ImportEtudiant, $request->file('etudiant'));
        if($request->input('filiere') != 'filiere') {
            for($i=0; $i<count($rows[0]); $i++) { 
                $user = new User();                   
                $user->name = $rows[0][$i][0];
                $user->prenom = $rows[0][$i][1];
                $user->cne = $rows[0][$i][2];
                $user->email = $rows[0][$i][3];
                $user->password = Hash::make($rows[0][$i][4]);
                $user->anneeScolaire = date('Y');
                $user->filiere = $request->input('filiere');
                $user->annee = $request->input('annee');
                if($user->annee == '1') {
                    @$userId = User::where('cne', $user->cne)->first()->id;
                    if($userId)
                        return redirect()->back()->with('alert-admin','Etudianst existes déja');
                    else
                        $user->save();
                }else {
                    @$etudiant = User::where('cne', $user->cne)->first()->id;
                    if($etudiant) { 
                        $USER = User::find($etudiant);
                        $USER->annee = "2";
                        $USER->save();
                    }else{
                        return redirect()->back()->with('alert-admin','Etudiants ne sont pas trouvés dans la premier anne');
                    }
                }
            }
            return redirect()->back()->with('alert-admin', 'les donnes sont inséres succesvement');
    
        }else
            return redirect()->back()->with('alert-admin','Vous devez choisir la filiere ');

    } 

    public function upload(Request $request)
    {
        $request->validate(
            ['upload' =>'required|mimes:pdf']
        );
        $files = glob(public_path()."/pdf/*.*");
        foreach($files as $file){
            unlink($file);
        }
        $fielName = $request->file('upload')->getClientOriginalName();
        $request->file('upload')->move(public_path('pdf'), $fielName);
        return redirect()->back()->with('annonce', 'fichier est chargé successevement');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'cne' => 'required|string|max:12'
        ]);
        @$idEtudiant = User::where('cne', $request->input('cne'))->first()->id;
        if($idEtudiant) {
            User::find($idEtudiant)->delete();
            return redirect()->back()->with('alert-etudiant', 'etudiant a été supprimé successevement!');
        }else
            return redirect()->back()->with('alert-etudiant', 'Etudiant n\'est pas existe!');

    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'cin' => ['required', 'string', 'max:12'],
            'tel' => ['required', 'numeric', 'digits:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $abreviations = config('variables.abreviations');
        $matieres = [];
        $index = 0;
        $i = 0;
        foreach($abreviations as $name=>$val){
            if($request->input($name) !== null){
                $matieres[$index] = $request->input($name);
                $index++;
            }
        }
                
        $user = new User();
        $user->name = $request->input('name');
        $user->prenom = $request->input('prenom');
        $user->tel = $request->input('tel');
        $user->cin = $request->input('cin');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->isProf = true;
        foreach($matieres as $mat ) {
            $i++;
            $user->{'mat'.$i} = $mat;
        }

        $user->save();
        return redirect()->back()->with('add-prof','le professeur a été ajouté successevement !');
    }
    public function destroyProf(Request $request) 
    {
        $request->validate([
            'CIN' => 'required|string|max:10'
        ]);
        @$prof = DB::table('users')->select('id')->where('cin', '=', $request->input('CIN'))->get();
        $idProf = @$prof[0]->id;
        if(@$idProf != null) {
            User::find(@$idProf[0]->id)->delete();
            return redirect()->back()->with('alert-delete', 'Professeur a été supprimé successevement!');
        }else
            return redirect()->back()->with('alert-delete', 'Professeur n\'est pas existe!');

    }

    public function getCarteEtudiant(Request $request)
    {
        $abreviations = config('variables.branchesAnne');
        $request->validate([
            'CNE' => 'required|string|max:12'
        ]);
        @$idEtudiant = User::where('cne', $request->input('CNE'))->first()->id;
        if($idEtudiant) {
            $user = User::find($idEtudiant);
            $data = [
                'name' => $user->name,
                'prenom' => $user->prenom,
                'dateNs' => $user->dateNs,
                'lieuNs' => $user->lieuNs, 
                'filiere' =>$abreviations[$user->filiere],
                'cne' => $user->cne,
                'email' => $user->email,
                'tel' => $user->tel
            ];
            $pdf = PDF::loadView('index', $data);
            return $pdf->download('carte_etudiant.pdf');
        }else
            return redirect()->back()->with('alert-etudiant', 'Etudiant n\'est pas existe!');

    }
}
