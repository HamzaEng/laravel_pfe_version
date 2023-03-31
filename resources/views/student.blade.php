@extends('layouts.app')
@section('title', 'etudiant')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card p-2">
                    <div class="card-header">{{ __('Bonjour Mr/Ms  ' . Auth::user()->name) }}</div>
                    <div class="col-md-8 p-2 pt-3">
                        <h4 class="h4">Nom: <small class="text-muted" >{{ Auth::user()->name }} </small> </h4>
                        <h4 class="h4">Prenom: <small class="text-muted" > {{ Auth::user()->prenom }}</small> </h4>
                        <h4 class="h4">Filière: <small class="text-muted" > {{ $branchesAnnee[Auth::user()->filiere] }}</small> </h4>
                        <h4 class="h4">Nombre des etudiants: <small class="text-muted" > {{ $nbrEtudiants }} </small> </h4>
                    </div>
                    <form action=" {{ route('get-notes') }} " method="POST" class="col-md-8 p-2 mt-1">
                        @csrf
                        <div class="form-group mb-2">
                            <select class="form-control" name="annee">
                                <option value="1">{{ Auth::user()->anneeScolaire }} /
                                    {{ Auth::user()->anneeScolaire + 1 }} </option>
                                @if (Auth::user()->annee == 2)
                                    <option value="2">{{ Auth::user()->anneeScolaire + 1 }} /
                                        {{ Auth::user()->anneeScolaire + 2 }}</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <select class="form-control" name="semestre">
                                <option selected>semestre</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="moy">Moyenne génerale</option>
                            </select>
                        </div>
                        <button class="btn btn-success">
                            Trouver
                        </button>
                    </form>
                    @php
                        $table = Session::get('Donnes');
                        $notes = Auth::user()->note;
                        switch (Auth::user()->filiere) {
                            case 'SRI':
                                $tableau = $matieres['SRI'];
                                $tableau1 = $matieres['SRI1'];
                                break;
                            case 'MT':
                                $tableau = $matieres['MT'];
                                $tableau1 = $matieres['MT1'];
                                $tableau2 = $matieres['MT2'];
                                break;
                            default:
                                $tableau = $matieres['MCW'];
                                $tableau1 = $matieres['MCW1'];
                        
                                break;
                        }
                        if ($table == null) {
                            $table['semestre'] = '1';
                            $table['annee'] = 1;
                        }
                        
                        if ($table['annee'] == 2) {
                            $year = 'N';
                        } else {
                            $year = 'P';
                        }
                    @endphp
                    @if ($table['semestre'] != 'P' && $table['semestre'] != 'N')
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Matière</th>
                                    <th scope="col">Examen 1</th>
                                    <th scope="col">Examen 2</th>
                                </tr>
                            </thead>
                            <thead class="thead-dark">
                                @foreach ($matieres['commun'] as $mat => $cof)
                                    <tr>
                                        <td scope="col"> {{ $abreviations[$mat] }} </td>
                                        <td scope="col"> {{ $notes[$mat . '1' . $table['semestre']] }} </td>
                                        <td scope="col"> {{ $notes[$mat . '2' . $table['semestre']] }} </td>
                                    </tr>
                                @endforeach
                            </thead>
                            <tbody>
                                @foreach ($tableau as $mat => $cof)
                                    <tr>
                                        <td scope="row"> {{ $abreviations[$mat] }} </td>
                                        <td scope="row">{{ $notes[$mat . '1' . $table['semestre']] }}</td>
                                        <td scope="row">{{ $notes[$mat . '2' . $table['semestre']] }}</td>
                                    </tr>
                                @endforeach
                                @if ($table['annee'] == 2 && !empty($tableau2))
                                    @foreach ($tableau2 as $mat => $cof)
                                        <tr>
                                            <td scope="row"> {{ $abreviations[$mat] }} </td>
                                            <td scope="row">{{ $notes[$mat . '1' . $table['semestre']] }}</td>
                                            <td scope="row">{{ $notes[$mat . '2' . $table['semestre']] }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    @if ($table['annee'] == 1)
                                        @foreach ($tableau1 as $mat => $cof)
                                            <tr>
                                                <td scope="row"> {{ $abreviations[$mat] }} </td>
                                                <td scope="row">{{ $notes[$mat . '1' . $table['semestre']] }}</td>
                                                <td scope="row">{{ $notes[$mat . '2' . $table['semestre']] }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endif
                            </tbody>
                        </table>
                    @endif
                    @if ($table['semestre'] == 'P' || $table['semestre'] == 'N')
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Matière</th>
                                    <th scope="col">Moyenne</th>
                                    <th scope="col">Note Examen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matieres['commun'] as $mat => $cof)
                                    <tr>
                                        <td scope="row" scope="row"> {{ $abreviations[$mat] }} </td>
                                        <td scope="row" scope="row">{{ @$table['matsNotes'][$mat]}} </td>
                                        <td scope="row" scope="row">{{ $notes[$mat . $year] }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody>
                                @foreach ($tableau as $mat => $cof)
                                    <tr>
                                        <td scope="row"> {{ $abreviations[$mat] }} </td>
                                        <td scope="row"> {{ @$table['matsNotes'][$mat]}}</td>
                                        <td scope="row">{{ $notes[$mat . $year] }} </td>
                                    </tr>
                                @endforeach
                                @if(Auth::user()->annee == 2 && !empty($tableau2))
                                    @foreach ($tableau2 as $mat => $cof)
                                        <tr>
                                            <td scope="row"> {{ $abreviations[$mat] }} </td>
                                            <td scope="row">{{ @$table['matsNotes'][$mat]}}</td>
                                            <td scope="row">{{ $notes[$mat . $year] }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    @if (Auth::user()->annee == 1)
                                        @foreach ($tableau1 as $mat => $cof)
                                            <tr>
                                                <td scope="row"> {{ $abreviations[$mat] }} </td>
                                                <td scope="row">{{ @$table['matsNotes'][$mat]}}</td>
                                                <td scope="row">{{ $notes[$mat . $year] }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endif

                            </tbody>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="col">Moyenne semestre 1</th>
                                        <td scope="row"> 
                                            @if($table['moySem1'] != null)
                                                {{printf("%.2f", $table['moySem1'])}}    
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <th scope="col">Moyenne semestre 2</th>
                                        <td scope="row"> 
                                            @if($table['moySem2'])
                                                {{  printf("%.2f", $table['moySem2']) }}
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <th scope="col">Moyenne d'examen</th>
                                        <td scope="row"> 
                                            @if($table['moyenExam'] != null)
                                                {{ printf("%.2f", $table['moyenExam']) }}   
                                            @endif 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </table>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
