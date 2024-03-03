@extends('layout.default')
@section('title', 'ONFP - Liste employee')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a class="btn btn-outline-primary btn-sm"
                                    href="{{ route('employees.index') }}"><i class="fas fa-sync-alt"></i>&nbsp;actualiser</a></li>
                            <li class="breadcrumb-item active">Liste des employés</li>
                        </ul>
                    </div>
                    {{--  <div class="card-header">
                        <i class="fas fa-table"></i>
                        Liste du employee
                    </div>  --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <div align="right">
                                <a href="{{ route('employees.create') }}">
                                    <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i></div>
                                </a>
                            </div>
                            <br />
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0"
                                id="table-employees">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width:5%;"></th>
                                        <th style="width:5%;">Matricule</th>
                                        <th style="width:20%;">Nom</th>
                                        {{--  <th>Prenom</th>
                                        <th>Nom</th>  --}}
                                        <th style="width:20%;">Date et lieu naissance</th>
                                        {{--  <th>Lieu Nais.</th>  --}}
                                        {{--  <th>Email</th>  --}}
                                        <th style="width:10%;">Telephone</th>
                                        <th style="width:20%;">Fonction</th>
                                        <th style="width:5%;">Direction</th>
                                        <th style="width:1%;"></th>
                                        <th style="width:1%;"></th>
                                        <th style="width:1%;"></th>
                                    </tr>
                                </thead>
                                <tfoot class="table-dark">

                                </tfoot>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <img style="width:50%; max-width:50px;" class="rounded-circle w-100"
                                                    src="{{ asset($employee->user->profile->getImage()) }}" />
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">{!! $employee->matricule !!}
                                            </td>
                                            <td style="vertical-align: middle;">{!! $employee->user->civilite !!}
                                                {!! $employee->user->firstname !!} {!! mb_strtoupper($employee->user->name) !!}</td>
                                            {{--  <td style="vertical-align: middle;"></td>
                                            <td style="vertical-align: middle;"></td>  --}}
                                            <td style="vertical-align: middle;">
                                                @if ($employee->user->civilite == 'M.')
                                                    né le
                                                @endif
                                                @if ($employee->user->civilite == 'Mme')
                                                    née le
                                                @endif
                                                {!! $employee->user->date_naissance->format('d/m/Y') !!} à {!! $employee->user->lieu_naissance !!}
                                            </td>
                                            {{--  <td style="vertical-align: middle;"></td>  --}}
                                            {{--  <td style="vertical-align: middle;">{!! $employee->user->email !!}</td>  --}}
                                            <td style="vertical-align: middle;">{!! $employee->user->telephone ?? '' !!}</td>
                                            <td style="vertical-align: middle;">{!! $employee->fonction->name ?? '' !!}</td>
                                            <td style="vertical-align: middle;">
                                                @if (isset($employee->direction->sigle))
                                                    {!! $employee->direction->sigle !!}
                                                @else
                                                @endif

                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <a href="{!! url('employees/' . $employee->id . '/edit') !!}" class='' style="color:blue"
                                                    title="modifier">
                                                    <i class="far fa-edit">&nbsp;</i>
                                                </a>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <a href="{!! url('employees/' . $employee->id) !!}" class='' style="color:blue"
                                                    title="voir">
                                                    <i class="far fa-eye">&nbsp;</i>
                                                </a>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'url' => 'employees/' . $employee->id,
                                                    'id' => 'deleteForm',
                                                    'onsubmit' => 'return ConfirmDelete()',
                                                ]) !!}
                                                {!! Form::button('<i class="fa fa-times" aria-hidden="true" style="color:red"></i>', [
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-default btn-sm',
                                                    'title' => 'supprimer',
                                                ]) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_delete_employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form method="POST" action="" id="form-delete-employee">
            @csrf
            @method('DELETE')
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Êtes-vous sûr de bien vouloir supprimer cet admin ?
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        cliquez sur close pour annuler
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-times">&nbsp;Delete</i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-employees').DataTable({
                dom: 'lBfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i> Copy',
                        titleAttr: 'Copy'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        titleAttr: 'Excel'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        titleAttr: 'CSV'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        orientation: 'landscape',
                        pageSize: 'RA4',
                        titleAttr: 'PDF'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Print',
                        titleAttr: 'Print'
                    }
                ],
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Tout"]
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
