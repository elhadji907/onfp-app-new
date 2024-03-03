@extends('layout.default')
@section('title', 'ONFP - Modification directions')
@section('content')
    <div class="content">
        <div class="container col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
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
                <div class="row justify-content-center pb-2">
                    <div class="col-lg-12 margin-tb">
                        <a class="btn btn-outline-success" href="{{ route('directions.index') }}"> <i
                                class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                    </div>
                </div>
                <div class="card border-success">
                    <div class="card-header card-header-primary text-center border-success">
                        <h3 class="card-title">Modification direction</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::model($directions, ['method' => 'PATCH', 'route' => ['directions.update', $directions->id]]) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <div class="form-group">
                                    <strong>Direction:</strong> <span class="text-danger"> <b>*</b> </span>
                                    {!! Form::text('name', null, ['placeholder' => 'Direction', 'class' => 'form-control']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('name'))
                                            @foreach ($errors->get('name') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                    <strong>Sigle:</strong> <span class="text-danger"> <b>*</b> </span>
                                    {!! Form::text('sigle', null, ['placeholder' => 'Sigle', 'class' => 'form-control']) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('sigle'))
                                            @foreach ($errors->get('sigle') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                            </div>
                            <div class="form-group col col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                {!! Form::label('Type direction') !!}<span class="text-danger"> <b>*</b> </span>
                                {!! Form::select('type_direction', $types_directions, $directions->types_direction->name ?? '', ['placeholder' => '', 'data-width' => '100%', 'class' => 'form-control', 'id' => 'type_direction']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('type_direction'))
                                        @foreach ($errors->get('type_direction') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-right mb-5">
                                <button type="submit" class="btn btn-outline-primary"><i
                                        class="far fa-paper-plane"></i>&nbsp;Soumettre</button>
                            </div>
                                <div class="card-header col-xs-12 col-sm-12 col-md-12">
                                    <i class="fas fa-user"></i>
                                    Choisir responsable <span class="text-danger"> <b>*</b> </span>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="table-directions-create">
                                            <thead class="table-default">
                                                <tr>
                                                    <th style="width:1%;"></th>
                                                    <th style="width:5%;">Matricule</th>
                                                    <th style="width:5%;">N° CIN</th>
                                                    <th style="width:20%;">Nom</th>
                                                    <th style="width:20%;">Date et lieu naissance</th>
                                                    <th style="width:10%;">Email</th>
                                                    <th style="width:10%;">Telephone</th>
                                                    <th style="width:15%;">Adresse</th>
                                                    {{-- <th style="width:8%;"></th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($employees as $employee)
                                                    <tr>
                                                        <td>
                                                            {{ Form::radio('employee', $employee->id, $directions->chef == $employee ? 'checked' : '', ['class' => 'name']) }}
                                                        </td>
                                                        <td>{!! $employee->matricule !!}</td>
                                                        <td>{!! $employee->cin !!}</td>
                                                        <td>{!! $employee->user->civilite !!} {!! $employee->user->firstname !!}
                                                            {!! mb_strtoupper($employee->user->name) !!}
                                                        </td>
                                                        <td>
                                                            @if ($employee->user->civilite == 'M.')
                                                                né le
                                                            @endif
                                                            @if ($employee->user->civilite == 'Mme')
                                                                née le
                                                            @endif
                                                            {!! $employee->user->date_naissance->format('d/m/Y') !!} à {!! $employee->user->lieu_naissance !!}
                                                        </td>
                                                        <td>{!! $employee->user->email !!}</td>
                                                        <td>{!! $employee->user->telephone !!}</td>
                                                        <td>{!! $employee->user->adresse !!}</td>
                                                        {{-- <td style="text-align: center;"
                                                class="d-flex align-items-baseline align-content-center">
                                                <a href="{!! url('employees/' . $employee->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                    title="modifier">
                                                    <i class="far fa-edit">&nbsp;</i>
                                                </a>
                                                &nbsp;
                                                <a href="{!! url('employees/' . $employee->id) !!}" class='btn btn-primary btn-sm'
                                                    title="voir">
                                                    <i class="far fa-eye">&nbsp;</i>
                                                </a>
                                                &nbsp;
                                                {!! Form::open(['method' => 'DELETE', 'url' => 'employees/' . $employee->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'supprimer']) !!}
                                                {!! Form::close() !!}
                                            </td> --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-directions-create').DataTable({
                "lengthMenu": [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "Tout"]
                ],
                "order": [
                    [0, 'asc']
                ],
                language: {
                    "sProcessing": "Traitement en cours...",
                    "sSearch": "Rechercher&nbsp;:",
                    "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
                    "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                    "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                    "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    "sInfoPostFix": "",
                    "sLoadingRecords": "Chargement en cours...",
                    "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                    "oPaginate": {
                        "sFirst": "Premier",
                        "sPrevious": "Pr&eacute;c&eacute;dent",
                        "sNext": "Suivant",
                        "sLast": "Dernier"
                    },
                    "oAria": {
                        "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                        "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                    },
                    "select": {
                        "rows": {
                            _: "%d lignes séléctionnées",
                            0: "Aucune ligne séléctionnée",
                            1: "1 ligne séléctionnée"
                        }
                    }
                }
            });
        });
    </script>
@endpush
