@extends('layout.default')
@section('title', 'ONFP - Enregistrement formation individuelle')
@section('content')
    <div class="container col-12 col-md-12 col-lg-8 col-xl-12">
        <div class="container-fluid">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif
            <div class="row justify-content-center pb-2">
                <div class="col-lg-12 margin-tb">
                    <a class="btn btn-outline-success" href="{{ route('agerouteformations.index') }}"> <i
                            class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                </div>
            </div>
            <div class="card border-success">
                <div class="card card-header text-center bg-gradient-default border-success">
                    <h1 class="h4 card-title text-center text-black h-100 text-uppercase mb-0"><b></b><span
                            class="font-italic">FORMULAIRE DE CREATION DE FORMATION</span></h1>
                </div>
                <div class="card-body">
                    <div>
                        <p>
                            <b><u>Opérateur choisi </u>: </b>
                            {{ $operateur->name ?? 'Non disponible' }}<br />
                            <b><u>N° agrément </u> </b> {{ $operateur->numero_agrement ?? 'Aucun numéro' }}
                        </p>
                    </div>
                    <form method="POST" action="{{ url('agerouteformations') }}">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label for="annee">{{ __('Année') }}</label>(<span class="text-danger">*</span>)
                                {!! Form::number('annee', null, ['placeholder' => 'année', 'class' => 'form-control form-control-sm', 'min' => '2018', 'max' => '2030']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('annee'))
                                        @foreach ($errors->get('annee') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label>{{ __('Type de qualification ') }}</label> :(<span class="text-danger">*</span>)
                                <br />
                                {{ Form::radio('qualification', 'Titre', false, ['class' => 'name']) }}
                                {{ __('Titre') }}
                                {{ Form::radio('qualification', 'Attestation', false, ['class' => 'name']) }}
                                {{ __('Attestation') }}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('qualification'))
                                        @foreach ($errors->get('qualification') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>

                        </div>
                        <div class="form-row">
                            {{-- <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label for="code">{{ __('CODE') }}(<span
                                        class="text-danger">*</span>)</label>
                                <input id="code" type="text"
                                    class="form-control form-control-sm @error('code') is-invalid @enderror" name="code"
                                    placeholder="Code formation" value="{{ old('code') }}"
                                    autocomplete="code">
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div> --}}
                            {{-- <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                {!! Form::label('Type de formation:') !!}(<span class="text-danger">*</span>) --}}
                            {!! Form::hidden('types_formations', $types_formations, null, ['placeholder' => 'types_formations', 'class' => 'form-control form-control-sm', 'id' => 'types_formations', 'data-width' => '100%']) !!}
                            {{-- <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('types_formations'))
                                        @foreach ($errors->get('types_formations') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small> 
                            </div> --}}
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                {!! Form::label('module :') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('modules', $modules, null, ['placeholder' => 'module', 'data-width' => '100%', 'class' => 'form-control form-control-sm', 'id' => 'moduleageroute']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('modules'))
                                        @foreach ($errors->get('modules') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                {!! Form::label('Convention :') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('conventions', $conventions, null, ['placeholder' => 'convention', 'data-width' => '100%', 'class' => 'form-control form-control-sm', 'id' => 'convention']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('conventions'))
                                        @foreach ($errors->get('conventions') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label for="beneficiaire">{{ __('Bénéficiaires') }}(<span
                                        class="text-danger">*</span>)</label>
                                <textarea class="form-control form-control-sm  @error('beneficiaire') is-invalid @enderror" name="beneficiaire" id="beneficiaire"
                                    rows="1"
                                    placeholder="Ex : Jeune de la région de dakar">{{ old('beneficiaire') }}</textarea>
                                @error('beneficiaire')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label for="adresse">{{ __('Adresse') }}(<span class="text-danger">*</span>)</label>
                                <textarea class="form-control form-control-sm  @error('adresse') is-invalid @enderror" name="adresse" id="adresse" rows="1"
                                    placeholder="adresse exacte des bénéficiares">{{ old('adresse') }}</textarea>
                                @error('adresse')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                {!! Form::label('Ingénieur:') !!}
                                {!! Form::select('ingenieur', $ingenieurs, null, ['placeholder' => 'ingenieur', 'class' => 'form-control form-control-sm', 'id' => 'ingenieur', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('ingenieur'))
                                        @foreach ($errors->get('ingenieur') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            {{-- <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                {!! Form::label('Programme :') !!}
                                {!! Form::select('programme', $programmes, null, ['placeholder' => '', 'class' => 'form-control form-control-sm', 'id' => 'programme', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('programme'))
                                        @foreach ($errors->get('programme') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div> --}}
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8 col-lg-8 col-xs-12 col-sm-12">
                                <label for="lieu">{{ __('Lieu formation') }}(<span
                                        class="text-danger">*</span>)</label>
                                <textarea class="form-control form-control-sm  @error('lieu') is-invalid @enderror" name="lieu" id="lieu" rows="1"
                                    placeholder="Lieu de la formation">{{ old('lieu') }}</textarea>
                                @error('lieu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="total">{{ __('Effectif à former') }}</label>
                                {!! Form::number('total', null, ['placeholder' => 'Ex: 20', 'class' => 'form-control form-control-sm', 'min' => '10', 'max' => '25']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('total'))
                                        @foreach ($errors->get('total') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="frais_operateurs">{{ __('Frais opérateur') }}</label>
                                {!! Form::text('frais_operateurs', '0.00', ['class' => 'form-control form-control-sm']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('frais_operateurs'))
                                        @foreach ($errors->get('frais_operateurs') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="frais_additionnels">{{ __('Frais additionnels') }}</label>
                                {!! Form::text('frais_additionnels', '0.00', ['class' => 'form-control form-control-sm']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('frais_additionnels'))
                                        @foreach ($errors->get('frais_additionnels') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                <label for="autres_frais">{{ __('Autres frais') }}</label>
                                {!! Form::text('autres_frais', '0.00', ['class' => 'form-control form-control-sm']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('autres_frais'))
                                        @foreach ($errors->get('autres_frais') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                {!! Form::label('Localité:') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('localite', $localites, null, ['placeholder' => 'localite', 'class' => 'form-control form-control-sm', 'id' => 'localite', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('localite'))
                                        @foreach ($errors->get('localite') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                {!! Form::label('commission choix opérateur:') !!}(<span class="text-danger">*</span>)
                                {!! Form::select('choixoperateur', $choixoperateur, null, ['placeholder' => 'choix operateur', 'class' => 'form-control form-control-sm', 'id' => 'choixoperateur', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('choixoperateur'))
                                        @foreach ($errors->get('choixoperateur') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                {!! Form::label('Projet:') !!}
                                {!! Form::select('projet', $projets, null, ['placeholder' => 'projet', 'class' => 'form-control form-control-sm', 'id' => 'projet', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('projet'))
                                        @foreach ($errors->get('projet') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                {!! Form::label('Programme:') !!}
                                {!! Form::select('programme', $programmes, null, ['placeholder' => 'programme', 'class' => 'form-control form-control-sm', 'id' => 'programme', 'data-width' => '100%']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('programme'))
                                        @foreach ($errors->get('programme') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label for="date_debut">{{ __('Début') }}</label>
                                <input id="date_debut" {{ $errors->has('date_debut') ? 'is-invalid' : '' }} type="date"
                                    class="form-control form-control-sm @error('date_debut') is-invalid @enderror" name="date_debut"
                                    placeholder="Votre date de debutance" value="{{ old('date_debut') }}"
                                    autocomplete="username">
                                @error('date_debut')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label for="date_fin">{{ __('Fin') }}</label>
                                <input id="date_fin" {{ $errors->has('date_fin') ? 'is-invalid' : '' }} type="date"
                                    class="form-control form-control-sm @error('date_fin') is-invalid @enderror" name="date_fin"
                                    placeholder="Votre date de finance" value="{{ old('date_fin') }}"
                                    autocomplete="username">
                                @error('date_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {!! Form::hidden('operateur', $operateur->name, null, ['placeholder' => 'operateur', 'class' => 'form-control form-control-sm', 'id' => 'operateur', 'data-width' => '100%']) !!}
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
    </div>
    </div>
@endsection
