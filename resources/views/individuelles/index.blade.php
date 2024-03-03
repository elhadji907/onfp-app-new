@extends('layout.default')
@section('title', 'ONFP - Liste des demandeurs individuelles')
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
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a class="btn btn-outline-primary btn-sm"
                                    href="{{ route('individuelles.index') }}"><i class="fas fa-sync-alt"></i>&nbsp;actualiser</a>
                            </li>
                            <li class="breadcrumb-item active">Liste des demandes individuelles</li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div align="right">
                                <a href="{{ route('individuelles.create') }}">
                                    <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i></div>
                                </a>
                            </div>
                            <br />
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0"
                                id="table-individuelles">
                                <thead>
                                    <tr>
                                        <th style="width:5%;">N°</th>
                                        <th style="width:10%;">Cin</th>
                                        <th>Prénom</th>
                                        <th>Nom</th>
                                        <th style="width:8%;">Date nais.</th>
                                        <th>Lieu nais.</th>
                                        <th>Téléphone</th>
                                        <th>Commune</th>
                                        <th style="width:8%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($individuelles as $individuelle)
                                        <tr>
                                            <td style="vertical-align: middle;">{!! $individuelle->demandeur->numero_dossier !!}</td>
                                            <td style="vertical-align: middle;">{!! $individuelle->demandeur->cin !!}</td>
                                            <td style="vertical-align: middle;">{!! $individuelle->demandeur->user->firstname !!} </td>
                                            <td style="vertical-align: middle;">{!! $individuelle->demandeur->user->name !!} </td>
                                            <td style="vertical-align: middle;">{!! $individuelle->demandeur->user->date_naissance->format('d/m/Y') !!}</td>
                                            <td style="vertical-align: middle;">{!! $individuelle->demandeur->user->lieu_naissance !!}</td>
                                            <td style="vertical-align: middle;">{!! $individuelle->demandeur->user->telephone !!}</td>
                                            <td style="vertical-align: middle;">{!! $individuelle->commune->nom ?? '' !!}</td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <a href="{!! url('individuelles/' . $individuelle->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                    title="modifier">
                                                    <i class="far fa-edit">&nbsp;</i>
                                                </a>
                                                &nbsp;
                                                <a href="{{ url('individuelles', ['$id' => $individuelle->id]) }}"
                                                    class='btn btn-primary btn-sm' title="voir" target="_blank">
                                                    <i class="far fa-eye">&nbsp;</i>
                                                </a>
                                                &nbsp;
                                                @can('delete', $individuelle)
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'url' => 'individuelles/' . $individuelle->id,
                                                        'id' => 'deleteForm',
                                                        'onsubmit' => 'return ConfirmDelete()',
                                                    ]) !!}
                                                    {!! Form::button('<i class="fa fa-trash"></i>', [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'supprimer',
                                                    ]) !!}
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
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-individuelles').DataTable({
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
