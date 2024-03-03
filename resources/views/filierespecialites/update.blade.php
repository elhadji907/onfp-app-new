@extends('layout.default')
@section('title', 'ONFP - Modification users')
@section('content')
    <div class="content">
        <div class="container col-12 col-sm-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-lg-8 col-xl-8">
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
                        <a class="btn btn-outline-success" href="{{ route('users.index') }}"> <i
                                class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                    </div>
                </div>
                <div class="card border-success">
                    <div class="card-header card-header-primary text-center border-success">
                        <h3 class="card-title">Modification utilisateur</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['url' => 'users/' . $user->username, 'method' => 'PATCH', 'files' => true]) !!}
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                {!! Form::label('civilite') !!}
                                {!! Form::select('civilite', ['M.' => 'M.', 'Mme' => 'Mme'], $user->civilite, ['placeholder' => '', 'class' => 'form-control', 'id' => 'civilite']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('civilite'))
                                        @foreach ($errors->get('civilite') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                {!! Form::label('Prénom') !!}
                                {!! Form::text('firstname', $user->firstname, ['placeholder' => 'Votre prénom', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('firstname'))
                                        @foreach ($errors->get('firstname') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                {!! Form::label('Nom') !!}
                                {!! Form::text('name', $user->name, ['placeholder' => 'Votre nom', 'class' => 'form-control', 'id' => 'nom']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('name'))
                                        @foreach ($errors->get('name') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                {!! Form::label("Nom d'utilisateur") !!}
                                {!! Form::text('username', $user->username, ['placeholder' => 'Votre username', 'class' => 'form-control', 'id' => 'username']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('username'))
                                        @foreach ($errors->get('username') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                {!! Form::label('Email') !!}
                                {!! Form::text('email', $user->email, ['placeholder' => 'Numero de email', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('email'))
                                        @foreach ($errors->get('email') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                {!! Form::label('Telephone') !!}
                                {!! Form::text('telephone', $user->telephone, ['placeholder' => 'Numero de telephone', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('telephone'))
                                        @foreach ($errors->get('telephone') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                {!! Form::label('role') !!}
                                {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', 'multiple', 'id' => 'role']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('roles'))
                                        @foreach ($errors->get('roles') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                {!! Form::label('Mot de passe:') !!}
                                {!! Form::password('password', ['placeholder' => 'Mot de passe', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('password'))
                                        @foreach ($errors->get('password') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                {!! Form::label('Confirmez le mot de passe:') !!}
                                {!! Form::password('confirm-password', ['placeholder' => 'Confirmez le mot de passe', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        {!! Form::submit('Modifier', ['class' => 'btn btn-outline-primary pull-right']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
