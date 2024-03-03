@extends('layout.default')
@section('title', 'ONFP - Liste des prises en charge en attente')
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
                        Total <label class="badge badge-info">{{ $effectif }}</label>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div align="right">
                                <a href="{{ route('pcharges.selectetablissements') }}" target="_blank">
                                    <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                    </div>
                                </a>
                            </div>
                            <br />
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="table-users">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width:4%;">Civilité</th>
                                        <th>Prénom</th>
                                        <th>Nom</th>
                                        <th style="width:9%;">Date nais.</th>
                                        <th style="width:9%;">Lieu nais.</th>
                                        {{-- <th style="width:5%;">Email</th> --}}
                                        <th style="width:5%;">Téléphone</th>
                                        <th style="width:30%;">Etablissement</th>
                                        <th style="width:8%;">Scolarité</th>
                                        <th style="width:10%;"></th>
                                    </tr>
                                </thead>
                                <tfoot class="table-dark">
                                    <tr>
                                        <th>Civilité</th>
                                        <th>Prénom</th>
                                        <th>Nom</th>
                                        <th>Date nais.</th>
                                        <th>Lieu nais.</th>
                                        {{-- <th>Email</th> --}}
                                        <th>Téléphone</th>
                                        <th>Etablissement</th>
                                        <th>Scolarité</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($pcharges as $pcharge)
                                        <tr>
                                            <td>{!! $pcharge->demandeur->user->civilite !!}</td>
                                            <td>{!! ucwords(strtolower($pcharge->demandeur->user->firstname)) !!}</td>
                                            <td>{!! mb_strtoupper($pcharge->demandeur->user->name, 'UTF-8') !!}</td>
                                            <td>{!! $pcharge->demandeur->user->date_naissance->format('d/m/Y') !!}</td>
                                            <td> {!! mb_strtoupper($pcharge->demandeur->user->lieu_naissance) !!}</td>
                                            {{-- <td>{!! $pcharge->demandeur->user->email !!}</td> --}}
                                            <td>{!! $pcharge->demandeur->user->telephone !!}</td>
                                            <td>{!! $pcharge->etablissement->name ?? '' !!}</td>                                            
                                            <td><label class="badge badge-info">{!! $pcharge->scolarite->annee !!}</label></td>
                                            <td class="d-flex align-items-baseline align-middle">
                                                <a href="{!! url('pcharges/' . $pcharge->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                    title="modifier">
                                                    <i class="far fa-edit">&nbsp;</i>
                                                </a>
                                                &nbsp;
                                                <a href="{!! url('pcharges/' . $pcharge->id) !!}" class='btn btn-primary btn-sm'
                                                    title="voir">
                                                    <i class="far fa-eye">&nbsp;</i>
                                                </a>
                                                &nbsp;
                                                {!! Form::open(['method' => 'DELETE', 'url' => 'pcharges/' . $pcharge->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
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
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">{{ __('Informations complètes') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="firstname" class="col-form-label">Prénom : </label>
                            {{-- <input type="text" class="form-control" id="firstname"> --}}
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    {{-- <button type="button" class="btn btn-primary">Send message</button> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-users').DataTable({
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
                    [1, 'asc']
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
