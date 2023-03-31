@extends('layouts.app')
@section('title', 'prof')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Bonjour Mr/Ms  '.Auth::user()->name) }}</div>
                <form  action="{{ route('import-notes') }}" class="card-body" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group mb-2">
                    <label for="matiere" class="col-md-4 col-form-label ">{{ __('Choisir la matiere') }}</label>
                    <select class="form-control" name="matiere" id="matiere">
                        <option selected>Choisir</option>
                        @foreach($matieres as $mat => $val ) 
                            <option value="{{ $mat }}">{{ $val }}</option>
                        @endforeach
                    </select>
                    <label for="" class="col-md-4 col-form-label ">{{ __('Quelle annee, semestre et examen ?') }}</label>
                    <div class="d-inline-flex mt-2">
                        <select class="form-select form-select-sm me-2" name="semestre" aria-label="Choisir la semestre ">
                            <option selected>Semestre </option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        <select class="form-select form-select-sm me-2" name="examen" aria-label="Choisir la Examen ">
                            <option selected>Examen </option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="P">Passage</option>
                            <option value="N">National</option>
                        </select>
                    </div>
                </div>
                <input type="file" name="notes"
                        class="form-control  @error('notes') is-invalid @enderror" value="{{ old('notes')}}">                   
                    @error('notes')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button class="btn btn-success mt-2">
                        Importer les notes
                    </button>
                    <div class="row mb-2">
                        @if(Session::has('alert-prof'))
                        <div class="alert alert-success">
                            {{Session::get('alert-prof')}}
                        </div>
                         @endif
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
