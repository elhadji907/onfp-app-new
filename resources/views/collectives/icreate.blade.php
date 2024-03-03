@extends('layout.default')
@section('title', 'ONFP - Modification demandeur collective')
@section('content')
    <div class="content mb-5">
        <div class="container col-12 col-md-12 col-lg-8 col-xl-12">
            <div class="container-fluid">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                <div class="row pt-0"></div>
                <div class="card">
                    <div class="card-header bg-secondary text-center">
                        <h1 class="h4 text-white mb-0"><span data-feather="info"></span>Compléter ma demande
                            collective</h1>
                    </div>
                    <div class="card-body">
                        NB : Les champs(<span class="text-danger">*</span>)sont obligatoires
                        <form method="POST" action="{{ url('collectives') }}">
                            @csrf
                            <div class="text-center">
                                <p class="h4 bg-secondary text-white mb-2 mt-0">RESPONSABLE</p>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="cin">{{ __('CIN') }}(<span class="text-danger">*</span>)</label>
                                    <input id="cin" type="text" class="form-control @error('cin') is-invalid @enderror"
                                        name="cin" placeholder="Votre et cin"
                                        value="{{ $user->demandeur->cin ?? old('cin') }}" autocomplete="cin">
                                    @error('cin')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="prenom">{{ __('Prénom') }}(<span class="text-danger">*</span>)</label>
                                    <input id="prenom" type="text"
                                        class="form-control @error('prenom') is-invalid @enderror" name="prenom"
                                        placeholder="Votre et prenom" value="{{ $user->firstname ?? old('prenom') }}"
                                        autocomplete="prenom">
                                    @error('prenom')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="nom">{{ __('Nom') }}(<span class="text-danger">*</span>)</label>
                                    <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror"
                                        name="nom" placeholder="Votre et nom" value="{{ $user->name ?? old('nom') }}"
                                        autocomplete="nom">
                                    @error('nom')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="date_naiss">{{ __('Date de naissance') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <input id="date_naiss" {{ $errors->has('date_r') ? 'is-invalid' : '' }} type="date"
                                        class="form-control @error('date_naiss') is-invalid @enderror" name="date_naiss"
                                        placeholder="Votre date de naissance"
                                        value="{{ $user->date_naissance->format('Y-m-d') ?? old('date_naiss') }}"
                                        autocomplete="username">
                                    @error('date_naiss')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="lieu_naissance">{{ __('Lieu de naissance') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <input id="lieu_naissance" type="text"
                                        class="form-control @error('lieu_naissance') is-invalid @enderror"
                                        name="lieu_naissance" placeholder="Votre lieu de naissance"
                                        value="{{ $user->lieu_naissance ?? old('lieu_naissance') }}"
                                        autocomplete="lieu_naissance">
                                    @error('lieu_naissance')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="email">{{ __('E-Mail') }}(<span class="text-danger">*</span>)</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" placeholder="Votre adresse e-mail"
                                        value="{{ $user->email ?? old('email') }}" autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                    </small>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="telephone">{{ __('Telephone') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <input id="telephone" type="text"
                                        class="form-control @error('telephone') is-invalid @enderror" name="telephone"
                                        placeholder="7x xxx xx xx" value="{{ $user->telephone ?? old('telephone') }}"
                                        autocomplete="telephone">
                                    @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="fixe">{{ __('Fixe') }}(<span class="text-danger">*</span>)</label>
                                    <input id="fixe" type="text" class="form-control @error('fixe') is-invalid @enderror"
                                        name="fixe" placeholder="3x xxx xx xx" value="{{ $user->fixe ?? old('fixe') }}"
                                        autocomplete="fixe">
                                    @error('fixe')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="autre_tel">{{ __('Téléphone secondaire') }}</label>
                                    <input id="autre_tel" type="text"
                                        class="form-control @error('autre_tel') is-invalid @enderror" name="autre_tel"
                                        placeholder="7x xxx xx xx" value="{{ $user->demandeur->telephone ?? old('autre_tel') }}"
                                        autocomplete="autre_tel">
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    {!! Form::label('sexe :', null, ['class' => 'control-label']) !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('sexe', ['M' => 'M', 'F' => 'F'], $user->sexe, ['placeholder' => 'sélectionner sexe', 'class' => 'form-control', 'id' => 'sexe', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('sexe'))
                                            @foreach ($errors->get('sexe') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    <label for="input-name">{{ __('Situation professionnelle') }}:</label>
                                    <select name="professionnelle" id="professionnelle" class="form-control"
                                        data-width="100%">
                                        <option value="{{ $user->situation_professionnelle }}">
                                            {{ $user->situation_professionnelle }}</option>
                                        <option value="">{{ __('...sélectionner...') }}</option>
                                        <option value="{{ 'Salarié CDD' }}">{{ 'Salarié CDD' }}</option>
                                        <option value="{{ 'Recherche d\'emploi' }}">{{ 'Recherche d\'emploi' }}
                                        </option>
                                        <option value="{{ 'Salarié CDI' }}">{{ 'Salarié CDI' }}</option>
                                        <option value="{{ 'Élève' }}">{{ 'Élève' }}</option>
                                        <option value="{{ 'Étudiant(e)' }}">{{ 'Étudiant(e)' }}</option>
                                        <option value="{{ 'Sans activité' }}">{{ 'Sans activité' }}</option>
                                        <option value="{{ 'En stage' }}">{{ 'En stage' }}</option>
                                        <option value="{{ 'Autre' }}">{{ 'Autre' }}</option>
                                    </select>
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('professionnelle'))
                                            @foreach ($errors->get('professionnelle') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    <label for="adresse">{{ __('Adresse de résidence') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <textarea class="form-control  @error('adresse') is-invalid @enderror" name="adresse"
                                        id="adresse" rows="1"
                                        placeholder="Votre adresse complète">{{ $user->adresse ?? old('adresse') }}</textarea>
                                    @error('adresse')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    <div class="text-center">
                                        <p class="h4 bg-secondary text-white mb-2">DEMANDE</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    <label for="name">{{ __('Structure') }}(<span class="text-danger">*</span>)</label>
                                    <textarea class="form-control  @error('name') is-invalid @enderror" name="name"
                                        id="name" rows="2" placeholder="nom de la structure">{{ old('name') }}</textarea>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    {!! Form::label('Commune :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('commune', $communes, null, ['placeholder' => 'Choir une commune', 'class' => 'form-control', 'id' => 'commune', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('commune'))
                                            @foreach ($errors->get('commune') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    <label for="structure_adresse">{{ __('Adresse complète de la structure') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <textarea class="form-control  @error('structure_adresse') is-invalid @enderror"
                                        name="structure_adresse" id="structure_adresse" rows="2"
                                        placeholder="adresse de la structure">{{ old('structure_adresse') }}</textarea>
                                    @error('structure_adresse')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="structure_fixe">{{ __('Fixe structure') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <input id="structure_fixe" type="text"
                                        class="form-control @error('structure_fixe') is-invalid @enderror"
                                        name="structure_fixe" placeholder="3x xxx xx xx"
                                        value="{{ old('structure_fixe') }}" autocomplete="structure_fixe">
                                    @error('structure_fixe')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="bp">{{ __('Boite postale') }}</label>
                                    <input id="bp" type="text" class="form-control @error('bp') is-invalid @enderror"
                                        name="bp" placeholder="Votre adresse postale"
                                        value="{{ $user->bp ?? old('bp') }}" autocomplete="bp">
                                    @error('bp')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="fax">{{ __('Téléphone fax') }}</label>
                                    <input id="fax" type="text" class="form-control @error('fax') is-invalid @enderror"
                                        name="fax" placeholder="Votre numero de fax"
                                        value="{{ $user->fax ?? old('fax') }}" autocomplete="fax">
                                    @error('fax')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                {{-- <div class="form-row"> --}}
                                {{-- <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12"> --}}
                                {{-- {!! Form::label('N° courrier :') !!}(<span class="text-danger">*</span>) --}}
                                {!! Form::hidden('numero_courrier', null, ['placeholder' => 'Le numéro du courrier', 'class' => 'form-control']) !!}
                                {{-- <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('numero_courrier'))
                                            @foreach ($errors->get('numero_courrier') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12"> --}}
                                {{-- {!! Form::label('Nbre pièces:') !!}(<span class="text-danger">*</span>) --}}
                                {!! Form::hidden('nombre_de_piece', 3, ['placeholder' => 'Le nombre de pièces fournis', 'class' => 'form-control', 'min' => '3', 'max' => '20']) !!}
                                {{-- <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('nombre_de_piece'))
                                            @foreach ($errors->get('nombre_de_piece') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12"> --}}
                                {{-- {!! Form::label('Dépot :', null, ['class' => 'control-label']) !!}(<span class="text-danger">*</span>) --}}
                                {!! Form::hidden('date_depot', $date_depot->format('Y-m-d'), ['placeholder' => 'La date de dépot', 'class' => 'form-control']) !!}
                                {{-- <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('date_depot'))
                                            @foreach ($errors->get('date_depot') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div> --}}
                                {{-- </div> --}}
                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    {!! Form::label('modules demandés :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('modules[]', $modules, null, ['multiple' => 'multiple', 'data-width' => '100%', 'class' => 'form-control', 'id' => 'module']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('modules'))
                                            @foreach ($errors->get('modules') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    <label
                                        for="description">{{ __('Pourquoi voulez-vous faire cette formation ?') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <textarea class="form-control  @error('description') is-invalid @enderror"
                                        name="description" id="description" rows="5"
                                        placeholder="Décrire en quelques lignes votre projet pour cette formation">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    {!! Form::label('experience :') !!}
                                    {!! Form::textarea('experience', null, ['placeholder' => 'Experience dans le domaine, ...', 'rows' => 2, 'class' => 'form-control']) !!}
                                </div>
                                @hasrole('Administrateur|Gestionnaire')
                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    {!! Form::label('Statut :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('statut', ['Attente' => 'Attente', 'Retenue' => 'Retenue', 'Annulée' => 'Annulée', 'Présélectionné' => 'Présélectionné', 'Absent' => 'Absent', 'En cours' => 'En cours', 'Terminée' => 'Terminée'], null, ['placeholder' => '', 'data-width' => '100%', 'class' => 'form-control', 'id' => 'statut']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('statut'))
                                            @foreach ($errors->get('statut') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                            @else
                                @endhasrole
                                @hasrole('Administrateur|Gestionnaire')
                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    <div class="text-center">
                                        <p class="h4 bg-secondary text-white mb-2">INSCRIVEZ-VOUS A UN PROGRAMME</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    {!! Form::label('Programme :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('programme', $programmes, null, ['placeholder' => 'Choir un programme', 'class' => 'form-control', 'id' => 'programme', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('programme'))
                                            @foreach ($errors->get('programme') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                            @else
                                @endhasrole
                            </div>
                            {!! Form::hidden('username', $user->username, ['placeholder' => 'Votre nom', 'class' => 'form-control']) !!}
                            {!! Form::hidden('numero', null, ['placeholder' => '', 'class' => 'form-control']) !!}
                            <input type="hidden" name="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Mot de passe">
                            {!! Form::hidden('password', null, ['placeholder' => 'Votre mot de passe', 'class' => 'form-control']) !!}
                            <button type="submit" class="btn btn-primary"><i
                                    class="far fa-paper-plane"></i>&nbsp;Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
