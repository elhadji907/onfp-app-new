@extends('layout.default')
@section('title', 'ONFP - Scolarité')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                        <i class="fas fa-table"></i>
                        Scolarité
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div align="right">
                                <a href="{!! url('scolarites/create') !!}">
                                    <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</div>
                                </a>
                            </div>
                            <br />
                            <table class="table table-bordered table-striped" id="table-scolarites" width="100%"
                                cellspacing="0">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width:15%;">{!! __('Scolarité') !!}</th>
                                        <th>{!! __('Date début') !!}</th>
                                        <th>{!! __('Date fin') !!}</th>
                                        <th style="width:10%;">{!! __('Effectif') !!}</th>
                                        <th style="width:10%;">{!! __('Statut') !!}</th>
                                        <th style="width:10%;"></th>
                                    </tr>
                                </thead>
                                <tfoot class="table-dark">
                                    <tr>
                                        <th>{!! __('Scolarité') !!}</th>
                                        <th>{!! __('Date début') !!}</th>
                                        <th>{!! __('Date fin') !!}</th>
                                        <th>{!! __('Effectif') !!}</th>
                                        <th>{!! __('Statut') !!}</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($scolarites as $scolarite)
                                        <tr>
                                            <td>
                                                <a href="{{ url('countscolarite', ['$nombre' => $scolarite->annee]) }}"
                                                    class="btn btn-outline-info btn-md">
                                                    {!! $scolarite->annee !!}
                                                </a>
                                            </td>
                                            <td>{!! date('d/m/Y', strtotime($scolarite->date_debut)) ?? '' !!}</td>
                                            <td>{!! date('d/m/Y', strtotime($scolarite->date_fin)) ?? '' !!}</td>
                                            <td>
                                                @foreach ($scolarite->pcharges as $charge)
                                                    @if ($loop->last)
                                                        {!! $loop->count !!}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @if (isset($scolarite->statut) && $scolarite->statut !== 'Fermé')
                                                    <label class="badge badge-success">{!! $scolarite->statut ?? '' !!}</label>
                                                @else
                                                    <label class="badge badge-danger">{!! $scolarite->statut ?? '' !!}</label>
                                                @endif
                                            </td>
                                            <td class="d-flex align-items-baseline align-content-center">
                                                <a href="{!! url('scolarites/' . $scolarite->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                    title="modifier">
                                                    <i class="far fa-edit">&nbsp;</i>
                                                </a>
                                                {{-- &nbsp;
                        <a href="{!! url('scolarites/' .$scolarite->id) !!}" class= 'btn btn-primary btn-sm' title="voir">
                          <i class="far fa-eye">&nbsp;</i>
                        </a> --}}
                                                &nbsp;
                                                {!! Form::open(['method' => 'DELETE', 'url' => 'scolarites/' . $scolarite->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'supprimer']) !!}
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
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-scolarites').DataTable({
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
