@extends('layout.default')
@section('content')
    <div class="container col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12 margin-tb">
                    <a class="btn btn-primary" href="{{ route('typedirections.index') }}"> <i
                            class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                </div>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger mt-2">
                    <strong>Oups!</strong> Il y a eu quelques problèmes avec vos entrées.<br><br>
                    {{-- <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul> --}}
                </div>
            @endif
            <div class="row pt-1"></div>
            <div class="card border-primary">
                <div class="card-header card-header-primary text-center border-primary">
                    <h3 class="card-title">{{ 'Enregistrement Type de direction' }}</h3>
                </div>
                <div class="card-body">

                    {!! Form::open(['route' => 'typedirections.store', 'method' => 'POST']) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Type de direction:</strong>
                                {!! Form::text('name', null, ['placeholder' => 'Type de direction', 'class' => 'form-control']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('name'))
                                        @foreach ($errors->get('name') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div align="right">
                                <a href="{{ route('typedirections.create') }}">

                                    <button type="submit" class="btn btn-primary btn-sm"><i
                                            class="far fa-paper-plane"></i>&nbsp;Soumettre</button>
                                </a>
                            </div>
                            <br />

                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        {{-- $('input[type=checkbox]').on('change', function (e) {
            if ($('input[type=checkbox]:checked').length > 3) {
                $(this).prop('checked', false);
                alert("autorisé seulement 3");
            }
        }); --}}

        {{-- $(document).ready(function() {
            $('#table-roles-create').DataTable({
                dom: 'lBfrtip',
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
        }); --}}
    </script>
@endpush
