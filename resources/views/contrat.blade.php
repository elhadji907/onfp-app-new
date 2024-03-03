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
            font-size: 16px;
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
            border-spacing: -1px;
        }

        table td,
        table th {
            border-left: 0;
            border-right: 1px solid rgb(0, 0, 0);
            border-top: 0;
            border-bottom: 1px solid rgb(0, 0, 0);
            text-align: center;
        }

    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    @foreach ($pcharges as $pcharge)
        <div class="invoice-box">
            <div class="row justify-content-center pb-2">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
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
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo1.png'))) }}"
                        style="width: 100%; height: auto;">
                </div>
                <b>
                    <center>
                        <br>
                        <br>
                        <br>
                        <br>
                        <p>Entre les soussignés<br></p>
                    </center>
                    <center>
                        <p>Office National de Formation Professionnelle (O.N.F.P.)
                            Cité SIPRES 1, Lot 2, 2 voies Liberté 6 extension VDN - BP 21013 – Dakar Ponty<br>
                            Et
                        </p>
                        <p>{{ $pcharge->etablissement->name }}
                            @if (isset($pcharge->etablissement->sigle))
                                ({{ $pcharge->etablissement->sigle }})
                            @else
                            @endif <br>
                            <strong>Contact</strong> : {{ $pcharge->etablissement->fixe }}&nbsp; /
                            &nbsp;{{ $pcharge->etablissement->telephone1 }}<br>
                            <strong>Email</strong> : <span style="color: blue">
                                {{ $pcharge->etablissement->email }}</span>
                        </p>
                    </center>
                </b>
                <p>Il a été convenu et arrêté ce qui suit :</p>
                <h6><b>Article 1 : Objet du contrat </b></h6>
                {{-- <p>Pour l’année académique <b>{{ $pcharge->scolarite->annee }}</b>, l’Office National de Formation
                    Professionnelle (ONFP) confie à
                    l’Opérateur, qui accepte, la formation d’un(e) étudiant(e), conformément aux indications du tableau
                    suivant :</p> --}}
                <div>

                    {{-- <table class="table table-bordered" method="POST" cellpadding="0" cellspacing="0">
                        <tr class="heading">
                            <td>
                                Prénom & Nom
                            </td>
                            <td>
                                Niveau
                            </td>

                        </tr>

                        <tr class="item">
                            <td>
                                {{ $pcharge->demandeur->user->firstname }}&nbsp;&nbsp;{{ $pcharge->demandeur->user->name }}
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr class="heading">
                            <td>
                                {{ __('Spécialité') }}
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
                            <td>{{ __('Montant global') }}</td>

                            <td>{!! number_format($pcharge->montant, 0, ',', ' ') . ' ' . 'F CFA' !!}</td>
                        </tr>

                        <tr class="total">
                            <td></td>

                            <td>Total: {!! number_format($pcharge->avis_dg, 0, ',', ' ') . ' ' . 'F CFA' !!}</td>
                        </tr>

                    </table> --}}

                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Prénoms et Nom</th>
                                <th scope="col">Spécialité</th>
                                <th scope="col">Niveau</th>
                                <th scope="col">Montant (CFA)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $pcharge->demandeur->user->firstname }}&nbsp;&nbsp;{{ $pcharge->demandeur->user->name }}
                                </td>
                                <td>{{ $pcharge->filiere->name }}</td>
                                <td>{{ $pcharge->niveau }}</td>
                                <td>{!! number_format($pcharge->avis_dg, 0, ',', ' ') . ' ' . 'F CFA' !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h6><b>Article 2 : Engagement des parties</b></h6>
                <h6><b>A : Engagement de l’ONFP</b></h6>
                <p>L’ONFP s’engage :</p>
                <ul>
                    <li> A prendre en charge les frais de scolarité annuels (excepté les frais d’inscription), selon les
                        modalités prévues à article 3;</li>
                    <li>A réaliser des visites ponctuelles au niveau de l’établissement pour le suivi de la formation
                    </li>
                </ul>
                <h6><b>B : Engagement de l’Etablissement</b></h6>
                <p>L’Etablissement s’engage à:</p>
                <ul>
                    <li>Assurer à l’apprenant une formation, correspondant à la spécialité et au niveau indiqué dans le
                        contrat;</li>
                    <li>Veuillez au respect de l’assiduité de l’apprenant /étudiant ;</li>
                    <li>Mettre à la disposition de l’ONFP les relevés de notes de l’apprenant/étudiant ainsi que les
                        factures et rapport d’exécution</li>
                    <li>Signaler tout manquement de la part de l’étudiant notamment assiduité, résultat scolaire,
                        discipline.</li>
                    <li>Faciliter à tout moment les visites de contrôle au sein de l’établissement </li>
                </ul>
                <h6>Article 3 : Modalités de paiement:</h6>
                <p>Le règlement s’effectue selon les modalités ci-après :</p>
                <ul>
                    <li>50% dès signature du présent contrat par les deux parties, sur présentation d’une facture
                        d’acompte par l’Opérateur ; </li>
                    <li>50% à la fin de la formation, après présentation par l’opérateur d’un rapport d’exécution et de
                        la facture reliquat.</li>
                </ul>
                <h6>Article 4 : Modification</h6>
                <p>Toute modification de la présente convention fera l’objet d’un avenant écrit et dûment signé par les
                    deux parties.</p>
                <h6>Article 5: Résiliation </h6>
                <p>La présente convention peut être résiliée, sans indemnités, à tout moment par l’une des parties en
                    cas de manquement grave des obligations mises à la charge de l’autre, ou encore en cas d’arrêt
                    définitif de l’apprenant en cours de formation pour un quelconque motif. Le contrat ne sera pas
                    renouvelé en cas d’insuffisance de résultat du bénéficiaire.</p>
                <h6>Article 6: règlement des Litiges : </h6>
                <p>Le présent contrat est soumis au droit en vigueur au Sénégal.</p>
                <p>Les parties conviennent de tout mettre en œuvre pour trouver un règlement amiable aux différends qui
                    pourraient naître de l’exécution ou de l’interprétation des présentes.</p>
                <center>
                    <p>Fait à Dakar en deux exemplaires originaux, le………………………</p>
                </center>
                {{-- <table class="table" style="border: hidden">
                    <tbody>
                        <tr>
                            <td><b>{{ __('Pour l’Opérateur,') }} <br>
                                    Le Directeur
                                </b></td>
                            <td class="float-right" style="border: hidden"><b>{{ __('Pour l’ONFP') }} <br> Le
                                    Directeur Général</b></td>
                        </tr>
                    </tbody>
                </table> --}}
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
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/pied.png'))) }}"
                    style="width: 100%; height: auto;">
            </div>
        </div>
    @endforeach
</body>

</html>
