<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>{{ $module_name }} {{$zone}} </title>
    <style>
        .invoice-box {
            max-width: 1500px;
            margin: auto;
            padding: 30px;
            font-size: 12px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: rgb(0, 0, 0);
        }

        /** RTL **/
        .rtl {
            imputation: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        table {
            border: 0.3px solid rgb(0, 0, 0);
            width: 100%;
            border-spacing: 0px;
        }

        table td,
        table th {
            border: 0.3px solid rgb(0, 0, 0);
            text-align: center;
            line-height: 25px;
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
            <div class="" style="position: fixed;
                top: -10px;
                left: 0px;
                right: 0px;
                height: 50px;
                background-color: #ffffff;
                color: white;
                text-align: center;
                line-height: 35px;">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/enteteonfpagerouteliste.png'))) }}"
                    style="width: 100%; height: auto;">
            </div>
            <br /><br /><br /><br /><br /><br /><br />
            <h4 align="center">
                <span style="color: rgb(255, 0, 0); text-shadow: 1px 1px;"> <u>{{ $zones->localite->nom }} </u>: liste des
                    candidats retenus pour les formation en {{ $module_name }}, commune de {{ $zone }}</span>
            </h4>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-ageroutebeneficiaires">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width:3%;">N°</th>
                                <th style="width:5%;">Civilité</th>
                                <th style="width:12%;">Prenom</th>
                                <th style="width:10%;">Nom</th>
                                <th style="width:10%;">Date naissance</th>
                                <th style="width:10%;">Lieu naissance</th>
                                <th style="width:5%;">Téléphone</th>
                                <th style="width:15%;">Adresse</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($individuelles as $key => $individuelle)
                                @if (isset($individuelle) && $individuelle->zone->nom == $zone && $individuelle->module->name == $module_name && $individuelle->statut == 'accepter')
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{!! $individuelle->demandeur->user->civilite !!}</td>
                                        <td>{!! ucfirst(strtolower($individuelle->demandeur->user->firstname)) !!} </td>
                                        <td>{!! strtoupper(preg_replace('#&[^;]+;#', '', preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', htmlentities($individuelle->demandeur->user->name, ENT_NOQUOTES, 'utf-8'))))) !!} </td>
                                        <td>{!! $individuelle->demandeur->user->date_naissance->format('d/m/Y') !!}</td>
                                        <td>{!! strtoupper(preg_replace('#&[^;]+;#', '', preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', htmlentities($individuelle->demandeur->user->lieu_naissance, ENT_NOQUOTES, 'utf-8'))))) !!} </td>
                                        <td>{!! $individuelle->demandeur->user->telephone !!}</td>
                                        <td>{!! ucfirst(strtolower($individuelle->adresse)) ?? '' !!}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
