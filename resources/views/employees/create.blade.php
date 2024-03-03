@extends('layout.default')
@section('title', 'ONFP - Enregistrement Employes')
@section('content')
    <div class="container col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a class="btn btn-outline-success btn-sm"
                        href="{{ route('employees.index') }}"><i class="fas fa-undo-alt"></i>&nbsp;retour</a></li>
                <li class="breadcrumb-item active">ajout employé</li>
            </ul>
            {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif
            
            <div class="card">
               {{--   <div class="card-header card-header-primary text-center">
                    <h3 class="card-title">Enregistrement</h3>
                    <p class="card-category">Employes</p>
                </div>  --}}

                <div class="card-body">
                    {!! Form::open(['url' => 'employees', 'files' => true]) !!}
                    <div class="row form-row">
                        {{--  <div class="form-group col-md-4">
                            {!! Form::label('e-mail') !!}(<span class="text-danger">*</span>)
                            {!! Form::email('email', null, [
                                'placeholder' => 'Votre adresse e-mail',
                                'class' => 'form-control form-control-sm',
                                'id' => 'email',
                            ]) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('email'))
                                    @foreach ($errors->get('email') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>  --}}
                        <div class="form-group col-md-4">
                            <label for="">Adresse e-mail</label>
                            <input type="email" placeholder="email"
                                class="form-control form-control-sm @error('email') is-invalid @enderror" name="email"
                                id="email" value="">
                            <div class="col-lg-12" id="emailList">
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <div>{{ $message }}</div>
                                </span>
                            @enderror
                        </div>

                        {{--  <div class="form-group col-md-4">
                            <label for="">Fonction</label>
                            <input type="text" placeholder="Fonction"
                                class="form-control form-control-sm @error('fonction') is-invalid @enderror" name="fonction"
                                id="fonction" value="">
                            <div class="col-lg-12" id="fonctionList">
                            </div>
                            @error('fonction')
                                <span class="invalid-feedback" role="alert">
                                    <div>{{ $message }}</div>
                                </span>
                            @enderror
                        </div>  --}}
                        <div class="form-group col-md-4">
                            {!! Form::label('prénom') !!}(<span class="text-danger">*</span>)
                            {!! Form::text('firstname', null, ['placeholder' => 'Votre prenom', 'id' => 'firstname', 'class' => 'form-control form-control-sm']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('firstname'))
                                    @foreach ($errors->get('firstname') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('nom') !!}(<span class="text-danger">*</span>)
                            {!! Form::text('name', null, [
                                'placeholder' => 'Votre nom',
                                'class' => 'form-control form-control-sm',
                                'id' => 'name',
                            ]) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('name'))
                                    @foreach ($errors->get('name') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('fonction') !!}(<span class="text-danger">*</span>)
                            {!! Form::select('fonction', $fonctions, null, [
                                'placeholder' => '',
                                'class' => 'form-control form-control-sm',
                                'id' => 'fonction',
                            ]) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('categorie'))
                                    @foreach ($errors->get('categorie') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('categorie') !!}(<span class="text-danger">*</span>)
                            {!! Form::select('categorie', $categories, null, [
                                'placeholder' => '',
                                'class' => 'form-control form-control-sm',
                                'id' => 'categorie',
                            ]) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('categorie'))
                                    @foreach ($errors->get('categorie') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('direction') !!}
                            {!! Form::select('direction', $directions, null, [
                                'placeholder' => '',
                                'class' => 'form-control form-control-sm',
                                'id' => 'direction',
                            ]) !!}
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('civilite') !!}(<span class="text-danger">*</span>)
                            {!! Form::select('civilite', ['M.' => 'M.', 'Mme' => 'Mme'], null, [
                                'placeholder' => '',
                                'class' => 'form-control form-control-sm',
                                'id' => 'civilite',
                            ]) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('civilite'))
                                    @foreach ($errors->get('civilite') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('Date de naissance', null, ['class' => 'control-label']) !!}(<span class="text-danger">*</span>)
                            {!! Form::date('date_naiss', null, [
                                'placeholder' => 'La date de naissance',
                                'class' => 'form-control form-control-sm',
                                'id' => 'date_naiss',
                            ]) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('date_naiss'))
                                    @foreach ($errors->get('date_naiss') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>

                        
                        <div class="form-group col-md-4">
                            {!! Form::label('Lieu naissance') !!}(<span class="text-danger">*</span>)
                            {!! Form::text('lieu', null, ['placeholder' => 'Le lieu de naissance', 'id' => 'lieuNaissance', 'class' => 'form-control form-control-sm']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('lieu'))
                                    @foreach ($errors->get('lieu') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        {{--  <div class="form-group col-md-4">
                            {!! Form::label('Lieu') !!}(<span class="text-danger">*</span>)
                            {!! Form::text('lieu', null, [
                                'placeholder' => 'Votre lieu de naissance',
                                'class' => 'form-control form-control-sm',
                                'id' => 'lieuNaissance',
                            ]) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('lieu'))
                                    @foreach ($errors->get('lieu') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>  --}}
                        <div class="invalid-feedback">
                            {{ $errors->first('username') }}
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('cin') !!}(<span class="text-danger">*</span>)
                            {!! Form::text('cin', null, ['placeholder' => 'Votre cin', 'class' => 'form-control form-control-sm']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('cin'))
                                    @foreach ($errors->get('cin') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="invalid-feedback">
                            {{ $errors->first('cin') }}
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('matricule') !!}(<span class="text-danger">*</span>)
                            {!! Form::text('matricule', null, [
                                'placeholder' => 'Votre matricule',
                                'class' => 'form-control form-control-sm',
                                'id' => 'email',
                            ]) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('matricule'))
                                    @foreach ($errors->get('matricule') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('Situation familiale :') !!}(<span class="text-danger">*</span>)
                            {!! Form::select('familiale', $familiale, null, [
                                'placeholder' => 'Votre situation familiale',
                                'class' => 'form-control form-control-sm',
                                'id' => 'familiale',
                                'data-width' => '100%',
                            ]) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('familiale'))
                                    @foreach ($errors->get('familiale') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('date embauche', null, ['class' => 'control-label']) !!}(<span class="text-danger">*</span>)
                            {!! Form::date('date_embauche', null, [
                                'placeholder' => 'La date de recrutement',
                                'class' => 'form-control form-control-sm',
                            ]) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('date_embauche'))
                                    @foreach ($errors->get('date_embauche') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('Adresse') !!}(<span class="text-danger">*</span>)
                            {!! Form::text('adresse', null, ['placeholder' => 'Votre adresse', 'class' => 'form-control form-control-sm']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('adresse'))
                                    @foreach ($errors->get('adresse') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('Telephone portable') !!}(<span class="text-danger">*</span>)
                            {!! Form::text('telephone', null, [
                                'placeholder' => 'Numero de telephone portable',
                                'class' => 'form-control form-control-sm',
                                'id' => 'telephone',
                            ]) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('telephone'))
                                    @foreach ($errors->get('telephone') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('Telephone Fixe') !!}
                            {!! Form::text('fixe', null, [
                                'placeholder' => 'Numero de telephone fixe',
                                'class' => 'form-control form-control-sm',
                            ]) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('fixe'))
                                    @foreach ($errors->get('fixe') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('Numero fax') !!}
                            {!! Form::text('fax', null, ['placeholder' => 'Votre numero fax', 'class' => 'form-control form-control-sm']) !!}
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('Boite postale') !!}
                            {!! Form::text('bp', null, ['placeholder' => 'Votre Boite postale', 'class' => 'form-control form-control-sm']) !!}
                        </div>
                    </div>
                    {!! Form::submit('Enregistrer', ['class' => 'btn btn-outline-primary pull-right']) !!}
                    {!! Form::close() !!}
                    <div class="modal fade" id="error-modal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Verifier les donn&eacute;es saisies
                                        svp
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>
    <script id="document-template" type="text/x-handlebars-template">
   
    </script>
    <script type="text/javascript">
        $('#fonction').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('fonction.fetch') }}",
                    method: "POST",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('#fonctionList').fadeIn();
                        $('#fonctionList').html(data);
                    }
                });
            }
        });
        $('#email').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('employe.fetch') }}",
                    method: "POST",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('#emailList').fadeIn();
                        $('#emailList').html(data);
                    }
                });
            }
        });
        $(document).on('click', 'li', function() {
            $('#fonction').val($(this).data("name"));
            $('#fonctionList').fadeOut();
        });
        $(document).on('click', 'li', function() {
            $('#email').val($(this).data("email"));
            $('#firstname').val($(this).data("prenom"));
            $('#name').val($(this).data("nom"));
            $('#civilite').val($(this).data("civilite"));
            $('#telephone').val($(this).data("telephone"));
            $('#emailList').fadeOut();
        });
    </script>
@endsection
