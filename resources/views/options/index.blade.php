@extends('layout.default')
@section('title', 'ONFP - Liste des options')
@section('content')
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session()->has('success'))
                  <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif 
                @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif
              <div class="card"> 
                  <div class="card-header">
                      <i class="fas fa-table"></i>
                      Liste des options
                  </div>              
                <div class="card-body">
                      <div class="table-responsive">
                          <div align="right">
                            <a href="{{route('options.create')}}"><div class="btn btn-success btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i></div></a>
                          </div>
                          <br />
                        <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="table-options">
                          <thead class="table-dark">
                            <tr>
                              <th>ID</th>
                               <th>{!! __("Option") !!}</th>
                              <th style="width:20%;">Action</th>
                            </tr>
                          </thead>
                          <tfoot class="table-dark">
                              <tr>
                                <th>ID</th>
                                 <th>{!! __("Option") !!}</th>
                                <th style="width:20%;">Action</th>
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
      <div class="modal fade" id="modal_delete_option" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form method="POST" action="" id="form-delete-option">
          @csrf
          @method('DELETE')
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Êtes-vous sûr de bien vouloir supprimer cet admin ?</h6>
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
      $(document).ready(function () {
          $('#table-options').DataTable( { 
            "processing": true,
            "serverSide": true,
            "ajax": "{{route('options.list')}}",
            columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: null ,orderable: false, searchable: false}

                ],
                "columnDefs": [
                        {
                        "data": null,
                        "render": function (data, type, row) {
                        url_e =  "{!! route('options.edit',':id')!!}".replace(':id', data.id);
                        url_d =  "{!! route('options.destroy',':id')!!}".replace(':id', data.id);
                        return '<a href='+url_e+'  class=" btn btn-primary edit btn-sm" title="Modifier"><i class="far fa-edit"></i></a>'+
                        '<div class="btn btn-danger delete btn_delete_option btn-sm ml-1" title="Supprimer" data-href='+url_d+'><i class="fas fa-trash-alt"></i></div>';
                        },
                        "targets": 2
                        },
                ],

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

                "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Tout"] ],
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
                },            
          });

          
        $('#table-options').off('click', '.btn_delete_option').on('click', '.btn_delete_option',
        function() { 
          var href=$(this).data('href');
          $('#form-delete-option').attr('action', href);
          $('#modal_delete_option').modal();
        });
      });
      
  </script> 
  @endpush