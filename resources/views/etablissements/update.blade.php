@extends('layout.default')
@section('title', 'ONFP - Modification utilisateur')
@section('content')
    <div class="content">
        <div class="container col-12 col-sm-12 col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 col-lg-8 col-xl-10">
            <div class="container-fluid">
                @if (count($errors) > 0)
                    <div class="alert alert-danger mt-2">
                        <strong>Oups!</strong> Il y a eu quelques problèmes avec vos entrées.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row justify-content-center pb-2">
                    <div class="col-lg-12 margin-tb">
                        <a class="btn btn-outline-success" href="{{ route('etablissements.index') }}"> <i
                                class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                    </div>
                </div>
                <div class="card border-success">
                    <div class="card-header card-header-primary text-center border-success">
                        <h3 class="card-title">Modification établissement</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['url' => 'etablissements/' . $etablissement->id, 'method' => 'PATCH', 'files' => true]) !!}
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label for="civilite">{{ __('Région') }}</label>
                                <select name="region" id="region"
                                    class="form-control @error('region') is-invalid @enderror">
                                    <option value="{{ $etablissement->region->nom }}">{{ $etablissement->region->nom }}
                                    </option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->nom }}">{{ $region->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('region')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
                                {!! Form::label('Etablissement') !!}
                                {!! Form::text('etablissement', $etablissement->name, ['placeholder' => 'Nom de l\'établissement', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('etablissement'))
                                        @foreach ($errors->get('etablissement') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                                {!! Form::label('Sigle') !!}
                                {!! Form::text('sigle', $etablissement->sigle, ['placeholder' => 'Sigle', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('sigle'))
                                        @foreach ($errors->get('sigle') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                {!! Form::label('Email') !!}
                                {!! Form::text('email', $etablissement->email, ['placeholder' => 'Adresse email', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('email'))
                                        @foreach ($errors->get('email') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                {!! Form::label('Telephone') !!}
                                {!! Form::text('telephone_1', $etablissement->telephone1, ['placeholder' => 'Numero de telephone', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('telephone_1'))
                                        @foreach ($errors->get('telephone_1') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                {!! Form::label('Fixe') !!}
                                {!! Form::text('fixe', $etablissement->fixe, ['placeholder' => 'Numero de téléphone fixe', 'class' => 'form-control']) !!}
                                <small id="fixeHelp" class="form-text text-muted">
                                    @if ($errors->has('fixe'))
                                        @foreach ($errors->get('fixe') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                {!! Form::label('Telephone secondaire') !!}
                                {!! Form::text('telephone_2', $etablissement->telephone2, ['placeholder' => 'Numero de telephone secondaire', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('telephone_2'))
                                        @foreach ($errors->get('telephone_2') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                {!! Form::label('Adresse résidence') !!}(<span class="text-danger">*</span>)
                                {!! Form::textarea('adresse', $etablissement->adresse, ['placeholder' => 'Votre adresse de résidence', 'class' => 'form-control', 'id' => 'adresse', 'rows' => '1']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('adresse'))
                                        @foreach ($errors->get('adresse') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            {!! Form::submit('Modifier', ['class' => 'btn btn-outline-primary pull-right']) !!}
                            {!! Form::close() !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
