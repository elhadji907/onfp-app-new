<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Contrat</title>
    <style>
        .invoice-box {
            max-width: 1500px;
            margin: auto;
            padding: 30px;
            font-size: 12px;
            line-height: 24px;
            color: #555;
        }

        /** RTL **/
        .rtl {
            imputation: rtl;
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
</head>

<body>
    <div class="invoice-box">
        <div>
            <div class="" style="position: fixed;
                top: -10px;
                left: 0px;
                right: 0px;
                height: 50px;
                background-color: #ffffff;
                color: white;
                text-align: center;
                line-height: 35px;">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/enteteonfpageroute.png'))) }}"
                    style="width: 100%; height: auto;">
            </div>
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            <div align="right">
                <p><b><u>N° Dossier</u></b> : <span style="color: rgb(255, 0, 0); text-shadow: 2px 2px;">
                        {{ $individuelle->demandeur->numero_dossier ?? '' }}</span></p>
            </div>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th colspan="4"><b><u>I. IDENTIFICATION DU CANDIDAT</b></u></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4"><b>{{ __("N° carte nationale d'identité (CIN)") }}</b> :
                            {{ $individuelle->demandeur->cin ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>{{ __('Prénom et Nom') }}</b> :
                            {{ $individuelle->demandeur->user->firstname ?? '' }}&nbsp;&nbsp;{{ $individuelle->demandeur->user->name ?? '' }}
                        </td>
                        <td colspan="1"><b>{{ __('Civilité') }}</b> :
                            {{ $individuelle->demandeur->user->civilite ?? '' }}</td>
                    </tr>
                    <tr>
                        <td colspan="4"><b>{{ __('Date et lieu naissance') }}</b> :
                            {{ $individuelle->demandeur->user->date_naissance->format('d/m/Y') ?? '' }}&nbsp;à&nbsp;
                            {{ $individuelle->demandeur->user->lieu_naissance ?? '' }} </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <b>{{ __('Adresse (Commune / village ou quartier) :  ') }}</b>{{ $individuelle->adresse ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>{{ __('Téléphone du candidat (Personnel) :  ') }}</b>{{ $individuelle->demandeur->user->telephone ?? '' }}
                        </td>
                        <td colspan="2">
                            <b>{{ __('Autre téléphone (Parent / Tuteur) :  ') }}</b>{{ $individuelle->telephone ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>{{ __('Situation matrimoniale :  ') }}</b>{{ $individuelle->demandeur->user->familiale->name ?? '' }}
                        </td>
                        <td colspan="2">
                            <b>{{ __('Nombre d’enfants en charge :  ') }}</b>{{ $individuelle->nbre_enfants ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th colspan="4"><b><u>II. PARCOURS ACADEMIQUE ET PROFESSIONNEL</b></u></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3">
                            <b>{{ __('Diplômes académiques : ') }}</b>{{ $individuelle->diplome->name ?? '' }}
                        </td>
                        @if (isset($individuelle->annee_diplome))
                            <td colspan="1"><b>{{ __('Année : ') }}</b>{{ $individuelle->annee_diplome ?? '' }}
                            </td>
                        @else
                        @endif
                    </tr>
                    <tr>
                        @if (isset($individuelle->autres_diplomes))
                            <td colspan="4">
                                <b>{{ __('Autres diplômes académiques : ') }}</b>{{ $individuelle->autres_diplomes ?? '' }}
                            </td>
                        @else
                        @endif
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>{{ __('Diplômes professionnels  : ') }}</b>{{ $individuelle->diplomespro->name ?? '' }}
                        </td>
                        @if (isset($individuelle->annee_diplome_professionelle))
                            <td colspan="1">
                                <b>{{ __('Année : ') }}</b>{{ $individuelle->annee_diplome_professionelle ?? '' }}
                            </td>
                        @else
                        @endif
                    </tr>
                    <tr>
                        @if (isset($individuelle->autres_diplomes_pros))
                            <td colspan="4">
                                <b>{{ __('Autres diplômes professionnels : ') }}</b>{{ $individuelle->autres_diplomes_pros ?? '' }}
                            </td>
                        @else
                        @endif
                    </tr>
                </tbody>
            </table>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th colspan="4"><b><u>III. PROJET PROFESSIONNEL</b></u></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4">
                            <b>{{ __('Quelle activité ou travail exercez -vous ? : ') }}</b>{{ $individuelle->activite_travail ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>{{ __('Etes-vous dans un travail rémunéré ? : ') }}</b>{{ $individuelle->travail_renumeration ?? '' }}
                        </td>
                        @if (isset($individuelle->travail_renumeration) && $individuelle->travail_renumeration == 'Oui')
                            <td colspan="2">
                                <b>{{ __('Comment trouvez -vous votre salaire ? : ') }}</b>{{ $individuelle->salaire ?? '' }}
                            </td>
                        @else
                        @endif
                    </tr>
                    <tr>
                        <td colspan="4">
                            <b>{{ __('Dans quelle activité voulez-vous travailler à l’avenir ? : ') }}</b>{{ $individuelle->activite_avenir ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th colspan="4"><b><u>IV. SITUATION SOCIO- ECONOMIQUE</b></u></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="1">
                            <b>{{ __("Souffrez- vous d'un handicap quelconque ? : ") }}</b>{{ $individuelle->handicap ?? '' }}
                        </td>
                        @if (isset($individuelle->handicap) && $individuelle->handicap == 'Oui')
                            <td colspan="3">
                                <b>{{ __('Précisez ? : ') }}</b>{{ $individuelle->preciser_handicap ?? '' }}
                            </td>
                        @else
                        @endif
                    </tr>
                    <tr>
                        <td colspan="4">
                            <b>{{ __('Comment appréciez-vous votre situation économique familiale ? : ') }}</b>{{ $individuelle->situation_economique ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        @if (isset($individuelle->victime_social) && $individuelle->victime_social == 'Aucun')
                            <td colspan="4">
                                <b>{{ __('Avez-vous été victime d’un quelconque problème social ? : ') }}</b>
                                {{ __('Non') }}
                            </td>
                        @elseif (isset($individuelle->victime_social) && $individuelle->victime_social != 'Autre')
                            <td colspan="4">
                                <b>{{ __('Avez-vous été victime d’un quelconque problème social ? ') }}</b>
                                {{ __('Oui') }}, <b>{{ __('Précisez :') }}</b>
                                {{ $individuelle->victime_social ?? '' }}
                            </td>
                        @else
                            <td colspan="4">
                                <b>{{ __('Avez-vous été victime d’un quelconque problème social ? ') }}</b>
                                {{ __('Autre') }}, <b>{{ __('Précisez :') }}</b>
                                {{ $individuelle->autre_victime ?? '' }}
                            </td>
                        @endif
                    </tr>
                </tbody>
            </table>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th colspan="4"><b><u>V. LOCALISATION DU CANDIDAT</b></u></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2"><b>{{ __('Département : ') }}</b>
                            {{ $individuelle->localite->nom ?? '' }}
                        </td>
                        <td colspan="1"><b>{{ __('Commune : ') }}</b>
                            {{ $individuelle->zone->nom ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th align="left" colspan="2"> <u>{{ __('Module demandé') }}</u> </th>
                        <th align="left" colspan="2"> <u>
                                {{ __('Statut') }}
                            </u> </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">
                            {{ $individuelle->module->name ?? '' }}
                        </td>
                        <td colspan="2">
                            {{ $individuelle->statut ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="position: fixed;
            bottom: -10px;
            left: 0px;
            right: 0px;
            height: 50px;
            background-color: white;
            color: white;
            text-align: center;
            line-height: 35px;">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/pied_ageroute_onfp_f.png'))) }}"
                style="width: 100%; height: auto;">
        </div>
    </div>
</body>

</html>
