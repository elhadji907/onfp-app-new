<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>A simple, clean, and responsive HTML invoice template</title>
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
</head>

<body>
    @foreach ($pcharges as $pcharge)
        <div class="invoice-box justify-content-center">
            <div class="row justify-content-center pb-2">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <div class="card">
                <div class="card-header bg-gradient-default">

                    <img style="max-width:100%;" src="{{ asset('images/logo1.png') }}">

                    {{-- <h3 class="text-black h-100 text-uppercase mb-0"><b></b><span
                            class="font-italic">REPUBLIQUE DU SENEGAL</span></h3>
                    <small class="text-black h-100 text-uppercase mb-0"><b></b><span
                            class="font-italic">Un Peuple  - Un But – Une Foi</span></small>
                    <small class="text-black h-100 text-uppercase mb-0"><b></b><span
                            class="font-italic"><br>--------------------</span></small>
                            <h3 class="text-black h-100 text-uppercase mb-0"><b></b><span
                                class="font-italic">MINISTERE DE L’EMPLOI,<br> DE LA FORMATION
                                PROFESSIONNELLE, <br> DE L’APPRENTISSAGE ET DE L’INSERTION
                                </span></h3>
                    <small class="text-black h-100 text-uppercase mb-0"><b></b><span
                            class="font-italic">--------------------</span></small> --}}
                </div>
                <div class="card-body">
                    <table method="POST" cellpadding="0" cellspacing="0">
                        <tr class="item">
                            <td colspan="2">
                                <table>
                                    <tr>
                                        <td class="title">
                                            {{-- <img src="" style="width:100%; max-width:300px;"> --}}
                                            {{-- <img style="width:75%; max-width:100%;"
                                                src="{{ asset('images/logo1.png') }}"> --}}
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
                        <tr class="item">
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
                                            <h3>{{ __('BENEFICIAIRE') }}</h3>
                                            <b>Nom:</b>
                                            {{ $pcharge->demandeur->user->firstname }}&nbsp;&nbsp;{{ $pcharge->demandeur->user->name }}<br>
                                            <b>Tel:</b> {{ $pcharge->demandeur->user->telephone }}
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
                </div>
            </div>
        </div>
    @endforeach

</body>

</html>
