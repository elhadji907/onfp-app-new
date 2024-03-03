@extends('layout.default')
@section('title', 'ONFP - Enregistrement des courriers départs')
@section('content')
    <div class="content mb-5">
        <div class="container col-12 col-md-12 col-lg-8 col-xl-8 col-xs-12">
            <div class="container-fluid">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                <div class="row justify-content-center pb-2">
                    <div class="col-lg-12 margin-tb">
                        <a class="btn btn-outline-success" href="{{ route('departs.index') }}"> <i
                                class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                    </div>
                </div>
                {{--      @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif  --}}
                <div class="row pt-5"></div>
                <div class="card border-success">
                    <div class="card card-header text-center bg-gradient-default border-success">
                        <h1 class="h4 card-title text-center text-black h-100 text-uppercase mb-0"><b></b><span
                                class="font-italic">FORMULAIRE COURRIER DEPART</span></h1>
                    </div>

                    <div class="card-body">
                        NB : Les champs(<span class="text-danger">*</span>)sont obligatoires
                        <hr class="sidebar-divider my-0"><br>
                        {!! Form::open(['url' => 'departs', 'files' => true]) !!}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="annee">{{ __("ANNEE") }} (<span
                                        class="text-danger">*</span>)</label>
                                <input id="annee" type="number" min="1"
                                    class="form-control @error('annee') is-invalid @enderror" name="annee" min="2022"
                                    placeholder="ANNEE" value="{{ $annee ?? old('annee') }}"
                                    autocomplete="annee">
                                @error('annee')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="numero_ordre">{{ __("NUMERO D'ORDRE") }} (<span
                                        class="text-danger">*</span>)</label>
                                <input id="numero_ordre" type="number" min="1"
                                    class="form-control @error('numero_ordre') is-invalid @enderror" name="numero_ordre"
                                    placeholder="NUMERO D'ORDRE" value="{{ $numCourrier ?? old('numero_ordre') }}"
                                    autocomplete="numero_ordre">
                                @error('numero_ordre')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nbre_pieces">{{ __('NOMBRE DE PIECES') }} (<span
                                        class="text-danger">*</span>)</label>
                                <input id="nbre_pieces" type="number" min="1"
                                    class="form-control @error('nbre_pieces') is-invalid @enderror" name="nbre_pieces"
                                    placeholder="NOMBRE DE PIECES" value="{{ old('nbre_pieces') }}"
                                    autocomplete="nbre_pieces">
                                @error('nbre_pieces')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date_depart">{{ __('DATE DEPART') }}(<span class="text-danger">*</span>)</label>
                                <input id="date_depart" {{ $errors->has('date_r') ? 'is-invalid' : '' }} type="date"
                                    class="form-control @error('date_depart') is-invalid @enderror" name="date_depart"
                                    placeholder="Date de départt" value="{{ old('date_depart') }}" autocomplete="username">
                                @error('date_depart')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="destinataire">{{ __('DESTINATAIRE') }}(<span
                                        class="text-danger">*</span>)</label>
                                <input id="destinataire" type="text"
                                    class="form-control @error('destinataire') is-invalid @enderror" name="destinataire"
                                    placeholder="Destinataire" value="{{ old('destinataire') }}" autocomplete="destinataire">
                                @error('destinataire')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group col-md-12">
                                <label for="objet">{{ __('OBJET') }}(<span class="text-danger">*</span>)</label>
                                <input id="objet" type="text"
                                    class="form-control @error('objet') is-invalid @enderror" name="objet"
                                    placeholder="Votre et objet" value="{{ old('objet') }}" autocomplete="objet">
                                @error('objet')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="reference">{{ __('REFERENCE') }}</label>
                                <input id="reference" type="text"
                                    class="form-control @error('reference') is-invalid @enderror" name="reference"
                                    placeholder="référence du courrier" value="{{ old('reference') }}" autocomplete="reference">
                                @error('reference')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="numero_reponse">{{ __('NUMERO ARCHIVE') }}(<span
                                        class="text-danger">*</span>)</label>
                                <input id="numero_archive" type="number" min="1"
                                    class="form-control @error('numero_archive') is-invalid @enderror" name="numero_archive"
                                    placeholder="NUMERO ARCHIVE" value="{{ old('numero_archive') }}"
                                    autocomplete="numero_archive">
                                @error('numero_archive')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                {!! Form::label('OBSERVATIONS') !!}
                                {!! Form::textarea('observation', null, [
                                    'placeholder' => 'Observations...',
                                    'rows' => 2,
                                    'class' => 'form-control',
                                    'id' => 'observation',
                                ]) !!}
                            </div>
                        </div>
                        {!! Form::submit('Enregistrer', ['class' => 'btn btn-outline-primary pull-right']) !!}
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
