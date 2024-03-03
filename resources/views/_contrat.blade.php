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
                <div>
                    <img style="max-width:100%;" src="{{ asset('images/logo1.png') }}">
                    {{-- <h5 class="text-black h-100 text-uppercase mb-0"><b></b><span
                            class="font-italic">REPUBLIQUE DU SENEGAL</span></h5>
                    <small class="text-black h-100 text-uppercase mb-0"><b></b><span
                            class="font-italic">Un Peuple  - Un But – Une Foi</span></small>
                    <small class="text-black h-100 text-uppercase mb-0"><b></b><span
                            class="font-italic"><br>--------------------</span></small>
                            <h5 class="text-black h-100 text-uppercase mb-0"><b></b><span
                                class="font-italic">MINISTERE DE L’EMPLOI,<br> DE LA FORMATION
                                PROFESSIONNELLE, <br> DE L’APPRENTISSAGE ET DE L’INSERTION
                                </span></h5>
                    <small class="text-black h-100 text-uppercase mb-0"><b></b><span
                            class="font-italic">--------------------</span></small> --}}
                </div>
                <b>
                    <center>
                        <br>
                        <br>
                        <br>
                        <br>
                        <p>Entre les soussignés<br><br></p>
                    </center>
                    <center>
                        <p>L’Office National de Formation Professionnelle (O.N.F.P.)
                            Cité SIPRES 1, Lot 2, 2 voies Liberté 6 extension VDN - BP 21013 – Dakar Ponty<br><br>
                            Et
                        </p>
                    </center>
                    <center>
                        <p>{{ $pcharge->etablissement->name }}
                        </p>
                    </center>
                </b>
                <p>Il a été convenu et arrêté ce qui suit :</p>
                <h5><b>Article 1 : Objet du contrat </b></h5>
                <p>Pour l’année académique {{ $pcharge->scolarite->annee }}, l’Office National de Formation
                    Professionnelle (O.N.F.P.) confie à
                    l’Opérateur, qui accepte, la formation d’un(e) étudiant(e), conformément aux indications du tableau
                    suivant :</p>
                <div>
                    <table class="table table-bordered" method="POST" cellpadding="0" cellspacing="0">
                        {{-- <tr class="item">
                            <td colspan="2">
                                <table>
                                    <tr>
                                        <td class="title">
                                            <img src="" style="width:100%; max-width:300px;">
                                            <img style="width:75%; max-width:100%;"
                                                src="{{ asset('images/logo1.png') }}">
                                        </td>
                                        <td>
                                            <b>Numéro dossier </b>#:
                                            {!! $pcharge->demandeur->numero !!}<br>
                                            <b>Date dépot </b>: {!! Carbon\Carbon::parse($pcharge->demandeur->date_depot)->format('d/m/Y') !!}<br>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr> --}}
                        {{-- <tr class="item">
                            <td colspan="2">
                                <table>
                                    <tr>
                                        <td>
                                            <h5>{{ __('INFORMATIONS PERSONNELLES') }}</h5>
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
                                            <h5>{{ __('BENEFICIAIRE') }}</h5>
                                            <b>Nom:</b>
                                            {{ $pcharge->demandeur->user->firstname }}&nbsp;&nbsp;{{ $pcharge->demandeur->user->name }}<br>
                                            <b>Tel:</b> {{ $pcharge->demandeur->user->telephone }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr> --}}
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
                                {{-- <label class="badge badge-info">{{ $pcharge->statut }}</label> --}}
                            </td>
                        </tr>
                        {{-- <tr class="heading">
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
                        </tr> --}}
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

                        {{-- <tr class="item">
                            <td>Inscription</td>

                            <td>{!! number_format($pcharge->inscription, 0, ',', ' ') . ' ' . 'F CFA' !!}</td>
                        </tr> --}}
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
                <h5><b>Article 2 : Engagement des parties</b></h5>
                <h5><b>A : Engagement de l’ONFP</b></h5>
                <p>L’ONFP s’engage :</p>
                <ul>
                    <li> A prendre en charge les frais de scolarité annuels (excepté les frais d’inscription), selon les
                        modalités prévues à article 3;</li>
                    <li>A réaliser des visites ponctuelles au niveau de l’établissement pour le suivi de la formation
                    </li>
                </ul>
                <h5><b>B : Engagement de l’Etablissement</b></h5>
                <p>L’Etablissement s’engage à:</p>
                <ul>
                    <li>Assurer à l’apprenant une formation, correspondant à la spécialité et au niveau indiqué dans le
                        contrat;</li>
                    <li>Veillez au respect de l’assiduité de l’apprenant /étudiant ;</li>
                    <li>Mettre à la disposition de l’ONFP les relevés de notes de l’apprenant/étudiant ainsi que les
                        factures et rapport d’exécution</li>
                    <li>Signaler tout manquement de la part de l’étudiant notamment assiduité, résultat scolaire,
                        discipline.</li>
                    <li>Faciliter à tout moment les visites de contrôle au sein de l’établissement </li>
                </ul>

                <h5>Article 3 : Modalités de paiement:</h5>

                <p>Le règlement s’effectue selon les modalités ci-après :</p>
                <ul>
                    <li>50% dès signature du présent contrat par les deux parties, sur présentation d’une facture
                        d’acompte par l’Opérateur ; </li>
                    <li>50% à la fin de la formation, après présentation par l’opérateur d’un rapport d’exécution et de
                        la facture reliquat.</li>
                </ul>

                <h5>Article 4 : Modification</h5>

                <p>Toute modification de la présente convention fera l’objet d’un avenant écrit et dûment signé par les
                    deux parties.</p>

                <h5>Article 5: Résiliation </h5>

                <p>La présente convention peut être résiliée, sans indemnités, à tout moment par l’une des parties en
                    cas de manquement grave des obligations mises à la charge de l’autre, ou encore en cas d’arrêt
                    définitif de l’apprenant en cours de formation pour un quelconque motif. Le contrat ne sera pas
                    renouvelé en cas d’insuffisance de résultat du bénéficiaire.</p>

                <h5>Article 6: règlement des Litiges : </h5>

                <p>Le présent contrat est soumis au droit en vigueur au Sénégal.</p>
                <p>Les parties conviennent de tout mettre en œuvre pour trouver un règlement amiable aux différends qui
                    pourraient naître de l’exécution ou de l’interprétation des présentes.</p>
                <br>
                <br>
                <br>
                <br>
                <center>
                    <p>Fait à Dakar en deux exemplaires originaux, le………………………</p>
                </center>
                <br>
                <br>
                <br>
                <br>
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <b> {{ __('Pour l’Opérateur,') }} <br> Le Directeur</b>
                            </td>

                            <td>
                                <b>{{ __('Pour l’O.N.F.P') }} <br> Le Directeur Général</b>
                            </td>
                        </tr>
                    </table>
                </td>
            </div>
        </div>
    @endforeach

</body>

</html>
