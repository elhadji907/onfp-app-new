@extends('layout.default')
@section('title', 'ONFP - ' . $user->username)
@section('content')
    <div class="content">
        <div class="container col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="container-fluid">
                <div class="row p-2">
                    <div class="col-4 mx-auto">
                        <img src="{{ asset($user->profile->getImage()) }}" class="rounded-circle w-50" />
                    </div>
                </div>
                <div class="row justify-content-center pb-2">
                    <div class="col-lg-12 margin-tb">
                        <a class="btn btn-outline-success" href="{{ route('users.index') }}"> <i
                                class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                    </div>
                </div>
                <div class="card border-success">
                    <div class="card card-header text-center bg-gradient-default border-success">
                        <h1 class="h4 card-title text-center text-black h-100 text-uppercase mb-0"><b></b><span
                                class="font-italic">INFORMATIONS</span></h1>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Civilité ') }}:</b> {{ $user->civilite }} </label>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Prénom ') }}:</b> {{ $user->firstname }} </label>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Nom ') }}:</b> {{ $user->name }} </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __("Nom d'utilisateur ") }}:</b> {{ $user->username }}
                                </label>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Email ') }}:</b> {{ $user->email }} </label>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Téléphone ') }}:</b> {{ $user->telephone }} </label>
                            </div>
                        </div>
                        <div class="form-row">
                            {{--  <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __("Date naissance ") }}:</b> {{ $user->date_naissance->format('d/m/Y') ?? ' ' }}
                                </label>
                            </div>  --}}
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Lieu naissance ') }}:</b> {{ $user->lieu_naissance }} </label>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Situation familiale ') }}:</b> {{ $user->situation_familiale }} </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __("Fixe ") }}:</b> {{ $user->fixe }}
                                </label>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('BP ') }}:</b> {{ $user->bp }} </label>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Fax ') }}:</b> {{ $user->fax }} </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8 col-lg-8 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Adresse ') }}:</b> {{ $user->adresse }} </label>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Situation professionnelle ') }}:</b> {{ $user->situation_professionnelle }} </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Créé le ') }}:</b> {{ $user->created_at->format('d/m/Y') }} </label>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __("Créé par ") }}:</b> {{ $user->created_by }}
                                </label>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Modifié par ') }}:</b> {{ $user->updated_by }} </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Role ') }}:</b>
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $v)
                                            <label class="badge badge-success">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </label>
                            </div>
                            <div class="form-group col-md-8 col-lg-8 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Permission ') }}:</b>
                                    @if (!empty($user->getPermissionsViaRoles()))
                                        @foreach ($user->getPermissionsViaRoles()->pluck('name') as $v)
                                            <label class="badge badge-success">
                                                {{ $v }} </label>
                                        @endforeach
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
