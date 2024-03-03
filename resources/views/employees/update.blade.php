@extends('layout.default')
@section('title', 'ONFP - Modification employee')
@section('content')
    <div class="container col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a class="btn btn-outline-success btn-sm"
                        href="{{ route('employees.index') }}"><i class="fas fa-undo-alt"></i>&nbsp;retour</a></li>
                <li class="breadcrumb-item active">Modification employé</li>
            </ul>
           {{--   <div class="col-lg-12 margin-tb">
                <a class="btn btn-outline-success" href="{{ route('employees.index') }}"> <i
                        class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
            </div>  --}}
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif
            
            <div class="card">
                {{--  <div class="card-header card-header-primary text-center border-success">
                    <h3 class="card-title">Modification employé</h3>
                </div>  --}}
                <div class="card-body">
                    {!! Form::open(['url' => 'employees/' . $employee->id, 'method' => 'PATCH', 'files' => true]) !!}
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            {!! Form::label('fonction') !!}
                            {!! Form::select('fonction', $fonctions, $employee->fonction->name ?? '', ['placeholder' => '', 'class' => 'form-control form-control-sm', 'id' => 'fonction']) !!}
                             {{--  {!! Form::text('fonction', $employee->matricule, ['placeholder' => 'fonction', 'class' => 'form-control form-control-sm', 'id' => 'fonction']) !!}  --}}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('fonction'))
                                    @foreach ($errors->get('fonction') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                            {{--  <label for="">Fonction</label>
                            <input type="text" placeholder="Fonction"
                                class="form-control form-control-sm @error('fonction') is-invalid @enderror" name="fonction"
                                id="fonction" value="{{ $employee->fonction->name ?? '' }}">
                            <div class="col-lg-12" id="fonctionList">
                            </div>
                            @error('fonction')
                                <span class="invalid-feedback" role="alert">
                                    <div>{{ $message }}</div>
                                </span>
                            @enderror  --}}
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('categorie') !!}
                            {!! Form::select('categorie', $categories, $employee->category->name, [
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
                            {!! Form::select('direction', $directions, $employee->direction->name ?? '', [
                                'placeholder' => '',
                                'class' => 'form-control form-control-sm',
                                'id' => 'direction',
                            ]) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('direction'))
                                    @foreach ($errors->get('direction') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('civilite') !!}
                            {!! Form::select('civilite', ['M.' => 'M.', 'Mme' => 'Mme'], $employee->user->civilite, [
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
                            {!! Form::label('prénom') !!}
                            {!! Form::text('firstname', $employee->user->firstname, [
                                'placeholder' => 'Votre prenom',
                                'class' => 'form-control form-control-sm',
                            ]) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('firstname'))
                                    @foreach ($errors->get('firstname') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('nom') !!}
                            {!! Form::text('name', $employee->user->name, [
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
                            {!! Form::label('Date de naissance', null, ['class' => 'control-label']) !!}
                            {!! Form::date('date_naiss', Carbon\Carbon::parse($employee->user->date_naissance)->format('Y-m-d'), [
                                'placeholder' => 'La date de naissance',
                                'class' => 'form-control form-control-sm',
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
                            {!! Form::label('Lieu') !!}
                            {!! Form::text('lieu', $employee->user->lieu_naissance, [
                                'placeholder' => 'Votre lieu de naissance',
                                'class' => 'form-control form-control-sm',
                            ]) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('lieu'))
                                    @foreach ($errors->get('lieu') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('votre adresse e-mail') !!}(<span class="text-danger">*</span>)
                            {!! Form::email('email', $employee->user->email, [
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
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('cin') !!}
                            {!! Form::text('cin', $employee->cin, ['placeholder' => 'Votre cin', 'class' => 'form-control form-control-sm']) !!}
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
                            {!! Form::label('matricule') !!}
                            {!! Form::text('matricule', $employee->matricule, [
                                'placeholder' => 'Votre matricule',
                                'class' => 'form-control form-control-sm',
                                'id' => 'matricule',
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
                            {!! Form::label('Situation familiale') !!}
                            {!! Form::select('familiale', $familiale, $employee->user->familiale->name ?? old('familiale'), [
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
                            {!! Form::label('date embauche', null, ['class' => 'control-label']) !!}
                            {!! Form::date('date_embauche', Carbon\Carbon::parse($employee->date_embauche)->format('Y-m-d'), [
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
                            {!! Form::label('Adresse') !!}
                            {!! Form::text('adresse', $employee->user->adresse, [
                                'placeholder' => 'Votre adresse',
                                'class' => 'form-control form-control-sm',
                            ]) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                @if ($errors->has('adresse'))
                                    @foreach ($errors->get('adresse') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                    @endforeach
                                @endif
                            </small>
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('Telephone portable') !!}
                            {!! Form::text('telephone', $employee->user->telephone, [
                                'placeholder' => 'Numero de telephone portable',
                                'class' => 'form-control form-control-sm',
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
                            {!! Form::label('Telephone fixe') !!}
                            {!! Form::text('fixe', $employee->user->fixe, [
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
                            {!! Form::text('fax', $employee->user->fax, [
                                'placeholder' => 'Votre numero fax',
                                'class' => 'form-control form-control-sm',
                            ]) !!}
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('Boite postale') !!}
                            {!! Form::text('bp', $employee->user->bp, [
                                'placeholder' => 'Votre Boite postale',
                                'class' => 'form-control form-control-sm',
                            ]) !!}
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('Image de profile') !!}<br />
                            {!! Form::file('image', null, ['class' => 'form-control-file rounded-circle w-100']) !!}
                            <img class="pt-1" src="{{ asset($employee->user->profile->getImage()) }}" width="50"
                                height="auto">
                        </div>
                    </div>
                    {!! Form::submit('Modifier', ['class' => 'btn btn-outline-primary pull-right']) !!}
                    {!! Form::close() !!}

                    <div class="modal fade" id="error-modal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Verifier les donn&eacute;es
                                        saisies
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
        $(document).on('click', 'li', function() {
            $('#fonction').val($(this).text());
            $('#fonctionList').fadeOut();
        });
    </script>
@endsection
