@extends('layout.default')
@section('title', 'ONFP - Liste des users')
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
                        Liste des utilisateurs
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div align="right">
                                @can('user-create')
                                <a href="{{ route('users.create') }}">
                                    <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i></div>
                                </a>
                                @endcan
                            </div>
                            <br />
                            <table class="table table-bordered table-striped" width="100%" cellspacing="0" id="table-users">
                                <thead>
                                    <tr>
                                        <th>Civilité</th>
                                        <th>Prenom & Nom</th>
                                        {{-- <th>Date et lieu naissance</th> --}}
                                        <th width="50px">Email</th>
                                        <th>Téléphone</th>
                                        {{-- <th>Username</th> --}}
                                        <th width="300px">Role</th>
                                        {{--  <th width="200px">Permission</th>  --}}
                                        <th width="70px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{!! $user->civilite !!}
                                            </td>
                                            <td>{!! ucwords(strtolower($user->firstname)) !!}
                                                {!! mb_strtoupper($user->name, 'UTF-8') !!}</td>
                                            {{-- <td>
                                                @if ($user->civilite == 'M.')
                                                    né le
                                                @endif
                                                @if ($user->civilite == 'Mme')
                                                    née le
                                                @endif
                                                {!! $user->date_naissance->format('d/m/Y') !!} {{ __('à') }} {!! mb_strtoupper($user->lieu_naissance) !!}
                                            </td> --}}
                                            <td>{!! $user->email !!}
                                            </td>
                                            <td>{!! $user->telephone !!}
                                            </td>
                                            {{-- <td>{!! mb_strtolower($user->username) !!}</td> --}}
                                            <td>
                                                @if (!empty($user->getRoleNames()))
                                                    @foreach ($user->getRoleNames() as $v)
                                                        <label class="badge badge-success">{{ $v }}</label>
                                                    @endforeach
                                                @endif
                                            </td>
                                            {{--  <td>
                                                @if (!empty($user->getPermissionNames()))
                                                    @foreach ($user->getPermissionNames() as $v)
                                                        <label class="badge badge-success">
                                                            {{ $v }}</label>
                                                    @endforeach
                                                @endif
                                            </td>  --}}
                                            <td class="d-flex align-items-baseline align-middle">
                                                <a href="{!! url('users/' . $user->username . '/edit') !!}" class='btn btn-success btn-sm'
                                                    title="modifier">
                                                    <i class="far fa-edit">&nbsp;</i>
                                                </a>
                                                &nbsp;
                                                <a href="{!! url('users/' . $user->username) !!}" class='btn btn-primary btn-sm'
                                                    title="voir">
                                                    <i class="far fa-eye">&nbsp;</i>
                                                </a>
                                                {{-- <button data-id="{{$user}}" class='btn btn-primary btn-sm'
                                                    title="voir" data-toggle="modal" data-target="#userModal" data-whatever="@mdo">
                                                    <i class="far fa-eye">&nbsp;</i>
                                                </button> --}}
                                                &nbsp;
                                                {!! Form::open(['method' => 'DELETE', 'url' => 'users/' . $user->username, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
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
                            <label for="firstname" class="col-form-label">Prénom : {!! $user !!} </label>
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
