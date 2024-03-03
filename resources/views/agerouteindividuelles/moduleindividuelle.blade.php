@extends('layout.default')
@section('title', 'ONFP - Fiche Personnel')
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
                        {{ $civilite_individuelle }} {{ $prenom_individuelle }} {{ $nom_individuelle }}, N° CIN :
                        {{ $cin_individuelle }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div align="right">
                                <a href="{{ route('agerouteindividuelles.create') }}">
                                    <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                    </div>
                                </a>
                            </div>
                            <table class="table table-bordered" id="table-ageroutebeneficiaires">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width:5%;">N°</th>
                                        <th style="width:25%;">Modules</th>
                                        <th style="width:15%;">Départements</th>
                                        <th style="width:20%;">Communes</th>
                                        <th class="text-center" style="width:10%;">Statut</th>
                                        <th class="text-center" style="width:10%;">Validation</th>
                                            <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($projet->individuelles as $key => $individuelle)
                                        @if ($individuelle->cin == $cin_individuelle)
                                            @foreach ($individuelle->modules as $key => $module)
                                                <tr>
                                                    <td>
                                                        <?php $n = $i; ?>
                                                        {!! $i++ ?? '' !!}
                                                    </td>
                                                    <td>
                                                        {!! $module->name ?? '' !!}
                                                    </td>
                                                    <td>
                                                        @foreach ($individuelle->localites as $key => $localite)
                                                            {!! $localite->nom ?? '' !!}
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($individuelle->zones as $key => $zone)
                                                            {!! $zone->nom ?? '' !!}
                                                        @endforeach
                                                    </td>
                                                    <td ALIGN="CENTER">
                                                     {{--     @foreach ($individuelle->formations as $key => $formation)
                                                        {!! $formation->statut->name ?? '' !!}
                                                        @endforeach  --}}
                                                        @if (isset($n) && $n == '1' && $individuelle->module1 != null)
                                                            <label class="badge badge-info">{!! $individuelle->statut1 ?? '' !!} </label>
                                                        @elseif (isset($n) && $n == '1' && $individuelle->module1 == null)
                                                            {{ $individuelle->statut ?? '' }}
                                                        @endif
                                                        @if (isset($n) && $n == '2' && $individuelle->module2 != null)
                                                            <label class="badge badge-info">{!! $individuelle->statut2 ?? '' !!} </label>
                                                        @elseif (isset($n) && $n == '2' && $individuelle->module2 == null)
                                                            {{ $individuelle->statut ?? '' }}
                                                        @endif
                                                        @if (isset($n) && $n == '3' && $individuelle->module3 != null)
                                                            <label class="badge badge-info">{!! $individuelle->statut3 ?? '' !!} </label>
                                                        @elseif (isset($n) && $n == '3' && $individuelle->module3 == null)
                                                            {{ $individuelle->statut ?? '' }}
                                                        @elseif(isset($n) && $n == '1' && $n == '2' && $n == '3')
                                                            {{ $individuelle->statut ?? '' }}
                                                        @endif
                                                    </td>
                                                    <td ALIGN="CENTER">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <a href="{{ url('agerouteattente', ['$individuelle' => $individuelle, '$statut' => 'validée', '$module' => $module->id, '$numero' => $n]) }}"
                                                                title="valider" class="btn btn-outline-info btn-sm mt-0">
                                                                <i class="fas fa-info-circle"></i>
                                                            </a>
                                                            <a href="{{ url('agerouteencours', ['$individuelle' => $individuelle, '$statut' => 'en cours', '$module' => $module->id, '$numero' => $n]) }}"
                                                                title="en cours"
                                                                class="btn btn-outline-secondary btn-sm mt-0">
                                                                <i class="fas fa-redo"></i>
                                                            </a>
                                                            <a href="{{ url('agerouterejeter', ['$individuelle' => $individuelle, '$statut' => 'rejeter', '$module' => $module->id, '$numero' => $n]) }}"
                                                                title="rejeter" class="btn btn-outline-danger btn-sm mt-0">
                                                                <i class="fas fa-exclamation-triangle"></i>
                                                            </a>
                                                            <a href="{{ url('agerouteretenues', ['$individuelle' => $individuelle, '$statut' => 'retenue', '$module' => $module->id, '$numero' => $n]) }}"
                                                                title="retenue" class="btn btn-outline-primary btn-sm mt-0">
                                                                <i class="fas fa-check"></i>
                                                            </a>
                                                            <a href="{{ url('agerouteterminer', ['$individuelle' => $individuelle, '$statut' => 'terminée', '$module' => $module->id, '$numero' => $n]) }}"
                                                                title="terminer"
                                                                class="btn btn-outline-success btn-sm mt-0">
                                                                <i class="fas fa-save"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td ALIGN="CENTER" class="d-flex align-items-baseline">
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
                                            @endforeach
                                        @else
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
