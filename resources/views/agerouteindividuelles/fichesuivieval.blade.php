<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>{{ $beneficiaires }}</title>
    <style>
        .invoice-box {
            max-width: 1500px;
            margin: auto;
            padding: 30px;
            font-size: 12px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        /** RTL **/
        .rtl {
            imputation: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        table {
            border-left: 1px solid rgb(0, 0, 0);
            border-right: 0;
            border-top: 1px solid rgb(0, 0, 0);
            border-bottom: 0;
            width: 100%;
            border-spacing: 0px;
        }

        table td,
        table th {
            border-left: 0;
            border-right: 1px solid rgb(0, 0, 0);
            border-top: 0;
            border-bottom: 1px solid rgb(0, 0, 0);
            text-align: left;
            line-height: 20px;
        }

        #footer {
            position: absolute;
            width: 100%;
            height: 60px;
            /* Height of the footer */
            background: rgb(255, 255, 255);
            display: inline-block;
            align-self: flex-end;
            display: inline-flex;
            align-content: space-evenly;
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
            <div style="position: fixed;
                top: -10px;
                left: 0px;
                right: 0px;
                height: 50px;
                background-color: #ffffff;
                color: white;
                text-align: center;
                line-height: 35px;">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/entete_onfp_suivi.png'))) }}"
                    style="width: 100%; height: auto;">
            </div>
            <br /><br /><br /><br /><br />
            <table class="table table-responsive">
                <tr>
                    <td colspan="2"><b>{{ __('Code formation') }}</b> :
                        {{ $formation->code ?? '' }}
                    </td>
                    <td colspan="2"><b>{{ __('Réf convention') }}</b> :
                        {{ $formation->convention->numero ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="4"><b>{{ __('Opérateur') }}</b> :
                        {{ $formation->operateur->name ?? '' }} &nbsp; ({{ $formation->operateur->sigle ?? '' }})
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>{{ __('Module') }}</b> :
                        {{ $formation->module->name ?? '' }}
                    </td>
                    <td colspan="2"><b>{{ __('Lieu formation') }}</b> :
                        {{ $formation->lieu ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>{{ __('Effectif prévu') }}</b> :
                        {{ $formation->total ?? '' }}
                    </td>
                    <td colspan="2"><b>{{ __('Bénéficiaires') }}</b> :
                        {{ $formation->beneficiaires ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>{{ __('Type de qualification') }}</b> :
                        {{ $formation->qualifications ?? '' }}
                    </td>
                    <td colspan="2"><b>{{ __('Ingénieur en charge') }}</b> :
                        {{ $formation->ingenieur->name ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>{{ __('Date début') }}</b> :
                        @if (isset($formation->date_debut))
                            {{ $formation->date_debut->format('d/m/Y') ?? '' }}
                        @else
                            .................
                        @endif
                    </td>
                    <td colspan="2"><b>{{ __('Date fin') }}</b> :
                        @if (isset($formation->date_fin))
                            {{ $formation->date_fin->format('d/m/Y') ?? '' }}
                        @else
                            .................
                        @endif
                    </td>
                </tr>
            </table>
            <br />
            <center><b>LISTE DES BENEFICIAIRES</b></center>
            <br />
            @if (isset($formation->individuelles) && $formation->individuelles != '[]')
                <table class="table table-bordered" width="100%" cellspacing="0">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <thead class="heading">
                        <tr>
                            <th width="2%">N°</th>
                            <th width="10%">CIN</th>
                            <th width="5%">Civilité</th>
                            <th width="10%">Prénom</th>
                            <th width="10%">Nom</th>
                            <th width="8%">Date nais.</th>
                            <th width="15%">Lieu nais.</th>
                            <th width="10%">Téléphone</th>
                            <th width="5%">Emmargement</th>
                        </tr>
                    </thead>
                    <tbody class="details" id="liste">
                        <?php $i = 1; ?>
                        @foreach ($formation->individuelles as $individuelle)
                            @if (isset($individuelle) && $individuelle->module->name == $findividuelle->module->name && strtolower($individuelle->localite->nom) == strtolower($findividuelle->formation->localite->nom) && strtolower($individuelle->projet->name) == strtolower($findividuelle->projet->name))
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $individuelle->demandeur->cin }}</td>
                                    <td>{{ $individuelle->demandeur->user->civilite }}</td>
                                    <td>{{ $individuelle->demandeur->user->firstname }}</td>
                                    <td>{{ $individuelle->demandeur->user->name }}</td>
                                    <td>{{ $individuelle->demandeur->user->date_naissance->format('d/m/Y') }}</td>
                                    <td>{{ $individuelle->demandeur->user->lieu_naissance }}</td>
                                    <td>{{ $individuelle->demandeur->user->telephone }}</td>
                                    <td></td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @else
                <center> Aucun bénéficiaire pour le momement </center>
            @endif
            @if (isset($formation->individuelles) && $formation->individuelles != '[]')
                <div id="footer">
                    <span> <b>Observations :</b>
                    </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span> <b>Agent de suivi :</b> ............. .............................{{--  {{ $formation->ingenieur->name }}  --}}
                    </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span><b> Date :</b>
                        @if (isset($formation->date_suivi))
                            {{ $formation->date_suivi->format('d/m/Y') ?? '' }}
                        @else
                            ................................
                        @endif
                    </span>
                </div>
            @else
            @endif
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
