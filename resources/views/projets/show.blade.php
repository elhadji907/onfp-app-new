@extends('layout.default')
@section('title', 'ONFP - ' .$projet->sigle)
@section('content')
    <div class="container col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="container-fluid">
            <div class="row justify-content-center pb-2">
                <div class="col-lg-12 margin-tb">
                    <a class="btn btn-outline-success" href="{{ route('projets.index') }}"> <i
                            class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                </div>
            </div>
            <div class="card border-success">
                <div class="card card-header text-center bg-gradient-default border-success">
                    <h1 class="h4 card-title text-center text-black h-100 text-uppercase mb-0"><b></b><span
                            class="font-italic">INFORMATIONS</span></h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-10">
                            <div class="form-group">
                                <span class="badge badge-dark">Projet</span> :
                                <label>{{ $projet->name }}</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-2">
                            <div class="form-group">
                                <span class="badge badge-dark">Sigle</span> :
                                <label>{{ $projet->sigle }}</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <span class="badge badge-dark">Descrption</span> :
                                <label>{{ $projet->description }}</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <span class="badge badge-dark">Date signature</span> :
                                <label>{{ Carbon\Carbon::parse($projet->date_signature)->format('d/m/Y') }}</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <span class="badge badge-dark">Date début</span> :
                                <label>{{ Carbon\Carbon::parse($projet->debut)->format('d/m/Y') }}</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <span class="badge badge-dark">Date fin</span> :
                                <label>{{ Carbon\Carbon::parse($projet->fin)->format('d/m/Y') }}</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <span class="badge badge-dark">Localités</span> :
                                @if (!empty($projetLocalites))
                                    @foreach ($projetLocalites as $v)
                                        <label>{{ $v->nom }},</label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <span class="badge badge-dark">Zones</span> :
                                @if (!empty($projetZones))
                                    @foreach ($projetZones as $v)
                                        <label>{{ $v->nom }},</label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <span class="badge badge-dark">Modules</span> :
                                @if (!empty($projetModules))
                                    @foreach ($projetModules as $v)
                                        <label>{{ $v->name }},</label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <span class="badge badge-dark">Ingenieurs</span> :
                                @if (!empty($projetIngenieurs))
                                    @foreach ($projetIngenieurs as $v)
                                        <label>{{ $v->name }},</label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>   
                    <hr>                
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-individuelles-show">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width:10%;">N°</th>
                                    <th style="width:10%;">Cin</th>
                                    <th style="width:5%;">Civilité</th>
                                    <th style="width:10%;">Prenom</th>
                                    <th style="width:10%;">Nom</th>
                                    <th style="width:10%;">Date nais.</th>
                                    <th style="width:10%;">Lieu nais.</th>
                                    <th style="width:10%;">Téléphone</th>
                                    <th style="width:10%;">Commune</th>
                                    <th style="width:10%;">Région</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($projet->individuelles as $key => $individuelle)
                                    <tr>
                                        <td>
                                            <a class="btn btn-outline-info" href="{{ route('individuelles.show', $individuelle->id) }}">{!! $individuelle->demandeur->numero !!}</a>
                                        </td>
                                        <td>{!! $individuelle->cin !!}</td>
                                        <td>{!! $individuelle->demandeur->user->civilite !!}</td>
                                        <td>{!! $individuelle->demandeur->user->firstname !!} </td>
                                        <td>{!! $individuelle->demandeur->user->name !!} </td>
                                        <td>{!! $individuelle->demandeur->user->date_naissance->format('d/m/Y') !!}</td>
                                        <td>{!! $individuelle->demandeur->user->lieu_naissance !!}</td>
                                        <td>{!! $individuelle->demandeur->user->telephone !!}</td>
                                        <td>{!! $individuelle->commune->nom ?? '' !!}</td>
                                        <td>{!! $individuelle->commune->arrondissement->departement->region->nom ?? '' !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-individuelles-show').DataTable({
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
