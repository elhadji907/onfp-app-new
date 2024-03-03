@extends('layout.default')
@section('title', 'ONFP - Modification projets')
@section('content')
    <div class="content">
        <div class="container col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="container-fluid">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                <div class="row pt-5"></div>
                <div class="card">
                    <div class="card-header card-header-primary text-center">
                        <h3 class="card-title">{{ 'Modification' }}</h3>
                        <p class="card-category">{{ 'projet' }}</p>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['url' => 'projets/' . $projet->id, 'method' => 'PATCH', 'files' => true]) !!}
                        @csrf
                        <input type="hidden" name="_method" value="PATCH" />
                        <div class="form-row">
                            <div class="form-group col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Projet') }}:</b>(<span
                                        class="text-danger">*</span>)</label>
                                <input type="text" name="name" class="form-control" id="input-name"
                                    placeholder="nom complète" value="{{ old('name') ?? $projet->name }}">
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('name'))
                                        @foreach ($errors->get('name') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-2 col-lg-2 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Sigle') }}:</b></label>
                                <input type="text" name="sigle" class="form-control" id="input-sigle"
                                    placeholder="nom complète" value="{{ old('sigle') ?? $projet->sigle }}">
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('sigle'))
                                        @foreach ($errors->get('sigle') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label for="description">{{ __('Description') }}(<span
                                        class="text-danger">*</span>)</label>
                                <textarea class="form-control  @error('description') is-invalid @enderror"
                                    name="description" id="description" rows="4"
                                    placeholder="Décrire en quelques lignes le projet...">{{ $projet->description ?? old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                {!! Form::label('Date signature :', null, ['class' => 'control-label']) !!}
                                {!! Form::date('date_signature', Carbon\Carbon::parse($projet->date_signature)->format('Y-m-d'), ['placeholder' => 'La date de signature', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('date_signature'))
                                        @foreach ($errors->get('date_signature') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                {!! Form::label('Date début :', null, ['class' => 'control-label']) !!}
                                {!! Form::date('debut', Carbon\Carbon::parse($projet->debut)->format('Y-m-d'), ['placeholder' => 'La date de démarrage', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('debut'))
                                        @foreach ($errors->get('debut') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                {!! Form::label('Date fin :', null, ['class' => 'control-label']) !!}
                                {!! Form::date('fin', Carbon\Carbon::parse($projet->fin)->format('Y-m-d'), ['placeholder' => 'La date de cloture', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('fin'))
                                        @foreach ($errors->get('fin') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-10 col-lg-10 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Budjet (en lettre)') }}:</b></label>
                                <input type="text" name="budjet_lettre" class="form-control" id="input-budjet"
                                    placeholder="Budjet en lettre"
                                    value="{{ old('budjet_lettre') ?? $projet->budjet_lettre }}">
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('budjet'))
                                        @foreach ($errors->get('budjet') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="form-group col-md-2 col-lg-2 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Budjet (F CFA)') }}:</b></label>
                                <input type="text" name="budjet" class="form-control" id="input-budjet"
                                    placeholder="Budjet en FCFA" value="{{ old('budjet') ?? $projet->budjet }}">
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('budjet'))
                                        @foreach ($errors->get('budjet') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                            <button type="submit" class="btn btn-outline-primary"><i
                                    class="far fa-paper-plane"></i>&nbsp;Modifier</button>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3 col-lg-3 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Ingenieurs') }}:</b></label>
                                <br />
                                @foreach ($ingenieur as $value)
                                    <label>{{ Form::checkbox('ingenieur[]', $value->id, in_array($value->id, $projetIngenieurs) ? true : false, ['class' => 'name']) }}
                                        {{ $value->name }}</label>
                                    <br />
                                @endforeach
                            </div>
                            <div class="form-group col-md-3 col-lg-3 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Localités') }}:</b></label>
                                <br />
                                @foreach ($localite as $value)
                                    <label>{{ Form::checkbox('localite[]', $value->id, in_array($value->id, $projetLocalites) ? true : false, ['class' => 'name']) }}
                                        {{ $value->nom }}</label>
                                    <br />
                                @endforeach
                            </div>
                            <div class="form-group col-md-3 col-lg-3 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Zones') }}:</b></label>
                                <br />
                                @foreach ($zone as $value)
                                    <label>{{ Form::checkbox('zone[]', $value->id, in_array($value->id, $projetZones) ? true : false, ['class' => 'name']) }}
                                        {{ $value->nom }}</label>
                                    <br />
                                @endforeach
                            </div>
                            <div class="form-group col-md-3 col-lg-3 col-xs-12 col-sm-12">
                                <label for="input-name"><b>{{ __('Modules') }}:</b></label>
                                <br />
                                @foreach ($module as $value)
                                    <label>{{ Form::checkbox('module[]', $value->id, in_array($value->id, $projetModules) ? true : false, ['class' => 'name']) }}
                                        {{ $value->name }}</label>
                                    <br />
                                @endforeach
                            </div>
                        </div>

                        <div class="modal fade" id="error-modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Verifier les donn&eacute;es
                                            saisies
                                            svp</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
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