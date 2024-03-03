@extends('layout.default')
@section('title', 'ONFP - Liste des bordereaux')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        {{--   <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the 
        <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>  --}}
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
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weiht-bold text-info"><i class="fas fa-table"></i>Liste des bordereaux</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="d-flex justify-content-between align-items-center pb-3">
                                <p>
                                    {{--  <a target="_blank" class="btn btn-primary  btn-sm" href="{{ route('listes.index') }}"><i class="fas fa-eye"></i>&nbsp;Voir toutes les feuilles</a>  --}}
                                </p>
                                <span>
                                    <a href="{!! url('bordereaus/create') !!}">
                                        <div class="btn btn-success btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</div>
                                    </a>
                                </span>
                            </div>
                            <table class="table table-bordered table-striped" id="table-bordereaus" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width:5%;">N°/C</th>
                                        <th style="width:3%;">N°/MP</th>
                                        <th style="width:5%;">Date/MP</th>
                                        <th>Désignation</th>
                                        <th style="width:5%;">Projet</th>
                                        <th style="width:5%;">Montant</th>
                                        <th style="width:2%;">NB/PC</th>
                                        {{--  <th style="width:2%;">SCAN</th>  --}}
                                        {{--  <th>Bobservations</th>  --}}
                                        <th style="width:5%;">Classeur</th>
                                        <th style="width:10%;"></th>
                                    </tr>
                                </thead>
                                {{--  <tfoot class="table-dark">
                                    <tr>
                                        <th>N° MP</th>
                                        <th>Date MP</th>
                                        <th>Désignation réglement</th>
                                        <th>Projet</th>
                                        <th>Montant</th>
                                        <th>Nbre pièces</th>
                                        <th>Bobservations</th>
                                        <th>Classeur</th>
                                        <th></th>
                                    </tr>
                                </tfoot>  --}}
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($bordereaus as $bordereau)
                                        <tr>
                                            <td class="align-middle">{!! $bordereau->numero !!}</td>
                                            <td class="align-middle">{!! $bordereau->numero_mandat !!}</td>
                                            <td class="align-middle">{!! Carbon\Carbon::parse($bordereau->date_mandat)->format('d/m/Y') !!}</td>
                                            <td class="align-middle">{!! $bordereau->designation !!}</td>
                                            <td class="align-middle">{!! $bordereau->courrier->projet->sigle !!}</td>
                                            <td class="align-middle">{!! $bordereau->montant !!}</td>
                                            <td class="align-middle">{!! $bordereau->nombre_de_piece !!}</td>
                                           {{--   <td>
                                                @if ($bordereau->courrier->file != '')
                                                    <a class="btn btn-outline-secondary btn-sm"
                                                        title="télécharger le fichier joint" target="_blank"
                                                        href="{{ asset($bordereau->courrier->getFile()) }}">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                @endif
                                            </td>  --}}
                                            {{--  <td class="align-middle">{!! $bordereau->observation !!}</td>  --}}
                                            <td class="align-middle">
                                                <a style="color: darkorange; text-decoration: none;"
                                                    href="{!! url('listes/' . $bordereau->liste->id) !!}" class="view" title="voir"
                                                    target="_blank">
                                                    {!! $bordereau->liste->numero !!}
                                                </a>
                                            </td>
                                            <td class="align-middle d-flex align-items-baseline">
                                                {{--  @can('update', $bordereau->courrier)  --}}
                                                <a href="{!! url('bordereaus/' . $bordereau->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                    title="modifier">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                {{--  @endcan  --}}
                                                &nbsp
                                                <a href="{!! url('courriers/' . $bordereau->courrier->id) !!}" class='btn btn-primary btn-sm'
                                                    title="voir">
                                                    <i class="far fa-eye">&nbsp;</i>
                                                </a>
                                                &nbsp;
                                                {{--  @can('delete', $bordereau->courrier)  --}}
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'url' => 'bordereaus/' . $bordereau->id,
                                                    'id' => 'deleteForm',
                                                    'onsubmit' => 'return ConfirmDelete()',
                                                ]) !!}
                                                {!! Form::button('<i class="fa fa-trash"></i>', [
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'supprimer',
                                                ]) !!}
                                                {!! Form::close() !!}
                                                {{--  @endcan  --}}
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
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-bordereaus').DataTable({
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
