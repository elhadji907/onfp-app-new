@extends('layout.default')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="container col-12 col-md-12 col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        {{ __("Sélection de l'opérateur") }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div align="right">
                            </div>
                            <br />
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0"
                                id="table-operateurs" style="height: 100px;">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="12%">Numéro agrément</th>
                                        <th width="50%">Opérateur</th>
                                        <th width="10%">Sigle</th>
                                        <th width="5%">Formations</th>
                                        <th style="width:2%;">Choisir</th>
                                    </tr>
                                </thead>
                                <tfoot class="table-dark">
                                    <tr>
                                        <th>Numéro agrément</th>
                                        <th>Opérateur</th>
                                        <th>Sigle</th>
                                        <th>Formations</th>
                                        <th>Choisir</th>
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
            $('#table-operateurs').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('operateurs.list') }}",
                columns: [{
                        data: 'numero_agrement',
                        name: 'numero_agrement'
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
                        data: 'formations_count',
                        name: 'formations_count'
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
                            url_e = "{!! route('agerouteformations.create', 'operateur=:id') !!}".replace(':id', data.id);
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
