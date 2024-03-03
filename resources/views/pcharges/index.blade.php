@extends('layout.default')
@section('title', 'ONFP - Liste des prises en charge')
@section('content')
    <div class="container-fluid">
        <div class="row">
            {{--  <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <a class="nav-link" href="{{ route('pcharges.index') }}">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ 'Prises en charge (TOTAL)' }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pctotal }}</div>
                                </div>
                                <div class="col-auto">
                                    <span data-feather="mail"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>  --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <a class="nav-link" href="{{ url('attente', ['$attente' => 'Attente']) }}">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Attente </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $attente }}</div>
                                </div>
                                <div class="col-auto">
                                    <span data-feather="mail"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <a class="nav-link" href="{{ url('rejeter', ['$attente' => 'Non accordée']) }}">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Non accordée </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nonaccorde }}</div>
                                </div>
                                <div class="col-auto">
                                    <span data-feather="mail"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <a class="nav-link" href="{{ url('accorder', ['$attente' => 'Accordée']) }}">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Accordée </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $accorde }}</div>
                                </div>
                                <div class="col-auto">
                                    <span data-feather="mail"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <a class="nav-link" href="{{ url('terminer', ['$attente' => 'Terminée']) }}">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Terminée</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $termine }}</div>
                                </div>
                                <div class="col-auto">
                                    <span data-feather="mail"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
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
                        @if (isset($pctotal))
                        Total <label class="badge badge-info">{{ $pctotal }}</label>
                    @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div align="right">
                                <a href="{{ route('pcharges.selectetablissements') }}">
                                    <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                    </div>
                                </a>
                            </div>
                            <br />
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="table-users">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width:4%;">Civilité</th>
                                        <th style="width:4%;">Cin</th>
                                        <th>Prénom</th>
                                        <th>Nom</th>
                                       {{--   <th style="width:5%;">Âge</th>  --}}
                                        {{-- <th style="width:9%;">Lieu nais.</th> --}}
                                        {{-- <th style="width:5%;">Email</th> --}}
                                        {{--  <th style="width:5%;">Téléphone</th>  --}}
                                        <th style="width:30%;">Etablissement</th>
                                        <th style="width:5%;">Scolarité</th>
                                        <th style="width:12%;">Type demande</th>
                                        <th style="width:9%;">Appréciation</th>
                                        <th style="width:10%;"></th>
                                    </tr>
                                </thead>
                                <tfoot class="table-dark">
                                    <tr>
                                        <th>Civilité</th>
                                        <th>Cin</th>
                                        <th>Prénom</th>
                                        <th>Nom</th>
                                       {{--   <th>Âge</th>  --}}
                                        {{-- <th>Lieu nais.</th> --}}
                                        {{-- <th>Email</th> --}}
                                       {{--   <th>Téléphone</th>  --}}
                                        <th>Etablissement</th>
                                        <th>Scolarité</th>
                                        <th>Type demande</th>
                                        <th>Appréciation</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($pcharges as $pcharge)
                                        <tr>
                                            <td>{!! $pcharge->demandeur->user->civilite !!}</td>
                                            <td>
                                                <a href="{{ url('countscolaritenbre', ['$nombre' => $pcharge->cin]) }}"
                                                    class="btn btn-outline-info btn-sm">{!! $pcharge->cin !!}</a>
                                            </td>
                                            <td>{!! ucwords(strtolower($pcharge->demandeur->user->firstname)) !!}</td>
                                            <td>{!! mb_strtoupper($pcharge->demandeur->user->name, 'UTF-8') !!}</td>
                                            {{-- <td>{!! $pcharge->demandeur->user->date_naissance->format('d/m/Y') !!}</td> --}}
                                            {{--  <td>{!! number_format(Carbon\Carbon::now()->floatDiffInYears($pcharge->demandeur->user->date_naissance), 0, ',', ' ') . ' ' !!}</td>  --}}
                                           {{--   <td>
                                                <a href="{{ url('diffage', ['$age' => $pcharge->demandeur->user->date_naissance, '$id' => $pcharge->id]) }}"
                                                    class="btn btn-outline-success btn-sm">
                                                    {!! number_format(Carbon\Carbon::now()->floatDiffInYears($pcharge->demandeur->user->date_naissance), 0, ',', ' ') . ' ' !!}</a>
                                            </td>  --}}
                                            {{-- <td> {!! mb_strtoupper($pcharge->demandeur->user->lieu_naissance) !!}</td> --}}
                                            {{-- <td>{!! $pcharge->demandeur->user->email !!}</td> --}}
                                           {{--   <td>{!! $pcharge->demandeur->user->telephone !!}</td>  --}}
                                            <td>{!! $pcharge->etablissement->name ?? '' !!}</td>
                                            <td>{!! $pcharge->scolarite->annee ?? '' !!}</td>
                                            <td>{!! $pcharge->typedemande !!}</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    @if (isset($pcharge->statut) && $pcharge->statut == "Accordée")
                                                    <label class="badge badge-info">{!! $pcharge->statut ?? '' !!}</label>
                                                    <a href="{{ url('termine', ['$pcharge' => $pcharge, '$statut' => 'Terminée']) }}"
                                                        title="terminer" class="btn btn-outline-success btn-sm mt-0">
                                                        <i class="fas fa-check-double"></i>
                                                    </a>   
                                                    @elseif (isset($pcharge->statut) && $pcharge->statut == "Non accordée")
                                                    <label class="badge badge-danger">{!! $pcharge->statut ?? '' !!}</label>
                                                   {{--   <a href="{{ url('nonaccord', ['$pcharge' => $pcharge, '$statut' => 'Attente']) }}"
                                                        title="Annuler" class="btn btn-outline-danger btn-sm mt-0">
                                                        <i class="fas fa-times"></i>
                                                    </a>    --}} 
                                                    @elseif (isset($pcharge->statut) && $pcharge->statut == "Terminée")
                                                    <label class="badge badge-success">{!! $pcharge->statut ?? '' !!}</label>
                                                    @else
                                                    <label class="badge badge-warning">{!! $pcharge->statut ?? '' !!}</label>
                                                    <a href="{{ url('accord', ['$pcharge' => $pcharge, '$statut' => 'Accordée', '$avis_dg' =>$pcharge->montant]) }}"
                                                        title="Accordée" class="btn btn-outline-primary btn-sm mt-0">
                                                        <i class="fas fa-check-circle"></i>
                                                    </a>
                                                    <a href="{{ url('nonaccord', ['$pcharge' => $pcharge, '$statut' => 'Non accordée']) }}"
                                                        title="Non accordée" class="btn btn-outline-danger btn-sm mt-0">
                                                        <i class="fas fa-times"></i>
                                                    </a>                                                        
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="d-flex align-items-baseline align-middle">
                                                <a href="{!! url('pcharges/' . $pcharge->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                    title="modifier">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                &nbsp;
                                                <a href="{{ url('pdetails', ['$id' => $pcharge->demandeur->id, '$pchareg' => $pcharge->id]) }}" class='btn btn-primary btn-sm'
                                                    title="voir">
                                                    <i class="far fa-eye"></i>
                                                </a>&nbsp;
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
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Tout"]
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
