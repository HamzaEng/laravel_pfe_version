<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ImportEtudiant;
use App\Models\note;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ProfController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
         $this->middleware('auth');
    }

    public function index()
    {
        $abreviations = config('variables.abreviations');
        $tableau = [];
        for($i = 1; $i< 5; $i++) {
            if(Auth::user()->{'mat'.$i} !== NULL) {
                $mat = Auth::user()->{"mat".$i};
                $tableau[$mat] = $abreviations[$mat];
            } 
        }
        
        return view('prof', ['matieres' => $tableau]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'semestre' => 'required',
            'examen' => 'required',
            'notes' => 'required|mimes:xlsx,xls',
            'matiere' => 'required'
        ]);
        $rows = Excel::toArray(new ImportEtudiant , $request->file('notes'));
        $semestre = $request->input('semestre');
        $matiere = $request->input('matiere');
        $examen = $request->input('examen');
        for($i=0; $i<count($rows[0]); $i++) {
            $note = new note();
            @$id = User::where('cne', $rows[0][$i][2])->first()->id;
            @$etudiant = note::where('etudiant_id',$rows[0][$i][2])->first()->id;
            if($id !== null ) {
               if($etudiant !== null ){
                    $etudiant_note = note::find($etudiant);
               } else
                    $etudiant_note = $note;
                $etudiant_note->etudiant_id = $rows[0][$i][2];
                if($examen != 'Examen' && $matiere != 'Choisir' && $semestre != 'Semestre' ){
                    if($examen !== 'N' && $examen !== 'P' ) {
                        $etudiant_note->{$matiere.$examen.$semestre} = $rows[0][$i][3];
                    }else {
                        $etudiant_note->{$matiere.$examen} = $rows[0][$i][3];
                    }               

                }else
                    return redirect()->back()->with('alert-prof', 'Invalide choix');
               
            }else
                    return redirect()->back()->with('alert-prof', 'Code massar n\'est pat trouvé ');
            $etudiant_note->save();
        }
        
        return redirect()->back()->with('alert-prof', 'les notes sont insirés successevement !');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
