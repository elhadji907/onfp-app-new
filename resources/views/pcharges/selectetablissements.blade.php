@extends('layout.default')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        {{ __("Sélectionner votre établissement ou cliquez sur ajouter pour l'ajouter") }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div align="right">
                                <a href="{{ route('etablissements.create') }}" target="_blank">
                                    <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i></div>
                                </a>
                            </div>
                            <br />
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0"
                                id="table-etablissements" style="height: 100px;">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width:5%;">N°</th>
                                        <th>Établissement</th>
                                        <th style="width:10%;">Sigle</th>
                                        <th style="width:15%;">Réssgion</th>
                                        <th style="width:5%;"></th>
                                    </tr>
                                </thead>
                                <tfoot class="table-dark">
                                    <tr>
                                        <th>N°</th>
                                        <th>Établissement</th>
                                        <th>Réssgion</th>
                                        <th>Sigle</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
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
            $('#table-etablissements').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('etablissements.list') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'sigle',
                        name: 'sigle'
                    },
                    {
                        data: 'region.nom',
                        name: 'region.nom'
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false
                    }

                ],
                "columnDefs": [{
                        "data": null,
                        "render": function(data, type, row) {
                            url_e = "{!! route('pcharges.create', 'etablissement=:id') !!}".replace(':id', data.id);
                            return '<a href=' + url_e +
                                '  class="btn btn-outline-primary" ><i class="fa fa-check" aria-hidden="true"></i>';
                        },
                        "targets": 4
                    },
                ],
                dom: 'lBfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print',
                ],
                "lengthMenu": [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "Tout"]
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
                },

            });

        });

    </script>
@endpush
