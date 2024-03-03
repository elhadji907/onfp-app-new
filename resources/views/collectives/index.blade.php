@extends('layout.default')
@section('title', 'ONFP - Liste des demandeurs collectives')
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
                      <i class="fas fa-table"></i>
                      Liste des demandeurs collectives
                  </div>              
                <div class="card-body">
                      <div class="table-responsive">
                          <div align="right">
                            <a href="{{route('collectives.create')}}"><div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i></div></a>
                          </div>
                          <br />
                        <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="table-collectives">
                          <thead class="table-dark">
                            <tr>
                              <th width="50px">N°</th>
                              <th width="300px">Raison sociale</th>
                              <th width="30px">Dépot</th>
                              <th width="120px">Responsable</th>
                              <th width="30px">Module</th>
                              <th>Localité</th>
                              <th>Etat</th>
                              <th width="80px"></th>
                            </tr>
                          </thead>
                          <tfoot class="table-dark">
                              <tr>
                              <th>N°</th>
                              <th>Raison sociale</th>
                              <th>Dépot</th>
                              <th>Responsable</th>
                              <th>Module</th>
                              <th>Localité</th>
                              <th>Etat</th>
                              <th></th>
                              </tr>
                            </tfoot>
                          <tbody>
                            <?php $i = 1 ?>
                  @foreach ($collectives as $collective)
                  <tr> 
                    {{-- <td>{!! $i++ !!}</td> --}}
                    <td>{!! $collective->demandeur->numero !!}</td>
                    <td>{!! $collective->name !!}</td>
                    <td>{!! $collective->date_depot->format('d/m/Y') ?? '' !!}</td>
                    <td>{!! $collective->demandeur->user->firstname !!} {{" "}} {!! $collective->demandeur->user->name !!}</td>
                    <td>
                      @foreach ($collective->modules as $module)
                      {!! $module->name !!}
                      @endforeach
                    </td>
                    <td>{!! $collective->commune->nom ?? '' !!}</td>
                    <td style="text-align: center;">
                      {!! $collective->statut!!}
                    </td>
                    <td style="text-align: center;" class="d-flex align-items-baseline align-content-center">
                        <a href="{!! url('collectives/' .$collective->id. '/edit') !!}" class= 'btn btn-success btn-sm' title="modifier">
                          <i class="far fa-edit">&nbsp;</i>
                        </a>
                        &nbsp;
                        <a href="{{ url('coldetails', ['$id' => $collective->id]) }}" class='btn btn-primary btn-sm'
                            title="voir">
                            <i class="far fa-eye">&nbsp;</i>
                        </a>
                        &nbsp;
                        {!! Form::open(['method'=>'DELETE', 'url'=>'collectives/' .$collective->id, 'id'=>'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title'=>"supprimer"] ) !!}
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
      @endsection

  @push('scripts')
  <script type="text/javascript">
    $(document).ready( function () {
      $('#table-collectives').DataTable({
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
        "lengthMenu": [ [5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Tout"] ],
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