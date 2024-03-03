@extends('layout.default')
@section('title', 'ONFP - AGEROUTE DEPARTEMENTS')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
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
                        AGEROUTE, liste des localités impactées
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div align="right">
                                {{-- @can('role-create') --}}
                                <a href="{{ route('ageroutelocalites.create') }}">
                                    <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                    </div>
                                </a>
                                {{-- @endcan --}}
                            </div>
                            <br />
                            <table class="table table-bordered" id="table-ageroutelocalites">
                                <thead class="table-dark">
                                    <tr>
                                        {{-- <th width="5%">N°</th> --}}
                                        <th width="20%">Départements</th>
                                        <th width="5%">Effectif</th>
                                        <th width="3%">Retenus</th>
                                        <th width="3%">Rejets</th>
                                        <th width="8%">Liste attente</th>
                                        <th width="5%">Communes</th>
                                        <th width="8%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $h = 1; ?>
                                    @foreach ($localites as $key => $localite)
                                        <tr>
                                            {{-- <td>{{ $h++ }}</td> --}}
                                            <td>{{ $localite->nom }}</td>
                                            <td ALIGN="CENTER">
                                                <?php $i = 0; ?>
                                                @foreach ($localite->individuelles as $individuelle)
                                                    @if ($individuelle->projets_id == $projet_id)
                                                        <?php $i++; ?>
                                                    @endif
                                                @endforeach
                                                <a class="nav-link"
                                                    href="{{ url('candidatlocalite', ['$projet' => $projet, '$localite' => $localite->nom]) }}"
                                                    target="_blank">
                                                    <span class="badge badge-info">{!! $i !!}</span></a>
                                            </td>
                                            <td ALIGN="CENTER">
                                                <?php $i = 0; ?>
                                                @foreach ($localite->individuelles as $individuelle)
                                                    @if ($individuelle->projets_id == $projet_id && $individuelle->statut == "accepter")
                                                        <?php $i++; ?>
                                                    @endif
                                                @endforeach
                                                <a class="nav-link"
                                                    href="{{ url('candidatlocalitevalides', ['$projet' => $projet, '$localite' => $localite->nom]) }}"
                                                    target="_blank">
                                                    <span class="badge badge-success">{!! $i !!}</span></a>
                                            </td>
                                            <td ALIGN="CENTER">
                                                <?php $i = 0; ?>
                                                @foreach ($localite->individuelles as $individuelle)
                                                    @if ($individuelle->projets_id == $projet_id && $individuelle->statut == "liste attente")
                                                        <?php $i++; ?>
                                                    @endif
                                                @endforeach
                                                {{--  <a class="nav-link"
                                                    href="{{ url('candidatlocalitevalidesattente', ['$projet' => $projet, '$localite' => $localite->nom]) }}"
                                                    target="_blank">  --}}
                                                    <span class="badge badge-danger">{!! $i !!}</span>
                                                {{--  </a>  --}}
                                            </td>
                                            <td ALIGN="CENTER">
                                                <?php $i = 0; ?>
                                                @foreach ($localite->individuelles as $individuelle)
                                                    @if ($individuelle->projets_id == $projet_id && $individuelle->statut == "rejeter")
                                                        <?php $i++; ?>
                                                    @endif
                                                @endforeach
                                                    <span class="badge badge-primary">{!! $i !!}</span>
                                            </td>
                                            <td ALIGN="CENTER">
                                                @foreach ($localite->zones as $zone)
                                                    @if ($loop->last)
                                                        {!! $loop->count !!}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="d-flex align-items-baseline align-middle">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('ageroutelocalites.show', $localite->id) }}"><i
                                                        class="far fa-eye" title="détails">&nbsp;</i>
                                                </a>
                                                &nbsp;
                                                @can('role-delete')
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('ageroutelocalites.edit', $localite->id) }}"><i
                                                            class="far fa-edit" title='modifier'>&nbsp;</i>
                                                    </a>
                                                    &nbsp;
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['ageroutelocalites.destroy', $localite->id], 'style' => 'display:inline', 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
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
            $('#table-ageroutelocalites').DataTable({
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
                    [1, 'desc']
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
