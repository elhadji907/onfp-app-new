@extends('layout.default')
@section('content')
    <div class="container col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12 margin-tb">
                    <a class="btn btn-primary" href="{{ route('ageroutezones.index') }}"> <i
                            class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                </div>
            </div>
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
            <div class="row pt-1"></div>
            <div class="card border-primary">
                <div class="card-header card-header-primary text-center border-primary">
                    <h3 class="card-title">{{ 'Modification commune' }}</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($zone, ['method' => 'PATCH', 'route' => ['ageroutezones.update', $zone->id]]) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            {!! Form::label('Département :') !!}
                            {!! Form::select('departement', $projetLocalites, $zone->localite->nom  ?? old('departement'), ['placeholder' => 'Sélectionner département', 'data-width' => '100%', 'class' => 'form-control', 'id' => 'departement']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('departement'))
                                    @foreach ($errors->get('departement') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>commune:</strong>
                                {!! Form::text('commune', $zone->nom, ['placeholder' => 'commune', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('commune'))
                                        @foreach ($errors->get('commune') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div align="right">
                                <a href="{{ route('ageroutezones.create') }}">

                                    <button type="submit" class="btn btn-primary btn-sm"><i
                                            class="far fa-paper-plane"></i>&nbsp;Soumettre</button>
                                </a>
                            </div>
                            <br />
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
