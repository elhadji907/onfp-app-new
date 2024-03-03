@extends('layout.default')
@section('title', 'ONFP - AGEROUTE COMMUNES')
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
                        AGEROUTE, liste des zones impactées
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div align="right">
                                @can('role-create')
                                    <a href="{{ route('ageroutezones.create') }}">
                                        <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                        </div>
                                    </a>
                                @endcan
                            </div>
                            <br />
                            <table class="table table-bordered" id="table-ageroutezones">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="2%">N°</th>
                                        <th width="25%">Communes</th>
                                        <th width="10%">Effectif</th>
                                        <th width="3%">Acceptés</th>
                                        <th width="3%">Rejets</th>
                                        <th width="8%">Liste attente</th>
                                        <th width="15%">Départements</th>
                                        <th style="width:8%;"></th>
                                    </tr>
                                </thead>
                                {{-- <tfoot class="table-dark">
                                    <tr>
                                        <th>N°</th>
                                        <th>Communes</th>
                                        <th>Effectif</th>
                                        <th>Départements</th>
                                        <th></th>
                                    </tr>
                                </tfoot> --}}
                                <tbody>
                                    <?php $h = 1; ?>
                                    @foreach ($zones as $key => $zone)
                                        <tr>
                                            <td>{{ $h++ }}</td>
                                            <td>{{ $zone->nom }}</td>
                                            <td ALIGN="CENTER">
                                                <?php $i = 0; ?>
                                                @foreach ($zone->individuelles as $individuelle)
                                                    @if ($individuelle->projets_id == $projet_id)
                                                        <?php $i++; ?>
                                                    @endif
                                                @endforeach
                                                <a class="nav-link"
                                                    href="{{ url('candidatzone', ['$projet' => $projet, '$zone' => $zone->nom]) }}"
                                                    target="_blank">
                                                    <span class="badge badge-info">{!! $i !!}</span></a>
                                            </td>
                                            <td ALIGN="CENTER">
                                                <?php $a = 0; ?>
                                                @foreach ($zone->individuelles as $individuelle)
                                                    @if ($individuelle->projets_id == $projet_id && $individuelle->statut == 'accepter')
                                                        <?php $a++; ?>
                                                    @endif
                                                @endforeach
                                                <a class="nav-link"
                                                    href="{{ url('candidatzonevalides', ['$projet' => $projet, '$zone' => $zone->nom]) }}"
                                                    target="_blank">
                                                    <span class="badge badge-success">{!! $a !!}</span></a>
                                            </td>
                                            <td ALIGN="CENTER">
                                                <?php $a = 0; ?>
                                                @foreach ($zone->individuelles as $individuelle)
                                                    @if ($individuelle->projets_id == $projet_id && $individuelle->statut == 'rejeter')
                                                        <?php $a++; ?>
                                                    @endif
                                                @endforeach
                                               {{--   <a class="nav-link"
                                                    href="{{ url('candidatzonevalides', ['$projet' => $projet, '$zone' => $zone->nom]) }}"
                                                    target="_blank">  --}}
                                                    <span class="badge badge-danger">{!! $a !!}</span>
                                                {{--  </a>  --}}
                                            </td>
                                            <td ALIGN="CENTER">
                                                <?php $i = 0; ?>
                                                @foreach ($zone->individuelles as $individuelle)
                                                    @if ($individuelle->projets_id == $projet_id && $individuelle->statut == "liste attente")
                                                        <?php $i++; ?>
                                                    @endif
                                                @endforeach
                                                <a class="nav-link"
                                                    href="{{ url('candidatzonevalidesattente', ['$projet' => $projet, '$zone' => $zone->nom]) }}"
                                                    target="_blank">
                                                    <span class="badge badge-primary">{!! $i !!}</span></a>
                                            </td>
                                            <td>
                                                <span>{{ $zone->localite->nom ?? '' }}</span>
                                            </td>
                                            <td class="d-flex align-items-baseline align-middle">
                                                {{-- <a class="btn btn-info btn-sm"
                                                    href="{{ route('ageroutezones.show', $zone->id) }}"><i
                                                        class="far fa-eye">&nbsp;</i></a>&nbsp; --}}
                                                @can('role-edit')
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('ageroutezones.edit', $zone->id) }}"><i
                                                            class="far fa-edit">&nbsp;</i></a>
                                                @endcan
                                                &nbsp;
                                                @can('role-delete')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['ageroutezones.destroy', $zone->id], 'style' => 'display:inline', 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'supprimer']) !!}
                                                    {!! Form::close() !!}
                                                @endcan
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
    {{-- <p class="text-center text-primary"><small>Tutorial by Tutsmake.com</small></p> --}}
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-ageroutezones').DataTable({
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
                    [3, 'desc']
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
