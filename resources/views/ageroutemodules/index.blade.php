@extends('layout.default')
@section('title', 'ONFP - AGEROUTE MODULES')
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
                        AGEROUTE, liste des modules concernées
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div align="right">
                                @can('role-create')
                                    <a href="{{ route('ageroutemodules.create') }}">
                                        <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                        </div>
                                    </a>
                                @endcan
                            </div>
                            <br />
                            <table class="table table-bordered" id="table-ageroutemodules">
                                <thead class="table-dark">
                                    <tr>
                                        {{--  <th width="5%">N°</th>  --}}
                                        <th width="20%">Modules</th>
                                        <th width="5%">Demandeurs</th>
                                        <th width="5%">Acceptés</th>
                                        <th width="5%">Attente</th>
                                        <th width="5%">Rejeter</th>
                                        <th width="8%">Liste attente</th>
                                        <th width="15%">Domaine</th>
                                        <th width="10%">Secteur</th>
                                        <th width="8%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($modules as $key => $module)
                                        <tr>
                                            {{--  <td>{{ $i++ }}</td>  --}}
                                            <td>{{ $module->name }}</td>
                                            <td ALIGN="CENTER">
                                                <?php $h = 0; ?>
                                                @foreach ($module->individuelles as $individuelle)
                                                    @if ($individuelle->projets_id == $projet_id)
                                                        <?php $h++; ?>
                                                    @endif
                                                @endforeach
                                                <a class="nav-link"
                                                    href="{{ url('candidatmodule', ['$projet' => $projet, '$module' => $module->name]) }}"
                                                    target="_blank" title="voir demandeurs">
                                                    <span class="badge badge-primary">{!! $h !!}</span></a>
                                            </td>
                                            <td ALIGN="CENTER">
                                                <?php $a = 0; ?>
                                                @foreach ($module->individuelles as $individuelle)
                                                    @if ($individuelle->projets_id == $projet_id && $individuelle->statut == "accepter")
                                                        <?php $a++; ?>
                                                    @endif
                                                @endforeach
                                                <a class="nav-link"
                                                    href="{{ url('candidatmoduleaccepter', ['$projet' => $projet, '$module' => $module->name]) }}"
                                                    target="_blank" title="voir demandeurs acceptés">
                                                    <span class="badge badge-success">{!! $a !!}</span></a>
                                            </td>
                                            <td ALIGN="CENTER">
                                                <?php $a = 0; ?>
                                                @foreach ($module->individuelles as $individuelle)
                                                    @if ($individuelle->projets_id == $projet_id && $individuelle->statut == "attente")
                                                        <?php $a++; ?>
                                                    @endif
                                                @endforeach
                                                <a class="nav-link"
                                                    href="{{ url('candidatmoduleattente', ['$projet' => $projet, '$module' => $module->name]) }}"
                                                    target="_blank" title="voir demandeurs acceptés">
                                                    <span class="badge badge-info">{!! $a !!}</span></a>
                                            </td>
                                            <td ALIGN="CENTER">
                                                <?php $a = 0; ?>
                                                @foreach ($module->individuelles as $individuelle)
                                                    @if ($individuelle->projets_id == $projet_id && $individuelle->statut == "rejeter")
                                                        <?php $a++; ?>
                                                    @endif
                                                @endforeach
                                                <a class="nav-link"
                                                    href="{{ url('candidatmodulerejeter', ['$projet' => $projet, '$module' => $module->name]) }}"
                                                    target="_blank" title="voir demandeurs rejetés">
                                                    <span class="badge badge-danger">{!! $a !!}</span></a>
                                            </td>
                                            <td ALIGN="CENTER">
                                                <?php $a = 0; ?>
                                                @foreach ($module->individuelles as $individuelle)
                                                    @if ($individuelle->projets_id == $projet_id && $individuelle->statut == "liste attente")
                                                        <?php $a++; ?>
                                                    @endif
                                                @endforeach
                                                <a class="nav-link"
                                                    href="{{ url('candidatmodulelisteattente', ['$projet' => $projet, '$module' => $module->name]) }}"
                                                    target="_blank" title="voir demandeurs sur la liste d'attente">
                                                    <span class="badge badge-warning">{!! $a !!}</span></a>
                                            </td>
                                            <td>{{ $module->domaine->name }}</td>
                                            <td>{{ $module->domaine->secteur->name }}</td>
                                            <td class="d-flex align-items-baseline align-middle">
                                                {{--  <a class="btn btn-info btn-sm"
                                                    href="{{ route('ageroutemodules.show', $module->id) }}" target="_blank"><i
                                                        class="far fa-eye">&nbsp;</i></a>&nbsp;  --}}
                                                @can('role-edit')
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('ageroutemodules.edit', $module->id) }}"><i
                                                            class="far fa-edit">&nbsp;</i></a>
                                                @endcan
                                                &nbsp;
                                                @can('role-delete')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['ageroutemodules.destroy', $module->id], 'style' => 'display:inline', 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
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
            $('#table-ageroutemodules').DataTable({
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
