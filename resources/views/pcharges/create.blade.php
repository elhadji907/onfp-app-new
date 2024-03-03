@extends('layout.default')
@section('title', 'ONFP - Enregistrement utilisateur')
@section('content')
    <div class="content">
        <div class="container col-12 col-sm-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-lg-12 col-xl-12">
            <div class="container-fluid">
                @can('user-create')
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <a class="btn btn-outline-primary" href="{{ route('pcharges.index') }}"> <i
                                class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                        <a class="btn btn-outline-primary" href="{{ route('filieres.create') }}" target="_blank"> <i
                                class="fas fa-plus"></i>&nbsp;Ajouter filière</i></a>
                        {{-- <a class="btn btn-outline-primary" href="{{ route('specialites.create') }}" target="_blank"> <i
                            class="fas fa-plus"></i>&nbsp;Ajouter spécialité</i></a> --}}

                    </div>
                @endcan
                <div class="card border-success">
                    <div class="card-header card-header-primary text-center border-success">
                        <h3 class="card-title">Enregistrement demande de prise en charge</h3>
                        Établissement => <label class="badge badge-success">{{ $etablissement->name ?? '' }}
                            @if (isset($etablissement->sigle))
                                [{{ $etablissement->sigle ?? '' }}]
                        </label>
                        @endif
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'pcharges.store', 'method' => 'POST']) !!}
                        <input type="hidden" name="etablissement" value="{{ $etablissement->id }}" class="form-control"
                            name="inputName" id="inputName" placeholder="">
                        {!! Form::hidden('date_depot', $date_depot->format('Y-m-d'), ['placeholder' => 'La date de dépot', 'class' => 'form-control']) !!}
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Scolarité') !!}
                                {!! Form::select('scolarite', $scolarites, null, ['placeholder' => '', 'class' => 'form-control', 'id' => 'scolarite']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('scolarite'))
                                        @foreach ($errors->get('scolarite') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Type demande') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('typedemande', ['Nouvelle demande' => 'Nouvelle demande', 
                                'Renouvellement' => 'Renouvellement',
                                'Report' => 'Report'
                                ], null, ['placeholder' => '', 'class' => 'form-control', 'id' => 'typedemande']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('typedemande'))
                                        @foreach ($errors->get('typedemande') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Filière') !!}
                                {!! Form::select('filiere', $filieres, null, ['placeholder' => '', 'class' => 'form-control', 'id' => 'filiere']) !!}
                                @can('user-create')
                                <small id="emailHelp" class="form-text text-muted">{{ __('Merci de ') }}
                                    <a href="{{ route('filieres.create') }}" target="_blank">cliquer ici</a>
                                    {{ __('pour ajouter une nouvelle filière') }}
                                </small>
                                @endcan
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('filiere'))
                                        @foreach ($errors->get('filiere') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            {{-- <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('spécialité') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('specialite', $filierespecialites, null, ['placeholder' => '', 'class' => 'form-control', 'id' => 'filierespecialite']) !!}
                                <small id="emailHelp"
                                    class="form-text text-muted">{{ __("Merci de ") }}
                                    <a href="{{ route('specialites.create') }}" target="_blank">cliquer ici</a> {{ __("pour ajouter une nouvelle spécialité") }}
                                </small>
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('filiere'))
                                        @foreach ($errors->get('filiere') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div> --}}
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Spécialité') !!}
                                {!! Form::text('specialite', null, ['placeholder' => 'La spécialité de la filière choisie', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('specialite'))
                                        @foreach ($errors->get('specialite') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('CIN') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('cin', null, ['placeholder' => 'Votre numéro de cin', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('cin'))
                                        @foreach ($errors->get('cin') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Prénom') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('firstname', null, ['placeholder' => 'Votre prénom', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('firstname'))
                                        @foreach ($errors->get('firstname') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Nom') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('name', null, ['placeholder' => 'Votre nom', 'class' => 'form-control', 'id' => 'nom']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('name'))
                                        @foreach ($errors->get('name') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Date naissance') !!}(<span class="text-danger">*</span>)
                                {!! Form::date('date', null, ['placeholder' => 'Votre date de naissance', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('date'))
                                        @foreach ($errors->get('date') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Lieu naissance') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('lieu_naissance', null, ['placeholder' => 'Votre lieu de naissance', 'class' => 'form-control', 'id' => 'lieu_naissance']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('lieu_naissance'))
                                        @foreach ($errors->get('lieu_naissance') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('civilite') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('civilite', ['M.' => 'M.', 'Mme' => 'Mme'], null, ['placeholder' => '', 'class' => 'form-control', 'id' => 'civilite']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('civilite'))
                                        @foreach ($errors->get('civilite') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Situation professionnelle:') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('professionnelle', $professionnelle, null, ['placeholder' => 'Dernier dipôme', 'class' => 'form-control', 'id' => 'professionnelle', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('professionnelle'))
                                        @foreach ($errors->get('professionnelle') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        {{--      <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Situation familiale :') !!}
                                {!! Form::select('familiale', $familiale, null, ['placeholder' => 'Votre situation familiale', 'class' => 'form-control', 'id' => 'familiale', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('familiale'))
                                        @foreach ($errors->get('familiale') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>  --}}
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Commune résidence') !!}
                                {!! Form::select('commune', $communes, null, ['placeholder' => '', 'class' => 'form-control', 'id' => 'commune']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('commune'))
                                        @foreach ($errors->get('commune') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Email') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('email', null, ['placeholder' => 'Numero de email', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('email'))
                                        @foreach ($errors->get('email') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Telephone portable') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('telephone', null, ['placeholder' => 'Numero de telephone', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('telephone'))
                                        @foreach ($errors->get('telephone') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Adresse résidence') !!}(<span class="text-danger">*</span>)
                                {!! Form::textarea('adresse', null, ['placeholder' => 'Votre adresse de résidence', 'class' => 'form-control', 'id' => 'adresse', 'rows' => '1']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('adresse'))
                                        @foreach ($errors->get('adresse') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Telephone secondaire') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('fixe', null, ['placeholder' => 'Numero de secondaire', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('fixe'))
                                        @foreach ($errors->get('fixe') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Téléphone fax') !!}
                                {!! Form::text('fax', null, ['placeholder' => 'Numero de fax', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('fax'))
                                        @foreach ($errors->get('fax') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Boite postale (BP)') !!}
                                {!! Form::text('bp', null, ['placeholder' => 'Numero de bp', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('bp'))
                                        @foreach ($errors->get('bp') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        {{--      <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Année') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('annee', $enCours, ['placeholder' => 'Année', 'class' => 'form-control', 'id' => 'annee']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('annee'))
                                        @foreach ($errors->get('annee') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>  --}}
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Inscription') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('inscription', null, ['placeholder' => 'Montant inscription', 'class' => 'form-control', 'id' => 'inscription']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('inscription'))
                                        @foreach ($errors->get('inscription') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Montant') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('montant', null, ['placeholder' => 'Montant annuelle de la formation', 'class' => 'form-control', 'id' => 'montant']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('montant'))
                                        @foreach ($errors->get('montant') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Durée (année)') !!}(<span class="text-danger">*</span>)
                                {!! Form::number('duree', null, ['placeholder' => 'Ex: 3', 'class' => 'form-control', 'id' => 'duree', 'min' => '1', 'max' => '3']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('duree'))
                                        @foreach ($errors->get('duree') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Niveau entrée') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('niveauentree', null, ['placeholder' => 'Ex : licence 1', 'class' => 'form-control', 'id' => 'niveauentree']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('niveauentree'))
                                        @foreach ($errors->get('niveauentree') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Niveau sortie') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('niveausortie', null, ['placeholder' => 'Ex : licence 3', 'class' => 'form-control', 'id' => 'niveausortie']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('niveausortie'))
                                        @foreach ($errors->get('niveausortie') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('nombre de pièces fournis') !!}(<span class="text-danger">*</span>)                                
                                {!! Form::number('nbre_piece', 0, ['placeholder' => 'Le nombre de pièces fournis', 'class' => 'form-control', 'min' => '0', 'max' => '10']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('nbre_piece'))
                                        @foreach ($errors->get('nbre_piece') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label
                                    for="motivation">{{ __('Quelles sont vos motivations pour cette formation ?') }}(<span
                                        class="text-danger">*</span>)</label>
                                <textarea class="form-control  @error('motivation') is-invalid @enderror" name="motivation"
                                    id="motivation" rows="3"
                                    placeholder="Décrire en quelques lignes votre motivation à faire cette formation">{{ old('motivation') }}</textarea>
                                @error('motivation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Niveau étude:') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('etude', $etude, null, ['placeholder' => 'Niveau d\'étude', 'class' => 'form-control', 'id' => 'etude', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('etude'))
                                        @foreach ($errors->get('etude') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Dernier diplôme :') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('diplome', $diplomes, null, ['placeholder' => 'Dernier dipôme', 'class' => 'form-control', 'id' => 'diplome', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('diplome'))
                                        @foreach ($errors->get('diplome') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                {!! Form::label('Option diplôme') !!}(<span class="text-danger">*</span>)
                                {!! Form::text('optiondiplome', null, ['placeholder' => 'Option du diplôme obtenu', 'class' => 'form-control', 'id' => 'optiondiplome']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('optiondiplome'))
                                        @foreach ($errors->get('optiondiplome') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            {!! Form::hidden('username', null, ['placeholder' => 'Votre username', 'class' => 'form-control', 'id' => 'username']) !!}
                            <input type="hidden" name="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Mot de passe">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary"><i
                                        class="far fa-paper-plane"></i>&nbsp;Soumettre</button>
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
    @endsection
