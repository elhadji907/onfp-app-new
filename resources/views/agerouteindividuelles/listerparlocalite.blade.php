@extends('layout.default')
@section('title', 'AGEROUTE - demandeurs du département de ' . $localite_concernee)
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <a class="nav-link" href="{{ url('statutageroute', ['$localite' => $localite_concernee, '$projet' => $projet->id, '$statut' => 'attente']) }}" target="_blank">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        attente </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $attente }}</div>
                                </div>
                                <div class="col-auto">
                                    <span data-feather="mail"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <a class="nav-link" href="{{ url('statutageroute', ['$localite' => $localite_concernee, '$projet' => $projet->id, '$statut' => 'rejeter']) }}" target="_blank">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        rejeter </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $rejeter }}</div>
                                </div>
                                <div class="col-auto">
                                    <span data-feather="mail"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <a class="nav-link" href="{{ url('statutageroute', ['$localite' => $localite_concernee, '$projet' => $projet->id, '$statut' => 'accepter']) }}" target="_blank">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        accepter </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $accepter }}</div>
                                </div>
                                <div class="col-auto">
                                    <span data-feather="mail"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <a class="nav-link" href="{{ url('statut_ageroute', ['$localite' => $localite_concernee, '$projet' => $projet->id, '$statut' => 'enlever']) }}" target="_blank">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        enlever</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $enlever }}</div>
                                </div>
                                <div class="col-auto">
                                    <span data-feather="mail"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <a class="nav-link" href="{{ url('statutageroute', ['$localite' => $localite_concernee, '$projet' => $projet->id, '$statut' => 'liste attente']) }}" target="_blank">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{__("Liste d'attente")}} </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $listeattante }}</div>
                                </div>
                                <div class="col-auto">
                                    <span data-feather="mail"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
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
                        Agéroute - Liste des demandeurs du département de {{ $localite_concernee }} avec un effectif de  <label class="badge badge-info">{{ $total}}</label>
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
                                <table class="table table-bordered text-center align-middle" id="table-ageroutebeneficiaires">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="width:5%;">N° CIN</th>
                                            <th style="width:2%;">Sexe</th>
                                            <th style="width:5%;">Prenom</th>
                                            <th style="width:5%;">Nom</th>
                                            <th style="width:12%;">Date et lieu nais.</th>
                                            <th style="width:5%;">Commune</th>
                                            <th style="width:5%;">Module</th>
                                            <th style="width:5%;">P.M.R</th>
                                            <th style="width:5%;">Victime</th>
                                            <th style="width:5%;">S.E</th>
                                            <th style="width:8%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($individuelles as $key => $individuelle)
                                            @if (isset($individuelle) && $individuelle->localite->nom == $localite_concernee)
                                                <tr>
                                                    <td>{!! $individuelle->demandeur->cin !!}</td>
                                                    <td>
                                                        {{--  <a href="{{ url('ageroutesexe', ['$sexe' => $individuelle->demandeur->user->sexe, '$localite' => $localite_concernee, '$projet' => $projet->id]) }}"
                                                            class="btn btn-outline-info btn-sm" target="_blank">{!! $individuelle->demandeur->user->sexe !!}</a>  --}}
                                                            {!! $individuelle->demandeur->user->sexe !!}
                                                        </td>
                                                        <td>{!! ucfirst(strtolower($individuelle->demandeur->user->firstname)) !!} </td>
                                                        <td>{!! strtoupper(preg_replace('#&[^;]+;#', '', preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', htmlentities($individuelle->demandeur->user->name, ENT_NOQUOTES, 'utf-8'))))) !!} </td>
                                                    <td>{!! $individuelle->demandeur->user->date_naissance->format('d/m/Y') !!} &nbsp;à&nbsp;{!! strtoupper(preg_replace('#&[^;]+;#', '', preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', htmlentities($individuelle->demandeur->user->lieu_naissance, ENT_NOQUOTES, 'utf-8'))))) !!}</td>
                                                    <td>{!! $individuelle->zone->nom ?? '' !!}</td>
                                                    <td ALIGN="CENTER">
                                                        <a href="{{ url('listerparmodulelocalite', ['$projet' => $projet,'$localite' => $localite_concernee,'$module' => $individuelle->module->id]) }}"
                                                            target="_blank">
                                                            {!! $individuelle->module->name ?? '' !!}<br />
                                                        </a>
                                                    </td>
                                                    <td ALIGN="CENTER">
                                                        <a href="{{ url('candidatspmr', ['$localite' => $individuelle->localite->id,'$projet' => $projet->id,'$handicap' => $individuelle->handicap]) }}"
                                                            title="voir liste" target="_blank">
                                                            {!! $individuelle->handicap !!}
                                                        </a>
                                                    </td>
                                                    <td ALIGN="CENTER">
                                                        <a href="{{ url('candidatsvs', ['$localite' => $individuelle->localite->id,'$projet' => $projet->id,'$victimes' => $individuelle->victime_social]) }}"
                                                            title="voir liste" target="_blank">
                                                            {!! $individuelle->victime_social !!}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('candidatse', ['$localite' => $individuelle->localite->id,'$projet' => $projet->id,'$situation_eco' => $individuelle->situation_economique]) }}"
                                                            title="voir liste" target="_blank">
                                                            {!! $individuelle->situation_economique !!}
                                                        </a>
                                                        {{--  <div class="d-flex justify-content-between align-items-center">
                                                            @if (isset($individuelle->statut) && $individuelle->statut == 'accepter')
                                                                <label class="badge badge-success">{!! $individuelle->statut ?? '' !!}</label>
                                                            @elseif(isset($individuelle->statut) && $individuelle->statut == 'rejeter')
                                                                <label class="badge badge-danger">{!! $individuelle->statut ?? '' !!}</label>
                                                            @else
                                                                <label class="badge badge-info">{!! $individuelle->statut ?? '' !!}</label>
                                                            @endif
                                                        </div>  --}}
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
                    [0, 'desc']
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
