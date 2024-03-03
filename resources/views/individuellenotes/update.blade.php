@extends('layout.default')
@section('title', 'Appreciation candidat - ONFP - AGEROUTE')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @elseif (session('messages'))
                    <div class="alert alert-danger">
                        {{ session('messages') }}
                    </div>
                @endif
                <div class="card border-success">
                    <div class="card card-header text-center bg-gradient-default border-success">
                        <p class="card-title text-center text-black h-100 mb-0"><b></b><span
                                class="font-italic">Appreciation du bénéficiaire : {{ $individuelle->demandeur->user->civilite }} {{ $individuelle->demandeur->user->firstname }} {{ $individuelle->demandeur->user->name }} </span></p>
                    </div>
                    <div class="card-body">
                        <hr class="sidebar-divider my-0"><br>
                        {!! Form::open(['url' => 'individuellenotes/' . $individuelle->id, 'method' => 'PATCH', 'files' => true]) !!}
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                <label for="note_obtenue">{{ __('Note obtenue') }}</label>
                                <input id="note_obtenue" type="text"
                                    class="form-control @error('note_obtenue') is-invalid @enderror" name="note_obtenue"
                                    placeholder="ajouter une note" value="{{ $individuelle->note_obtenue ?? old('note_obtenue') }}"
                                    autocomplete="note_obtenue">
                                @error('note_obtenue')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                <label for="niveau_maitrise">{{ __('Niveau maitrise') }}</label>
                                <input id="niveau_maitrise" type="text"
                                    class="form-control @error('niveau_maitrise') is-invalid @enderror"
                                    name="niveau_maitrise" placeholder="Le niveau de maitrise"
                                    value="{{ $individuelle->niveau_maitrise ?? old('niveau_maitrise') }}"
                                    autocomplete="niveau_maitrise">
                                @error('niveau_maitrise')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                <label for="observations">{{ __('Observations') }}</label>
                                <textarea class="form-control  @error('observations') is-invalid @enderror" name="observations" id="observations"
                                    rows="1"
                                    placeholder="observations faites">{{ $individuelle->observations ?? old('observations') }}</textarea>
                                @error('observations')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                <label for="appreciations">{{ __('Appreciation') }}</label>
                                <textarea class="form-control  @error('appreciations') is-invalid @enderror" name="appreciations" id="appreciations"
                                    rows="1"
                                    placeholder="appreciation du candidat">{{ $individuelle->appreciation ?? old('appreciations') }}</textarea>
                                @error('appreciations')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-outline-primary"><i
                                    class="far fa-paper-plane"></i>&nbsp;Enregistrer</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
