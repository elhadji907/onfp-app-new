@extends('layout.default')
@section('title', 'ONFP - Fiche Couriers departs')

@section('extra-js')
    <script>
        function toggleReplayComment(id)
        {
            let element = document.getElementById('replayComment-' +id);
            element.classList.toggle('d-none');
        }
    </script>
@endsection

@section('content')
        <div class="container">
            <div class="container-fluid">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif                
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a class="btn btn-outline-success btn-sm"
                                href="{{ route('departs.index') }}"><i class="fas fa-undo-alt"></i>Retour</a></li>
                        <li class="breadcrumb-item active">Commentaires courriers départs</li>
                    </ul>
                </div>
                <div class="card">
                    @foreach ($departs as $depart)  
                    <div class="card-body">
                        <h3 class="card-title">{!! $depart->courrier->types_courrier->name !!}</h5>
                        <h5 class="card-category">{!! $depart->courrier->objet !!}</h5>
                        <p>{{ $depart->courrier->message }}</p>

                        <div class="d-flex justify-content-between align-items-center">
                            <small>Posté le {!! Carbon\Carbon::parse($depart->courrier->created_at)->format('d/m/Y à H:i:s') !!}</small>
                            <span class="badge badge-primary">{!! $depart->courrier->user->firstname !!}&nbsp;{!! $depart->courrier->user->name !!}</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            @can('update', $depart->courrier)     
                            <a href="{!! url('departs/' .$depart->id. '/edit') !!}" title="modifier" class="btn btn-outline-warning">
                                <i class="far fa-edit">&nbsp;Modifier</i>
                            </a>
                            @endcan 
                            <a href="{!! url('courriers/' .$depart->courrier->id. '/edit') !!}" title="voir les d&eacute;tails du courrier" class="btn btn-outline-primary">
                                <i class="far fa-eye">&nbsp;D&eacute;tails</i>
                            </a>
                            {{--  <a href="{!! url('courriers/' .$depart->courrier->id. '/edit') !!}" title="supprimer" class="btn btn-outline-danger">
                                <i class="far fa-edit">&nbsp;Supprimer</i>
                            </a>  --}}
                            @can('delete', $depart->courrier)     
                            {!! Form::open(['method'=>'DELETE', 'url'=>'departs/' .$depart->id, 'id'=>'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                            {!! Form::button('<i class="fa fa-trash">&nbsp;Supprimer</i>', ['type' => 'submit', 'class' => 'btn btn-outline-danger', 'title'=>"supprimer"] ) !!}
                            {!! Form::close() !!}
                            @endcan 
                        </div>
                    </div>                    
                    @endforeach
                </div>

                <hr>

                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Commentaires</h5>
                            @forelse ($depart->courrier->comments as $comment)
                            <div class="card mt-2">
                                <div class="card-body">
                                    {!! $comment->content !!}
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <small>Posté le {!! Carbon\Carbon::parse($comment->created_at)->format('d/m/Y à H:i:s') !!}</small>
                                        <span class="badge badge-primary">{!! $comment->user->firstname !!}&nbsp;{!! $comment->user->name !!}</span>
                                    </div>
                                </div>
                            </div>
                            {{--  Réponse aux commentaires  --}}
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
                            {{--  fin réponse aux commentaires  --}}
                            @empty

                            <div class="alert alert-info">Aucun commentaire pour ce courrier</div>
                                
                            @endforelse
                            <form method="POST" action="{{ route('comments.store', $depart->courrier) }}" class="mt-3">
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
                </div>
            </div>
        </div>
@endsection