@extends('layout.default')
@section('title', 'ONFP - Changement montant accordé')
@section('content')
    <div class="content">
        <div class="container col-8 col-sm-12 col-md-8 col-lg-8 col-xl-8">
            <div class="container-fluid">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                <div class="row pt-5"></div>
                <div class="card">
                    <div class="card-header card-header-primary text-center">
                        <h3 class="card-title">{{ 'Changement' }}</h3>
                        <p class="card-category">{{ 'montant accordé' }}</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('change.montant', ['$pcharge' => $pcharge]) }}">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH" />                     
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="input-name"><b>{{ __('Montant demandé') }}:</b></label>
                                    <input type="text" name="montant" class="form-control" id="input-montant"
                                        placeholder="Scolarité" value="{{ old('montant') ?? $pcharge->montant }}">
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('montant'))
                                            @foreach ($errors->get('montant') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="input-name"><b>{{ __('Montant accordé') }}:</b></label>
                                    <input type="text" name="avis_dg" class="form-control" id="input-avis_dg"
                                        placeholder="Scolarité" value="{{ old('avis_dg') ?? $pcharge->avis_dg }}">
                                    <small id="emailHelp" class="form-text text-muted">
                                        @if ($errors->has('avis_dg'))
                                            @foreach ($errors->get('avis_dg') as $message)
                                                <p class="text-danger">{{ $message }}</p>
                                            @endforeach
                                        @endif
                                    </small>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i
                                    class="far fa-paper-plane"></i>&nbsp;Modifier</button>
                        </form>
                        <div class="modal fade" id="error-modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Verifier les donn&eacute;es
                                            saisies svp</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
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
        </div>
    </div>
@endsection
