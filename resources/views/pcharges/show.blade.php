@extends('layout.default')
@section('title', 'ONFP - Fiche demande pcharge')

{{-- @section('extra-js')
    <script>
        function toggleReplayComment(id)
        {
            let element = document.getElementById('replayComment-' +id);
            element.classList.toggle('d-none');
        }
    </script>
@endsection --}}

@section('content')
    <div class="container">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h1 class="h4 h-100 text-uppercase mb-4"><b><u>Type de demande</u> : {!! __('prise en charge') !!}
                        </b></h1>
                    <h4>
                        <b><u>N° du dossier</u></b> : <span
                            class="font-italic">{{ $pcharge->demandeur->numero ?? 'numéro de dossier introuvable' }}</span>
                    </h4><br />
                    <h4>
                        <b><u>Filière de formation </u></b>:
                        {!! $pcharge->filiere->name ?? 'aucune filière demandée' !!}</small>
                    </h4><br />
                    <h4>
                        <b><u>Scolarité </u></b>:
                        {!! $pcharge->scolarite->annee ?? '' !!}</small>
                    </h4><br />
                    <h4>
                        <b><u>Établissement </u></b>:
                        {!! $pcharge->etablissement->name ?? '' !!}</small>
                    </h4><br />
                    <h4>
                        <b><u>Localisation </u></b>:
                        Commune de {!! $pcharge->etablissement->commune->nom ?? '' !!}, dans la région de {!! $pcharge->etablissement->commune->arrondissement->departement->region->nom ?? '' !!}</small>
                    </h4><br />

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <a href="{!! url('pcharges/' . $pcharge->id . '/edit') !!}" title="modifier" class="btn btn-outline-warning">
                            <i class="far fa-edit">&nbsp;Modifier</i>
                        </a>
                        <a href="{!! url('pdetails', ['$id' => $pcharge->demandeur->id, '$pchareg' => $pcharge->id]) !!}" title="voir les d&eacute;tails du courrier"
                            class="btn btn-outline-primary">
                            <i class="far fa-eye">&nbsp;D&eacute;tails</i>
                        </a>
                        @can('user-delete')
                            {!! Form::open(['method' => 'DELETE', 'url' => 'pcharges/' . $pcharge->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                            {!! Form::button('<i class="fa fa-trash">&nbsp;Supprimer</i>', ['type' => 'submit', 'class' => 'btn btn-outline-danger', 'title' => 'supprimer']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-5">
                        <small>Déposée depuis le {!! Carbon\Carbon::parse($pcharge->demandeur->created_at)->format('d/m/Y à H:i:s') !!}</small>
                        <span class="badge badge-primary">{!! $pcharge->demandeur->user->firstname !!}&nbsp;{!! $pcharge->demandeur->user->name !!}</span>
                    </div>
                </div>
            </div>
            <hr>
            {{-- <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Commentaires</h5>
                            @forelse ($pcharge->demandeur->comments as $comment)
                            <div class="card mt-2">
                                <div class="card-body">
                                    {!! $comment->content !!}
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <small>Posté le {!! Carbon\Carbon::parse($comment->created_at)->format('d/m/Y à H:i:s') !!}</small>
                                        <span class="badge badge-primary">{!! $comment->user->firstname !!}&nbsp;{!! $comment->user->name !!}</span>
                                    </div>
                                </div>
                            </div>
                            //Réponse aux commentaires 
                            @foreach ($comment->comments as $replayComment)
                            <div class="card mt-2 ml-5">
                                <div class="card-body">
                                    {!! $replayComment->content !!}
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <small>Posté le {!! Carbon\Carbon::parse($replayComment->created_at)->format('d/m/Y à H:i:s') !!}</small>
                                        <span class="badge badge-primary">{!! $replayComment->user->firstname !!}&nbsp;{!! $replayComment->user->name !!}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            @auth
                            <button class="btn btn-info btn-sm mt-2" id="commentReplyId" onclick="toggleReplayComment({{ $comment->id }})">
                                Répondre
                            </button>
                            <form method="POST" action="{{ route('comments.storeReply', $comment) }}" class="ml-5 d-none" id="replayComment-{{ $comment->id }}">
                                @csrf
                                <div class="form-group">
                                    <label for="replayComment"><b>Ma réponse</b></label>
                                    <textarea class="form-control @error('replayComment') is-invalid @enderror"  name="replayComment" id="replayComment" rows="3" placeholder="Répondre à ce commentaire"></textarea>
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('replayComment'))
                                        @foreach ($errors->get('replayComment') as $message)
                                        <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                        @endif
                                </small>
                                </div>
                                <button class="btn btn-primary btn-sm mb-2">
                                    Répondre à ce commentaire
                                </button>
                            </form>                                
                            @endauth
                            //fin réponse aux commentaires  
                            @empty

                            <div class="alert alert-info">Aucun commentaire pour ce courrier</div>
                                
                            @endforelse
                            <form method="POST" action="{{ route('comments.store', $pcharge->demandeur->id) }}" class="mt-3">
                                @csrf                                                         
                                 <div class="form-group">
                                     <label for="commentaire"><b>Votre commentaire</b></label>                                   
                                     <textarea class="form-control @error('commentaire') is-invalid @enderror" name="commentaire" id="commentaire" rows="5" placeholder="Ecrire votre commentaire"></textarea>                                     
                                     <small id="emailHelp" class="form-text text-muted">
                                             @if ($errors->has('commentaire'))
                                             @foreach ($errors->get('commentaire') as $message)
                                             <p class="text-danger">{{ $message }}</p>
                                             @endforeach
                                             @endif
                                     </small>
                                 </div>
                                <button type="submit" class="btn btn-primary"><i class="far fa-paper-plane"></i>&nbsp;Poster</button>
                            </form>
                    </div>
                </div> --}}
        </div>
    </div>
@endsection
