<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
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
        $branchesAnnee = config('variables.branchesAnne');
        $matieres = config('matieres');
        $nbrEtudiants = count(
            DB::table('users')
                ->where('cne', '!=', 'NULL')
                ->get(),
        );

        return view('student', ['abreviations' => $abreviations, 'branchesAnnee' => $branchesAnnee, 'nbrEtudiants' => $nbrEtudiants, 'matieres' => $matieres]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function sumCoffecients($matieres)
    {
        // => get sum of coffs of any branche;
        $total = 0;
        foreach ($matieres as $coff) {
            $total = $total + $coff;
        }
        return $total;
    }

    public function getMoyenneExam($matieres, $semestre, $notes)
    {
        // => get moyenne of examen
        $total = 0;
        $sumCoffs = $this->sumCoffecients($matieres);
        foreach ($matieres as $matiere => $coffecient) {
            if ($notes[$matiere . $semestre] == null) {
                return;
            } else {
                $total += $notes[$matiere . $semestre] * $coffecient;
            }
        }
        $MoyenneExamen = $total / $sumCoffs;
        return $MoyenneExamen;
    }

    public function getMoyenneOfmatieres($annee, $matieres, $notes)
    {
        // => get moyenne  of chaque matieres hhh
        if ($annee == '1') {
            $start = 1;
            $end = 2;
        } else {
            $start = 3;
            $end = 4;
        }
        foreach ($matieres as $mat => $coff) {
            $total = 0;
            for ($sem = $start; $sem <= $end; $sem++) {
                for ($exam = 1; $exam <= 2; $exam++) {
                    if ($notes[$mat . $exam . $sem] == null) {
                        return;
                    } else {
                        $total += $notes[$mat . $exam . $sem];
                    }
                }
            }
            $note[$mat] = $total / 4; // moyenne
        }
        return $note;
    }

    public function getMoyenneOfSemestre($matieres, $semestre, $student)
    {
        //=> get moyenne of semestre
        $sumCoffs = $this->sumCoffecients($matieres);
        $total = 0;
        foreach ($matieres as $mat => $coff) {
            $sum = 0;
            for ($exam = 1; $exam <= 2; $exam++) {
                if ($student[$mat . $exam . $semestre] == null) {
                    return;
                }
                $sum += $student[$mat . $exam . $semestre];
            }
            $total += ($sum / 2) * $coff;
        }
        return $total / $sumCoffs;
    }

    public function getNotes(Request $request)
    {
        $request->validate([
            'annee' => 'required',
            'semestre' => 'required',
        ]);
        $semestre = '1';
        $annee = '1';
        if ($request->input('annee') == '1') {
            if ($request->input('semestre') == 'semestre') {
                $semestre = '1';
            } elseif ($request->input('semestre') != 'moy') {
                $semestre = $request->input('semestre');
            } else {
                $semestre = 'P';
            }
        } else {
            $annee = '2';
            if ($request->input('semestre') == 'semestre' || $request->input('semestre') == '1') {
                $semestre = '3';
            } elseif ($request->input('semestre') != 'moy') {
                $semestre = '4';
            } else {
                $semestre = 'N';
            }
            $annee = 2;
        }
        $matieres = config('matieres');
        switch (Auth::user()->filiere) {
            case 'SRI':
                if ($request->input('annee') == 1) {
                    $subjects = $matieres['Sri1Coffs'];
                } else {
                    $subjects = $matieres['Sri2Coffs'];
                }
                break;
            case 'MT':
                if ($request->input('annee') == 1) {
                    $subjects = $matieres['Mt1Coffs'];
                } else {
                    $subjects = $matieres['Mt2Coffs'];
                }
                break;
            case 'MCW':
                if ($request->input('annee') == 1) {
                    $subjects = $matieres['Mcw1Coffs'];
                } else {
                    $subjects = $matieres['Mcw2Coffs'];
                }
                break;
        }
        $notes = Auth::user()->note;
        $moyenExam = $this->getMoyenneExam($subjects, $semestre, $notes);
        $matsNotes = $this->getMoyenneOfmatieres($annee, $subjects, $notes);
        if ($annee == 1) {
            $moySem1 = $this->getMoyenneOfSemestre($subjects, '1', $notes);
            $moySem2 = $this->getMoyenneOfSemestre($subjects, '2', $notes);
        } else {
            $moySem1 = $this->getMoyenneOfSemestre($subjects, '3', $notes);
            $moySem2 = $this->getMoyenneOfSemestre($subjects, '4', $notes);
        }

        return redirect()
            ->back()
            ->with('Donnes', ['annee' => $annee, 'semestre' => $semestre, 'moyenExam' => $moyenExam, 'matsNotes' => $matsNotes, 'moySem1' => $moySem1, 'moySem2' => $moySem2]);
    }
}
