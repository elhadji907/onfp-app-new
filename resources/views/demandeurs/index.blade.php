@extends('layout.default')
@section('title', 'ONFP - Liste des demandeurs')
@section('content')
<div class="container-fluid">
    <div class="row">     
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <a class="nav-link" href="{{ route('demandeurs.index') }}" target="_blank">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ ('Demandeurs') }}</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $effectif }}</div>
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
            <div class="card border-left-success shadow h-100 py-2">
              <a class="nav-link" href="{{ route('individuelles.index') }}" target="_blank">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                     {{ ('individuelles') }}
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{  $individuelles }}</div>
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
                 <a class="nav-link" href="{{ route('collectives.index') }}" target="_blank">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">{{ ('collectives') }}</div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{  $collectives }}</div>
                          </div>
                        </div>
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
              <a class="nav-link" href="{{ route('pcharges.index') }}" target="_blank" >
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ ('pcharges') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pcharges }}</div>
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
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Liste des demandeurs
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div align="right">
                                <a href="{{ route('demandeurs.create') }}">
                                    <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                    </div>
                                </a>
                            </div>
                            <br />
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0"
                                id="table-demandeurs">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width:4%;">Civilité</th>
                                        <th>Prenom</th>
                                        <th>Nom</th>
                                        <th>Date naissance</th>
                                        <th>Lieu naissance</th>
                                        <th style="width:18%;">Email</th>
                                        <th>Téléphone</th>
                                        <th style="width:4%;"></th>
                                    </tr>
                                </thead>
                                {{--  <tfoot class="table-dark">
                                    <tr>
                                        <th>Civilité</th>
                                        <th>Prenom</th>
                                        <th>Nom</th>
                                        <th>Date naissance</th>
                                        <th>Lieu naissance</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th></th>
                                    </tr>
                                </tfoot>  --}}
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($demandeurs as $demandeur)
                                        <tr>
                                            <td>{!! $demandeur->user->civilite ?? '' !!}</td>
                                            <td>{!! ucwords($demandeur->user->firstname) ?? '' !!}</td>
                                            <td>{!! mb_strtoupper($demandeur->user->name, 'UTF-8')  ?? '' !!}</td>
                                            <td>{!! $demandeur->user->date_naissance->format('d/m/Y')  ?? '' !!}</td>
                                            <td>{!! mb_strtoupper($demandeur->user->lieu_naissance, 'UTF-8')  ?? '' !!}</td>
                                            <td>{!! $demandeur->user->email  ?? '' !!}</td>
                                            <td>{!! $demandeur->user->telephone  ?? '' !!}</td>
                                            <td>
                                                <a href="{!! url('demandeurs/' . $demandeur->id) !!}" class='btn btn-primary btn-sm'
                                                    title="voir" target='_blank'>
                                                    <i class="far fa-eye">&nbsp;</i>
                                                </a>
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
            $('#table-demandeurs').DataTable({
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
