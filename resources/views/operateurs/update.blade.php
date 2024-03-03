@extends('layout.default')
@section('title', 'ONFP - Modification opérateurs')
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
                <div class="row pt-0"></div>
                <div class="row justify-content-center pb-2">
                    <div class="col-lg-12 margin-tb">
                        <a class="btn btn-outline-success" href="{{ route('operateurs.index') }}"> <i
                                class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                    </div>
                </div>
                <div class="card border-success">
                    <div class="card">
                        <div class="card-header card-header-primary text-center border-success">
                            <h3 class="card-title">Modification opérateurs</h3>
                        </div>
                        <div class="card-body">
                            <b> NB </b> : Les champs<span class="text-danger"> <b>*</b> </span>sont obligatoires
                            {!! Form::open(['url' => 'operateurs/' . $operateur->id, 'method' => 'PATCH', 'files' => true]) !!}
                            @csrf
                            <div class="bg-gradient-secondary text-center">
                                <p class="h5 text-white mb-2 mt-0">IDENTIFICATION</p>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-10">
                                    <label for="operateur">{{ __('Opérateur') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <textarea id="operateurupdate" rows="1" class="form-control form-control-sm @error('operateur') is-invalid @enderror" name="operateur"
                                        placeholder="Opérateur" autocomplete="operateur"
                                        autofocus>{{ $operateur->name ?? old('operateur') }}</textarea>
                                    @error('operateur')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2 col-lg-2 col-xs-12 col-sm-12">
                                    <label for="sigle">{{ __('Sigle') }}(<span class="text-danger">*</span>)</label>
                                    <textarea id="sigle" rows="1" class="form-control form-control-sm @error('sigle') is-invalid @enderror" name="sigle" placeholder="Sigle"
                                        autocomplete="sigle">{{ $operateur->sigle ?? old('sigle') }}</textarea>
                                    @error('sigle')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    <label>{{ __('Type structure :') }}</label>(<span class="text-danger">*</span>)
                                    <br />
                                    {{ Form::radio('type_structure', 'Publique', $operateur->typestructure == 'Publique' ? 'checked' : '', ['class' => 'name']) }}
                                    {{ __('Publique') }}
                                    {{ Form::radio('type_structure', 'Privé', $operateur->typestructure == 'Privé' ? 'checked' : '', ['class' => 'name']) }}
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
                                    <label>{{ __('Type opérateur :') }}</label>(<span class="text-danger">*</span>)
                                    <br />
                                    {{ Form::radio('type_operateur', 'GIE', $operateur->operateur_type == 'GIE' ? 'checked' : '', ['class' => 'name']) }}
                                    {{ __('GIE') }}
                                    {{ Form::radio('type_operateur', 'Association', $operateur->operateur_type == 'Association' ? 'checked' : '', ['class' => 'name']) }}
                                    {{ __('Association') }}
                                    {{ Form::radio('type_operateur', 'Entreprise', $operateur->operateur_type == 'Entreprise' ? 'checked' : '', ['class' => 'name']) }}
                                    {{ __('Entreprise') }}
                                    {{ Form::radio('type_operateur', 'Institution', $operateur->operateur_type == 'Institution' ? 'checked' : '', ['class' => 'name']) }}
                                    {{ __('Institution') }}
                                    {{ Form::radio('type_operateur', 'Autre', $operateur->operateur_type == 'Autre' ? 'checked' : '', ['class' => 'name']) }}
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
                                    <textarea class="form-control form-control-sm  @error('autres_type_operateur') is-invalid @enderror" name="autres_type_operateur"
                                        id="autres_type_operateur" rows="1"
                                        placeholder="autre type opérateur">{{ $operateur->file10 ?? old('autres_type_operateur') }}</textarea>
                                    @error('autres_type_operateur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- <div class="form-group col-md-8 col-lg-8 col-xs-12 col-sm-12">
                                <label>{{ __('Type opérateur :') }}</label>(<span class="text-danger">*</span>)
                                {!! Form::select('type_operateur', $types_operateurs, $operateur->types_operateur->name, ['placeholder' => '', 'class' => 'form-control form-control-sm', 'id' => 'type_operateur', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('type_operateur'))
                                        @foreach ($errors->get('type_operateur') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div> --}}
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    <label for="numero_agrement">{{ __('numero agrement') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <input id="numero_agrement" type="text"
                                        class="form-control form-control-sm @error('numero_agrement') is-invalid @enderror"
                                        name="numero_agrement" placeholder="numero agrement"
                                        value="{{ $operateur->numero_agrement ?? old('numero_agrement') }}"
                                        autocomplete="numero_agrement">
                                    @error('numero_agrement')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    <label for="email1">{{ __('E-mail') }}(<span class="text-danger">*</span>)</label>
                                    <input id="email1" type="text"
                                        class="form-control form-control-sm @error('email1') is-invalid @enderror" name="email1"
                                        placeholder="adresse e-mail" value="{{ $operateur->email1 ?? old('email1') }}"
                                        autocomplete="email1">
                                    @error('email1')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-4 col-sm-4">
                                    {!! Form::label('Commune :', null, ['class' => 'control-label']) !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('commune', $communes, $operateur->commune->nom ?? '', ['placeholder' => 'sélectionner régions de résidence', 'class' => 'form-control form-control-sm', 'id' => 'commune', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('commune'))
                                            @foreach ($errors->get('commune') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-4 col-sm-4">
                                    {!! Form::label('departement :', null, ['class' => 'control-label']) !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('departement', $departements, $operateur->commune->arrondissement->departement->nom ?? '', ['placeholder' => 'sélectionner régions de résidence', 'class' => 'form-control form-control-sm', 'id' => 'departement', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('departement'))
                                            @foreach ($errors->get('departement') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-4 col-sm-4">
                                    {!! Form::label('Région :', null, ['class' => 'control-label']) !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('laregion', $lesregion, $operateur->commune->arrondissement->departement->region->nom ?? '', ['placeholder' => 'sélectionner régions de résidence', 'class' => 'form-control form-control-sm', 'id' => 'laregion', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('laregion'))
                                            @foreach ($errors->get('laregion') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                    <label for="adresse">{{ __('Adresse complète') }}(<span
                                            class="text-danger">*</span>)</label>
                                    <textarea id="adresse" rows="1" class="form-control form-control-sm @error('adresse') is-invalid @enderror" name="adresse"
                                        placeholder="adresse de la structure" autocomplete="adresse"
                                        autofocus>{{ $operateur->adresse ?? old('adresse') }}</textarea>
                                    @error('adresse')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                {{-- <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                {!! Form::label('Régions d\'intervention :') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('regions[]', $regions, null, ['multiple' => 'multiple', 'data-width' => '100%', 'class' => 'form-control form-control-sm', 'id' => 'regions_op']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('region'))
                                        @foreach ($errors->get('region') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                {!! Form::label('Modules :') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('modules[]', $modules, null, ['multiple' => 'multiple', 'data-width' => '100%', 'class' => 'form-control form-control-sm', 'id' => 'modules_op']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('module'))
                                        @foreach ($errors->get('module') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div> --}}
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    {!! Form::label('Fixe :') !!}<span class="text-danger"> <b>*</b> </span>
                                    {!! Form::text('fixe_op', $operateur->fixe, ['placeholder' => 'Numero fixe', 'class' => 'form-control form-control-sm']) !!}
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    {!! Form::label('Téléphone :') !!}<span class="text-danger"> <b>*</b> </span>
                                    {!! Form::text('telephone1', $utilisateurs->telephone ?? "", ['placeholder' => 'Numero de telephone de la structure', 'class' => 'form-control form-control-sm']) !!}
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    {!! Form::label('E-mail secondaire:') !!}<span class="text-danger"> <b>*</b> </span>
                                    {!! Form::text('email2', $operateur->email2, ['placeholder' => 'adresse e-mail secondaire de la structure', 'class' => 'form-control form-control-sm']) !!}
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    {!! Form::label('Téléphone secondaire:') !!}<span class="text-danger"> <b>*</b> </span>
                                    {!! Form::text('telephone2', $operateur->telephone2, ['placeholder' => 'Numero de telephone secondaire de la structure', 'class' => 'form-control form-control-sm']) !!}
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    <label for="bp">{{ __('Boite postale') }}</label>
                                    <input id="bp" type="text" class="form-control form-control-sm @error('bp') is-invalid @enderror"
                                        name="bp" placeholder="Votre adresse postale"
                                        value="{{ $operateur->user->bp ?? old('bp') }}" autocomplete="bp" autofocus>
                                    @error('bp')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    <label for="fax">{{ __('Téléphone fax') }}</label>
                                    <input id="fax" type="text" class="form-control form-control-sm @error('fax') is-invalid @enderror"
                                        name="fax" placeholder="Votre numero de fax"
                                        value="{{ $operateur->user->fax ?? old('fax') }}" autocomplete="fax" autofocus>
                                    @error('fax')
                                        <span class="invalid-feedback" role="alert">
                                            <div>{{ $message }}</div>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    {!! Form::label('Ninéa :') !!}<span class="text-danger"> <b>*</b> </span>
                                    {!! Form::text('ninea', $operateur->ninea, ['placeholder' => 'Le ninea de votre structure', 'class' => 'form-control form-control-sm']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('ninea'))
                                            @foreach ($errors->get('ninea') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    {!! Form::label('Régistre de commerce:') !!}
                                    {!! Form::text('registre', $operateur->rccm, ['placeholder' => 'Le registre de commerce de votre établissement', 'class' => 'form-control form-control-sm']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('registre'))
                                            @foreach ($errors->get('registre') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    {!! Form::label('Numéro quitus fiscal:') !!}<span class="text-danger"> <b>*</b> </span>
                                    {!! Form::text('quitus', $operateur->quitus, ['placeholder' => 'Le numéro du quitus fiscal de votre structure', 'class' => 'form-control form-control-sm']) !!}
                                </div>
                                @if (isset($operateur->debut_quitus))
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="debut_quitus">{{ __('Date délivrance') }}(<span
                                                class="text-danger">*</span>)</label>
                                        <input id="debut_quitus" {{ $errors->has('debut_quitus') ? 'is-invalid' : '' }}
                                            type="date" class="form-control form-control-sm @error('debut_quitus') is-invalid @enderror"
                                            name="debut_quitus" placeholder="Votre date de naissance"
                                            value="{{ $operateur->debut_quitus->format('Y-m-d') ?? old('debut_quitus') }}"
                                            autocomplete="username" autofocus>
                                        @error('debut_quitus')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                @else
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="debut_quitus">{{ __('Date délivrance') }}(<span
                                                class="text-danger">*</span>)</label>
                                        <input id="debut_quitus" {{ $errors->has('debut_quitus') ? 'is-invalid' : '' }}
                                            type="date" class="form-control form-control-sm @error('debut_quitus') is-invalid @enderror"
                                            name="debut_quitus" placeholder="Votre date de naissance"
                                            value="{{ old('debut_quitus') }}" autocomplete="username" autofocus>
                                        @error('debut_quitus')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                @endif
                                @if (isset($operateur->fin_quitus))
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="fin_quitus">{{ __('Date fin') }}(<span
                                                class="text-danger">*</span>)</label>
                                        <input id="fin_quitus" {{ $errors->has('fin_quitus') ? 'is-invalid' : '' }}
                                            type="date" class="form-control form-control-sm @error('fin_quitus') is-invalid @enderror"
                                            name="fin_quitus" placeholder="Votre date de naissance"
                                            value="{{ $operateur->fin_quitus->format('Y-m-d') ?? old('fin_quitus') }}"
                                            autocomplete="username" autofocus>
                                        @error('fin_quitus')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                @else
                                    <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <label for="fin_quitus">{{ __('Date fin') }}(<span
                                                class="text-danger">*</span>)</label>
                                        <input id="fin_quitus" {{ $errors->has('fin_quitus') ? 'is-invalid' : '' }}
                                            type="date" class="form-control form-control-sm @error('fin_quitus') is-invalid @enderror"
                                            name="fin_quitus" placeholder="Votre date de naissance"
                                            value="{{ old('fin_quitus') }}" autocomplete="username" autofocus>
                                        @error('fin_quitus')
                                            <span class="invalid-feedback" role="alert">
                                                <div>{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                            <div class="bg-gradient-secondary text-center">
                                <p class="h5 text-white mb-2">RESPONSABLE</p>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    {!! Form::label('Prénom :') !!}<span class="text-danger"> <b>*</b> </span>
                                    {!! Form::text('prenom', $utilisateurs->firstname ?? '', ['placeholder' => 'Votre prénom', 'class' => 'form-control form-control-sm']) !!}
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    {!! Form::label('Nom :') !!}<span class="text-danger"> <b>*</b> </span>
                                    {!! Form::text('nom', $utilisateurs->name ?? '', ['placeholder' => 'Votre nom', 'class' => 'form-control form-control-sm']) !!}
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    {!! Form::label('E-mail :') !!}<span class="text-danger"> <b>*</b> </span>
                                    {!! Form::email('email', $utilisateurs->email ?? '', ['placeholder' => 'Votre adresse e-mail', 'class' => 'form-control form-control-sm', 'id' => 'email']) !!}
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    {!! Form::label('Téléphone :') !!}<span class="text-danger"> <b>*</b> </span>
                                    {!! Form::text('telephone', $utilisateurs->telephone ?? '', ['placeholder' => 'Numero de telephone', 'class' => 'form-control form-control-sm']) !!}
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    {!! Form::label('Fonction :') !!}<span class="text-danger"> <b>*</b> </span>
                                    {!! Form::text('fonction_responsable', $operateur->fonction_responsable ?? '', ['placeholder' => 'Ex: Directeur', 'class' => 'form-control form-control-sm']) !!}
                                </div>
                                <div class="form-group col-md-4 col-lg-4 col-xs-4 col-sm-4">
                                    {!! Form::label('civilite :', null, ['class' => 'control-label']) !!}(<span class="text-danger">*</span>)
                                    {!! Form::select('civilite', ['M.' => 'M.', 'Mme' => 'Mme'], $operateur->user->civilite ?? '', ['placeholder' => 'sélectionner civilite', 'class' => 'form-control form-control-sm', 'id' => 'civilite', 'data-width' => '100%']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('civilite'))
                                            @foreach ($errors->get('civilite') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                {{--  <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                    {!! Form::label('CIN :') !!}<span class="text-danger"> <b>*</b> </span>
                                    {!! Form::text('cin', $operateur->cin_responsable ?? '', ['placeholder' => 'numéro de CIN', 'class' => 'form-control form-control-sm']) !!}
                                </div>  --}}
                            </div>
                            <input type="hidden" name="password" class="form-control form-control-sm" id="exampleInputPassword1"
                                placeholder="Mot de passe">
                            {!! Form::hidden('password', null, ['placeholder' => 'Votre mot de passe', 'class' => 'form-control form-control-sm']) !!}
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-outline-primary"><i
                                        class="far fa-paper-plane"></i>&nbsp;Modifier</button>
                            </div>
                            <br />
                            <br />
                            <div class="bg-gradient-secondary text-center">
                                <p class="h5 text-white mb-2">CHOIX ET LOCALISATION</p>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    <strong>Regions:</strong>
                                    <br />
                                    @foreach ($region as $value)
                                        <label>{{ Form::checkbox('region[]', $value->id, in_array($value->id, $operateurRegions) ? true : false, ['class' => 'name']) }}
                                            {{ $value->nom }}</label>
                                        <br />
                                    @endforeach
                                </div>
                                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                    <strong>Modules:</strong>
                                    <br />
                                    @foreach ($module as $value)
                                        <label>{{ Form::checkbox('module[]', $value->id, in_array($value->id, $operateurModules) ? true : false, ['class' => 'name']) }}
                                            {{ $value->name }}</label>
                                        <br />
                                    @endforeach
                                </div>
                            </div>
                            {!! Form::close() !!}
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
@endsection
@section('javascripts')
    <script type="text/javascript">
        $('#regions_op').select2().val({!! json_encode($operateur->regions()->allRelatedIds()) !!}).trigger('change');
        $('#modules_op').select2().val({!! json_encode($operateur->modules()->allRelatedIds()) !!}).trigger('change');
    </script>
@endsection
