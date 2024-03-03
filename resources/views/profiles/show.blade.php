@extends('layout.default')
@section('extra-js')
    <script>
        function toggleReplayComment(id) {
            let element = document.getElementById('replayComment-' + id);
            element.classList.toggle('d-none');
        }
    </script>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center mt-4">
            @can('update', $user->profile)
                <div class="col-4 text-center">
                    <img src="{{ asset(Auth::user()->profile->getImage()) }}" class="rounded-circle w-50" />
                </div>
                <div class="col-4">
                    <div class="mt-3 d-flex">
                        <div class="mr-1"><b>{{ auth::user()->civilite }}</b></div>
                        <div class="mr-1"><b>{{ auth::user()->firstname }}</b></div>
                        <div class="mr-1"><b>{{ auth::user()->name }}</b></div>
                    </div>
                    @if (auth::user()->date_naissance !== null)
                        <div class="mt-0 d-flex">
                            @if (auth::user()->civilite == 'M.')
                                <div class="mr-1"><b>né le</b></div>
                            @endif
                            @if (auth::user()->civilite == 'Mme')
                                <div class="mr-1"><b>née le</b></div>
                            @endif
                            <div class="mr-1">{{ auth::user()->date_naissance->format('d/m/Y') }}</div>
                            @if (auth::user()->lieu_naissance !== null)
                                <div class="mr-1">à</div>
                                <div class="mr-1">{{ auth::user()->lieu_naissance }}</div>
                            @endif
                        </div>
                    @endif
                    <div class="mt-0">
                        <div class="mr-3"><b>{{ __("Nom d'utilisateur") }}:</b> {{ auth::user()->username }}</div>
                        <div class="mr-3"><b>E-mail:</b> {{ auth::user()->email }}</div>
                        <div class="mr-3"><b>Téléphone:</b> {{ auth::user()->telephone }}</div>
                    </div>
                    @if (auth::user()->civilite == null or auth::user()->fixe == null)
                        <a href="{{ route('profiles.edit', [auth::user()->username]) }}"
                            class="btn btn-outline-danger mt-3">Compléter votre profil</a>
                    @else
                        <a href="{{ route('profiles.edit', [auth::user()->username]) }}"
                            class="btn btn-outline-secondary mt-3">Modifier mon profil</a>
                    @endif
                </div>
            @endcan
        </div>
        <div class="list-group mt-5">
            @if (isset(auth::user()->employee->courriers) && auth::user()->employee->courriers != '[]')
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-courriers-emp">
                        <thead class="table-default">
                            <tr>
                                <th style="width:60%;">Imputations</th>
                                <th style="width:20%;">Instructions</th>
                                <th style="width:20%;">Suivi dossier</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (auth::user()->employee->courriers as $courrier)
                                <tr>
                                    <td>
                                        <h4><a href="{!! route('courriers.show', $courrier->id) !!}">{!! $courrier->objet ?? '' !!}</a></h4>
                                        <p>{!! $courrier->message !!}</p>
                                        <p><strong>Type de courrier : </strong> {!! $courrier->types_courrier->name ?? '' !!}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small>Posté le {!! Carbon\Carbon::parse($courrier->created_at)->format('d/m/Y à H:i:s') !!}</small>
                                            <span
                                                class="badge badge-info">{!! $courrier->user->firstname !!}&nbsp;{!! $courrier->user->name !!}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <p>{!! $courrier->description ?? '' !!}</p>
                                    </td>
                                    <td>
                                        
                                        <div class="d-flex justify-content-between align-items-center">                                            
                                        @foreach ($courrier->employees->unique('id') as $employee)
                                        {{ $employee->user->firstname .' '.$employee->user->name}}<br>
                                    @endforeach
                                    <a
                                    href="{!! url('courrierimputations', ['$type' => $courrier->types_courrier->id, '$id' => $courrier->id]) !!}" class='btn btn-warning btn-sm'
                                    title="changer agent suivi">
                                    <i class="fa fa-retweet"></i>
                                </a>
                                        </div>


                                    </td>
                                    {{--  <td>
                                        @forelse ($courrier->comments as $comment)
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small>Commentaire de
                                                    {!! $comment->user->firstname !!}&nbsp;{!! $comment->user->name !!} du
                                                    {!! Carbon\Carbon::parse($comment->created_at)->format('d/m/Y à H:i:s') !!}: <br>
                                                    <ul>
                                                        <li>{!! $comment->content !!}</li>
                                                    </ul>
                                                </small>
                                            @foreach ($comment->comments as $replayComment)
                                                <div class="ml-5">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small>Réponse de
                                                            {!! $comment->user->firstname !!}&nbsp;{!! $comment->user->name !!} du
                                                            {!! Carbon\Carbon::parse($replayComment->created_at)->format('d/m/Y à H:i:s') !!} : <br>
                                                            <ul>
                                                                <li>
                                                                    {!! $replayComment->content !!}</li>
                                                            </ul>
                                                        </small>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @auth
                                            @endauth
                                        @empty

                                            <div class="alert alert-info">Aucun commentaire pour ce courrier</div>
                                        @endforelse
                                    </td>  --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info"> {{ __("Vous n'avez pas de courrier à votre nom") }} </div>
            @endif
        </div>
        {{--  <div class="d-flex justify-content-center pt-2">
            {!! $courrierss->links() !!}
        </div>  --}}
    </div>
    <div class="container-fluid col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="mt-5">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="mt-5">
            @if (session()->has('attention'))
                <div class="alert alert-danger" role="alert">
                    <strong>Oups!</strong>.<br><br>{{ session('attention') }}
                </div>
            @endif
            @if (session('message'))
                <div class="alert alert-attention">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-courriers-emp').DataTable({
                "lengthMenu": [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "Tout"]
                ],
                "order": [
                    [0, 'desc']
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
