@extends('layout.default')
@section('title', 'ONFP - Liste des courriers arrivés')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a class="btn btn-outline-primary btn-sm"
                                    href="{{ route('recues.index') }}"><i class="fas fa-sync-alt"></i>&nbsp;actualiser</a>
                            </li>
                            <li class="breadcrumb-item active">Liste des courriers arrivés</li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div align="right">
                                <a href="{!! url('recues/create') !!}">
                                    <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</div>
                                </a>
                            </div>
                            <br />
                            <table class="table table-bordered table-striped" id="table-recus" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width:8%;">{{ __('ARRIVÉ') }} </th>
                                        <th style="width:8%;">{{ __('CORRESP.') }}</th>
                                        <th style="width:8%;">{{ __('N° COR.') }}</th>
                                        <th style="width:15%;">EXPEDITEUR</th>
                                        <th>OBJET</th>
                                        {{--  <th style="width:2%;">SCAN</th>  --}}
                                        <th style="width:15%;">IMPUTATION</th>
                                        <th style="width:2%;">IMPUTER</th>
                                        <th style="width:1%;"></th>
                                        <th style="width:1%;"></th>
                                        {{--  <th style="width:1%;"></th>  --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($recues as $recue)
                                        <tr>
                                            <td style="vertical-align: middle;">{!! optional($recue->courrier->date_recep)->format('d/m/Y') !!}
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">{!! optional($recue->courrier->date_cores)->format('d/m/Y') !!}
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">{!! $recue->numero !!}
                                            </td>
                                            <td style="vertical-align: middle;">{!! $recue->courrier->expediteur !!}
                                            </td>
                                            <td style="vertical-align: middle;">{!! $recue->courrier->objet !!}
                                            </td>
                                            {{--   <td>
                                                @if ($recue->courrier->file != '')
                                                    <a class="btn btn-outline-secondary btn-sm"
                                                        title="télécharger le fichier joint" target="_blank"
                                                        href="{{ asset($recue->courrier->getFile()) }}">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                @endif
                                            </td>  --}}
                                            <td style="vertical-align: middle;">
                                                @foreach ($recue->courrier->directions->unique('id') as $imputation)
                                                    {{--  <span class="btn btn-default">{!! $imputation->sigle ?? '' !!}</span>  --}}
                                                    <span>{!! $imputation->sigle ?? '' !!}, </span>
                                                @endforeach
                                            </td>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <small style="text-align: center; vertical-align: middle;">
                                                        <a href="{!! url('recufactures', ['$id' => $recue->id]) !!}" class='btn btn-primary btn-sm'
                                                            title="télécharger le coupon" target="_blank">
                                                            <i class="fa fa-print" aria-hidden="true"></i>
                                                        </a>
                                                    </small>
                                                    <small style="text-align: center; vertical-align: middle;">
                                                    <a href="{!! url('recuimputations', ['$id' => $recue->id]) !!}" class='btn btn-warning btn-sm'
                                                        title="imputer">
                                                        <i class="fa fa-retweet"></i>
                                                    </a>
                                                    </small>
                                                </td>
                                            </div>
                                            <td style="text-align: center; vertical-align: middle;">
                                                @can('courrier-edit')
                                                    <a href="{!! url('recues/' . $recue->id . '/edit') !!}" class='btn-sm' title="modifier">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <a href="{!! url('courriers/' . $recue->courrier->id) !!}" class='btn-sm' title="voir">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                           {{--   <td style="text-align: center; vertical-align: middle;">
                                                @can('courrier-delete')
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'url' => 'recues/' . $recue->id,
                                                        'id' => 'deleteForm',
                                                        'onsubmit' => 'return ConfirmDelete()',
                                                    ]) !!}
                                                    {!! Form::button('<i class="fa fa-times" aria-hidden="true" style="color:red"></i>', [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-default btn-sm',
                                                        'title' => 'supprimer',
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>  --}}
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
            $('#table-recus').DataTable({
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
                    [2, 'desc']
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
