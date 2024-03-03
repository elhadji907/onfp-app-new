<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            font-size: 12px;
            line-height: 24px;
            color: color: rgb(0, 0, 0);
            ;
        }

        /** RTL **/
        .rtl {
            imputation: rtl;
        }

        .invoice-box table tr.heading td {
            background: rgb(255, 255, 255);
            border: 0.5px solid rgb(0, 0, 0);
            font-weight: bold;
        }

        .invoice-box table tr.headingg td {
            background: rgb(255, 255, 255);
            border: 0.5px solid rgb(255, 255, 255);
        }

        .invoice-box table tr.total td {
            border-top: 2px solid #eee;
            border-bottom: 1px solid #eee;
            border-left: 1px solid #eee;
            border-right: 1px solid #eee;
            background: #eee;
            font-weight: bold;
        }

        {{--  .invoice-box table tr.item td {
            border-bottom: 0.5px solid rgb(0, 0, 0);
            border-left: 0.5px solid rgb(0, 0, 0);
            border-right: 0.5px solid rgb(0, 0, 0);
        }  --}} 
        
        .invoice-box table tr td.item1 {
            border-bottom: 0.5px solid rgb(0, 0, 0);
            border-left: 0.5px solid rgb(0, 0, 0);
            border-right: 0.5px solid rgb(0, 0, 0);
            border-top: 0.5px solid rgb(0, 0, 0);
        }

        .invoice-box table tr td.item2 {
            border-bottom: 0.5px solid rgb(0, 0, 0);
            border-right: 0.5px solid rgb(0, 0, 0);
            border-top: 0.5px solid rgb(0, 0, 0);
        }

        .invoice-box table tr td.item3 {
            border-bottom: 0.5px solid rgb(0, 0, 0);
            border-right: 0.5px solid rgb(0, 0, 0);
            border-top: 0.5px solid rgb(0, 0, 0);
        }

        .invoice-box table tr td.item4 {
            border-bottom: 0.5px solid rgb(0, 0, 0);
            border-right: 0.5px solid rgb(0, 0, 0);
            border-top: 0.5px solid rgb(0, 0, 0);
        }

        .invoice-box table tr td.item5 {
            border-bottom: 0.5px solid rgb(0, 0, 0);
            border-right: 0.5px solid rgb(0, 0, 0);
            border-top: 0.5px solid rgb(0, 0, 0);
        }

        .invoice-box table tr td.item6 {
            border-bottom: 0.5px solid rgb(0, 0, 0);
            border-right: 0.5px solid rgb(0, 0, 0);
            border-top: 0.5px solid rgb(0, 0, 0);
        }

        .invoice-box table tr td.item7 {
            border-bottom: 0.5px solid rgb(0, 0, 0);
            border-right: 0.5px solid rgb(0, 0, 0);
            border-top: 0.5px solid rgb(0, 0, 0);
        }

        table {
            border-left: 0px solid rgb(0, 0, 0);
            border-right: 0;
            border-top: 0px solid rgb(0, 0, 0);
            border-bottom: 0;
            width: 100%;
            border-spacing: 0px;
        }

        table td,
        table th {
            border-left: 0;
            border-right: 0px solid rgb(0, 0, 0);
            border-top: 0;
            border-bottom: 0px solid rgb(0, 0, 0);
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//db.onlinewebfonts.com/c/dd79278a2e4c4a2090b763931f2ada53?family=ArialW02-Regular" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    {{--  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">  --}}
</head>

<body>
    <div class="invoice-box">
        <table class="table table-responsive">
            <tbody>
                <tr class="headingg">
                    <td style="width:50%;" align="center">
                        {{ __('REPUBLIQUE DU SENEGAL') }}<br>{{ __('UN PEUPLE - UN BUT - UNE FOI') }}<br>
                            ----------<br>
                            {{ __('MINISTERE DE LA FORMATION PROFESSIONNELLE,') }} <br>
                            {{ __("DE L'APPRENTISSAGE ET DE L'INSERTION") }}<br>
                            ----------
                    </td>
                    <td style="width:50%;" align="right">{{ __('ONFP/DG/DAF') }}<br><br><br><br>

                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-responsive">
            <tbody>
                <tr>
                    {{--  <td colspan="2">
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/pharma-niaguis.png'))) }}"
                            style="width: 100%; max-width: 200px" />
                    </td>  --}}
                    <td style="width:35%;">
                    </td>
                    <td style="width:65%;" align="right">
                        <p>
                             {{ __('Direction Administrative et Financière') }} <br>
                        </p>
                        <p align="center">
                             {{ __('BORDEREAU D’ENVOI N°') }} 
                        </p>
                        <p align="right">
                             {{ __("Pièces adressées : Madame l’Agent Comptable de l’ONFP - DAKAR") }} 
                        </p>
                    </td>
                    <td align="right">
                        <p>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-responsive table-striped">
            <tbody>
                <tr class="heading">
                    <td style="width:3%;" align="center">{{ __('N°/MP') }}

                    </td>
                    <td style="width:5%;" align="center">{{ __('Date/MP') }}

                    </td>
                    <td align="center">{{ __('Désignation') }}

                    </td>
                    <td style="width:5%;" align="center">{{ __('Projet') }}

                    </td>
                    <td style="width:5%;" align="center">{{ __('Montant') }}

                    </td>
                    <td style="width:2%;" align="center">{{ __('NB/PC') }}

                    </td>
                    <td style="width:5%;" align="center">{{ __('Obervations') }}

                    </td>
                </tr>
                @foreach ($liste->bordereaus as $bordereau)
                    <tr class="item">
                        <td class="item1" align="center">{!! $bordereau->numero_mandat !!}</td>
                        <td class="item2" align="center">{!! Carbon\Carbon::parse($bordereau->date_mandat)->format('d/m/Y') !!}</td>
                        <td class="item3" align="center">{!! $bordereau->designation !!}</td>
                        <td class="item4" align="center">{!! $bordereau->courrier->projet->sigle !!}</td>
                        <td class="item5" align="center">{!! number_format($bordereau->montant, 0, '.', ' ') !!}</td>
                        <td class="item6" align="center">{!! $bordereau->nombre_de_piece !!}</td>
                        <td class="item7" align="center">{!! $bordereau->observation !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div
            style="position: fixed;
            bottom: -10px;
            left: 0px;
            right: 0px;
            height: 50px;
            background-color: rgb(255, 255, 255);
            color: rgb(0, 0, 0);
            text-align: center;
            line-height: 10px;">
            <span>
                {{--  <hr>
                {{ __('Pharmacie de Niaguis, Ziguinchor, commune de Niaguis, Tel : 78 264 08 02, Email: niaguis-pharma@gmail.com') }}  --}}
            </span>
            {{--  <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/pied_ageroute_onfp_f.png'))) }}"
                style="width: 100%; height: auto;">  --}}
        </div>
    </div>
</body>

</html>
