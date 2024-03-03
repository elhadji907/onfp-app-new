@extends('layout.default')
@section('title', 'ONFP - Ajouter modules')
@section('content')
    <div class="content mb-5">
        <div class="container col-8 col-md-8 col-lg-8 col-xl-8">
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
                <div class="row pb-2">
                    <div class="col-sm-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a class="btn btn-outline-success btn-sm"
                                    href="{{ route('operateurs.index') }}"><i class="fas fa-undo-alt"></i>Retour</a></li>
                            <li class="breadcrumb-item active">Ajouter modules</li>
                        </ul>
                    </div>
                    <div class="col-sm-12 col-md-12 pt-2">
                        <span class="card-category"><b>N° agrément </b>: {!! $operateur->numero_agrement ?? '' !!}</span><br />
                        <span class="card-category"><b>Opérateur </b>: {!! $operateur->name !!}</span> <br />
                        <span class="card-category"><b>Sigle </b>: {!! $operateur->sigle !!}</span><br />                        
                        <span class="card-category"><b>Modules </b>: </span>
                        @if ($operateur->modules != '[]')
                                @foreach ($operateur->modules->unique('id') as $key => $module)
                                    @if ($loop->last)
                                        <div class="badge badge-info">{!! $loop->count !!}</div>
                                    @endif
                                @endforeach
                            
                            <?php $i = 1; ?>
                            @foreach ($operateur->modules->unique('id') as $module)
                                <div> {{ $i }}{{ '.' }} {!! $module->name ?? '' !!}</div>
                                <?php $i++; ?>
                            @endforeach
                        @else
                            <span class="badge badge-danger">Aucun module</span>
                        @endif
                        <br /><br />
                        <div class="card">
                            <div class="card-body custom-edit-service">
                                @csrf
                                <div class="row form-row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="">Module</label>
                                            <input type="text" placeholder="Module"
                                                class="form-control form-control-sm @error('product') is-invalid @enderror"
                                                name="product" id="product" value="">
                                            <div class="col-lg-6" id="productList">
                                            </div>
                                            @error('product')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Domaine</label>
                                            <input type="text" placeholder="Domaine"
                                                class="form-control form-control-sm @error('domaine') is-invalid @enderror"
                                                name="domaine" id="domaine" value="">
                                            @error('domaine')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <input type="hidden" placeholder="ID"
                                        class="form-control form-control-sm @error('id_module') is-invalid @enderror"
                                        name="id_module" id="id_module" value="0.0" min="0">
                                    <input type="hidden" placeholder="imp"
                                        class="form-control form-control-sm @error('imp') is-invalid @enderror"
                                        name="imp" id="imp" value="1">

                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button id="addMore" class="btn btn-success btn-sm"><i class="fa fa-plus"
                                                aria-hidden="true"></i>&nbsp;Ajouter</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{--  @if ($operateur->courrier->directions != '[]')  --}}
                    {{--    <div class="col-xs-12 col-sm-12 col-md-12 text-center p-4">
                    <small style="text-align: center; vertical-align: middle;">
                        <a
                        href="{!! url('recufactures', ['$id' => $operateur->id]) !!}" class='btn btn-primary btn-sm'
                        title="télécharger le coupon" target="_blank">
                        <i class="fa fa-print" aria-hidden="true"></i>&nbsp;Télécharger coupon
                    </a>
                    </small>
                    </div>  --}}
                    {{--  @endif  --}}
                    <div class="col-lg-12">
                        {{--  <form method="POST" action="{{ route('sales.store') }}">  --}}
                        {!! Form::open(['url' => 'operateurs/' . $operateur->id, 'method' => 'PATCH', 'files' => true]) !!}
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered" style="display: none;">
                                <thead>
                                    <tr>
                                        <th style="width: 50%">Module</th>
                                        <th>Domaine</th>
                                        <th style="width: 5%"></th>
                                    </tr>
                                </thead>
                                <tbody id="addRow" class="addRow">
                                </tbody>
                                {{--  <tbody>
                                    <tr>
                                        <td colspan="1" class="">
                                            <strong>{!! Form::label('Actions attendues') !!}</strong>
                                            {!! Form::select(
                                                'description',
                                                [
                                                    'Urgent' => 'Urgent',
                                                    'M\'en parler' => 'M\'en parler',
                                                    'Etudes et Avis' => 'Etudes et Avis',
                                                    'Répondre' => 'Répondre',
                                                    'Suivi' => 'Suivi',
                                                    'Information' => 'Information',
                                                    'Diffusion' => 'Diffusion',
                                                    'Attribution' => 'Attribution',
                                                    'Classement' => 'Classement',
                                                ],
                                                $operateur->courrier->description,
                                                [
                                                    'placeholder' => 'Instructions du DG',
                                                    'class' => 'form-control form-control-sm',
                                                    'id' => 'description',
                                                ],
                                            ) !!}

                                            <small id="emailHelp" class="form-text text-muted">
                                                @if ($errors->has('description'))
                                                    @foreach ($errors->get('description') as $message)
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @endforeach
                                                @endif
                                            </small>
                                        </td>
                                        <td colspan="1">
                                            <strong><label for="date_imp">{{ __('Date Module') }}</label></strong>
                                            <input id="date_imp" {{ $errors->has('date_imp') ? 'is-invalid' : '' }}
                                                type="date"
                                                class="form-control form-control-sm @error('date_imp') is-invalid @enderror"
                                                name="date_imp" placeholder="Date Module" required
                                                value="{{ optional($operateur->courrier->date_imp)->format('Y-m-d') ?? old('date_imp') }}"
                                                autocomplete="date_imp">
                                            @error('date_imp')
                                                <span class="invalid-feedback" role="alert">
                                                    <div>{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                </tbody>  --}}
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            {{--  <button type="submit" class="btn btn-success btn-sm">
                                                    Imputer</button>  --}}
                                            {!! Form::submit('Enregistrer', ['class' => 'btn btn-outline-primary pull-right']) !!}
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>

                        {!! Form::close() !!}
                    </div>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
                    <script src="//code.jquery.com/jquery.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>
                    <script id="document-template" type="text/x-handlebars-template">
                    <tr class="delete_add_more_item" id="delete_add_more_item">    
                        <td>
                            <input type="hidden" name="id_module[]" value="@{{ id_module }}" required placeholder="Id direction" class="form-control form-control-sm">
                            <input type="text" name="product[]" value="@{{ product }}" required placeholder="Module" class="form-control form-control-sm">                            
                            <input type="hidden" name="imp" value="@{{ imp }}">
                        </td>
                        <td>
                        <input type="text" class="domaine form-control form-control-sm" name="domaine[]" value="@{{ domaine }}" required min="1" placeholder="Domaine">
                      </td>
                        <td>
                        <i class="removeaddmore" style="cursor:pointer;color:red;" title="supprimer"><i class="fas fa-trash"></i></i>
                        </td>    
                    </tr>
                    </script>
                    <script type="text/javascript">
                        $(document).on('click', '#addMore', function() {
                            $('.table').show();
                            var product = $("#product").val();
                            var id_module = $("#id_module").val();
                            var domaine = $("#domaine").val();
                            var imp = $("#imp").val();
                            var source = $("#document-template").html();
                            var template = Handlebars.compile(source);
                            var data = {
                                product: product,
                                id_module: id_module,
                                domaine: domaine,
                                imp: imp,
                            }
                            var html = template(data);
                            $("#addRow").append(html)
                            total_ammount_price();
                        });
                        $(document).on('click', '.removeaddmore', function(event) {
                            $(this).closest('.delete_add_more_item').remove();
                            total_ammount_price();
                        });

                        $('#product').keyup(function() {
                            var query = $(this).val();
                            if (query != '') {
                                var _token = $('input[name="_token"]').val();
                                $.ajax({
                                    url: "{{ route('moduleoperateur.fetche') }}",
                                    method: "POST",
                                    data: {
                                        query: query,
                                        _token: _token
                                    },
                                    success: function(data) {
                                        $('#productList').fadeIn();
                                        $('#productList').html(data);
                                    }
                                });
                            }
                        });
                        $(document).on('click', 'li', function() {
                            $('#product').val($(this).text());
                            $('#id_module').val($(this).data("id"));
                            $('#domaine').val($(this).data("domaine"));
                            $('#productList').fadeOut();
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
