@extends('layout.default')
@section('title', 'ONFP - Liste des roles')
@section('content')
    <div class="container-fluid">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Liste des roles
                </div>
                <div class="card-body">
                    <form id="frm-example" method="POST" action="{{ url('roles') }}">
                        @csrf
                    <div class="table-responsive">
                        <div align="right">
                            <a href="{{ route('roles.create') }}">
                                <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i></div>
                            </a>
                        </div>
                        <br />
                        <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="table-roles">
                            <thead class="table-dark">
                                <tr>
                                    <th></th>
                                    <th>Role</th>
                                    <th style="width:13%;">Action</th>
                                </tr>
                            </thead>
                            <tfoot class="table-dark">
                                <tr>
                                    <th></th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>

                            </tbody>
                        </table> 
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Soumettre</font>                          
                            </font>
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="modal_delete_demandeur" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form method="POST" action="" id="form-delete-demandeur">
            @csrf
            @method('DELETE')
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Êtes-vous sûr de bien vouloir supprimer cet admin ?
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        cliquez sur close pour annuler
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-times">&nbsp;Delete</i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-roles').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('roles.list') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false
                    }

                ],
                "columnDefs": [{
                    'targets': 2,
                    'checkboxes': {
                        'selectRow': true
                    }
                }],
                'select': {
                    'style': 'multi'
                 },
                 'order': [[0, 'asc']],

                dom: 'lBfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print',
                ],

                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Tout"]
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
// Handle form submission event
$('#frm-example').on('submit', function(e){
    var form = this;

    var rows_selected = table.column(0).checkboxes.selected();

    // Iterate over all selected checkboxes
    $.each(rows_selected, function(index, rowId){
       // Create a hidden element
       $(form).append(
           $('<input>')
              .attr('type', 'hidden')
              .attr('name', 'id[]')
              .val(rowId)
       );
    });
 });

            $('#table-roles').off('click', '.btn_delete_demandeur').on('click', '.btn_delete_demandeur',
                function() {
                    var href = $(this).data('href');
                    $('#form-delete-demandeur').attr('action', href);
                    $('#modal_delete_demandeur').modal();
                });
        });
    </script>
@endpush
