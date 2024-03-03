@extends('layout.default')
@section('title', 'ONFP - Fiche opérateur')
@section('content')

    <style>
        .invoice-box {
            max-width: 1500px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: left;
        }

        .invoice-box table tr td:nth-child(3) {
            text-align: left;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            imputation: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>

    <div class="invoice-box justify-content-center">
        <div class="card">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a class="btn btn-outline-success btn-sm" href="{{ route('operateurs.index') }}"><i
                            class="fas fa-undo-alt"></i>Retour</a></li>
                <li class="breadcrumb-item active">Détails opérateur</li>
            </ul>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mt-0">

                    {{--  @can('update', $recue->courrier)  --}}
                    <a href="{!! url('operateurs/' . $operateur->id . '/edit') !!}" title="modifier" class="btn btn-outline-warning btn-sm">
                        <i class="far fa-edit">&nbsp;Modifier</i>
                    </a>
                    {{--  @endcan  --}}

                    {{--  @can('delete', $operateur)  --}}
                    {!! Form::open([
                        'method' => 'DELETE',
                        'url' => 'operateurs/' . $operateur->id,
                        'id' => 'deleteForm',
                        'onsubmit' => 'return ConfirmDelete()',
                    ]) !!}
                    {!! Form::button('<i class="fa fa-times" aria-hidden="true">&nbsp;Supprimer</i>', [
                        'type' => 'submit',
                        'class' => 'btn btn-outline-danger btn-sm',
                        'title' => 'supprimer',
                    ]) !!}
                    {!! Form::close() !!}
                    {{--  @endcan  --}}

                </div>
                <table method="POST" cellpadding="0" cellspacing="0">
                    <tr class="top">
                        <td colspan="2">
                            <table>
                                <tr>
                                    <td>
                                        {{-- <img src="" style="width:100%; max-width:300px;"> --}}
                                        {{--  <img style="width:50%; max-width:100px;"
                                            src="{{ asset('images/image_onfp.jpg') }}">  --}}
                                        <b>Numéro</b> : {!! $operateur->numero_agrement !!}<br>
                                        <b>Opérateur</b> : {!! $operateur->name !!} ({!! $operateur->sigle !!})<br>
                                        <b>Adresse E-mail</b> : {!! $operateur->email1 !!}<br>
                                        <b>Téléphone </b> : {!! $operateur->fixe !!} <b>/</b> {!! $operateur->telephone1 !!}<br>
                                        <b>Adresse </b> : {!! $operateur->adresse !!}<br>
                                    </td>
                                </tr>

                                <tr class="heading">
                                    <td>
                                        {{ __('Régions') }}
                                    </td>
                                    <td>
                                        {{ __('Modules') }}
                                    </td>
                                    <td>
                                        {{ __('Formations') }}
                                    </td>
                                </tr>

                                <tr class="details">
                                    <td>
                                        @if ($operateur->regions != '[]')
                                            <?php $i = 1; ?>
                                            @foreach ($operateur->regions->unique('id') as $region)
                                                <div> {{ $i }}{{ '.' }} {!! $region->nom ?? '' !!}</div>
                                                <?php $i++; ?>
                                            @endforeach
                                        @else
                                            <span class="badge badge-danger">Aucune région</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($operateur->modules != '[]')
                                            <?php $i = 1; ?>
                                            @foreach ($operateur->modules->unique('id') as $module)
                                                <div> {{ $i }}{{ '.' }} {!! $module->name ?? '' !!}</div>
                                                <?php $i++; ?>
                                            @endforeach
                                        @else
                                            <span class="badge badge-danger">Aucun module</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($operateur->formations != '[]')
                                            <?php $i = 1; ?>
                                            @foreach ($operateur->formations->unique('id') as $formation)
                                                <div> {{ $i }}{{ '.' }} {!! $formation->beneficiaires ?? '' !!}</div>
                                                <?php $i++; ?>
                                            @endforeach
                                        @else
                                            <span class="badge badge-danger">Aucune formation</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    {{--  @endforeach  --}}
@endsection
