@extends('layout.default')
@section('title', 'ONFP - Liste des formations de ' . $individuelles->demandeur->user->civilite . ' ' .
    $individuelles->demandeur->user->firstname . ' ' . $individuelles->demandeur->user->name)
@section('content')
    <div class="container-fluid">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Liste des formations du candidat :
                        {{ $individuelles->demandeur->user->firstname }}&nbsp;{{ $individuelles->demandeur->user->name }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0"
                                id="table-agerouteformations">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width:3%;">N°</th>
                                        <th style="width:5%;">Code</th>
                                        <th style="width:20%;">Module</th>
                                        <th style="width:20%;">Bénéficiares</th>
                                        <th style="width:40%;">Opérateurs</th>
                                        <th style="width:15%;">Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($individuelles->demandeur->formations as $formation)
                                    @foreach ($formation->findividuelles as $findividuelle)
                                        <tr>
                                            <td>{!! $i++ !!}</td>
                                            <td>
                                                <a style="color: rgba(255, 140, 0, 0.829); text-decoration: none;" class="view"
                                                    title="ouvrir"
                                                    href="{!! url('agerouteformations/' . $findividuelle->id) !!}"
                                                    target="_blank">{!! $findividuelle->formation->code ?? '' !!}</a>
                                            </td>
                                            <td>
                                                {{ $findividuelle->formation->module->name }}
                                            </td>
                                            <td>{!! $findividuelle->formation->beneficiaires ?? '' !!}</td>
                                            <td>{!! $findividuelle->formation->operateur->name ?? '' !!} ({!! $findividuelle->formation->operateur->sigle ?? '' !!})</td>
                                            <td>{!! $findividuelle->formation->statut->name ?? '' !!}</td>

                                            {{-- 
                                                <td class="d-flex align-items-baseline text-center-row">
                                                <a href="{!! url('agerouteformations/' . $formation->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                    title="modifier">
                                                    <i class="far fa-edit">&nbsp;</i>
                                                </a>
                                                &nbsp;
                                                <a href="{!! url('agerouteformations/' . $formation->id) !!}" class='btn btn-primary btn-sm'
                                                    title="voir" target="__blank">
                                                    <i class="far fa-eye">&nbsp;</i>
                                                </a>
                                                &nbsp;
                                                {!! Form::open(['method' => 'DELETE', 'url' => 'agerouteformations/' . $formation->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'supprimer']) !!}
                                                {!! Form::close() !!}
                                            </td> 
                                            --}}
                                            
                                        </tr>
                                    @endforeach
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
            $('#table-agerouteformations').DataTable({
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
