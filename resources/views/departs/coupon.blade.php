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
            border: 1px solid #000000;
            font-weight: bold;
        }

        .invoice-box table tr.total td {
            border-top: 2px solid #eee;
            border-bottom: 1px solid #eee;
            border-left: 1px solid #eee;
            border-right: 1px solid #eee;
            background: #eee;
            font-weight: bold;
        }

        .invoice-box table tr.item td {
            border: 1px solid #000000;
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
                <tr>
                    <td colspan="2" align="left" valign="top" style="text-align: center;">
                        <b>REPUBLIQUE DU SENEGAL<br>
                            Un Peuple - Un But - Une Foi<br>
                            ********<br>
                            MFPAI
                        </b>
                    </td>
                    <td colspan="2" align="right" valign="top">
                        <p>
                            <b> {{ __("Date d'imputation : ") }} </b>
                            {{ optional($courrier->date_imp)->format('d/m/Y') }} <span><br />
                                <b> {{ __("Date d'arrivée : ") }} </b>
                                {{ optional($courrier->date_recep)->format('d/m/Y') }} <span><br />
                                    <b> {{ __('N° du courrier : ') }} </b> {{ $courrier->numero }} <span><br />

                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-responsive">
            <tbody>
                <tr>
                    <td colspan="4" align="left">
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/LOGOONFPTEXTEGOOD1.jpg'))) }}"
                            style="width: 100%; max-width: 300px" />
                    </td>
                    <td colspan="4" align="right"><b>
                            <h1><br><u>{{ __("FICHE D'IMPUTATION") }}</u></h1>
                        </b>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <table class="table table-responsive">
            <tbody>
                <tr>
                    <td colspan="4" align="left" valign="top">
                        <b><u>{{ __('Expéditeur') }}</u></b> : {{ $courrier->expediteur }}<br>
                        
                        <b><u>{{ __('Réf') }}</u></b> : {{ $courrier->reference }}&nbsp;&nbsp;&nbsp;&nbsp;
                        <b><u>{{ __('du') }}</u></b> : {{ optional($courrier->date_recep)->format('d/m/Y') }}<br>
                        <b><u>{{ __('Objet') }}</u></b> : {{ $courrier->objet }}<br>
                    </td>
                    <td colspan="4" align="right" valign="top">
                        <table class="table table-responsive table-striped">
                            
                            <tbody>
                                <tr class="heading">
                                    <td colspan="2" align="center"><b>{{ __('Direction / Service / Cellule') }}</b>
                                    </td>
                                    <td colspan="2" align="center"><b>{{ __('Sigle') }}</b>
                                    </td>
                                </tr>                               
                                @if ($courrier->directions != '[]')
                                @foreach ($courrier->directions as $imputation)
                                    <tr class="item">
                                        <td colspan="2" align="center">
                                            <span>{!! $imputation->name ?? 'Aucune' !!} </span>
                                        </td>
                                        <td colspan="2" align="center">
                                            <span>{!! $imputation->sigle ?? 'Aucune' !!} </span>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <table class="table table-responsive">
            <tbody>
                <tr>
                    <td colspan="2" align="right" valign="top">
                        <table class="table table-responsive table-striped">
                            <tbody>
                                <tr class="heading">
                                    <td colspan="4" align="center"><b>{{ __('ACTIONS ATTENDUES') }}</b>
                                    </td>
                                </tr>
                                @foreach ($actions as $action)
                                    <tr class="item">
                                        <td colspan="2" align="center">
                                            {{ $action }}
                                        </td>
                                        <td colspan="2" align="center">
                                            @if ($action == $courrier->description)
                                                {{ __('X') }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>        
        <br>
        <table class="table table-responsive">
            <tbody>
                <tr>
                    <td colspan="2" align="left" valign="top">
                        <b><u>Observations:</u></b>
                           {{$courrier->observation}}
                        
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-responsive">
            <tbody>
                <tr>
                    <td colspan="1" align="left">
                        
                    </td>
                    <td colspan="3" align="right" valign="top">
                        <p>
                            <b><u> {{ __("Dossier suivi par : ") }}</u> </b>
                            @foreach ($courrier->employees as $employee)
                            {{ $employee->user->firstname .' '.$employee->user->name }} ;
                        @endforeach

                        </p>
                    </td>
                </tr>
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
                <hr>
                {{ __('Sipres 1 lot 2 - 2 voies liberté 6, extension VDN, Tel : 33 827 92 51, Email: onfp@onfp.sn, site web: www.onfp.sn') }}
            </span>
        </div>
    </div>
</body>

</html>
