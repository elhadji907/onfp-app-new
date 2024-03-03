@extends('layout.default')
@section('title', 'Faire un classement')
@section('content')
    <div class="content mb-5">
        <div class="container col-6 col-md-6 col-lg-4 col-xl-8">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @elseif (session('messages'))
                    <div class="alert alert-danger">
                        {{ session('messages') }}
                    </div>
                @endif
                <div class="card border-success">
                    <div class="card card-header text-center bg-gradient-default border-success">
                       {{--   <h1 class="h4 card-title text-center text-black h-100 text-uppercase mb-0"><b></b><span
                                class="font-italic">Faire un classement</span></h1>  --}}
                                <span>{!! ucwords(strtolower($individuelle->demandeur->user->firstname)) !!} {!! strtoupper(preg_replace('#&[^;]+;#', '', preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', htmlentities($individuelle->demandeur->user->name, ENT_NOQUOTES, 'utf-8'))))) !!}</span>
                    </div>
                    <div class="card-body">
                        NB : Les champs(<span class="text-danger">*</span>)sont obligatoires
                        <hr class="sidebar-divider my-0"><br>
                        {!! Form::open(['url' => 'agerouteindividuellesrang/' . $individuelle->id, 'method' => 'PATCH', 'files' => true]) !!}
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                <label for="rang"><b>{{ __('Rang : ') }}</b></label>(<span class="text-danger">*</span>)
                                {!! Form::number('rang', $individuelle->items1 ?? '', ['placeholder' => 'rang', 'class' => 'form-control', 'min' => '1']) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    @if ($errors->has('rang'))
                                        @foreach ($errors->get('rang') as $message)
                                            <p class="text-danger">{{ $message }}</p>
                                        @endforeach
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-outline-primary"><i
                                    class="far fa-paper-plane"></i>&nbsp;Classer</button>
                        </div>
                    </div>
                </div>
                <br />
                <input type="hidden" name="password" class="form-control" id="exampleInputPassword1"
                    placeholder="Mot de passe">
                {!! Form::hidden('username', $individuelle->demandeur->user->username, ['placeholder' => '', 'class' => 'form-control']) !!}
                {!! Form::hidden('numero', $individuelle->demandeur->numero, ['placeholder' => '', 'class' => 'form-control']) !!}
                {!! Form::hidden('password', null, ['placeholder' => 'Votre mot de passe', 'class' => 'form-control']) !!}
                {!! Form::close() !!}
                <div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Verifier les donn&eacute;es
                                    saisies svp</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if ($errors->any())
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger mt-2">
                                            <strong>Oups!</strong> Il y a eu quelques problèmes avec vos
                                            entrées.
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @push('scripts')
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $("#error-modal").modal({
                                                    'show': true,
                                                })
                                            });
                                        </script>
                                    @endpush
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
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
        $('input[type=checkbox]').on('change', function(e) {
            if ($('input[type=checkbox]:checked').length > 7) {
                $(this).prop('checked', false);
                alert("autorisé seulement 3");
            }
        });
    </script>
@endpush
{{-- @section('javascripts')
    <script type="text/javascript">
        $('#moduleup').select2().val({!! json_encode($individuelle->modules()->allRelatedIds()) !!}).trigger('change');
    </script>
@endsection --}}
