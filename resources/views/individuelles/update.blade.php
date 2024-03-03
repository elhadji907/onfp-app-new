@extends('layout.default')
@section('title', 'FORMULAIRE DE CANDIDATURE - ONFP')
@section('content')
    <div class="content mb-5">
        <div class="container col-12 col-md-12 col-lg-8 col-xl-12">
            <div class="container-fluid">
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
                <div class="row justify-content-center pb-2">
                    <div class="col-lg-12 margin-tb">
                        <a class="btn btn-outline-success" href="{{ route('individuelles.index') }}"> <i
                                class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                    </div>
                </div>
                <div class="card border-success">
                    <div class="card card-header text-center bg-gradient-default border-success">
                        <h1 class="h4 card-title text-center text-black h-100 text-uppercase mb-0"><b></b><span
                                class="font-italic">FORMULAIRE DE MODIFICATION</span></h1>
                    </div>
                    <div class="card-body">
                        NB : Les champs(<span class="text-danger">*</span>)sont obligatoires
                        <hr class="sidebar-divider my-0"><br>
                        {!! Form::open(['url' => 'individuelles/' . $individuelle->id, 'method' => 'PATCH', 'files' => true]) !!}
                        @csrf
                        <div class="bg-gradient-secondary text-center">
                            <p class="h5 text-white mb-2">IDENTIFICATION DU CANDIDAT</p>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="date_depot">{{ __('Date dépôt') }}(<span
                                        class="text-danger">*</span>)</label>
                                <input id="date_depot" {{ $errors->has('date_r') ? 'is-invalid' : '' }} type="date"
                                    class="form-control form-control-sm @error('date_depot') is-invalid @enderror" name="date_depot"
                                    placeholder="Votre date dépôt"
                                    value="{{ $individuelle->date_depot->format('Y-m-d') ?? old('date_depot') }}"
                                    autocomplete="date_depot">
                                @error('date_depot')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="numero_dossier">{{ __('Numero de dossier') }}(<span
                                        class="text-danger">*</span>)</label>
                                <input id="numero_dossier" type="text"
                                    class="form-control form-control-sm @error('numero_dossier') is-invalid @enderror" name="numero_dossier"
                                    placeholder="Votre et numero de dossier"
                                    value="{{ $individuelle->demandeur->numero_dossier ?? old('numero_dossier') }}"
                                    autocomplete="numero_dossier">
                                @error('numero_dossier')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="cin">{{ __('CIN') }}(<span class="text-danger">*</span>)</label>
                                <input id="cin" type="text" class="form-control form-control-sm @error('cin') is-invalid @enderror"
                                    name="cin" placeholder="Votre et cin"
                                    value="{{ $individuelle->demandeur->cin ?? old('cin') }}" autocomplete="cin">
                                @error('cin')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="prenom">{{ __('Prénom') }}(<span class="text-danger">*</span>)</label>
                                <input id="prenom" type="text" class="form-control form-control-sm @error('prenom') is-invalid @enderror"
                                    name="prenom" placeholder="Votre et prenom"
                                    value="{{ $individuelle->demandeur->user->firstname ?? old('prenom') }}"
                                    autocomplete="prenom">
                                @error('prenom')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="nom">{{ __('Nom') }}(<span class="text-danger">*</span>)</label>
                                <input id="nom" type="text" class="form-control form-control-sm @error('nom') is-invalid @enderror"
                                    name="nom" placeholder="Votre et nom"
                                    value="{{ $individuelle->demandeur->user->name ?? old('nom') }}" autocomplete="nom">
                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="date_naiss">{{ __('Date de naissance') }}(<span
                                        class="text-danger">*</span>)</label>
                                <input id="date_naiss" {{ $errors->has('date_naiss') ? 'is-invalid' : '' }} type="date"
                                    class="form-control form-control-sm @error('date_naiss') is-invalid @enderror" name="date_naiss"
                                    placeholder="Votre date de naissance"
                                    value="{{ $individuelle->demandeur->user->date_naissance->format('Y-m-d') ?? old('date_naiss') }}"
                                    autocomplete="date_naiss">
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
                                    class="form-control form-control-sm @error('lieu_naissance') is-invalid @enderror" name="lieu_naissance"
                                    placeholder="Votre lieu de naissance"
                                    value="{{ $individuelle->demandeur->user->lieu_naissance ?? old('lieu_naissance') }}"
                                    autocomplete="lieu_naissance">
                                @error('lieu_naissance')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="email">{{ __('Addresse E-Mail') }}(<span
                                        class="text-danger">*</span>)</label>
                                <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror"
                                    name="email" placeholder="Votre adresse e-mail"
                                    value="{{ $individuelle->demandeur->user->email ?? old('email') }}"
                                    autocomplete="email">
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
                                    class="form-control form-control-sm @error('telephone') is-invalid @enderror" name="telephone"
                                    placeholder="70 000 00 00"
                                    value="{{ $individuelle->demandeur->user->telephone ?? old('telephone') }}"
                                    autocomplete="telephone">
                                @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="telephone_secondaire">{{ __('Téléphone parent (ou tuteur)') }}</label>
                                <input id="telephone_secondaire" type="text"
                                    class="form-control form-control-sm @error('telephone_secondaire') is-invalid @enderror"
                                    name="telephone_secondaire" placeholder="70 000 00 00"
                                    value="{{ $individuelle->telephone ?? old('telephone_secondaire') }}"
                                    autocomplete="telephone_secondaire">
                                @error('telephone_secondaire')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="adresse">{{ __('Adresse de résidence') }}(<span
                                        class="text-danger">*</span>)</label>
                                <textarea class="form-control form-control-sm  @error('adresse') is-invalid @enderror" name="adresse" id="adresse" rows="1"
                                    placeholder="Votre adresse complète">{{ $individuelle->demandeur->user->adresse ?? old('adresse') }}</textarea>
                                @error('adresse')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                {!! Form::label('Commune :') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('commune', $communes, $individuelle->commune->nom ?? old('commune'), ['placeholder' => '', 'class' => 'form-control form-control-sm', 'id' => 'commune', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('commune'))
                                        @foreach ($errors->get('commune') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label>{{ __("Situation matrimoniale  : ")}}</label> 
                                {!! Form::select('familiale', $familiale, $individuelle->demandeur->user->familiale->name ?? old('familiale'), ['placeholder' => 'Votre situation familiale', 'class' => 'form-control form-control-sm', 'id' => 'familiale', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('familiale'))
                                        @foreach ($errors->get('familiale') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label>{{ __("Nombre d'enfants en charge : ")}}</label> (<span class="text-danger">*</span>)
                                {!! Form::number('enfant', $individuelle->nbre_enfants ?? old('enfant'), ['placeholder' => 'Ex: 2', 'class' => 'form-control form-control-sm', 'min' => '0', 'max' => '50']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('enfant'))
                                        @foreach ($errors->get('enfant') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                {!! Form::label('Genre :', null, ['class' => 'control-label']) !!}(<span class="text-danger">*</span>)
                                {!! Form::select('sexe', ['M' => 'M', 'F' => 'F'], $individuelle->demandeur->user->sexe ?? old('sexe'), ['placeholder' => 'sélectionner sexe', 'class' => 'form-control form-control-sm-lg', 'id' => 'sexe', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('sexe'))
                                        @foreach ($errors->get('sexe') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="bg-gradient-secondary text-center">
                            <p class="h5 text-white mb-2">PARCOURS ACADEMIQUE ET PROFESSIONNEL</p>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3 col-lg-3 col-xs-12 col-sm-12">
                                <label>{{ __("Niveau d'étude : ")}}</label> (<span class="text-danger">*</span>)
                                {!! Form::select('etude', $etude, $individuelle->etude->name ?? old('etude'), ['placeholder' => 'Niveau d\'étude', 'class' => 'form-control form-control-sm', 'id' => 'etude', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('etude'))
                                        @foreach ($errors->get('etude') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-3 col-lg-3 col-xs-12 col-sm-12">
                                <label>{{ __("Diplômes académiques : ")}}</label> (<span class="text-danger">*</span>)
                                {!! Form::select('diplome', $diplomes, $individuelle->diplome->sigle ?? old('diplome'), ['placeholder' => 'diplome', 'class' => 'form-control form-control-sm', 'id' => 'diplome', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('diplome'))
                                        @foreach ($errors->get('diplome') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-2 col-lg-2 col-xs-12 col-sm-12">
                                <label>{{ __("Année d'obtention : ")}}</label>
                                {!! Form::number('annee_diplome', $individuelle->annee_diplome ?? old('annee_diplome'), ['placeholder' => 'Ex: 2010', 'class' => 'form-control form-control-sm', 'min' => '1980', 'max' => '2022']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('annee_diplome'))
                                        @foreach ($errors->get('annee_diplome') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="autres_diplomes">{{ __('Si autre, précisez :') }}</label>
                                <textarea class="form-control form-control-sm  @error('autres_diplomes') is-invalid @enderror" name="autres_diplomes"
                                    id="autres_diplomes" rows="1"
                                    placeholder="autre diplôme académique">{{ $individuelle->autres_diplomes ?? old('autres_diplomes') }}</textarea>
                                @error('autres_diplomes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 col-lg-3 col-xs-12 col-sm-12">
                                <label>{{ __("Diplômes professionnels : ")}}</label>(<span class="text-danger">*</span>)
                                {!! Form::select('diplomespro', $diplomespros, $individuelle->diplomespro->sigle ?? old('diplomespro'), ['placeholder' => 'diplomespro', 'class' => 'form-control form-control-sm', 'id' => 'diplome_pros', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('diplomespro'))
                                        @foreach ($errors->get('diplomespro') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-2 col-lg-2 col-xs-12 col-sm-12">
                                <label>{{ __("Année d'obtention : ")}}</label> :
                                {!! Form::number('annee_diplome_professionelle', $individuelle->annee_diplome_professionelle ?? old('annee_diplome_professionelle'), ['placeholder' => 'Ex: 2021', 'class' => 'form-control form-control-sm', 'min' => '1980', 'max' => '2022']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('annee_diplome_professionelle'))
                                        @foreach ($errors->get('annee_diplome_professionelle') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-3 col-lg-3 col-xs-12 col-sm-12">
                                <label for="specialite">{{ __('Spécialité') }}</label>
                                <input id="specialite" type="specialite"
                                    class="form-control form-control-sm @error('specialite') is-invalid @enderror" name="specialite"
                                    placeholder="Ex: Comptabilité"
                                    value="{{ $individuelle->optiondiplome ?? old('specialite') }}"
                                    autocomplete="specialite">
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('specialite'))
                                        @foreach ($errors->get('specialite') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="autres_diplomes_pros">{{ __('Si autre, précisez :') }}</label>
                                <textarea class="form-control form-control-sm  @error('autres_diplomes_pros') is-invalid @enderror" name="autres_diplomes_pros"
                                    id="autres_diplomes_pros" rows="1"
                                    placeholder="autre diplôme professionnel">{{ $individuelle->autres_diplomes_pros ?? old('autres_diplomes_pros') }}</textarea>
                                @error('autres_diplomes_pros')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="bg-gradient-secondary text-center">
                            <p class="h5 text-white mb-2">PROJET PROFESSIONNEL</p>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                <label
                                    for="activite_travail">{{ __('Quellle activité ou travail exercez-vous ? ') }}(<span
                                        class="text-danger">*</span>)</label>
                                <textarea class="form-control form-control-sm  @error('activite_travail') is-invalid @enderror" name="activite_travail"
                                    id="activite_travail" rows="1"
                                    placeholder="Votre activité ou travail que vous exercez">{{ $individuelle->activite_travail ?? old('activite_travail') }}</textarea>
                                @error('activite_travail')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label>{{ __('Etes-vous dans un travail rénuméré ? ') }}</label> :(<span
                                    class="text-danger">*</span>)
                                <br />
                                {{ Form::radio('travail_renumeration', 'Oui', $individuelle->travail_renumeration == 'Oui' ? 'checked' : '', ['class' => 'name']) }}
                                {{ __('Oui') }}
                                <br />
                                {{ Form::radio('travail_renumeration', 'Non', $individuelle->travail_renumeration == 'Non' ? 'checked' : '', ['class' => 'name']) }}
                                {{ __('Non') }}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('travail_renumeration'))
                                        @foreach ($errors->get('travail_renumeration') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label>{{ __("Si oui, comment trouvez-vous votre salaire ? ")}}</label> :
                                <br />
                                {{ Form::radio('salaire', 'Indécent', $individuelle->salaire == 'Indécent' ? 'checked' : '', ['class' => 'name']) }}
                                {{ __('Indécent') }}
                                <br />
                                {{ Form::radio('salaire', 'Moyen', $individuelle->salaire == 'Moyen' ? 'checked' : '', ['class' => 'name']) }}
                                {{ __('Moyen') }}
                                <br />
                                {{ Form::radio('salaire', 'Bien', $individuelle->salaire == 'Bien' ? 'checked' : '', ['class' => 'name']) }}
                                {{ __('Bien') }}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('salaire'))
                                        @foreach ($errors->get('salaire') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                <label
                                    for="activite_avenir">{{ __('Dans quellle activité voulez-vous travailler à l\'avenir ? ') }}(<span
                                        class="text-danger">*</span>)</label>
                                <textarea class="form-control form-control-sm  @error('activite_avenir') is-invalid @enderror" name="activite_avenir"
                                    id="activite_avenir" rows="1"
                                    placeholder="Votre activité ou travail dans l'avenir">{{ $individuelle->activite_avenir ?? old('activite_avenir') }}</textarea>
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('activite_avenir'))
                                        @foreach ($errors->get('activite_avenir') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="bg-gradient-secondary text-center">
                            <p class="h5 text-white mb-2">SITUATION ÉCONOMIQUE</p>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label> {{ __("Souffrez-vous d'un handicap quelconque ?") }} </label> :(<span
                                    class="text-danger">*</span>)
                                <br />
                                {{ Form::radio('handicap', 'Oui', $individuelle->handicap == 'Oui' ? 'checked' : '', ['class' => 'name']) }}
                                {{ __('Oui') }}
                                <br />
                                {{ Form::radio('handicap', 'Non', $individuelle->handicap == 'Non' ? 'checked' : '', ['class' => 'name']) }}
                                {{ __('Non') }}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('handicap'))
                                        @foreach ($errors->get('handicap') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-8 col-lg-8 col-xs-12 col-sm-12">
                                <label for="preciser_handicap">{{ __('Si oui, précisez-le ou lesquels ? ') }}</label>
                                <textarea class="form-control form-control-sm  @error('preciser_handicap') is-invalid @enderror" name="preciser_handicap"
                                    id="preciser_handicap" rows="1"
                                    placeholder="Précisez le type de handicap">{{ $individuelle->preciser_handicap ?? old('preciser_handicap') }}</textarea>
                                @error('preciser_handicap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label>
                                    {{ __('Comment appréciez-vous votre situation économique familiale ?') }}(<span
                                        class="text-danger">*</span>)
                                </label> :
                                <br />
                                {{ Form::radio('situation_economique','Très faible',$individuelle->situation_economique == 'Très faible' ? 'checked' : '',['class' => 'name']) }}
                                {{ __('Très faible') }}
                                <br />
                                {{ Form::radio('situation_economique','Faible',$individuelle->situation_economique == 'Faible' ? 'checked' : '',['class' => 'name']) }}
                                {{ __('Faible') }}
                                <br />
                                {{ Form::radio('situation_economique','Moyenne',$individuelle->situation_economique == 'Moyenne' ? 'checked' : '',['class' => 'name']) }}
                                {{ __('Moyenne') }}
                                <br />
                                {{ Form::radio('situation_economique','Correcte',$individuelle->situation_economique == 'Correcte' ? 'checked' : '',['class' => 'name']) }}
                                {{ __('Correcte') }}
                                <br />
                                {{ Form::radio('situation_economique','Aucun',$individuelle->situation_economique == 'Aucun' ? 'checked' : '',['class' => 'name']) }}
                                {{ __('Aucun') }}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('situation_economique'))
                                        @foreach ($errors->get('situation_economique') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label> {{ __('Avez-vous été victime d\'un quelconque problème social ?') }}(<span
                                        class="text-danger">*</span>)
                                </label> :
                                <br />
                                {{ Form::radio('victime_social','Emigration irrégulière',$individuelle->victime_social == 'Emigration irrégulière' ? 'checked' : '',['class' => 'name']) }}
                                {{ __('Emigration irrégulière') }}
                                <br />
                                {{ Form::radio('victime_social','Déplacé ou démobilisé par le conflit',$individuelle->victime_social == 'Déplacé ou démobilisé par le conflit' ? 'checked' : '',['class' => 'name']) }}
                                {{ __('Déplacé ou démobilisé par le conflit') }}
                                <br />
                                {{ Form::radio('victime_social','Emprisonnement',$individuelle->victime_social == 'Emprisonnement' ? 'checked' : '',['class' => 'name']) }}
                                {{ __('Emprisonnement') }}
                                <br />
                                {{ Form::radio('victime_social', 'Aucun', $individuelle->victime_social == 'Aucun' ? 'checked' : '', ['class' => 'name']) }}
                                {{ __('Aucun') }}
                                <br />
                                {{ Form::radio('victime_social', 'Autre', $individuelle->victime_social == 'Autre' ? 'checked' : '', ['class' => 'name']) }}
                                {{ __('Autre') }}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('victime_social'))
                                        @foreach ($errors->get('victime_social') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="autre_victime">{{ __('Si autre, précisez :') }}</label>
                                <textarea class="form-control form-control-sm  @error('autre_victime') is-invalid @enderror" name="autre_victime" id="autre_victime"
                                    rows="1"
                                    placeholder="Autre victime">{{ $individuelle->autre_victime ?? old('autre_victime') }}</textarea>
                                @error('autre_victime')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="bg-gradient-secondary text-center">
                            <p class="h5 text-white mb-2">COMPOSITION DOSSIER</p>
                        </div>
                        <div class="form-row">
                            {{--  <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="autre_diplomes_fournis"><b>{{ __('Composition dossier :') }}</b></label>
                                <br />
                                {{ Form::checkbox('dossier', 'Fiche de candidature', true, ['class' => 'name', 'disabled' => 'disabled']) }}
                                {{ __('Fiche de candidature') }}(<span class="text-danger">*</span>)
                                <br />
                                {{ Form::checkbox('dossier', "Copie carte nationale d'identité", true, ['class' => 'name','disabled' => 'disabled']) }}
                                {{ __("Copie carte nationale d'identité") }}(<span class="text-danger">*</span>)
                                <br />
                                {{ Form::checkbox('dossier', 'Certificat de résidence', true, ['class' => 'name', 'disabled' => 'disabled']) }}
                                {{ __('Certificat de résidence') }}(<span class="text-danger">*</span>)
                                <br />
                                {{ Form::checkbox('dossiers', 'Copie diplomes ou attestations', $individuelle->dossier ? true : false, ['class' => 'name']) }}
                                {{ __('Copie diplomes ou attestations') }}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('dossier'))
                                        @foreach ($errors->get('dossier') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>  --}}
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="autre_diplomes_fournis"><b>{{ __('Total documents fournis :') }}</b></label>
                                {!! Form::number('nbre_pieces', $individuelle->nbre_pieces, ['placeholder' => 'Ex: 4', 'class' => 'form-control form-control-sm', 'min' => '0', 'max' => '25']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('nbre_pieces'))
                                        @foreach ($errors->get('nbre_pieces') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-8 col-lg-8 col-xs-12 col-sm-12">
                                <label for="autre_diplomes_fournis"><b>{{ __('Précisez-les :') }}</b></label>
                                <textarea class="form-control form-control-sm  @error('autre_diplomes_fournis') is-invalid @enderror" name="autre_diplomes_fournis"
                                    id="autre_diplomes_fournis" rows="1"
                                    placeholder="Enumérer les autres diplômes, certificats, titres, attestations, contrats de travail ou stage">{{ $individuelle->autre_diplomes_fournis ?? old('autre_diplomes_fournis') }}</textarea>
                                @error('autre_diplomes_fournis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="bg-gradient-secondary text-center">
                            <p class="h5 text-white mb-2">MODULE</p>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                {!! Form::label('Module :') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('module', $modules, $individuelle->module->name ?? old('module'), ['placeholder' => '', 'data-width' => '100%', 'class' => 'form-control form-control-sm', 'id' => 'module']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('module'))
                                        @foreach ($errors->get('module') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-outline-primary"><i
                                    class="far fa-paper-plane"></i>&nbsp;Modifier</button>
                        </div>
                    </div>
                </div>
                <br />
                <input type="hidden" name="password" class="form-control form-control-sm" id="exampleInputPassword1"
                    placeholder="Mot de passe">
                {!! Form::hidden('username', $individuelle->demandeur->user->username, ['placeholder' => '', 'class' => 'form-control form-control-sm']) !!}
                {{-- {!! Form::hidden('updated_by', $individuelle->demandeur->user->updated_by, ['placeholder' => '', 'class' => 'form-control form-control-sm']) !!} --}}
                {!! Form::hidden('numero', $individuelle->demandeur->numero, ['placeholder' => '', 'class' => 'form-control form-control-sm']) !!}
                {!! Form::hidden('password', null, ['placeholder' => 'Votre mot de passe', 'class' => 'form-control form-control-sm']) !!}
                {!! Form::close() !!}
                <div class="modal fade" id="error-modal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Verifier les donn&eacute;es
                                    saisies svp</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $('input[type=checkbox]').on('change', function(e) {
            if ($('input[type=checkbox]:checked').length > 7) {
                $(this).prop('checked', false);
                alert("autorisé seulement 3");
            }
        });
    </script>
@endpush
{{-- @section('javascripts')
    <script type="text/javascript">
        $('#moduleup').select2().val({!! json_encode($individuelle->modules()->allRelatedIds()) !!}).trigger('change');
    </script>
@endsection --}}
