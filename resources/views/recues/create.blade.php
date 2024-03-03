@extends('layout.default')
@section('title', 'ONFP - Enregistrement des courriers arrivées')

@section('extra-js')
    {!! NoCaptcha::renderJs() !!}
@endsection

@section('content')
    <div class="content mb-5">
        <div class="container col-12 col-md-12 col-lg-8 col-xl-8 col-xs-12">
            <div class="container-fluid">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a class="btn btn-outline-success btn-sm"
                                    href="{{ route('recues.index') }}"><i class="fas fa-undo-alt"></i>Retour</a></li>
                            <li class="breadcrumb-item active">Enregistrement courrier arrivé</li>
                        </ul>
                    </div>
                </div>
                {{--   @if ($errors->any())
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
                <div class="row"></div>
                <div class="card border-success">
                   {{--   <div class="card card-header text-center bg-gradient-default border-success">
                        <h1 class="h4 card-title text-center text-black h-100 text-uppercase mb-0"><b></b><span
                                class="font-italic">FORMULAIRE COURRIER ARRIVEE</span></h1>
                    </div>  --}}
                    <div class="card-body">
                        NB : Les champs(<span class="text-danger">*</span>)sont obligatoires
                        <hr class="sidebar-divider my-0"><br>
                        {!! Form::open(['url' => 'recues', 'files' => true]) !!}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="date_recep">{{ __('DATE D\'ARRIVEE') }}(<span
                                        class="text-danger">*</span>)</label>
                                <input id="date_recep" {{ $errors->has('date_r') ? 'is-invalid' : '' }} type="date"
                                    class="form-control form-control-sm @error('date_recep') is-invalid @enderror" name="date_recep"
                                    placeholder="La date dépôt" value="{{ old('date_recep') }}" autocomplete="username">
                                @error('date_recep')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                                {{--  {!! Form::label('DATE D\'ARRIVEE', null, ['class' => 'control-label']) !!}  --}}
                                {{--  {!! Form::date('date_recep', $date_r->format('Y-m-d'), ['placeholder'=>"La date de reception du courrier", 'class'=>'form-control form-control-sm']) !!}                      --}}
                                {{--   {!! Form::date('date_recep', null, [
                                    'placeholder' => 'La date de reception du courrier',
                                    'class' => 'form-control form-control-sm',
                                ]) !!}  --}}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date_cores">{{ __('DATE CORRESPONDANCE') }}(<span
                                        class="text-danger">*</span>)</label>
                                <input id="date_cores" {{ $errors->has('date_r') ? 'is-invalid' : '' }} type="date"
                                    class="form-control form-control-sm @error('date_cores') is-invalid @enderror" name="date_cores"
                                    placeholder="Votre date dépôt" value="{{ old('date_cores') }}" autocomplete="username">
                                @error('date_cores')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror

                                {{--  {!! Form::label('DATE CORRESPONDANCE', null, ['class' => 'control-label']) !!}  --}}
                                {{--  {!! Form::date('date_cores', $date_r->format('Y-m-d'), ['placeholder'=>"La date de correspondance du courrier", 'class'=>'form-control form-control-sm']) !!}                      --}}
                                {{--  {!! Form::date('date_cores', null, [
                                    'placeholder' => 'La date de correspondance du courrier',
                                    'class' => 'form-control form-control-sm',
                                ]) !!}  --}}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="numero_cores">{{ __('NUMERO CORRESPONDANCE') }} (<span
                                        class="text-danger">*</span>)</label>
                                <input id="numero_cores" type="text" min="1"
                                    class="form-control form-control-sm @error('numero_cores') is-invalid @enderror" name="numero_cores"
                                    placeholder="NUMERO CORRESPONDANCE" value="{{ $numCourrier ?? old('numero_cores') }}"
                                    autocomplete="numero_cores">
                                @error('numero_cores')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror

                                {{--    {!! Form::label('NUMERO CORRESPONDANCE') !!}
                                {!! Form::number('numero_cores', null, [
                                    'placeholder' => 'Numéro de correspondance',
                                    'class' => 'form-control form-control-sm',
                                    'min' => '1',
                                ]) !!}  --}}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="annee">{{ __('ANNEE') }} (<span class="text-danger">*</span>)</label>
                                <input id="annee" type="number" min="2022"
                                    class="form-control form-control-sm @error('annee') is-invalid @enderror" name="annee"
                                    placeholder="ANNEE" value="{{ $annee ?? old('annee') }}" autocomplete="annee">
                                @error('annee')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror

                                {{--    {!! Form::label('NUMERO CORRESPONDANCE') !!}
                                {!! Form::number('numero_cores', null, [
                                    'placeholder' => 'Numéro de correspondance',
                                    'class' => 'form-control form-control-sm',
                                    'min' => '1',
                                ]) !!}  --}}
                            </div>
                            <div class="form-group col-md-12">
                                {{--  {!! Form::label('EXPEDITEUR') !!}
                                {!! Form::text('expediteur', null, ['placeholder' => 'Expéditeur du courrier', 'class' => 'form-control form-control-sm']) !!}  --}}
                                <label for="expediteur">{{ __('EXPEDITEUR') }}(<span class="text-danger">*</span>)</label>
                                <input id="expediteur" type="text"
                                    class="form-control form-control-sm @error('expediteur') is-invalid @enderror" name="expediteur"
                                    placeholder="Expediteur" value="{{ old('expediteur') }}"
                                    autocomplete="expediteur">
                                @error('expediteur')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group col-md-12">
                                <label for="objet">{{ __('OBJET') }}(<span class="text-danger">*</span>)</label>
                                <input id="objet" type="text"
                                    class="form-control form-control-sm @error('objet') is-invalid @enderror" name="objet"
                                    placeholder="Objet" value="{{ old('objet') }}" autocomplete="objet">
                                @error('objet')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror

                                {{--  {!! Form::label('OBJET') !!}
                                {!! Form::text('objet', null, [
                                    'placeholder' => 'Objet du courrier',
                                    'class' => 'form-control form-control-sm',
                                    'id' => 'objet',
                                ]) !!}  --}}
                            </div>
                            <div class="form-group col-md-12">
                                <label for="reference">{{ __('REFERENCE') }}</label>
                                <input id="reference" type="text"
                                    class="form-control form-control-sm @error('reference') is-invalid @enderror" name="reference"
                                    placeholder="référence du courrier" value="{{ old('reference') }}" autocomplete="reference">
                                @error('reference')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="numero_reponse">{{ __('NUMERO REPONSE') }}</label>
                                <input id="numero_reponse" type="number" min="1"
                                    class="form-control form-control-sm @error('numero_reponse') is-invalid @enderror" name="numero_reponse"
                                    placeholder="NUMERO CORRESPONDANCE" value="{{ old('numero_reponse') }}"
                                    autocomplete="numero_reponse">
                                @error('numero_reponse')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date_response">{{ __('DATE REPONSE') }}</label>
                                <input id="date_response" {{ $errors->has('date_r') ? 'is-invalid' : '' }} type="date"
                                    class="form-control form-control-sm @error('date_response') is-invalid @enderror" name="date_response"
                                    placeholder="La date de réponse" value="{{ old('date_response') }}"
                                    autocomplete="date_response">
                                @error('date_response')
                                    <span class="invalid-feedback" role="alert">
                                        <div>{{ $message }}</div>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                {!! Form::label('Observations') !!}
                                {!! Form::textarea('observation', null, [
                                    'placeholder' => 'Observations',
                                    'rows' => 2,
                                    'class' => 'form-control form-control-sm',
                                    'id' => 'observation',
                                ]) !!}
                            </div>
                        </div>
                        {{--  <div class="form-row">
                        <div class="form-group col-md-6">
                            {!! Form::label('Adresse e-mail') !!}
                            {!! Form::email('email', null, [
                                'placeholder' => 'Votre adresse e-mail',
                                'class' => 'form-control form-control-sm',
                                'id' => 'email',
                            ]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('Téléphone') !!}
                            {!! Form::text('telephone', null, ['placeholder' => 'Votre numero de téléphone', 'class' => 'form-control form-control-sm']) !!}
                        </div>
                        <div class="invalid-feedback">
                            {{ $errors->first('telephone') }}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {!! Form::label('Adresse') !!}
                            {!! Form::text('adresse', null, ['placeholder' => 'Votre adresse de résidence', 'class' => 'form-control form-control-sm']) !!}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {!! Form::label('Numero fax') !!}
                            {!! Form::text('fax', null, ['placeholder' => 'Votre numero fax', 'class' => 'form-control form-control-sm']) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('Boite postale') !!}
                            {!! Form::text('bp', null, ['placeholder' => 'Votre Boite postale', 'class' => 'form-control form-control-sm']) !!}
                        </div>
                    </div>  --}}

                        {{--  <div class="form-row">
                        {!! NoCaptcha::display() !!}
                    </div>  --}}

                        {{--  <div class="form-row">
                        <div class="form-group col-md-6">
                            {!! Form::label('', null, ['class' => 'control-label']) !!}                    
                            {!! Form::file('file', null, ['class'=>'form-control form-control-sm-file']) !!}                    
                        </div>
                        <div class="form-group col-md-6">                
                            {!! Form::text('legende', null, ['placeholder'=>'Le nom du fichier joint', 'class'=>'form-control form-control-sm']) !!}                    
                        </div> 
                    </div> --}}
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-outline-primary"><i
                                    class="far fa-paper-plane"></i>&nbsp;Enregistrer</button>
                        </div>
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
