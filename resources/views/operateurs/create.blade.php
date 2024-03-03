@extends('layout.default')
@section('title', 'ONFP - Enregistrement opérateurs')
@section('content')
    <div class="content">
        <div class="container col-12 col-md-12 col-lg-8 col-xl-12">
            <div class="container-fluid">
                {{-- @if (count($errors) > 0)
                    <div class="alert alert-danger mt-2">
                        <strong>Oups!</strong> Il y a eu quelques problèmes avec vos entrées.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif --}}
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a class="btn btn-outline-success btn-sm"
                                    href="{{ route('operateurs.index') }}"><i class="fas fa-undo-alt"></i>&nbsp;retour</a></li>
                            <li class="breadcrumb-item active">enregistrement opérateur</li>
                        </ul>
                    </div>
                </div>
                <div class="card border-success">
                    <div class="card">
                        {{--  <div class="card-header card-header-primary text-center border-success">
                            <h4 class="card-title">Enregistrement opérateurs</h3>
                        </div>  --}}
                        <div class="card-body">
                            <b> NB </b> : Les champs<span class="text-danger"> <b>*</b> </span>sont obligatoires
                            <form method="POST" action="{{ url('operateurs') }}">
                                @csrf
                                <div class="bg-gradient-secondary text-center">
                                    <p class="h5 text-white mb-2 mt-0">IDENTIFICATION</p>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <label for="operateur">{{ __('Opérateur') }}(<span
                                                class="text-danger">*</span>)</label>
                                        <textarea id="operateurAdd" rows="1" class="form-control form-control-sm @error('operateur') is-invalid @enderror"
                                            name="operateur" placeholder="Opérateur" autocomplete="operateur" autofocus>{{ old('operateur') }}</textarea>
                                        @error('operateur')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-2 col-lg-2 col-xs-12 col-sm-12">
                                        <label for="sigle">{{ __('Sigle') }}(<span
                                                class="text-danger">*</span>)</label>
                                        <textarea id="sigle" rows="1" class="form-control form-control-sm @error('sigle') is-invalid @enderror"
                                            name="sigle" placeholder="Sigle" autocomplete="sigle">{{ old('sigle') }}</textarea>
                                        @error('sigle')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="numero_agrement">{{ __('numero agrement') }}(<span
                                                class="text-danger">*</span>)</label>
                                        <input id="numero_agrement" type="text"
                                            class="form-control form-control-sm @error('numero_agrement') is-invalid @enderror"
                                            name="numero_agrement" placeholder="numero agrement"
                                            value="{{ old('numero_agrement') }}" autocomplete="numero_agrement">
                                        @error('numero_agrement')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="email1">{{ __('E-mail') }}(<span
                                                class="text-danger">*</span>)</label>
                                        <input id="email1" type="text"
                                            class="form-control form-control-sm @error('email1') is-invalid @enderror"
                                            name="email1" placeholder="adresse e-mail" value="{{ old('email1') }}"
                                            autocomplete="email1">
                                        @error('email1')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="fixe_op">{{ __('Téléphone fixe') }}(<span
                                            class="text-danger">*</span>)</label>
                                        <input id="fixe_op" type="text"
                                            class="form-control form-control-sm @error('fixe_op') is-invalid @enderror"
                                            name="fixe_op" placeholder="Téléphone fixe opérateur"
                                            value="{{ old('fixe_op') }}" autocomplete="fixe_op" autofocus>
                                        @error('fixe_op')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label>{{ __('Type structure :') }}</label>(<span class="text-danger">*</span>)
                                        <br />
                                        {{ Form::radio('type_structure', 'Publique', false, ['class' => 'name']) }}
                                        {{ __('Publique') }}
                                        {{ Form::radio('type_structure', 'Privé', false, ['class' => 'name']) }}
                                        {{ __('Privé') }}
                                        <small id="emailHelp" class="form-text text-muted">
                                            @if ($errors->has('type_structure'))
                                                @foreach ($errors->get('type_structure') as $message)
                                                    <p class="text-danger">{{ $message }}</p>
                                                @endforeach
                                            @endif
                                        </small>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label>{{ __('Statut juridique :') }}</label>(<span class="text-danger">*</span>)
                                        <br />
                                        {{ Form::radio('type_operateur', 'GIE', false, ['class' => 'name']) }}
                                        {{ __('GIE') }}
                                        {{ Form::radio('type_operateur', 'Association', false, ['class' => 'name']) }}
                                        {{ __('Association') }}
                                        {{ Form::radio('type_operateur', 'Entreprise', false, ['class' => 'name']) }}
                                        {{ __('Entreprise') }}
                                        {{ Form::radio('type_operateur', 'Institution', false, ['class' => 'name']) }}
                                        {{ __('Institution') }}
                                        {{ Form::radio('type_operateur', 'Autre', false, ['class' => 'name']) }}
                                        {{ __('Autre') }}
                                        <small id="emailHelp" class="form-text text-muted">
                                            @if ($errors->has('type_operateur'))
                                                @foreach ($errors->get('type_operateur') as $message)
                                                    <p class="text-danger">{{ $message }}</p>
                                                @endforeach
                                            @endif
                                        </small>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="autres_type_operateur">{{ __('Si autre, précisez :') }}</label>
                                        <textarea class="form-control form-control-sm  @error('autres_type_operateur') is-invalid @enderror"
                                            name="autres_type_operateur" id="autres_type_operateur" rows="1" placeholder="autre type opérateur">{{ old('autres_type_operateur') }}</textarea>
                                        <small id="emailHelp" class="form-text text-muted">
                                            @if ($errors->has('autres_type_operateur'))
                                                @foreach ($errors->get('autres_type_operateur') as $message)
                                                    <p class="text-danger">{{ $message }}</p>
                                                @endforeach
                                            @endif
                                        </small>
                                    </div>
                                    {{-- <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="operateur">{{ __('Type opérateur') }}(<span
                                                class="text-danger">*</span>)</label>
                                        {!! Form::select('type_operateur', $types_operateurs, null, ['placeholder' => '', 'class' => 'form-control form-control-sm', 'id' => 'type_operateur', 'data-width' => '100%']) !!}
                                        <small id="emailHelp" class="form-text text-muted">
                                            @if ($errors->has('type_operateur'))
                                                @foreach ($errors->get('type_operateur') as $message)
                                                    <p class="text-danger">{{ $message }}</p>
                                                @endforeach
                                            @endif
                                        </small>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="operateur">{{ __('Type structure') }}(<span
                                                class="text-danger">*</span>)</label>
                                        {!! Form::select('type_structure', ['Publique' => 'Publique', 'Privé' => 'Privé'], null, ['placeholder' => 'sélectionner type structure', 'class' => 'form-control form-control-sm', 'id' => 'type_structure', 'data-width' => '100%']) !!}
                                        <small id="emailHelp" class="form-text text-muted">
                                            @if ($errors->has('type_structure'))
                                                @foreach ($errors->get('type_structure') as $message)
                                                    <p class="text-danger">{{ $message }}</p>
                                                @endforeach
                                            @endif
                                        </small>
                                    </div> --}}


                                    <div class="form-group col-md-4 col-lg-4 col-xs-4 col-sm-4">
                                        <label for="">Commune</label>(<span class="text-danger">*</span>)
                                        <input type="commune" placeholder="Commune"
                                            class="form-control form-control-sm @error('commune') is-invalid @enderror"
                                            name="commune" id="commune" value="">
                                        <div class="col-lg-12" id="communeList">
                                        </div>
                                        @error('commune')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    {{--  <div class="form-group col-md-4 col-lg-4 col-xs-4 col-sm-4">
                                        {!! Form::label('Arrondissement') !!}(<span class="text-danger">*</span>)  --}}
                                    {!! Form::hidden('arrondissement', null, [
                                        'placeholder' => 'Arrondissement',
                                        'id' => 'arrondissement',
                                        'class' => 'form-control form-control-sm',
                                    ]) !!}
                                    {{--   <small id="emailHelp" class="form-text text-muted">
                                            @if ($errors->has('arrondissement'))
                                                @foreach ($errors->get('arrondissement') as $message)
                                                    <p class="text-danger">{{ $message }}</p>
                                                @endforeach
                                            @endif
                                        </small>
                                    </div>  --}}

                                    <div class="form-group col-md-4 col-lg-4 col-xs-4 col-sm-4">
                                        <label for="departement">{{ __('Département') }}</label>(<span class="text-danger">*</span>)
                                        <input id="departement" type="text"
                                            class="form-control form-control-sm @error('departement') is-invalid @enderror"
                                            name="departement" placeholder="Département"
                                            value="{{ old('departement') }}" autocomplete="departement" autofocus>
                                        @error('departement')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="laregion">{{ __('Région') }}</label>(<span class="text-danger">*</span>)
                                        <input id="laregion" type="text"
                                            class="form-control form-control-sm @error('laregion') is-invalid @enderror"
                                            name="laregion" placeholder="Région" value="{{ old('laregion') }}"
                                            autocomplete="laregion" autofocus>
                                        @error('region')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="adresse">{{ __('Adresse complète') }}(<span
                                                class="text-danger">*</span>)</label>
                                        <textarea id="adresse_op" rows="1"
                                            class="form-control form-control-sm @error('adresse_op') is-invalid @enderror" name="adresse_op"
                                            placeholder="adresse de la structure" autocomplete="adresse_op" autofocus>{{ old('adresse_op') }}</textarea>
                                        @error('adresse_op')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    {{--  <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                        <label for="operateur">{{ __('Région d\'intervention') }}(<span
                                                class="text-danger">*</span>)</label>
                                        {!! Form::select('regions[]', $regions, null, ['multiple' => 'multiple', 'data-width' => '100%', 'class' => 'form-control form-control-sm', 'id' => 'regions_op']) !!}
                                        <small id="emailHelp" class="form-text text-muted">
                                            @if ($errors->has('regions'))
                                                @foreach ($errors->get('regions') as $message)
                                                    <p class="text-danger">{{ $message }}</p>
                                                @endforeach
                                            @endif
                                        </small>
                                    </div>  --}}
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="telephone1">{{ __('Téléphone secondaire') }}</label>
                                        <input id="telephone1" type="text"
                                            class="form-control form-control-sm @error('telephone1') is-invalid @enderror"
                                            name="telephone1" placeholder="Téléphone secondaire"
                                            value="{{ old('telephone1') }}" autocomplete="telephone1" autofocus>
                                        @error('telephone1')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    {{--  <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                        {!! Form::label('E-mail secondaire:') !!}
                                        {!! Form::text('email2', null, [
                                            'placeholder' => 'adresse e-mail secondaire de la structure',
                                            'class' => 'form-control form-control-sm',
                                        ]) !!}
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                        {!! Form::label('Téléphone secondaire:') !!}
                                        {!! Form::text('telephone2', null, [
                                            'placeholder' => 'Numero de telephone secondaire de la structure',
                                            'class' => 'form-control form-control-sm',
                                        ]) !!}
                                    </div>  --}}
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="bp">{{ __('Boite postale') }}</label>
                                        <input id="bp" type="text"
                                            class="form-control form-control-sm @error('bp') is-invalid @enderror"
                                            name="bp" placeholder="Votre adresse postale"
                                            value="{{ old('bp') }}" autocomplete="bp" autofocus>
                                        @error('bp')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="fax">{{ __('Téléphone fax') }}</label>
                                        <input id="fax" type="text"
                                            class="form-control form-control-sm @error('fax') is-invalid @enderror"
                                            name="fax" placeholder="Votre numero de fax" value="{{ old('fax') }}"
                                            autocomplete="fax" autofocus>
                                        @error('fax')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="ninea">{{ __('Ninéa ') }}</label>(<span class="text-danger">*</span>)
                                        <input id="ninea" type="text"
                                            class="form-control form-control-sm @error('ninea') is-invalid @enderror"
                                            name="ninea" placeholder="Ninea" value="{{ old('ninea') }}"
                                            autocomplete="ninea" autofocus>
                                        @error('ninea')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        {!! Form::label('Régistre de commerce:') !!}
                                        {!! Form::text('registre', null, [
                                            'placeholder' => 'Le registre de commerce de votre établissement',
                                            'class' => 'form-control form-control-sm',
                                        ]) !!}
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="quitus">{{ __('Quitus ') }}</label>
                                        <input id="quitus" type="text"
                                            class="form-control form-control-sm @error('quitus') is-invalid @enderror"
                                            name="quitus" placeholder="Votre numero de quitus"
                                            value="{{ old('quitus') }}" autocomplete="quitus" autofocus>
                                        @error('quitus')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="debut_quitus">{{ __('Date délivrance') }}(<span
                                                class="text-danger">*</span>)</label>
                                        <input id="debut_quitus" {{ $errors->has('debut_quitus') ? 'is-invalid' : '' }}
                                            type="date"
                                            class="form-control form-control-sm @error('debut_quitus') is-invalid @enderror"
                                            name="debut_quitus" placeholder="Votre date de naissance"
                                            value="{{ old('debut_quitus') }}" autocomplete="username" autofocus>
                                        @error('debut_quitus')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="fin_quitus">{{ __('Date fin') }}(<span
                                                class="text-danger">*</span>)</label>
                                        <input id="fin_quitus" {{ $errors->has('fin_quitus') ? 'is-invalid' : '' }}
                                            type="date"
                                            class="form-control form-control-sm @error('fin_quitus') is-invalid @enderror"
                                            name="fin_quitus" placeholder="Votre date de naissance"
                                            value="{{ old('fin_quitus') }}" autocomplete="username" autofocus>
                                        @error('fin_quitus')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{--  <div class="bg-gradient-secondary text-center">
                                    <p class="h5 text-white mb-2">RESPONSABLE</p>
                                </div>  --}}
                                <div class="form-row">
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="prenom">{{ __('Prénom ') }}</label>
                                        <input id="prenom" type="text"
                                            class="form-control form-control-sm @error('prenom') is-invalid @enderror"
                                            name="prenom" placeholder="Votre numero de prenom"
                                            value="{{ old('prenom') }}" autocomplete="prenom" autofocus>
                                        @error('prenom')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="nom">{{ __('Nom ') }}</label>
                                        <input id="nom" type="text"
                                            class="form-control form-control-sm @error('nom') is-invalid @enderror"
                                            name="nom" placeholder="Votre numero de nom" value="{{ old('nom') }}"
                                            autocomplete="nom" autofocus>
                                        @error('nom')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    {{--  <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="cin">{{ __('Cin  ') }}</label>
                                        <input id="cin" type="text"
                                            class="form-control form-control-sm @error('cin') is-invalid @enderror"
                                            name="cin" placeholder="Votre numero de cin" value="{{ old('cin') }}"
                                            autocomplete="cin" autofocus>
                                        @error('cin')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>  --}}
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="email">{{ __('E-mail  ') }}</label>
                                        <input id="email" type="text"
                                            class="form-control form-control-sm @error('email') is-invalid @enderror"
                                            name="email" placeholder="Votre numero de email"
                                            value="{{ old('email') }}" autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="telephone">{{ __('Téléphone  ') }}</label>
                                        <input id="telephone" type="text"
                                            class="form-control form-control-sm @error('telephone') is-invalid @enderror"
                                            name="telephone" placeholder="Votre numero de telephone"
                                            value="{{ old('telephone') }}" autocomplete="telephone" autofocus>
                                        @error('telephone')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="fonction_responsable">{{ __('Fonction  ') }}</label>
                                        <input id="fonction_responsable" type="text"
                                            class="form-control form-control-sm @error('fonction_responsable') is-invalid @enderror"
                                            name="fonction_responsable" placeholder="Fonction du responsable"
                                            value="{{ old('fonction_responsable') }}" autocomplete="fonction_responsable"
                                            autofocus>
                                        @error('fonction_responsable')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                   {{--   <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        {!! Form::label('civilite :', null, ['class' => 'control-label']) !!}(<span class="text-danger">*</span>)
                                        {!! Form::select('civilite', ['M.' => 'M.', 'Mme' => 'Mme'], null, [
                                            'placeholder' => 'sélectionner civilite',
                                            'class' => 'form-control form-control-sm',
                                            'id' => 'civilite',
                                            'data-width' => '100%',
                                        ]) !!}
                                        <small id="emailHelp" class="form-text text-muted">
                                            @if ($errors->has('civilite'))
                                                @foreach ($errors->get('civilite') as $message)
                                                    <p class="text-danger">{{ $message }}</p>
                                                @endforeach
                                            @endif
                                        </small>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="date_naiss">{{ __('Date de naissance') }}</label>
                                        <input id="date_naiss" {{ $errors->has('date_naiss') ? 'is-invalid' : '' }}
                                            type="date"
                                            class="form-control form-control-sm @error('date_naiss') is-invalid @enderror"
                                            name="date_naiss" placeholder="Votre date de naissance"
                                            value="{{ old('date_naiss') }}" autocomplete="username" autofocus>
                                        @error('date_naiss')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="lieu_naissance">{{ __('Lieu de naissance') }}</label>
                                        <input id="lieu_naissance" type="text"
                                            class="form-control form-control-sm @error('lieu_naissance') is-invalid @enderror"
                                            name="lieu_naissance" placeholder="Votre lieu de naissance"
                                            value="{{ old('lieu_naissance') }}" autocomplete="lieu_naissance">
                                        @error('lieu_naissance')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>  --}}
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="adresse">{{ __('Adresse') }}</label>
                                        <textarea id="adresse" rows="1" class="form-control form-control-sm @error('adresse') is-invalid @enderror"
                                            name="adresse" placeholder="adresse du responsable" autocomplete="adresse" autofocus>{{ old('adresse') }}</textarea>
                                        @error('adresse')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="password" class="form-control form-control-sm"
                                    id="exampleInputPassword1" placeholder="Mot de passe">
                                {!! Form::hidden('password', null, [
                                    'placeholder' => 'Votre mot de passe',
                                    'class' => 'form-control form-control-sm',
                                ]) !!}
                                {{-- <button type="submit" class="btn btn-primary"><i
                                        class="far fa-paper-plane"></i>&nbsp;Enregistrer</button> --}}
                                {{--  <div class="bg-gradient-secondary text-center">
                                    <p class="h5 text-white mb-2">{{ __("ZONES D'INTERVENTION") }}</p>
                                </div>  --}}
                                <div class="form-row">
                                    <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                        <strong>Regions(<span class="text-danger">*</span>)</strong>
                                        <br />
                                        <div class="checkbox select-all">
                                            <input id="all" type="checkbox" />
                                            <label for="all">Toutes</label>
                                        </div>
                                        @foreach ($region as $regions)
                                            <span class="checkbox rows">
                                                <label for="regions"><input id="region" name="regions[]"
                                                        value="{{ $regions->id }}" type="checkbox" />
                                                    {{ $regions->nom }}</label>
                                            </span>
                                            {{--  <label>{{ Form::checkbox('region[]', $regions->id, false, ['class' => 'name-input checkbox rows']) }}
                                                {{ $regions->nom }}</label>  --}}
                                        @endforeach
                                        <small id="emailHelp" class="form-text text-muted">
                                            @if ($errors->has('region'))
                                                @foreach ($errors->get('region') as $message)
                                                    <p class="text-danger">{{ $message }}</p>
                                                @endforeach
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-outline-primary"><i
                                            class="far fa-paper-plane"></i>&nbsp;Enregistrer</button>
                                </div>
                            </form>
                            <div class="modal fade" id="error-modal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Verifier les donn&eacute;es
                                                saisies svp</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($errors->any())
                                                @if (count($errors) > 0)
                                                    <div class="alert alert-danger mt-2">
                                                        <strong>Oups!</strong> Il y a eu quelques problèmes avec vos
                                                        entrées.
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                @push('scripts')
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $("#error-modal").modal({
                                                                'show': true,
                                                            })
                                                        });
                                                    </script>
                                                @endpush
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>
    <script id="document-template" type="text/x-handlebars-template">
   
    </script>
    <script type="text/javascript">
        $('#commune').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('commune.fetch') }}",
                    method: "POST",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('#communeList').fadeIn();
                        $('#communeList').html(data);
                    }
                });
            }
        });
        $('#email').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('employe.fetch') }}",
                    method: "POST",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('#emailList').fadeIn();
                        $('#emailList').html(data);
                    }
                });
            }
        });
        $(document).on('click', 'li', function() {
            $('#commune').val($(this).data("name"));
            $('#communeList').fadeOut();
        });
        $(document).on('click', 'li', function() {
            $('#commune').val($(this).data("commune"));
            $('#arrondissement').val($(this).data("arrondissement"));
            $('#departement').val($(this).data("departement"));
            $('#laregion').val($(this).data("region"));
            $('#communeList').fadeOut();
        });
    </script>
    <script type="text/javascript">
        $('#all').change(function(e) {
            if (e.currentTarget.checked) {
                $('.rows').find('input[type="checkbox"]').prop('checked', true);
            } else {
                $('.rows').find('input[type="checkbox"]').prop('checked', false);
            }
        });
    </script>
@endsection
