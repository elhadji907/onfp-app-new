@extends('layout.default')
@section('content')
    <div class="container-fluid">
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
                        {{ __("Sélection des bénéficiaires") }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div align="right">
                                <a href="{!! url('formations/' . $id_form) !!}" class='btn btn-success btn-sm' title="voir">
                                    <i class="fas fa-check">&nbsp;Terminé</i>
                                </a>
                            </div>
                            <br />
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0"
                                style="height: 100px;" id="table-selectdindividuelles">
                                <thead class="table-default">
                                    <tr>
                                        <th width="50px">Cin</th>
                                        <th width="25px">Civilité</th>
                                        <th>Prenom</th>
                                        <th>Nom</th>
                                        <th width="50px">Date nais.</th>
                                        <th width="150px">Lieu nais.</th>
                                        <th width="50px">Téléphone</th>
                                        <th width="150px">Département</th>
                                        <th width="150px">Région</th>
                                        <th width="50px">Ajouter</th>
                                    </tr>
                                </thead>
                                {{--  <tfoot class="table-default">
                                    <tr>
                                        <th>Cin</th>
                                        <th>Civilité</th>
                                        <th>Prenom</th>
                                        <th>Nom</th>
                                        <th>Date nais.</th>
                                        <th>Lieu nais.</th>
                                        <th>Téléphone</th>
                                        <th>Département</th>
                                        <th>Région</th>
                                        <th>Ajouter</th>
                                    </tr>
                                </tfoot>  --}}
                                <tbody>
                                    @if ($individuelles->count())
                                        @foreach ($individuelles as $key => $individuelle)
                                            <tr id="tr_{{ $individuelle->id }}">
                                                {{--  <td>{{ ++$key }}</td>  --}}
                                                <td>{{ $individuelle->cin }}</td>
                                                <td>{!! $individuelle->demandeur->user->civilite !!}</td>
                                                <td>{!! $individuelle->demandeur->user->firstname !!}</td>
                                                <td>{!! $individuelle->demandeur->user->name !!}</td>
                                                <td>{!! $individuelle->demandeur->user->date_naissance->format('d/m/Y') !!}</td>
                                                <td>{!! $individuelle->demandeur->user->lieu_naissance !!}</td>
                                                <td>{!! $individuelle->demandeur->user->telephone !!}</td>
                                                <td>{!! $individuelle->demandeur->commune->arrondissement->departement->nom ?? '' !!}</td>
                                                <td>
                                                    {!! $individuelle->demandeur->commune->arrondissement->departement->region->nom ?? '' !!}

                                                </td>
                                                <td>
                                                    <a href="{{ url('adddindividuelles', ['$id_ind' => $individuelle->id, '$id_form' => $id_form]) }}"
                                                        title="ajouter" class="btn btn-outline-primary btn-sm mt-0">
                                                        <i class="fas fa-plus">&nbsp;ajouter</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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
  $(document).ready( function () {
    $('#table-selectdindividuelles').DataTable({
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
            },
        ],
        
      "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Tout"] ],
      "order": [
            [ 0, 'asc' ]
            ],
            language: {
              "sProcessing":     "Traitement en cours...",
              "sSearch":         "Rechercher&nbsp;:",
              "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
              "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
              "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
              "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
              "sInfoPostFix":    "",
              "sLoadingRecords": "Chargement en cours...",
              "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
              "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
              "oPaginate": {
                  "sFirst":      "Premier",
                  "sPrevious":   "Pr&eacute;c&eacute;dent",
                  "sNext":       "Suivant",
                  "sLast":       "Dernier"
              },
              "oAria": {
                  "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
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
} );
  
</script>
@endpush

