@extends('layout.default')
@section('title', 'AGEROUTE - demandeurs du département de ' . $localite_concernee)
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
                @elseif (session('messages'))
                    <div class="alert alert-danger">
                        {{ session('messages') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Agéroute - Liste des demandeurs du département de {{ $localite_concernee }} : {{ $statut }}
                        avec un effectif de <label class="badge badge-info">{{ $effectif }}</label>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <div align="right">
                                    <a href="{{ route('agerouteindividuelles.create') }}">
                                        <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                        </div>
                                    </a>
                                </div>
                                <table class="table table-bordered text-center align-middle"
                                    id="table-ageroutebeneficiaires">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="width:8%;">N° CIN</th>
                                            <th style="width:5%;">Prenom</th>
                                            <th style="width:5%;">Nom</th>
                                            <th style="width:8%;">Date nais.</th>
                                            <th style="width:8%;">Lieu nais.</th>
                                            <th style="width:8%;">Communes</th>
                                            <th style="width:18%;">Module</th>
                                            @can('role-delete')
                                                <th style="width:5%;">Statut</th>
                                                <th style="width:5%;">Note</th>
                                            @endcan
                                            <th style="width:5%;">Formation</th>
                                            {{-- <th style="width:5%;">P.M.R</th>
                                            <th style="width:10%;">Déplacés</th> --}}
                                            <th style="width:8%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($projet->individuelles as $key => $individuelle)
                                            @if (isset($individuelle) && $individuelle->localite->nom == $localite_concernee && $individuelle->statut == $statut)
                                                <tr>
                                                    <td>{!! $individuelle->demandeur->cin !!}</td>
                                                    <td>{!! ucfirst(strtolower($individuelle->demandeur->user->firstname)) !!} </td>
                                                    <td>{!! strtoupper(preg_replace('#&[^;]+;#', '', preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', htmlentities($individuelle->demandeur->user->name, ENT_NOQUOTES, 'utf-8'))))) !!} </td>
                                                    <td>{!! $individuelle->demandeur->user->date_naissance->format('d/m/Y') !!}</td>
                                                    <td>{!! strtoupper(preg_replace('#&[^;]+;#', '', preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', htmlentities($individuelle->demandeur->user->lieu_naissance, ENT_NOQUOTES, 'utf-8'))))) !!} </td>
                                                    <td>{!! $individuelle->zone->nom ?? '' !!}</td>
                                                    <td>
                                                        <a href="{{ url('listerparmodulelocalite', ['$projet' => $projet,'$localite' => $localite_concernee,'$module' => $individuelle->module->id]) }}"
                                                            target="_blank">
                                                            {!! $individuelle->module->name ?? '' !!}<br />
                                                        </a>
                                                    </td>
                                                    {{-- <td>
                                                        <a href="{{ url('candidatspmr', ['$localite' => $individuelle->localite->id,'$projet' => $projet->id,'$handicap' => $individuelle->handicap]) }}"
                                                            title="voir liste" class="nav-link mt-0" target="_blank">
                                                            {!! $individuelle->handicap !!}
                                                        </a>
                                                    </td> --}}
                                                    {{-- <td>
                                                        <a href="{{ url('candidatsvs', ['$localite' => $individuelle->localite->id,'$projet' => $projet->id,'$victimes' => $individuelle->victime_social]) }}"
                                                            title="voir liste" class="nav-link mt-0" target="_blank">
                                                            {!! $individuelle->victime_social !!}
                                                        </a>
                                                    </td> --}}
                                                    @can('role-delete')
                                                        <td>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                @if (isset($individuelle->statut) && $individuelle->statut == 'accepter')
                                                                    <label
                                                                        class="badge badge-success">{!! $individuelle->statut ?? '' !!}</label>
                                                                @elseif(isset($individuelle->statut) && $individuelle->statut == 'rejeter')
                                                                    <label
                                                                        class="badge badge-danger">{!! $individuelle->statut ?? '' !!}</label>
                                                                @else
                                                                    <label
                                                                        class="badge badge-info">{!! $individuelle->statut ?? '' !!}</label>
                                                                @endif
                                                                &nbsp;
                                                                @if (isset($individuelle->statut) && $individuelle->statut != 'accepter')
                                                                    <a href="{{ url('agerouteretenues', ['$individuelle' => $individuelle,'$statut' => 'accepter','$module' => $individuelle->module->id]) }}"
                                                                        title="accepter"
                                                                        class="btn btn-outline-primary btn-sm mt-0">
                                                                        <i class="fas fa-check-circle"></i>
                                                                    </a>
                                                                @endif
                                                                @if (isset($individuelle->statut) && $individuelle->statut != 'rejeter')
                                                                    <a href="{{ url('agerouterejeter', ['$individuelle' => $individuelle,'$statut' => 'rejeter','$module' => $individuelle->module->id]) }}"
                                                                        title="rejeter"
                                                                        class="btn btn-outline-danger btn-sm mt-0">
                                                                        <i class="fas fa-times"></i>
                                                                    </a>
                                                                @endif
                                                                @if (isset($individuelle->statut) && $individuelle->statut != 'attente')
                                                                    <a href="{{ url('agerouteattente', ['$individuelle' => $individuelle,'$statut' => 'attente','$module' => $individuelle->module->id]) }}"
                                                                        title="attente"
                                                                        class="btn btn-outline-warning btn-sm mt-0">
                                                                        <i class="fas fa-reply"></i>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>{!! $individuelle->note ?? '' !!}</td>
                                                    @endcan
                                                    <td align="center">
                                                        @if ($statut == 'enlever')
                                                            <a style="color: rgba(255, 140, 0, 0.829); text-decoration: none;"
                                                                class="view" title="ouvrir"
                                                                href="{{ url('individuelleformationsenlever', ['$individuelle' => $individuelle->item1]) }}"
                                                                target="_blank">{!! $individuelle->item1 ?? '' !!}</a>
                                                        @elseif(!isset($individuelle->formation->statut->name))
                                                            <label class="badge badge-default">
                                                                {!! $individuelle->formation->statut->name ?? 'aucune' !!}
                                                            </label>
                                                        @else
                                                            <label class="badge badge-info">
                                                                {!! $individuelle->formation->statut->name ?? 'aucune' !!}
                                                            </label>
                                                        @endif
                                                    </td>
                                                    <td class="d-flex align-items-baseline">
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
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "Tout"]
                ],
                "order": [
                    [9, 'desc']
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
