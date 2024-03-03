@extends('layout.default')
@section('title', 'ONFP - informations établissements')
@section('content')
    <div class="content">
        <div class="container col-12 col-sm-12 col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 col-lg-8 col-xl-8">
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
                        <h3 class="card-title">Informations établissement</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <b>{!! Form::label('region') !!}</b>: {{$etablissement->region->nom}}
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <b>{!! Form::label('Etablissement') !!}</b> : {{$etablissement->name}}
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <b>{!! Form::label('Sigle') !!}</b> : {{$etablissement->sigle}}
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <b>{!! Form::label('Email') !!}</b> : {{$etablissement->email}}
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <b>{!! Form::label('Telephone') !!}</b> : {{$etablissement->telephone1}}
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <b>{!! Form::label('Fixe') !!}</b> : {{$etablissement->fixe}}
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <b>{!! Form::label('Telephone secondaire') !!}</b> : {{$etablissement->telephone2}}
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <b>{!! Form::label('Adresse résidence') !!}</b> : {{$etablissement->adresse}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
