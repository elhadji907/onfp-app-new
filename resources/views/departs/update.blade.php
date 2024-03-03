@extends('layout.default')
@section('title', 'ONFP - Modification des courriers departs')
@section('content')
    <div class="container col-6 col-md-6 col-lg-8 col-xl-8">
        <div class="container-fluid">
            @if ($errors->any())
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
            @endif
            {{--  <div class="row justify-content-center pb-2">
                <div class="col-lg-12 margin-tb">
                    <a class="btn btn-outline-success" href="{{ route('departs.index') }}"> <i
                            class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                </div>
            </div>  --}}
            
            <div class="row">                  
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a class="btn btn-outline-success btn-sm"
                                href="{{ route('departs.index') }}"><i class="fas fa-undo-alt"></i>Retour</a></li>
                        <li class="breadcrumb-item active">Modification courrier départ</li>
                    </ul>
                </div>
            </div>
            <div class="row pt-5"></div>
            <div class="card border-success">
                {{--  <div class="card card-header text-center bg-gradient-default border-success">
                    <h1 class="h4 card-title text-center text-black h-100 text-uppercase mb-0"><b></b><span
                            class="font-italic">FORMULAIRE DE MODIFICATION COURRIER DEPART</span></h1>
                </div>  --}}

                <div class="card-body">
                    NB : Les champs(<span class="text-danger">*</span>)sont obligatoires
                    <hr class="sidebar-divider my-0"><br>
                    {!! Form::open(['url' => 'departs/' . $depart->id, 'method' => 'PATCH', 'files' => true]) !!}
                    {{--  <div class="form-row">
                        <div class="form-group col-md-12">
                            {!! Form::label('Objet') !!}                    
                            {!! Form::text('objet', $depart->courrier->objet, ['placeholder'=>'', 'class'=>'form-control', 'id'=>'objet']) !!}                    
                        </div> 
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            {!! Form::label('Message') !!}                    
                            {!! Form::textarea('message',  $depart->courrier->message, ['placeholder'=>'Message du courrier', 'rows' => 4, 'class'=>'form-control', 'id'=>'message']) !!}                    
                        </div> 
                    </div>  --}}

                    {{--  <div class="form-row">
                        <div class="form-group col-md-6">
                            {!! Form::label('Expéditeur') !!}                    
                            {!! Form::text('expediteur', $depart->courrier->expediteur, ['placeholder'=>"Nom et prénom de l'expéditeur", 'class'=>'form-control']) !!}                    
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('Imputation') !!}                    
                            {!! Form::select('imputations[]', $imputations, null, ['multiple'=>'multiple', 'class'=>'form-control', 'id'=>'imputation']) !!}                    
                        </div> 
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {!! Form::label('Telephone') !!}                    
                            {!! Form::text('telephone', $depart->courrier->telephone, ['placeholder'=>"Votre numero de téléphone", 'class'=>'form-control']) !!}                    
                        </div>
                        <div class="invalid-feedback">
                            {{ $errors->first('telephone') }}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('Adresse e-mail') !!}                    
                            {!! Form::email('email', $depart->courrier->email, ['placeholder'=>'Votre adresse e-mail', 'class'=>'form-control', 'id'=>'email']) !!}                    
                        </div> 
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {!! Form::label('Adresse') !!}                    
                            {!! Form::text('adresse', $depart->courrier->adresse, ['placeholder'=>'Votre adresse de résidence', 'class'=>'form-control']) !!}                    
                        </div>
                        <div class="form-group col-md-3">
                            {!! Form::label('Date correspondance', null, ['class' => 'control-label']) !!}                    
                            {!! Form::date('date_cores', Carbon\Carbon::parse($depart->courrier->date_cores)->format('Y-m-d'), ['placeholder'=>"La date de dépos du courrier", 'class'=>'form-control']) !!}                    
                        </div> 
                        <div class="form-group col-md-3">
                            {!! Form::label('Date réception', null, ['class' => 'control-label']) !!}                    
                            {!! Form::date('date_recep', Carbon\Carbon::parse($depart->courrier->date_recep)->format('Y-m-d'), ['placeholder'=>"La date de réception du courrier", 'class'=>'form-control']) !!}                    
                        </div> 
                    </div>  --}}
                    {{--  <div class="form-row">
                        <div class="form-group col-md-6">
                            {!! Form::label('Numero fax') !!}                    
                            {!! Form::text('fax', $depart->courrier->fax, ['placeholder'=>"Votre numero fax", 'class'=>'form-control']) !!}                    
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('Boite postale') !!}                    
                            {!! Form::text('bp', $depart->courrier->bp, ['placeholder'=>'Votre Boite postale', 'class'=>'form-control']) !!}                    
                        </div> 
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {!! Form::label('', null, ['class' => 'control-label']) !!}                    
                            {!! Form::file('file', null, ['class'=>'form-control-file']) !!}
                            @if ($depart->courrier->file !== '')
                            <a class="btn btn-outline-secondary mt-2" title="télécharger le fichier joint" target="_blank" href="{{ asset($depart->courrier->getFile()) }}">
                                <i class="fas fa-download">&nbsp;Télécharger le courrier</i>
                            </a>
                            @endif             
                        </div>
                        <div class="form-group col-md-6">                
                            {!! Form::text('legende', $depart->courrier->legende, ['placeholder'=>'Le nom du fichier joint', 'class'=>'form-control']) !!}                    
                        </div> 
                    </div>  --}}


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="annee">{{ __('ANNEE') }}(<span class="text-danger">*</span>)</label>
                            <input id="annee" type="number" min="2022"
                                class="form-control @error('annee') is-invalid @enderror" name="annee" placeholder="ANNEE"
                                value="{{ $depart->courrier->type ?? old('annee') }}" autocomplete="annee">
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
                                placeholder="NUMERO D'ORDRE" value="{{ $depart->courrier->numero ?? old('numero_ordre') }}"
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
                                placeholder="NOMBRE DE PIECES" value="{{ $depart->courrier->nb_pc ?? old('nbre_pieces') }}"
                                autocomplete="nbre_pieces">
                            @error('nbre_pieces')
                                <span class="invalid-feedback" role="alert">
                                    <div>{{ $message }}</div>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date_depart">{{ __('DATE DEPART') }}(<span class="text-danger">*</span>)</label>
                            <input id="date_depart" {{ $errors->has('date_depart') ? 'is-invalid' : '' }} type="date"
                                class="form-control @error('date_depart') is-invalid @enderror" name="date_depart"
                                placeholder="Date de départt"
                                value="{{ \Carbon\Carbon::parse($depart->courrier->date_depart)->format('Y-m-d') ?? old('date_depart') }}"
                                autocomplete="date_depart">
                            @error('date_depart')
                                <span class="invalid-feedback" role="alert">
                                    <div>{{ $message }}</div>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="destinataire">{{ __('DESTINATAIRE') }}(<span class="text-danger">*</span>)</label>
                            <input id="destinataire" type="text"
                                class="form-control @error('destinataire') is-invalid @enderror" name="destinataire"
                                placeholder="Destinataire" value="{{ $depart->destinataire ?? old('destinataire') }}"
                                autocomplete="destinataire">
                            @error('destinataire')
                                <span class="invalid-feedback" role="alert">
                                    <div>{{ $message }}</div>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group col-md-12">
                            <label for="objet">{{ __('OBJET') }}(<span class="text-danger">*</span>)</label>
                            <input id="objet" type="text" class="form-control @error('objet') is-invalid @enderror"
                                name="objet" placeholder="Votre et objet"
                                value="{{ $depart->courrier->objet ?? old('objet') }}" autocomplete="objet">
                            @error('objet')
                                <span class="invalid-feedback" role="alert">
                                    <div>{{ $message }}</div>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="reference">{{ __('REFERENCE') }}(<span class="text-danger">*</span>)</label>
                            <input id="reference" type="text"
                                class="form-control form-control-sm @error('reference') is-invalid @enderror" name="reference"
                                placeholder="Reference" value="{{ $depart->courrier->reference ?? old('reference') }}"
                                autocomplete="reference">
                            @error('reference')
                                <span class="invalid-feedback" role="alert">
                                    <div>{{ $message }}</div>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date_imp">{{ __('Date imputation') }}(<span
                                class="text-danger">*</span>)</label>
                        <input id="date_imp" {{ $errors->has('date_imp') ? 'is-invalid' : '' }} type="date"
                            class="form-control form-control-sm @error('date_imp') is-invalid @enderror" name="date_imp"
                            placeholder="Date imputation du courrier"
                            value="{{ optional($depart->courrier->date_imp)->format('Y-m-d') ?? old('date_imp') }}"
                            autocomplete="date_imp">
                        @error('date_imp')
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
                                placeholder="NUMERO ARCHIVE"
                                value="{{ $depart->courrier->num_bord ?? old('numero_archive') }}"
                                autocomplete="numero_archive">
                            @error('numero_archive')
                                <span class="invalid-feedback" role="alert">
                                    <div>{{ $message }}</div>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            {!! Form::label('Imputation') !!}
                            {!! Form::select('directions[]', $directions, null, [
                                'multiple' => 'multiple',
                                'class' => 'form-control',
                                'id' => 'direction',
                            ]) !!}
                        </div>                        

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                {!! Form::label('', null, ['class' => 'control-label']) !!}
                                {!! Form::file('file', null, ['class' => 'form-control-file']) !!}
                                @if ($depart->courrier->file !== '')
                                    <a class="btn btn-outline-secondary mt-2" title="télécharger le fichier joint"
                                        target="_blank" href="{{ asset($depart->courrier->getFile()) }}">
                                        <i class="fas fa-download">&nbsp;Télécharger le courrier</i>
                                    </a>
                                @endif
                            </div>
                        </div>                        
                        <div class="form-group col-md-12">
                            {!! Form::label('Instructions') !!}
                            {!! Form::textarea('description', $depart->courrier->description ?? old('description'), [
                                'placeholder' => 'Instructions',
                                'rows' => 2,
                                'class' => 'form-control form-control-sm',
                                'id' => 'description',
                            ]) !!}
                        </div>
                        <div class="form-group col-md-12">
                            {!! Form::label('OBSERVATIONS') !!}
                            {!! Form::textarea('observation', $depart->courrier->observation ?? old('observation'), [
                                'placeholder' => 'Observations...',
                                'rows' => 2,
                                'class' => 'form-control',
                                'id' => 'observation',
                            ]) !!}
                        </div>
                    </div>
                    {!! Form::submit('Enregistrer', ['class' => 'btn btn-outline-primary pull-right']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection


@section('javascripts')
    <script type="text/javascript">
        $('#direction').select2().val({!! json_encode($depart->courrier->directions()->allRelatedIds()) !!}).trigger('change');
    </script>
@endsection
