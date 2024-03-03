@extends('layout.default')
@section('title', 'ONFP - détails demandeurs')
@section('content')
    <div class="content">
        <div class="container col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="container-fluid">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                <div class="row justify-content-center pb-2">
                    <div class="col-lg-12 margin-tb">
                        <a class="btn btn-outline-success" href="{{ route('demandeurs.index') }}"> <i
                                class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
                    </div>
                </div>
                <div class="card border-success">
                    <div class="card card-header text-center bg-gradient-default border-success">
                        <h3 class="card-title">INFORMATIONS</h3>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="row justify-content-center mt-5">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="card border-success">
                                        <div class="card-header border-success">
                                            <i class="fas fa-table"></i>
                                            Liste demandes individuelles
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                @foreach ($demandeur->individuelles as $individuelle)
                                                @endforeach
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <button type="button" class="btn btn-outline-primary"
                                                        data-toggle="modal" data-target="#individuelles">
                                                        <i class="far fa-eye"></i>
                                                    </button>
                                                    @if (isset($individuelle))
                                                        <a href="{{ route('individuelles.create') }}">
                                                            <div class="btn btn-success  btn-sm"><i
                                                                    class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                                            </div>
                                                        </a>
                                                    @elseif (isset($individuelle->cin))
                                                        <a href="{!! url('individuelles/' . $individuelle->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                            title="modifier">
                                                            <i class="fas fa-plus">Ajouter</i>
                                                        </a>
                                                    @else
                                                    <a href="{{ route('individuelles.create') }}">
                                                        <div class="btn btn-success  btn-sm"><i
                                                                class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                                        </div>
                                                    </a>
                                                    @endif
                                                </div>
                                                <br />
                                                @if (isset($individuelle))
                                                    <table class="table table-bordered table-striped" width="100%"
                                                        cellspacing="0" id="table-individuelles">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <th style="width:15%;">N°</th>
                                                                <th style="width:30%;">Module</th>
                                                                <th>Région</th>
                                                                <th>Statut</th>
                                                                <th style="width:15%;"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i = 1; ?>
                                                            <tr>
                                                                <td>{{ $individuelle->demandeur->numero ?? '' }}</td>
                                                                <td>
                                                                    @foreach ($individuelle->modules as $module)
                                                                        {!! $module->name ?? '' !!}
                                                                    @endforeach
                                                                </td>
                                                                <td>{!! $individuelle->commune->arrondissement->departement->region->nom ?? '' !!}</td>
                                                                <td>
                                                                    <span>
                                                                        @if (isset($individuelle->modules) && $individuelle->modules != '[]')
                                                                            @foreach ($individuelle->modules as $module)
                                                                                @if (isset($module->name))
                                                                                    <h5>
                                                                                        @if ($individuelle->statut != 'Attente')
                                                                                            <label
                                                                                                class="badge badge-success">{{ $individuelle->statut }}</label>
                                                                                        @else
                                                                                            <label
                                                                                                class="badge badge-warning">{{ $individuelle->statut }}</label>
                                                                                        @endif
                                                                                    </h5>
                                                                                @else
                                                                                    <h5><label
                                                                                            class="badge badge-danger">Invalide</label>
                                                                                    </h5>
                                                                                @endif
                                                                            @endforeach

                                                                        @else
                                                                            <h5><label
                                                                                    class="badge badge-danger">Invalide</label>
                                                                            </h5>

                                                                        @endif
                                                                    </span>
                                                                </td>
                                                                <td class="d-flex align-items-baseline text-center-row">
                                                                    <a href="{!! url('individuelles/' . $individuelle->id . '/edit') !!}"
                                                                        class='btn btn-success btn-sm' title="modifier">
                                                                        <i class="far fa-edit">&nbsp;</i>
                                                                    </a>
                                                                    &nbsp;
                                                                    <a href="{{ url('indetails', ['$id' => $individuelle->id]) }}"
                                                                        class='btn btn-primary btn-sm' title="voir">
                                                                        <i class="far fa-eye">&nbsp;</i>
                                                                    </a>
                                                                    {{-- &nbsp;
                                                                    {!! Form::open(['method' => 'DELETE', 'url' => 'individuelles/' . $individuelle->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'supprimer']) !!}
                                                                    {!! Form::close() !!} --}}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                @else

                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="card border-success">
                                        <div class="card-header border-success">
                                            <i class="fas fa-table"></i>
                                            Liste demandes collectives
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                @foreach ($demandeur->collectives as $collective)
                                                @endforeach
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <button type="button" class="btn btn-outline-success"
                                                        data-toggle="modal" data-target="#collectives">
                                                        <i class="far fa-eye"></i>
                                                    </button>
                                                    @if (isset($collective))
                                                        <a href="{{ route('collectives.create') }}">
                                                            <div class="btn btn-success  btn-sm"><i
                                                                    class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                                            </div>
                                                        </a>
                                                    @elseif (isset($collective->cin))
                                                        <a href="{!! url('collectives/' . $collective->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                            title="modifier">
                                                            <i class="fas fa-plus">Ajouter</i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('collectives.create') }}">
                                                            <div class="btn btn-success  btn-sm"><i
                                                                    class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                                            </div>
                                                        </a>
                                                    @endif
                                                </div>
                                                <br />
                                                @if (isset($collective->name))
                                                    <table class="table table-bordered table-striped" width="100%"
                                                        cellspacing="0" id="table-collectives">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <th style="width:15%;">N°</th>
                                                                <th style="width:30%;">Module</th>
                                                                <th>Région</th>
                                                                <th>Statut</th>
                                                                <th style="width:15%;"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i = 1; ?>

                                                            <tr>
                                                                <td>{{ $collective->demandeur->numero ?? '' }}</td>
                                                                <td>
                                                                    @foreach ($collective->modules as $module)
                                                                        {!! $module->name ?? '' !!}
                                                                    @endforeach
                                                                </td>
                                                                <td>{!! $collective->commune->arrondissement->departement->region->nom ?? '' !!}</td>
                                                                <td>
                                                                    <span>
                                                                        @if (isset($collective->modules) && $collective->modules != '[]')
                                                                            @foreach ($collective->modules as $module)
                                                                                @if (isset($module->name))
                                                                                    <h5>
                                                                                        @if ($collective->statut != 'Attente')
                                                                                            <label
                                                                                                class="badge badge-success">{{ $collective->statut }}</label>
                                                                                        @else
                                                                                            <label
                                                                                                class="badge badge-warning">{{ $collective->statut }}</label>
                                                                                        @endif
                                                                                    </h5>
                                                                                @else
                                                                                    <h5><label
                                                                                            class="badge badge-danger">Invalide</label>
                                                                                    </h5>
                                                                                @endif
                                                                            @endforeach

                                                                        @else
                                                                            <h5><label
                                                                                    class="badge badge-danger">Invalide</label>
                                                                            </h5>

                                                                        @endif
                                                                    </span>
                                                                </td>
                                                                <td class="d-flex align-items-baseline text-center-row">
                                                                    <a href="{!! url('collectives/' . $collective->id . '/edit') !!}"
                                                                        class='btn btn-success btn-sm' title="modifier">
                                                                        <i class="far fa-edit">&nbsp;</i>
                                                                    </a>
                                                                    &nbsp;
                                                                    <a href="{{ url('coldetails', ['$id' => $collective->id]) }}"
                                                                        class='btn btn-primary btn-sm' title="voir">
                                                                        <i class="far fa-eye">&nbsp;</i>
                                                                    </a>
                                                                    {{-- &nbsp;
                                                                    {!! Form::open(['method' => 'DELETE', 'url' => 'collectives/' . $collective->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'supprimer']) !!}
                                                                    {!! Form::close() !!} --}}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                @else
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-2">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="card border-success">
                                        <div class="card-header border-success">
                                            <i class="fas fa-table"></i>
                                            Liste demandes prises en charges
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                @foreach ($demandeur->pcharges as $pcharge)
                                                @endforeach
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <button type="button" class="btn btn-outline-info" data-toggle="modal"
                                                        data-target="#pcharges">
                                                        <i class="far fa-eye"></i>
                                                    </button>
                                                    @if (isset($pcharge))
                                                    <a href="{{ route('pcharges.selectetablissements') }}">
                                                        <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                                        </div>
                                                    </a>
                                                    @elseif(isset($pcharge->scolarite))
                                                        <a href="{!! url('pcharges/' . $pcharge->id . '/edit') !!}" class='btn btn-success btn-sm'
                                                            title="modifier">
                                                            <i class="fas fa-plus">Ajouter</i>
                                                        </a>
                                                    @else
                                                    <a href="{{ route('pcharges.selectetablissements') }}">
                                                        <div class="btn btn-success  btn-sm"><i class="fas fa-plus"></i>&nbsp;Ajouter</i>
                                                        </div>
                                                    </a>
                                                    @endif
                                                </div>
                                                <br />
                                                @if (isset($pcharge))
                                                    <table class="table table-bordered table-striped" width="100%"
                                                        cellspacing="0" id="table-pcharges">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <th style="width:7%;">N°</th>
                                                                <th style="width:7%;">Scolarité</th>
                                                                <th style="width:30%;">Etablissement</th>
                                                                <th style="width:15%;">Filière</th>
                                                                <th style="width:8%;">Région</th>
                                                                <th style="width:7%;">Statut</th>
                                                                <th style="width:7%;"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i = 1; ?>
                                                                <tr>
                                                                    <td>{{ $pcharge->demandeur->numero ?? '' }}</td>
                                                                    <td>{{ $pcharge->scolarite->annee ?? '' }}</td>
                                                                    <td>{{ $pcharge->etablissement->name ?? '' }}</td>
                                                                    <td>{{ $pcharge->filiere->name ?? '' }}</td>
                                                                    <td>{!! $pcharge->commune->arrondissement->departement->region->nom ?? '' !!}</td>
                                                                    <td>
                                                                        @if (isset($pcharge->filiere->name))
                                                                            <h5>
                                                                                @if ($pcharge->statut == 'Attente')
                                                                                    <label
                                                                                        class="badge badge-warning">{{ $pcharge->statut }}</label>
                                                                                @else
                                                                                    <label
                                                                                        class="badge badge-success">{{ $pcharge->statut }}</label>
                                                                                @endif
                                                                            </h5>
                                                                        @else
                                                                            <h5><label
                                                                                    class="badge badge-danger">Invalide</label>
                                                                            </h5>
                                                                        @endif
                                                                    </td>
                                                                    <td class="d-flex align-items-baseline text-center-row">
                                                                        <a href="{!! url('pcharges/' . $pcharge->id . '/edit') !!}"
                                                                            class='btn btn-success btn-sm' title="modifier">
                                                                            <i class="far fa-edit"></i>
                                                                        </a>
                                                                        &nbsp;
                                                                        <a href="{{ url('pdetails', ['$id' => $pcharge->demandeur->id, '$pchareg' => $pcharge->id]) }}"
                                                                            class='btn btn-primary btn-sm' title="voir">
                                                                            <i class="far fa-eye"></i>
                                                                            {{-- &nbsp;
                                                                    {!! Form::open(['method' => 'DELETE', 'url' => 'pcharges/' . $pcharge->id, 'id' => 'deleteForm', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'supprimer']) !!}
                                                                    {!! Form::close() !!} --}}
                                                                    </td>
                                                                </tr>
                                                        </tbody>
                                                    </table>
                                                @else
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="mt-3 d-flex align-items-baseline align-middle">
                                        <a class="btn btn-outline-secondary btn-block" href="{!! url('operateurs/' . $pcharge_user->id . '/edit') !!}" target="_blank"><span
                                                data-feather="book-open"></span>Devenir opérateur</a>
                                        <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#operateurs">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
