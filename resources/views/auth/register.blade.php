@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="prenom" class="col-md-4 col-form-label text-md-end">{{ __('Prenom') }}</label>

                            <div class="col-md-6">
                                <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>

                                @error('prenom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="dateNs" class="col-md-4 col-form-label text-md-end">{{ __('Date de naissance') }}</label>

                            <div class="col-md-6">
                                <input id="dateNs" type="date" class="form-control @error('dateNs') is-invalid @enderror" name="dateNs" value="{{ old('dateNs') }}" required autocomplete="dateNs" autofocus>

                                @error('dateNs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="lieuNs" class="col-md-4 col-form-label text-md-end">{{ __('Lieu de naissance') }}</label>

                            <div class="col-md-6">
                                <input id="lieuNs" type="text" class="form-control @error('lieuNs') is-invalid @enderror" name="lieuNs" value="{{ old('lieuNs') }}" required autocomplete="lieuNs" autofocus>

                                @error('lieuNs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tel" class="col-md-4 col-form-label text-md-end">{{ __('télephone') }}</label>

                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel" autofocus>

                                @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="lycee" class="col-md-4 col-form-label text-md-end">{{ __('Lycée') }}</label>

                            <div class="col-md-6">
                                <input id="lycee" type="text" class="form-control @error('lycee') is-invalid @enderror" name="lycee" value="{{ old('lycee') }}" required autocomplete="lycee" autofocus>

                                @error('lycee')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="cin" class="col-md-4 col-form-label text-md-end">{{ __('CIN') }}</label>

                            <div class="col-md-6">
                                <input id="cin" type="text" class="form-control @error('cin') is-invalid @enderror" name="cin" value="{{ old('cin') }}" required autocomplete="cin" autofocus>

                                @error('cin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <div class="row mb-3">
                                <label for="cne" class="col-md-4 col-form-label text-md-end">{{ __('CNE') }}</label>
    
                                <div class="col-md-6">
                                    <input id="cne" type="text" class="form-control @error('cne') is-invalid @enderror" name="cne" value="{{ old('cne') }}" required autocomplete="cne" autofocus>
    
                                    @error('cne')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="row mb-3">
                            <label for="niveauBac" class="col-md-4 col-form-label text-md-end">{{ __('Niveau Bac') }}</label>

                            <div class="col-md-6">
                                <input id="niveauBac" type="text" class="form-control @error('niveauBac') is-invalid @enderror" name="niveauBac" value="{{ old('niveauBac') }}" required autocomplete="niveauBac" autofocus>

                                @error('niveauBac')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="bacMoyen" class="col-md-4 col-form-label text-md-end">{{ __('Moyenne Bac') }}</label>

                            <div class="col-md-6">
                                <input id="bacMoyen" type="text" class="form-control @error('bacMoyen') is-invalid @enderror" name="bacMoyen" value="{{ old('bacMoyen') }}" required autocomplete="bacMoyen" autofocus>

                                @error('bacMoyen')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="filiere" class="col-md-4 col-form-label text-md-end">{{ __('Choisir la filiere') }}</label>
                            <div class="col-md-6">
                                <select class="form-control @error('filiere') is-invalid @enderror" name="filiere" id="filiere" required>
                                    <option value="SRI">Système et réseau informatique</option>
                                    <option value="MT">Management et touristique</option>
                                    <option value="MCW">Multimédia et conception Web</option>
                                </select>
                            </div> 
                            @error('filiere')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row mb-3">
                            @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                        @endif
                        </div>

                        <div class="row m-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
