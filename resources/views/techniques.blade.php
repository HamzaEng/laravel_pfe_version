@php
    
$commun = array(
  'ARAB' => 10,
  'FRAN' => 10,
  'ENGL' => 10,
  'COMM' => 10
);

$SRI = array(
  'SYST' => 30,
  'RESE' => 30,
  'DEVE' => 15,
  'LINU' => 20,
  'MATH' => 15
);

$SRI1 = array(
  'ARCH' => 20,
  'ECON' => 10
);

$MT = array(
  'ESPG' => 10,
  'IFGT' => 10,
  'DECG' => 30
);

$MT1 = array(
  'ORGT' => 30,
  'MRKF' => 25,
  'OGCG' => 40,
  'MATH' => 10
);

$MT2 = array(
  'DECT' => 30,
  'SGRH' => 20,
  'MKCT' => 30,
  'CDG' => 30
);

$MCW = array(
  'MATH'=>20,
  'IFCM'=> 30,
  'ANPR'=> 30,
  'DEVM'=>30,
  'SIER'=> 30
);

$MCW1 = array( 
  'ECON'=>10
);


$Sri1Coffs = array_merge($commun, $SRI, $SRI1);
$Sri2Coffs = array_merge($commun, $SRI);
$Mt1Coffs = array_merge($commun, $MT, $MT1);
$Mt2Coffs = array_merge($commun, $MT,$MT2);
$Mcw1Coffs = array_merge($commun, $MCW, $MCW1);
$Mcw2Coffs = array_merge($commun, $MCW);

class Data{
    static public function getAbreviate($abreviateName, $names){
        return $names[$abreviateName];
    }
}

$abreviations = [
    'RESE'=>'Reseau informatique',
    'SYST'=>'Systeme d\'expoiltation',
    'DEVE'=>'Developpement informatique',
    'LINU'=>'System Gnu/Linux',
    'MATH'=>'Mathematique',
    'ENGL'=>'Langue anglais',
    'FRAN'=>'Langue français',
    'COMM'=>'Communication',
    'ECON'=>'Economie',
    'ARCH'=>'Archeticture',
    'ARAB'=>'Langue arabe',
    'ESPG'=>'Langue ESPAGNOL',
    'IFGT'=>'Informatique de gestion',
    'DECG'=>'Droit et Economie generale',
    'ORGT'=>'Les organisations touristique',
    'MRKF'=>'Marketing Fondamental',
    'OGCG'=>'Outils de gestion et comptabilite generale',
    'DECT'=>'Droit et economie touristique',
    'SGRH'=>'Strategies et GRH',
    'MKCT'=>'MARKETING ET COMMERCIALISATION TOURISTIQUE',
    'CDG'=>'Contole de gestoin',
    'IFCM'=>'infographie et conception multimedia',
    'ANPR'=>'Analyse et programmation',
    'DEVM'=>'Developpement multimedia',
    'SIER'=>'Systeme informatique et reseaux'
];

$branchesAnne = [
    'SRI1'=>'Premier année système et réseau informatique',
    'SRI2'=>'Deuxieme année système et réseaur informatique',
    'MT1'=>'Premier année management et touristique',
    'MT2'=>'Deuxieme année management et tourstique',
    'MCW1'=>'Premiere année modélisation et conception web',
    'MCW2'=>'Deuxieme année modélisation et conception web'
];
@endphp

<div id="Techniques">
    <h5 class="red">Pour la filiere SRI: </h5>
    @foreach ($SRI as $mat => $cof) 
        @if ($mat != "MATH")  
            <div class="form-check">
                <label class="form-check-label" for="{{ $mat }}">{{ $abreviations[$mat] }}</label>
                <input class="form-check-input" type="checkbox" name="{{ $mat }}" id="{{ $mat }}" value="{{ $mat }}">
            </div>
        @endif
    @endforeach
    @foreach ($SRI1 as $mat => $cof) 
        @if ($mat != "ECON") 
            <div class="form-check">
                <label class="form-check-label" for="{{ $mat }}">{{ $abreviations[$mat] }}</label>
                <input class="form-check-input" type="checkbox" name="{{ $mat }}" id="{{ $mat }}" value="{{ $mat }}">
            </div>
        @endif
    @endforeach

    <h5 class="red">Pour la filiere MT: </h5>
    @foreach ($MT as $mat => $cof) 
        @if($mat != "ESPG") 
            <div class="form-check">
                <label class="form-check-label" for="{{ $mat }}">{{ $abreviations[$mat] }}</label>
                <input class="form-check-input" type="checkbox" name="{{ $mat }}" id="{{ $mat }}" value="{{ $mat }}">
            </div>
        @endif
    @endforeach
    @foreach ($MT1 as $mat => $cof) 
        @if($mat != "MATH")
            <div class="form-check">
                <label class="form-check-label" for="{{ $mat }}">{{ $abreviations[$mat] }}</label>
                <input class="form-check-input" type="checkbox" name="{{ $mat }}" id="{{ $mat }}" value="{{ $mat }}">
            </div>
        @endif
    @endforeach
    @foreach ($MT2 as $mat => $cof) 
        <div class="form-check">
            <label class="form-check-label" for="{{ $mat }}">{{ $abreviations[$mat] }}</label>
            <input class="form-check-input" type="checkbox" name="{{ $mat }}" id="{{ $mat }}" value="{{ $mat }}">
        </div>
    @endforeach 
    <h5 class="red">Pour la filiere MCW: </h5>
    @foreach ($MCW as $mat => $cof) 
        @if($mat != "MATH" &&  $mat != 'ECON')
            <div class="form-check">
                <label class="form-check-label" for="{{ $mat }}">{{ $abreviations[$mat] }}</label>
                <input class="form-check-input" type="checkbox" name="{{ $mat}}" id="{{ $mat }}" value="{{ $mat }}">
            </div>
        @endif
    @endforeach
</div>
