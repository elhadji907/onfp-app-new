@extends('layout.default')
@section('title', 'ONFP - Enregistrement utilisateur')
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
                        <h3 class="card-title">Enregistrement établissement</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'etablissements.store', 'method' => 'POST']) !!}
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                {!! Form::label('Région') !!} (<span class="text-danger">*</span>)
                                {!! Form::select('region', $regions, null, ['placeholder' => '', 'class' => 'form-control', 'id' => 'region']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('region'))
                                        @foreach ($errors->get('region') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
                                {!! Form::label('Etablissement') !!} (<span class="text-danger">*</span>)
                                {!! Form::text('etablissement', null, ['placeholder' => 'Nom de l\'établissement', 'class' => 'form-control']) !!}
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
                                {!! Form::text('sigle', null, ['placeholder' => 'Sigle', 'class' => 'form-control']) !!}
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
                                {!! Form::label('Email') !!} (<span class="text-danger">*</span>)
                                {!! Form::text('email', null, ['placeholder' => 'Adresse email', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('email'))
                                        @foreach ($errors->get('email') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                {!! Form::label('Telephone') !!} (<span class="text-danger">*</span>)
                                {!! Form::text('telephone_1', null, ['placeholder' => 'Numero de telephone', 'class' => 'form-control']) !!}
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
                                {!! Form::label('Fixe') !!} (<span class="text-danger">*</span>)
                                {!! Form::text('fixe', null, ['placeholder' => 'Numero de téléphone fixe', 'class' => 'form-control']) !!}
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
                                {!! Form::text('telephone_2', null, ['placeholder' => 'Numero de telephone secondaire', 'class' => 'form-control']) !!}
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
                                {!! Form::label('Adresse résidence') !!} (<span class="text-danger">*</span>)
                                {!! Form::textarea('adresse', null, ['placeholder' => 'Votre adresse de résidence', 'class' => 'form-control', 'id' => 'adresse', 'rows' => '1']) !!}
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
                            <button type="submit" class="btn btn-primary"><i
                                    class="far fa-paper-plane"></i>&nbsp;Soumettre</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
