@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Bonjour Admin') }}</div>
                    <form action="{{ route('import-etudiants') }}" class="card-body" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="filiere" class="col-md-4 col-form-label ">{{ __('Choisir la filiere') }}</label>
                            <select class="form-control" name="filiere" id="filiere">
                                <option selected>filiere</option>
                                <option value="SRI">Système et réseau informatique</option>
                                <option value="MT">Management et touristique</option>
                                <option value="MCW">Multimédia et conception Web</option>
                            </select>
                            <label for="annee" class="col-md-4 col-form-label ">{{ __('Choisir la annee') }}</label>
                            <select class="form-control" name="annee" id="annee">
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>

                        <input type="file" name="etudiant" class="form-control  @error('etudiant') is-invalid @enderror"
                            value="{{ old('etudiant') }}">
                        @error('etudiant')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button class="btn btn-success">
                            Importer Etudiants
                        </button>
                        <a class="btn btn-warning m-2" href="{{ route('export-candidats') }}">
                            Voir Résultats d'inscription
                        </a>
                        <div class="row mb-2">
                            @if (Session::has('alert-admin'))
                                <div class="alert alert-warning">
                                    {{ Session::get('alert-admin') }}
                                </div>
                            @endif
                        </div>
                    </form>
                    <form action="{{ route('remove-etudiant') }}" method="POST" class="card-body">
                        @csrf
                        <label for="cne" class="col-form-label ">{{ __("Entrer le code CNE d'etudiant ") }}</label>
                        <input type="text" name="cne" class="form-control @error('cne') is-invalid @enderror"
                            value="{{ old('cne') }}">

                        @error('cne')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button class="btn btn-warning mt-2 ">
                            Supprimer
                        </button>
                        <div class="row mb-2">
                            @csrf
                            @if (Session::has('alert-etudiant'))
                                <div class="alert alert-warning">
                                    {{ Session::get('alert-etudiant') }}
                                </div>
                            @endif
                        </div>
                    </form>
                    <form action="{{ route('get-carte') }}" method="POST" class="card-body">
                        @csrf
                        <label for="CNE" class="col-form-label ">{{ __("Entrer le code CNE d'etudiant ") }}</label>
                        <input type="text" name="CNE" class="form-control @error('CNE') is-invalid @enderror"
                            value="{{ old('CNE') }}">

                        @error('CNE')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button class="btn btn-success mt-2">
                            Carte Etudiant
                        </button>
                        <div class="row mb-2">
                            @csrf
                            @if (Session::has('alert-pdf'))
                                <div class="alert alert-warning">
                                    {{ Session::get('alert-pdf') }}
                                </div>
                            @endif
                        </div>
                    </form>
                    <form action=" {{ route('export-notes') }} " class="card-body" method="POST">
                        @csrf
                        <label for="filiere"
                            class="col-md-4 col-form-label ">{{ __('Pour voir les notes sélectionnez ') }}</label>
                        <div class="d-flex">
                            <select class="form-select form-select-sm me-2" name="filiere" id="filiere">
                                <option selected>filiere</option>
                                <option value="SRI">Système et réseau informatique</option>
                                <option value="MT">Management et touristique</option>
                                <option value="MCW">Multimédia et conception Web</option>
                            </select>
                            <select class="form-select form-select-sm me-2" name="semestre" id="semestre">
                                <option selected>semestre</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                        <button class="btn btn-primary mt-2">
                            Télecharger
                        </button>
                        <div class="row mt-2">
                            @if (Session::has('alert-notes'))
                                <div class="alert alert-warning">
                                    {{ Session::get('alert-notes') }}
                                </div>
                            @endif
                        </div>
                    </form>
                    <form action="{{ route('upload') }}" class="card-body" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="upload"
                            class="col-form-label">{{ __('Annoncer les candidats par un fichier pdf ') }}</label>
                        <input type="file" name="upload" class="form-control @error('upload') is-invalid @enderror"
                            value="{{ old('upload') }}">
                        @error('upload')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button class="btn btn-success ">
                            Charger
                        </button>
                        <a href="{{ route('export-etudiants') }}" class="btn btn-secondary m-2">
                            Voir etudiants
                        </a>
                        <div class="row mb-3">
                            @if (Session::has('annonce'))
                                <div class="alert alert-warning">
                                    {{ Session::get('annonce') }}
                                </div>
                            @endif
                        </div>
                    </form>
                    <form action="{{ route('import-prof') }}" method="POST" class="card-body">
                        @csrf
                        <h4 class="mb-3 ">Ajouter les professeurs </h4>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                            
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="prenom" class="col-md-4 col-form-label">{{ __('Prenom') }}</label>

                            <div class="col-md-6">
                                <input id="prenom" type="text"
                                    class="form-control @error('prenom') is-invalid @enderror" name="prenom"
                                    value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>

                                @error('prenom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tel" class="col-md-4 col-form-label">{{ __('télephone') }}</label>

                            <div class="col-md-6">
                                <input id="tel" type="text"
                                    class="form-control @error('tel') is-invalid @enderror" name="tel"
                                    value="{{ old('tel') }}" required autocomplete="tel" autofocus>

                                @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="cin" class="col-md-4 col-form-label ">{{ __('CIN') }}</label>
                            <div class="col-md-6">
                                <input id="cin" type="text"
                                    class="form-control @error('cin') is-invalid @enderror" name="cin"
                                    value="{{ old('cin') }}" required autocomplete="cin" autofocus>

                                @error('cin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label ">{{ __('Ajouter les matieres ') }}</label>
                            <select class="form-control mb-2" id="matieres" onchange="displayValue()">
                                <option value="Secondaires">Secondaires</option>
                                <option value="Techniques">Techniques</option>
                            </select>
                            @include('techniques')
                            @include('secondaires')
                        </div>
                        <div class="row mb-3">
                            @if (Session::has('message'))
                                <div class="alert alert-warning">
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group mb-2">

                        </div>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Ajouter') }}
                        </button>
                        <a href="{{ route('export-profs') }}" class="btn btn-secondary m-1">
                            {{ __('Voir les profs') }}
                        </a>

                        <div class="row mb-2">
                            @if (Session::has('add-prof'))
                                <div class="alert alert-warning">
                                    {{ Session::get('add-prof') }}
                                </div>
                            @endif
                        </div>
                    </form>
                    <form action="{{ route('remove-prof') }}" method="POST" class="card-body">
                        @csrf
                        @method('DELETE')
                        <label for="CIN"
                            class="col-form-label ">{{ __('Entrer le code CIN de professeur  ') }}</label>
                        <input type="text" name="CIN" class="form-control @error('CIN') is-invalid @enderror"
                            value="{{ old('cin') }}">

                        @error('CIN')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button class="btn btn-warning mt-2">
                            Supprimer
                        </button>
                        <div class="row mb-2">
                            @if (Session::has('alert-delete'))
                                <div class="alert alert-warning">
                                    {{ Session::get('alert-delete') }}
                                </div>
                            @endif
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
