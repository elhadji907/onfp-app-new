@extends('layout.default')
@section('title', 'AGEROUTE - liste des demandeurs retenus dans la commune de ' . $zone_concernee)
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
                        {{ $modules->name }} : liste des demandeurs 
                        @if (isset($civilite) && $civilite == 'M.')
                        de sexe masculin
                        @else
                        de sexe féminin
                        @endif
                        retenus dans la commune de {{ $zone_concernee }},
                        département de {{ $zones->localite->nom }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" align="right">
                            <a href="{{ url('listecandidatretenus', ['$projet' => $projet, '$zone' => $zone_concernee, '$module' => $module]) }}"
                                target="_blank">
                                <div class="btn btn-info btn-sm"><i class="fas fa-print"></i>&nbsp;Imprimer</i>
                                </div>
                            </a>
                        </div>
                        <table class="table table-bordered" id="table-ageroutebeneficiaires">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width:2%;">N°</th>
                                    <th style="width:10%;">N° CIN</th>
                                    <th style="width:4%;">Civilité</th>
                                    <th style="width:10%;">Prenom</th>
                                    <th style="width:8%;">Nom</th>
                                    <th style="width:8%;">Date naissance</th>
                                    <th style="width:8%;">Lieu naissance</th>
                                    <th style="width:5%;">Téléphone</th>
                                    <th style="width:15%;">Adresse</th>
                                    {{-- <th style="width:8%;"></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <?php $h = 1; ?>
                                @foreach ($individuelles as $key => $individuelle)
                                    @if (isset($individuelle) && $individuelle->zone->nom == $zone_concernee && $individuelle->module->name == $modules->name && $individuelle->statut == 'accepter' && $individuelle->demandeur->user->civilite == $civilite)
                                        <tr>
                                            <td>{{ $h++ }}</td>
                                            <td>{!! $individuelle->demandeur->cin !!}</td>
                                            <td>{!! $individuelle->demandeur->user->civilite !!}</td>
                                            <td>{!! $individuelle->demandeur->user->firstname !!} </td>
                                            <td>{!! $individuelle->demandeur->user->name !!} </td>
                                            <td>{!! $individuelle->demandeur->user->date_naissance->format('d/m/Y') !!}</td>
                                            <td>{!! $individuelle->demandeur->user->lieu_naissance !!}</td>
                                            <td>{!! $individuelle->demandeur->user->telephone !!}</td>
                                            <td>{!! $individuelle->demandeur->user->adresse ?? '' !!}</td>
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
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
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
