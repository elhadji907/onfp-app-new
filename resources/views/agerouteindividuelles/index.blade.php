@extends('layout.default')
@section('title', 'ONFP - AGEROUTE BENEFICIAIRES')
@section('content')
    {{--  @can('role-delete')  --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-80 py-2">
                    <a class="nav-link" href="#">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('TOTAL') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $total_count }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    {{-- <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ __('%') }}</div> --}}
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                                        <label class="badge badge-pill badge-info">{{ $total_p }}
                                            {{ __('%') }}</label>
                                    </div>
                                </div>
                                {{-- <div class="col-auto">
                                        <span data-feather="mail"></span>
                                    </div> --}}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-80 py-2">
                    <a class="nav-link"
                        href="{{ url('listerparlocalite', ['$projet' => $projet, '$localite' => 'Ziguinchor']) }}"
                        target="_blank">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        {{ __('ZIGUINCHOR') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $ziguinchor_count }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    {{-- <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ __('%') }}</div> --}}
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                                        <label class="badge badge-pill badge-info">{{ $ziguinchor_p }}
                                            {{ __('%') }}</label>
                                    </div>
                                </div>
                                {{-- <div class="col-auto">
                                        <span data-feather="mail"></span>
                                    </div> --}}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-80 py-2">
                    <a class="nav-link"
                        href="{{ url('listerparlocalite', ['$projet' => $projet, '$localite' => 'Bignona']) }}"
                        target="_blank">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        {{ __('BIGNONA') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $bignona_count }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    {{-- <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ __('%') }}</div> --}}
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                                        <label class="badge badge-pill badge-info">{{ $bignona_p }}
                                            {{ __('%') }}</label>
                                    </div>
                                </div>
                                {{-- <div class="col-auto">
                                        <span data-feather="mail"></span>
                                    </div> --}}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-80 py-2">
                    <a class="nav-link"
                        href="{{ url('listerparlocalite', ['$projet' => $projet, '$localite' => 'Bounkiling']) }}"
                        target="_blank">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        {{ __('BOUNKILING') }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $bounkiling_count }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    {{-- <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ __('%') }}</div> --}}
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                                        <label class="badge badge-pill badge-info">{{ $bounkiling_p }}
                                            {{ __('%') }}</label>
                                    </div>
                                </div>
                                {{-- <div class="col-auto">
                                        <span data-feather="mail"></span>
                                    </div> --}}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{--  @endcan  --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @elseif (session('messages'))
                    <div class="alert alert-danger">
                        {{ session('messages') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        AGEROUTE, Liste des Bénéficiares
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <div align="right">
                                    <a href="{{ route('agerouteindividuelles.create') }}" target="_blank">
                                        <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                        </div>
                                    </a>
                                </div>
                                <br />
                                <table class="table table-bordered" id="table-ageroutebeneficiaires">
                                    <thead class="table-dark">
                                        <tr>
                                            {{-- <th style="width:5%;">N°</th> --}}
                                            <th style="width:5%;">N° CIN</th>
                                            <th style="width:5%;">Prenom</th>
                                            <th style="width:5%;">Nom</th>
                                            <th style="width:8%;">Date nais.</th>
                                            <th style="width:8%;">Lieu nais.</th>
                                            <th style="width:5%;">Téléphone</th>
                                            <th style="width:5%;">Départements</th>
                                            {{-- <th style="width:10%;">Communes</th> --}}
                                            <th style="width:15%;">Module</th>
                                            @can('role-delete')
                                                {{-- <th style="width:3%;">Op. saisie</th> --}}
                                                <th style="width:8%;"></th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($individuelles as $key => $individuelle)
                                            @if (isset($individuelle) && $individuelle->projet->name == $projet_name)
                                                <tr>
                                                    {{-- <td>{!! $individuelle->demandeur->numero_dossier !!}</td> --}}
                                                    <td>{!! $individuelle->demandeur->cin !!}</td>
                                                    <td>{!! ucwords(strtolower($individuelle->demandeur->user->firstname)) !!} </td>
                                                    <td>{!! strtoupper(
                                                        preg_replace(
                                                            '#&[^;]+;#',
                                                            '',
                                                            preg_replace(
                                                                '#&([A-za-z]{2})(?:lig);#',
                                                                '\1',
                                                                preg_replace(
                                                                    '#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#',
                                                                    '\1',
                                                                    htmlentities($individuelle->demandeur->user->name, ENT_NOQUOTES, 'utf-8'),
                                                                ),
                                                            ),
                                                        ),
                                                    ) !!} </td>
                                                    <td>{!! $individuelle->demandeur->user->date_naissance->format('d/m/Y') !!}</td>
                                                    <td>{!! strtoupper(
                                                        preg_replace(
                                                            '#&[^;]+;#',
                                                            '',
                                                            preg_replace(
                                                                '#&([A-za-z]{2})(?:lig);#',
                                                                '\1',
                                                                preg_replace(
                                                                    '#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#',
                                                                    '\1',
                                                                    htmlentities($individuelle->demandeur->user->lieu_naissance, ENT_NOQUOTES, 'utf-8'),
                                                                ),
                                                            ),
                                                        ),
                                                    ) !!} </td>
                                                    <td>{!! $individuelle->demandeur->user->telephone !!}</td>
                                                    <td>{!! $individuelle->localite->nom ?? '' !!}</td>
                                                    {{-- <td>{!! $individuelle->zone->nom ?? '' !!}</td> --}}
                                                    <td>{!! $individuelle->module->name ?? '' !!}</td>
                                                    @can('role-delete')
                                                        {{-- <td>
                                                            <a class="nav-link"
                                                                href="{{ url('createdby', ['$createdby' => $individuelle->created_by]) }}"
                                                                target="_blank">
                                                                {!! $individuelle->created_by ?? '' !!}<br />
                                                            </a>
                                                        </td> --}}
                                                    @endcan
                                                    {{-- <td ALIGN="CENTER">
                                                    <?php $h = 1; ?>
                                                    @foreach ($individuelle->module as $key => $module)
                                                        @if ($loop->last)
                                                            <a class="nav-link badge badge-info"
                                                                href="{{ url('moduleindividuelle', ['$projet' => $projet, '$individuelle' => $individuelle]) }}"
                                                                target="_blank">{!! $loop->count !!}</a>
                                                        @endif
                                                    @endforeach
                                                </td> --}}
                                                    @can('role-delete')
                                                        <td ALIGN="CENTER" class="d-flex align-items-baseline">
                                                            <a href="{!! url('agerouteindividuelles/' . $individuelle->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                                title="modifier">
                                                                <i class="far fa-edit">&nbsp;</i>
                                                            </a>
                                                            &nbsp;
                                                            <a href="{{ url('agerouteindividuelles', ['$id' => $individuelle->id]) }}"
                                                                class='btn btn-primary btn-sm' title="voir" target="_blank">
                                                                <i class="far fa-eye">&nbsp;</i>
                                                            </a>
                                                            &nbsp;
                                                            {!! Form::open([
                                                                'method' => 'DELETE',
                                                                'url' => 'agerouteindividuelles/' . $individuelle->id,
                                                                'id' => 'deleteForm',
                                                                'onsubmit' => 'return ConfirmDelete()',
                                                            ]) !!}
                                                            {!! Form::button('<i class="fa fa-trash"></i>', [
                                                                'type' => 'submit',
                                                                'class' => 'btn btn-danger btn-sm',
                                                                'title' => 'supprimer',
                                                            ]) !!}
                                                            {!! Form::close() !!}
                                                        </td>
                                                    @endcan
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
            $('#table-ageroutebeneficiaires').DataTable({
                "lengthMenu": [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "Tout"]
                ],
                "order": [
                    [2, 'asc']
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
