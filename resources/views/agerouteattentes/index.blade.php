@extends('layout.default')
@section('title', 'liste des candidats, liste attente')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        liste des candidats, liste attente
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="d-flex col-lg-12 margin-tb justify-content-between align-items-center pb-3">
                               {{--   <a href="{{ url('listecandidatacceptes', ['$projet' => $projet, '$localite' => $localite, '$module' => $module]) }}"
                                    target="_blank">
                                    <div class="btn btn-info btn-sm"><i class="fas fa-print"></i>&nbsp;Imprimer</i>
                                    </div>
                                </a>  --}}
                               {{--   <a href="{{ route('agerouteindividuelles.create') }}">
                                    <div class="btn btn-success btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                    </div>
                                </a>  --}}
                            </div>
                            <table class="table table-bordered" id="table-ageroutebeneficiaires">
                                <thead class="table-default">
                                    <tr>
                                        <th style="width:2%;">N°</th>
                                        <th style="width:5%;">CIN</th>
                                        <th style="width:5%;">Civilité</th>
                                        <th style="width:8%;">Prenom</th>
                                        <th style="width:5%;">Nom</th>
                                        <th style="width:8%;">Date nais.</th>
                                        <th style="width:8%;">Lieu nais.</th>
                                        <th style="width:5%;">Téléphone</th>
                                        <th style="width:5%;">Département</th>
                                        <th style="width:8%;">Commune</th>
                                        <th style="width:8%;">Module</th>
                                        <th style="width:2%;">Rang</th>
                                        <th style="width:10%;">Adresse</th>
                                        <th style="width:5%;">PMR</th>
                                        <th style="width:5%;">Victime sociale</th>
                                        <th style="width:5%;">Situation économique</th>
                                        <th style="width:5%;">Projet professionnel</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($individuelles as $key => $individuelle)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{!! $individuelle->demandeur->cin !!}</td>
                                                <td>{!! $individuelle->demandeur->user->civilite !!}</td>
                                                <td>{!! ucfirst(strtolower($individuelle->demandeur->user->firstname)) !!} </td>
                                                <td>{!! strtoupper(preg_replace('#&[^;]+;#', '', preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', htmlentities($individuelle->demandeur->user->name, ENT_NOQUOTES, 'utf-8'))))) !!} </td>
                                                <td>{!! $individuelle->demandeur->user->date_naissance->format('d/m/Y') !!}</td>
                                                <td>{!! strtoupper(preg_replace('#&[^;]+;#', '', preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', htmlentities($individuelle->demandeur->user->lieu_naissance, ENT_NOQUOTES, 'utf-8'))))) !!} </td>
                                                <td>{!! $individuelle->demandeur->user->telephone !!}</td>
                                                <td>{!! $individuelle->localite->nom ?? '' !!}</td>
                                                <td>{!! $individuelle->zone->nom ?? '' !!}</td>
                                                <td>{!! $individuelle->module->name ?? '' !!}</td>
                                                <td>{!! $individuelle->items1 ?? '' !!}</td>
                                                <td>{!! $individuelle->adresse ?? '' !!}</td>
                                                <td>{!! $individuelle->handicap ?? '' !!}</td>
                                                <td>{!! $individuelle->victime_social ?? '' !!}</td>
                                                <td>{!! $individuelle->situation_economique ?? '' !!}</td>
                                                <td>{!! $individuelle->activite_avenir ?? '' !!}</td>
                                                {{--  <td>{!! $individuelle->statut ?? '' !!}</td>
                                                <td>{{ $individuelle->items1 ?? '' }}</td>  --}}
                                                {{--  @can('role-delete')
                                                    <td>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <a href=" {!! url('agerouteindividuellesrang/' . $individuelle->id . '/edit') !!}" title="classer"
                                                                class="btn btn-outline-info btn-sm mt-0" target="_blank">
                                                                <i class="fa fa-plus-square" aria-hidden="true"></i>
                                                            </a>
                                                            @if (isset($individuelle->statut) && $individuelle->statut != 'liste attente')
                                                                <a href="{{ url('ageroutelisteattente', ['$individuelle' => $individuelle, '$statut' => 'liste attente', '$module' => $individuelle->module->id]) }}"
                                                                    title="liste d'attente"
                                                                    class="btn btn-outline-secondary btn-sm mt-0">
                                                                    <i class="fa fa-share" aria-hidden="true"></i>
                                                                </a>
                                                            @endif
                                                            @if (isset($individuelle->statut) && $individuelle->statut != 'accepter')
                                                                <a href="{{ url('agerouteretenues', ['$individuelle' => $individuelle, '$statut' => 'accepter', '$module' => $individuelle->module->id]) }}"
                                                                    title="accepter"
                                                                    class="btn btn-outline-primary btn-sm mt-0">
                                                                    <i class="fas fa-check-circle"></i>
                                                                </a>
                                                            @endif
                                                            @if (isset($individuelle->statut) && $individuelle->statut != 'rejeter')
                                                                <a href="{{ url('agerouterejeter', ['$individuelle' => $individuelle, '$statut' => 'rejeter', '$module' => $individuelle->module->id]) }}"
                                                                    title="rejeter" class="btn btn-outline-danger btn-sm mt-0">
                                                                    <i class="fas fa-times"></i>
                                                                </a>
                                                            @endif
                                                            @if (isset($individuelle->statut) && $individuelle->statut != 'attente')
                                                                <a href="{{ url('agerouteattente', ['$individuelle' => $individuelle, '$statut' => 'attente', '$module' => $individuelle->module->id]) }}"
                                                                    title="attente" class="btn btn-outline-warning btn-sm mt-0">
                                                                    <i class="fas fa-reply"></i>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                @endcan  --}}
                                                {{-- <td class="d-flex align-items-baseline">
                                                        <a href="{{ url('agerouteindividuelles', ['$id' => $individuelle->id]) }}"
                                                            class='btn btn-primary btn-sm' title="voir" target="_blank">
                                                            <i class="far fa-eye">&nbsp;</i>
                                                        </a>
                                                        &nbsp;
                                                        @can('role-delete')
                                                        <a href="{!! url('agerouteindividuelles/' . $individuelle->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                            title="modifier">
                                                            <i class="far fa-edit">&nbsp;</i>
                                                        </a>
                                                        &nbsp;      
                                                            {!! Form::open(['method' => 'DELETE', 'url' => 'agerouteindividuelles/' . $individuelle->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'supprimer']) !!}
                                                            {!! Form::close() !!}
                                                        @endcan
                                                    </td> --}}
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
            $('#table-ageroutebeneficiaires').DataTable({
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
