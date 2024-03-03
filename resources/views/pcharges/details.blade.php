@extends('layout.default')
@section('title', 'ONFP - Fiche demande prise en charge')
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
            text-align: right;
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
    @foreach ($pcharges as $pcharge)
        <div class="invoice-box justify-content-center">
            <div class="row justify-content-center pb-2">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="d-flex col-lg-12 margin-tb justify-content-between align-items-center">
                    <a class="btn btn-outline-success" href="{{ route('pcharges.index') }}"> <i
                            class="fas fa-undo-alt"></i>&nbsp;Retour</a>
                    <a class="btn btn-outline-success" href="{{ url('lettre', ['$pcharges' => $pcharge->id]) }}"
                        target="_blank">
                        <i class="far fa-envelope"></i>
                        &nbsp;Lettre</a>
                    <a class="btn btn-outline-success" title="télécharger"
                        href="{{ url('contrat', ['$pcharges' => $pcharge->id]) }}" target="_blank"><i
                            class="fas fa-file-download"></i>&nbsp;Contrat</a>
                </div>
            </div>
            <div class="card  border-success">
                <div class="card card-header text-center bg-gradient-default border-success">
                    <h1 class="h4 card-title text-center text-black h-100 text-uppercase mb-0"><b></b><span
                            class="font-italic">INFORMATIONS PRISES EN CHARGE</span></h1>
                </div>
                <div class="card-body">
                    <table method="POST" cellpadding="0" cellspacing="0">
                        <tr class="top">
                            <td colspan="2">
                                <table>
                                    <tr>
                                        <td class="title">
                                            {{-- <img src="" style="width:100%; max-width:300px;"> --}}
                                            <img style="width:50%; max-width:100px;"
                                                src="{{ asset('images/image_onfp.jpg') }}">
                                        </td>
                                        <td>
                                            <b>Numéro dossier </b>#:
                                            {!! $pcharge->demandeur->numero !!}<br>
                                            <b>Date dépot </b>: {!! Carbon\Carbon::parse($pcharge->demandeur->date_depot)->format('d/m/Y') !!}<br>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="information">
                            <td colspan="2">
                                <table>
                                    <tr>
                                        <td>
                                            <h3>{{ __('INFORMATIONS PERSONNELLES') }}</h3>
                                            <b>CIN:</b> {{ $pcharge->cin ?? '' }}<br>
                                            <b>Prénom:</b> {{ $pcharge->demandeur->user->firstname }}&nbsp;&nbsp;
                                            <b>Nom :</b>{{ $pcharge->demandeur->user->name }}<br>
                                            <b>Date et lieu de naissance:</b>
                                            {{ $pcharge->demandeur->user->date_naissance->format('d/m/Y') }}&nbsp;à&nbsp;
                                            {{ $pcharge->demandeur->user->lieu_naissance }}<br>
                                            <b>E-mail:</b> <span
                                                style="color: blue">{{ $pcharge->demandeur->user->email }}</span>&nbsp;&nbsp;
                                            <b>Tel:</b> {{ $pcharge->demandeur->user->telephone }}&nbsp;&nbsp;
                                            <b>Fixe:</b> {{ $pcharge->demandeur->user->fixe }}<br>
                                            <b>Fax:</b> {{ $pcharge->demandeur->user->fax }}&nbsp;&nbsp;
                                            <b>BP:</b> {{ $pcharge->demandeur->user->bp }}<br>
                                            <b>Adresse:</b> {{ $pcharge->demandeur->user->adresse }}<br>
                                        </td>

                                        <td>
                                            {{-- <h3>{{ __('GESTIONNAIRE') }}</h3>
                                <b>Nom:</b> {{ $pcharge->demandeur->user->firstname }}&nbsp;&nbsp;{{ $pcharge->demandeur->user->name }}<br>
                                <b>Tel:</b> {{ $pcharge->demandeur->user->telephone }} --}}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="heading">
                            <td>
                                SCOLARITÉ
                            </td>
                            <td>
                                STATUT
                            </td>

                        </tr>

                        <tr class="item">
                            <td>
                                {{ $pcharge->scolarite->annee }}
                            </td>
                            <td>
                                <label class="badge badge-info">{{ $pcharge->statut }}</label>
                            </td>
                        </tr>
                        <tr class="heading">
                            <td>
                                {{ __('ÉTABLISSEMENT') }}
                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr class="details">
                            <td>
                                {{ $pcharge->etablissement->name }}
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr class="heading">
                            <td>
                                {{ __('FILIERE') }}
                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr class="details">
                            <td>
                                {{ $pcharge->filiere->name }}
                            </td>
                            <td>

                            </td>
                        </tr>

                        <tr class="heading">
                            <td>Montant</td>

                            <td>Prix</td>
                        </tr>

                        <tr class="item">
                            <td>Inscription</td>

                            <td>{!! number_format($pcharge->inscription, 0, ',', ' ') . ' ' . 'F CFA' !!}</td>
                        </tr>
                        <tr class="item">
                            <td>{{ __('Montant global') }}</td>

                            <td>{!! number_format($pcharge->montant, 0, ',', ' ') . ' ' . 'F CFA' !!}</td>
                        </tr>

                        <tr class="total">
                            <td></td>

                            <td>Total: {!! number_format($pcharge->avis_dg, 0, ',', ' ') . ' ' . 'F CFA' !!}</td>
                        </tr>

                    </table>

                    <div class="d-flex justify-content-between align-items-center mt-5">
                        <a href="{!! url('pcharges/' . $pcharge->id . '/edit') !!}" title="modifier" class="btn btn-outline-warning mt-0">
                            <i class="far fa-edit">&nbsp;Modifier</i>
                        </a>
                        <div class="d-flex justify-content-between align-items-center">
                            @if (isset($pcharge->statut) && $pcharge->statut == 'Accordée')
                                <label class="badge badge-info">{!! $pcharge->statut ?? '' !!}</label>&nbsp;
                                <a href="{{ url('termine', ['$pcharge' => $pcharge, '$statut' => 'Terminée']) }}"
                                    title="terminer" class="btn btn-outline-success btn-sm mt-0">
                                    <i class="fas fa-check-double"></i>
                                </a>&nbsp;
                                <a href="{{ url('nonaccord', ['$pcharge' => $pcharge, '$statut' => 'Non accordée']) }}"
                                    title="Non accordée" class="btn btn-outline-danger btn-sm mt-0">
                                    <i class="fas fa-times"></i>
                                </a>
                            @elseif (isset($pcharge->statut) && $pcharge->statut == 'Non accordée')
                                <label class="badge badge-danger">{!! $pcharge->statut ?? '' !!}</label>&nbsp;
                                <a href="{{ url('accord', ['$pcharge' => $pcharge, '$statut' => 'Accordée', '$avis_dg' => $pcharge->montant]) }}"
                                    title="Accordée" class="btn btn-outline-primary btn-sm mt-0">
                                    <i class="fas fa-check-circle"></i>
                                </a>&nbsp;
                                <a href="{{ url('nonaccord', ['$pcharge' => $pcharge, '$statut' => 'Attente']) }}"
                                    title="Annuler" class="btn btn-outline-danger btn-sm mt-0">
                                    <i class="fas fa-times"></i>
                                </a>
                            @elseif (isset($pcharge->statut) && $pcharge->statut == 'Terminée')
                                <label class="badge badge-success">{!! $pcharge->statut ?? '' !!}</label>&nbsp;
                                <a href="{{ url('accord', ['$pcharge' => $pcharge, '$statut' => 'Accordée', '$avis_dg' => $pcharge->montant]) }}"
                                    title="Accordée" class="btn btn-outline-primary btn-sm mt-0">
                                    <i class="fas fa-check-circle"></i>
                                </a>&nbsp;
                                <a href="{{ url('nonaccord', ['$pcharge' => $pcharge, '$statut' => 'Non accordée']) }}"
                                    title="Non accordée" class="btn btn-outline-danger btn-sm mt-0">
                                    <i class="fas fa-times"></i>
                                </a>
                            @else
                                <label class="badge badge-warning">{!! $pcharge->statut ?? '' !!}</label>
                                <a href="{{ url('accord', ['$pcharge' => $pcharge, '$statut' => 'Accordée', '$avis_dg' => $pcharge->montant]) }}"
                                    title="Accordée" class="btn btn-outline-primary btn-sm mt-0">
                                    <i class="fas fa-check-circle"></i>
                                </a>&nbsp;
                                <a href="{{ url('nonaccord', ['$pcharge' => $pcharge, '$statut' => 'Non accordée']) }}"
                                    title="Non accordée" class="btn btn-outline-danger btn-sm mt-0">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                        <a href="{!! route('pcharges.show', $pcharge->id) !!}" title="modifier" class="btn btn-outline-primary mt-0">
                            <i class="far fa-eye">&nbsp;M&eacute;ssage</i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endsection
