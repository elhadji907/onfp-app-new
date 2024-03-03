@extends('layout.default')
@section('title', 'ONFP - Liste des communes')
@section('content')
<div class="container-fluid">
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Liste des communes
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div align="right">
                            <a href="{{ route('communes.create') }}">
                                <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i></div>
                            </a>
                        </div>
                        <br />
                        <table class="table table-bordered table-striped" width="100%" cellspacing="0"
                            id="table-communes">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width:5%;">N°</th>
                                    <th>{!! __('Commune') !!}</th>
                                    <th>{!! __('Arrondissement') !!}</th>
                                    <th>{!! __('Département') !!}</th>
                                    <th style="width:10%;">{!! __('Région') !!}</th>
                                    <th style="width:10%;"></th>
                                </tr>
                            </thead>
                            <tfoot class="table-dark">
                                <tr>
                                    <th>N°</th>
                                    <th>{!! __('Commune') !!}</th>
                                    <th>{!! __('Arrondissement') !!}</th>
                                    <th>{!! __('Département') !!}</th>
                                    <th>{!! __('Région') !!}</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($communes as $commune)
                                    <tr>
                                        <td>{!! $commune->id !!}</td>
                                        <td>{!! $commune->nom !!}</td>
                                        <td>{!! $commune->arrondissement->nom !!}</td>
                                        <td>{!! $commune->arrondissement->departement->nom !!}</td>
                                        <td>{!! $commune->arrondissement->departement->region->nom !!}</td>
                                        <td class="align-middle d-flex align-items-baseline">

                                            <a href="{!! url('communes/' . $commune->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                title="modifier">
                                                <i class="far fa-edit"></i>
                                            </a>

                                            &nbsp
                                            <a href="{!! url('courriers/' . $commune->id) !!}" class='btn btn-primary btn-sm'
                                                title="voir">
                                                <i class="far fa-eye">&nbsp;</i>
                                            </a>
                                            &nbsp;

                                            {!! Form::open(['method' => 'DELETE', 'url' => 'communes/' . $commune->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'supprimer']) !!}
                                            {!! Form::close() !!}

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

<div class="modal fade" id="modal_delete_commune" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <form method="POST" action="" id="form-delete-commune">
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
        $('#table-communes').DataTable({
            dom: 'lBfrtip',
            buttons: [
                {
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
                    orientation : 'landscape',
                    pageSize : 'RA4',
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
