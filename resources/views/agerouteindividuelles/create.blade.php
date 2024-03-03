@extends('layout.default')
@section('title', 'FORMULAIRE DE CANDIDATURE - ONFP - AGEROUTE')
@section('content')
    <div class="content mb-5">
        <div class="container col-12 col-md-12 col-lg-8 col-xl-12">
            <div class="container-fluid">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                <div class="row justify-content-center pb-2">
                    <div class="col-lg-12 margin-tb">
                        <a class="btn btn-outline-success" href="{{ route('agerouteindividuelles.index') }}"> <i
                                class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                    </div>
                </div>
                <div class="card border-success">
                    <div class="card card-header text-center bg-gradient-default border-success">
                        <h1 class="h4 card-title text-center text-black h-100 text-uppercase mb-0"><b></b><span
                                class="font-italic">FORMULAIRE DE CANDIDATURE</span></h1>
                    </div>
                    <div class="card-body">
                        NB : Les champs(<span class="text-danger">*</span>)sont obligatoires
                        <hr class="sidebar-divider my-0"><br>
                        <form method="POST" action="{{ url('agerouteindividuelles') }}">
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
                                        placeholder="Votre date dépôt" value="{{ old('date_depot') }}"
                                        autocomplete="username">
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
                                        class="form-control form-control-sm @error('numero_dossier') is-invalid @enderror"
                                        name="numero_dossier" placeholder="Votre et numero de dossier"
                                        value="{{ old('numero_dossier') }}" autocomplete="numero_dossier">
                                    @error('numero_dossier')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="cin">{{ __('CIN') }}(<span class="text-danger">*</span>)</label>
                                    <input id="cin" type="text" class="form-control form-control-sm @error('cin') is-invalid @enderror"
                                        name="cin" placeholder="Votre et cin" value="{{ old('cin') }}"
                                        autocomplete="cin">
                                    @error('cin')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="prenom">{{ __('Prénom') }}(<span class="text-danger">*</span>)</label>
                                    <input id="prenom" type="text"
                                        class="form-control form-control-sm @error('prenom') is-invalid @enderror" name="prenom"
                                        placeholder="Votre et prenom" value="{{ old('prenom') }}" autocomplete="prenom">
                                    @error('prenom')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="nom">{{ __('Nom') }}(<span class="text-danger">*</span>)</label>
                                    <input id="nom" type="text" class="form-control form-control-sm @error('nom') is-invalid @enderror"
                                        name="nom" placeholder="Votre et nom" value="{{ old('nom') }}"
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
                                    <input id="date_naiss" {{ $errors->has('date_naiss') ? 'is-invalid' : '' }}
                                        type="date" class="form-control form-control-sm @error('date_naiss') is-invalid @enderror"
                                        name="date_naiss" placeholder="Votre date de naissance"
                                        value="{{ old('date_naiss') }}" autocomplete="username">
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
                                        class="form-control form-control-sm @error('lieu_naissance') is-invalid @enderror"
                                        name="lieu_naissance" placeholder="Votre lieu de naissance"
                                        value="{{ old('lieu_naissance') }}" autocomplete="lieu_naissance">
                                    @error('lieu_naissance')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                {{--  <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="email">{{ __('Addresse E-Mail') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror"
                                        name="email" placeholder="Votre adresse e-mail" value="{{ old('email') }}"
                                        autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                    </small>
                                </div>  --}}
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label for="telephone">{{ __('Telephone') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <input id="telephone" type="text"
                                        class="form-control form-control-sm @error('telephone') is-invalid @enderror" name="telephone"
                                        placeholder="70 000 00 00" value="{{ old('telephone') }}"
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
                                        value="{{ old('telephone_secondaire') }}" autocomplete="telephone_secondaire">
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
                                        placeholder="Votre adresse complète">{{ old('adresse') }}</textarea>
                                    @error('adresse')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    {!! Form::label('Commune :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('commune', $communes, null, ['placeholder' => '', 'class' => 'form-control form-control-sm', 'id' => 'commune', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('commune'))
                                            @foreach ($errors->get('commune') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                {{-- <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    {!! Form::label('Situation professionnelle :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('professionnelle', $professionnelle, null, ['placeholder' => 'Votre situation professionnelle', 'class' => 'form-control form-control-sm', 'id' => 'professionnelle', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('professionnelle'))
                                            @foreach ($errors->get('professionnelle') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div> --}}
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label>{{ __('Situation matrimoniale  : ') }}</label>
                                    {!! Form::select('familiale', $familiale, null, ['placeholder' => 'Votre situation familiale', 'class' => 'form-control form-control-sm', 'id' => 'familiale', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('familiale'))
                                            @foreach ($errors->get('familiale') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label>{{ __("Nombre d'enfants en charge : ") }}</label> (<span
                                        class="text-danger">*</span>)
                                    {!! Form::number('enfant', null, ['placeholder' => 'Ex: 2', 'class' => 'form-control form-control-sm', 'min' => '0', 'max' => '50']) !!}
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
                                    {!! Form::select('sexe', ['M' => 'M', 'F' => 'F'], null, ['placeholder' => 'sélectionner sexe', 'class' => 'form-control form-control-sm-lg', 'id' => 'sexe', 'data-width' => '100%']) !!}
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
                                    <label>{{ __("Niveau d'étude : ") }}</label> (<span class="text-danger">*</span>)
                                    {!! Form::select('etude', $etude, null, ['placeholder' => 'Niveau d\'étude', 'class' => 'form-control form-control-sm', 'id' => 'etude', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('etude'))
                                            @foreach ($errors->get('etude') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-3 col-lg-3 col-xs-12 col-sm-12">
                                    <label>{{ __('Diplômes académiques : ') }}</label> (<span
                                        class="text-danger">*</span>)
                                    {!! Form::select('diplome', $diplomes, null, ['placeholder' => 'diplome', 'class' => 'form-control form-control-sm', 'id' => 'diplome', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('diplome'))
                                            @foreach ($errors->get('diplome') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-2 col-lg-2 col-xs-12 col-sm-12">
                                    <label>{{ __("Année d'obtention : ") }}</label>
                                    {!! Form::number('annee_diplome', null, ['placeholder' => 'Ex: 2010', 'class' => 'form-control form-control-sm', 'min' => '2000', 'max' => '2022']) !!}
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
                                        placeholder="autre diplôme académique">{{ old('autres_diplomes') }}</textarea>
                                    @error('autres_diplomes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3 col-lg-3 col-xs-12 col-sm-12">
                                    <label>{{ __('Diplômes professionnels : ') }}</label>(<span
                                        class="text-danger">*</span>)
                                    {!! Form::select('diplomespro', $diplomespros, null, ['placeholder' => 'diplomespro', 'class' => 'form-control form-control-sm', 'id' => 'diplome_pros', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('diplomespro'))
                                            @foreach ($errors->get('diplomespro') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-2 col-lg-2 col-xs-12 col-sm-12">
                                    <label>{{ __("Année d'obtention : ") }}</label> :
                                    {!! Form::number('annee_diplome_professionelle', null, ['placeholder' => 'Ex: 2021', 'class' => 'form-control form-control-sm', 'min' => '2000', 'max' => '2022']) !!}
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
                                        placeholder="Ex: Comptabilité" value="{{ old('specialite') }}"
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
                                        placeholder="autre diplôme professionnel">{{ old('autres_diplomes_pros') }}</textarea>
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
                                        placeholder="Votre activité ou travail que vous exercez">{{ old('activite_travail') }}</textarea>
                                    @error('activite_travail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    <label>Etes-vous dans un travail rénuméré ? </label> :(<span
                                        class="text-danger">*</span>)
                                    <br />
                                    <label>
                                        {{ Form::radio('travail_renumeration', 'Oui', false, ['class' => 'name']) }}
                                        {{ __('Oui') }}
                                        <br />
                                        {{ Form::radio('travail_renumeration', 'Non', false, ['class' => 'name']) }}
                                        {{ __('Non') }}
                                    </label>
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('travail_renumeration'))
                                            @foreach ($errors->get('travail_renumeration') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    <label>Si oui, comment trouvez-vous votre salaire ? </label> :
                                    <br />
                                    <label>
                                        {{ Form::radio('salaire', 'Indécent', false, ['class' => 'name']) }}
                                        {{ __('Indécent') }}
                                        <br />
                                        {{ Form::radio('salaire', 'Moyen', false, ['class' => 'name']) }}
                                        {{ __('Moyen') }}
                                        <br />
                                        {{ Form::radio('salaire', 'Bien', false, ['class' => 'name']) }}
                                        {{ __('Bien') }}
                                    </label>
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
                                        placeholder="Votre activité ou travail dans l'avenir">{{ old('activite_avenir') }}</textarea>
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
                                    <label>
                                        {{ Form::radio('handicap', 'Oui', false, ['class' => 'name']) }}
                                        {{ __('Oui') }}
                                        <br />
                                        {{ Form::radio('handicap', 'Non', false, ['class' => 'name']) }}
                                        {{ __('Non') }}
                                    </label>
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
                                        placeholder="Précisez le type de handicap">{{ old('preciser_handicap') }}</textarea>
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
                                    <label>
                                        {{ Form::radio('situation_economique', 'Très faible', false, ['class' => 'name']) }}
                                        {{ __('Très faible') }}
                                        <br />
                                        {{ Form::radio('situation_economique', 'Faible', false, ['class' => 'name']) }}
                                        {{ __('Faible') }}
                                        <br />
                                        {{ Form::radio('situation_economique', 'Moyenne', false, ['class' => 'name']) }}
                                        {{ __('Moyenne') }}
                                        <br />
                                        {{ Form::radio('situation_economique', 'Correcte', false, ['class' => 'name']) }}
                                        {{ __('Correcte') }}
                                        <br />
                                        {{ Form::radio('situation_economique', 'Aucun', false, ['class' => 'name']) }}
                                        {{ __('Aucun') }}
                                    </label>
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
                                    <label>
                                        {{ Form::radio('victime_social', 'Emigration irrégulière', false, ['class' => 'name']) }}
                                        {{ __('Emigration irrégulière') }}
                                        <br />
                                        {{ Form::radio('victime_social', 'Déplacé ou démobilisé par le conflit', false, ['class' => 'name']) }}
                                        {{ __('Déplacé ou démobilisé par le conflit') }}
                                        <br />
                                        {{ Form::radio('victime_social', 'Emprisonnement', false, ['class' => 'name']) }}
                                        {{ __('Emprisonnement') }}
                                        <br />
                                        {{ Form::radio('victime_social', 'Aucun', false, ['class' => 'name']) }}
                                        {{ __('Aucun') }}
                                        <br />
                                        {{ Form::radio('victime_social', 'Autre', false, ['class' => 'name']) }}
                                        {{ __('Autre') }}
                                    </label>
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
                                        placeholder="autre diplôme professionnel">{{ old('autre_victime') }}</textarea>
                                    @error('autre_victime')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-row">
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    <label for="etablissement">{{ __('Etablissement d\'obtention') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <textarea class="form-control form-control-sm  @error('etablissement') is-invalid @enderror"
                                        name="etablissement" id="etablissement" rows="1"
                                        placeholder="Votre etablissement complète">{{ old('etablissement') }}</textarea>
                                    @error('etablissement')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="bg-gradient-secondary text-center">
                                <p class="h5 text-white mb-2">CHOIX ET LOCALISATION</p>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    {!! Form::label('Localité :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('localites', $projetLocalites, null, ['placeholder' => '', 'data-width' => '100%', 'class' => 'form-control form-control-sm', 'id' => 'localite']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('localites'))
                                            @foreach ($errors->get('localites') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    {!! Form::label('Zone :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('zones', $projetZones, null, ['placeholder' => '', 'data-width' => '100%', 'class' => 'form-control form-control-sm', 'id' => 'zone']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('zones'))
                                            @foreach ($errors->get('zones') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    {!! Form::label('module :') !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('modules', $projetModules, null, ['placeholder' => '', 'data-width' => '100%', 'class' => 'form-control form-control-sm', 'id' => 'module-ageroute']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('modules'))
                                            @foreach ($errors->get('modules') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label
                                        for="autre_diplomes_fournis"><b>{{ __('Composition dossier :') }}</b></label>(<span
                                        class="text-danger">*</span>)
                                    <br />
                                    <label>{{ Form::checkbox('dossier', 'Fiche de candidature', true, ['class' => 'name', 'disabled' => 'disabled']) }}
                                        {{ __('Fiche de candidature') }}
                                        <br />
                                        {{ Form::checkbox('dossier', "Copie carte nationale d'identité", true, ['class' => 'name','disabled' => 'disabled']) }}
                                        {{ __("Copie carte nationale d'identité") }}
                                        <br />
                                        {{ Form::checkbox('dossier', 'Certificat de résidence', true, ['class' => 'name', 'disabled' => 'disabled']) }}
                                        {{ __('Certificat de résidence') }}
                                        <br />
                                        {{ Form::checkbox('dossiers', 'Copie diplomes ou attestations', false, ['class' => 'name']) }}
                                        {{ __('Copie diplomes ou attestations') }}
                                    </label>
                                </div>
                                <div class="form-group col-md-2 col-lg-2 col-xs-12 col-sm-12">
                                    <label
                                        for="autre_diplomes_fournis"><b>{{ __('Total documents fournis :') }}</b></label>
                                    {!! Form::number('nbre_pieces', null, ['placeholder' => 'Ex: 4', 'class' => 'form-control form-control-sm', 'min' => '4', 'max' => '25']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('nbre_pieces'))
                                            @foreach ($errors->get('nbre_pieces') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    <label for="autre_diplomes_fournis">{{ __('Si autre, précisez :') }}</label>
                                    <textarea class="form-control form-control-sm  @error('autre_diplomes_fournis') is-invalid @enderror" name="autre_diplomes_fournis"
                                        id="autre_diplomes_fournis" rows="4"
                                        placeholder="lister les autres diplômes fournis">{{ old('autre_diplomes_fournis') }}</textarea>
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('autre_diplomes_fournis'))
                                            @foreach ($errors->get('autre_diplomes_fournis') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                            </div>
                    </div>
                </div>
                <br />
                <input type="hidden" name="password" class="form-control form-control-sm" id="exampleInputPassword1"
                    placeholder="Mot de passe">
                {!! Form::hidden('password', null, ['placeholder' => 'Votre mot de passe', 'class' => 'form-control form-control-sm']) !!}
                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
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

{{-- @push('scripts')
    <script type="text/javascript">
$('input[type=checkbox]').on('change', function (e) {
    if ($('input[type=checkbox]:checked').length > 3) {
        $(this).prop('checked', false);
        alert("autorisé seulement 3");
    }
});
</script>
@endpush --}}
