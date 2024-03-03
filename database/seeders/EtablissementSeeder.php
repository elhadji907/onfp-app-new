<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Etablissement;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtablissementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {

        
        Etablissement::factory()
            ->count(0)
            ->create();

        /*
         DB::table('etablissements')->insert([
        'name' => "LES COURS DU SUD",
        'communes_id' => "525",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "CENTRE DE FORMATION PROFESSIONNELLE DE AMA",
        'communes_id' => "525",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "CENTRE PRIVE DE FORMATION PROFESSIONNELLE SATANG DIABANG",
        'communes_id' => "525",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "CENTRE TECHNOLOGIQUE ET PROFESSIONNEL SAINT ELOI",
        'communes_id' => "525",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "ECOLE DE COIFFURE LA FRANCISCAINE",
        'communes_id' => "525",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "INSTITUT DE BEAUTE SIGNARE",
        'communes_id' => "525",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Centre Ménager Familial du Saint Sacrement ",
        'communes_id' => "525",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "INSTITUT SUDINFO",
        'communes_id' => "525",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "IPSQ",
        'communes_id' => "525",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "CFP KAYADJ albadar",
        'communes_id' => "525",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "CPFP ZIGUINCHOR",
        'communes_id' => "525",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "IFGE ZIGUINCHOR",
        'communes_id' => "525",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Centre Polyvalent de Formation Professionnelle Hôtellerie Restauration et Santé (CPFPHRS)",
        'communes_id' => "525",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Collége Saint Charles Lwanga (CSCL)",
        'communes_id' => "525",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Ecole Internationale de Coiffure François Mitterand (EICFM)",
        'communes_id' => "525",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Zig-Vision (ZV)",
        'communes_id' => "525",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "SAINT ANTOINE DE PADOUE ZIG",
        'communes_id' => "525",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);


         DB::table('etablissements')->insert([
        'name' => "CENTE DE FORMATION FREDERIC OZANAM",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Centre Don Bosco / THIES",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Centre de Formation professionnelle en Informatique CFPIG",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "ECOLE SUPERIEUR DES TECHNOLOGIES INFORMATIQUES: ESTI",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "GME",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Institut Supérieur à Filières Multiples ISFM",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Institut Supérieur Polytechnique (ISP)",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "IPAIM – THIES",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Keur Yaakaar",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Haute Etudes de Management HEM",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "CIFOP de Mboro",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "CENTRE de Formation Professionnel et d'innovation Pédagogique (CPIP)",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "ISSIG THIES",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "AFITEL-Formation",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "centre de formation,d'application et d'incubation aux métiers du photovoltaîque",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "CAFMIG",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "RESOPP",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Ecole Supérieure Internationale des Praticiens de la Santé",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Institut de Formation en Sciences infirmières et techniques Sanitaires",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Ecole de Santé Banti Mame Yallah",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Ecole des Sage Femme, des Infirmiers et des Assistants Infirmiers",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "ISMS",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "ISFAP (Tivaouane)",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Ecoles d'Infirmiers et Infirmières 'Monseigneur Dione'",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Institut Supérieur de Santé de Mbour",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Complexe Privé de Formation Professionnelle/Mbour",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "American Institute",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "FOYER CLAIRE AMITIE",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "IFPPS CROIX ROUGE",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "CRITERIUM ",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "EFHTRA MBOUR",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "IFHT MBOUR",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "CFTP/MAME CHEIKH ALASSANE SENE",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Institut Supérieur de Culture et d’Entreprenariat pour la Renaissance (ISCER)",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Elite Ecole Hôtelière et Touristique (EEHT)",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Mame Abdoul Aziz Sy Dabakh",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Criterium Thiés (CT)",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Lycée d’Orientation Scientifique et Technique (LOST)",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "AFIP",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "BABELE Coiffure",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "CENTRE DE FORMATION PROFESSIONNELLE ABBE DAVID BOILAT MBOUR",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Ecole Privée de Formation 'Ecole Supérieure des Technologies Informatiques' E.S.T.I",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "IMAIS",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Institut Africain de Développement Local IADL",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Institut supérieur de formation technique et professionnelle(ISFTP)",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Institut Technique de Gestion(ITEG)",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "XAMTIC CENTER",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "cestp",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Ecole Ecologiques Agroalimentaire du Sénégal(EMAAS)",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Institut Supérieur de culture et d'entreprenariat pour la renaissance (ISCER)",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Elite Ecole Hotelière  et Touristique (EEHT)",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Groupe Lina Nankasa(GLN) Académie",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 DB::table('etablissements')->insert([
        'name' => "Institut Supérieur d'Administration des Entreprises (ISAE)",
        'communes_id' => "475",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);




          DB::table('etablissements')->insert([
        'name' => "CENTRE DE FORMATION YOONU NJUB",
        'communes_id' => "347",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
  DB::table('etablissements')->insert([
        'name' => "GROUPE CAFIT SAINT-LOUIS",
        'communes_id' => "347",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
  DB::table('etablissements')->insert([
        'name' => "Keur Mame Fatim Konté",
        'communes_id' => "347",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
  DB::table('etablissements')->insert([
        'name' => "Université Kocc Barma",
        'communes_id' => "347",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
  DB::table('etablissements')->insert([
        'name' => "YA SALAM",
        'communes_id' => "347",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
  DB::table('etablissements')->insert([
        'name' => "CENTRE DE FORMAION PROFESSIONELLE D. BOSCO",
        'communes_id' => "347",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
  DB::table('etablissements')->insert([
        'name' => "centre de formation professionnelle et ecologique alioune diagne mbor(CFPE)",
        'communes_id' => "347",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
  DB::table('etablissements')->insert([
        'name' => "cours privé alioune badara diagne dit golbert",
        'communes_id' => "347",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
  DB::table('etablissements')->insert([
        'name' => "centre social saint michel CSSM PODOR",
        'communes_id' => "347",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
  DB::table('etablissements')->insert([
        'name' => "Etablissement Supérieur Professionnel de Formation en Santé de St Louis",
        'communes_id' => "347",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
  DB::table('etablissements')->insert([
        'name' => "Ecole des Métiers du Son et de l'Image (EMSI)",
        'communes_id' => "347",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
  DB::table('etablissements')->insert([
        'name' => "Groupe Scolaire Khadimou Rassoul (GSKR)",
        'communes_id' => "347",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
  DB::table('etablissements')->insert([
        'name' => "Lycée Amadou Sow Ndiaye (LASN)",
        'communes_id' => "347",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
  DB::table('etablissements')->insert([
        'name' => "Lycée Papa Mar Diop (LPMD)",
        'communes_id' => "347",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
  DB::table('etablissements')->insert([
        'name' => "cours privé alioune badara diagne dit golbert",
        'communes_id' => "347",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
  DB::table('etablissements')->insert([
        'name' => "MCDES-Madiba",
        'communes_id' => "347",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
  DB::table('etablissements')->insert([
        'name' => "Institut des Métiers et Sciences Appliquées du Sénégal (IMSAS)",
        'communes_id' => "347",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);


           DB::table('etablissements')->insert([
        'name' => "Ndiambour Informatique Plus (NIP)",
        'communes_id' => "266",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
           DB::table('etablissements')->insert([
        'name' => "centre de formation Mame thierno birahim MBACKE",
        'communes_id' => "266",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

           DB::table('etablissements')->insert([
        'name' => "OPPORTUNITY FOR ALL (OFA)",
        'communes_id' => "226",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
   DB::table('etablissements')->insert([
        'name' => "SOURCE DU SAVOIR",
        'communes_id' => "226",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

   DB::table('etablissements')->insert([
        'name' => "INSTITUT PRIVE DE SANTE YABO DIAO",
        'communes_id' => "226",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
   DB::table('etablissements')->insert([
        'name' => "Institut des Sciences de la Santé  (ISSA)",
        'communes_id' => "226",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
   DB::table('etablissements')->insert([
        'name' => "Le Bon Samaritain (LBS)",
        'communes_id' => "226",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
   DB::table('etablissements')->insert([
        'name' => "Lycée Baba Larry Seck",
        'communes_id' => "226",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);


         DB::table('etablissements')->insert([
        'name' => "Delta Informatique Services",
        'communes_id' => "166",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
         DB::table('etablissements')->insert([
        'name' => "I.F.P.S KOUNDAM",
        'communes_id' => "166",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
         DB::table('etablissements')->insert([
        'name' => "Institut Polytechnique des Affaires du Commerce(IPAC)",
        'communes_id' => "166",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
         DB::table('etablissements')->insert([
        'name' => "Institut supérieur des technologies de l’information et de la communication-qualité informatique",
        'communes_id' => "166",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
         DB::table('etablissements')->insert([
        'name' => "Institut Technico commercial de Kaolack",
        'communes_id' => "166",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
         DB::table('etablissements')->insert([
        'name' => "Ecole privée de Formation en coiffure et esthétique Fatou Sarr",
        'communes_id' => "166",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
         DB::table('etablissements')->insert([
        'name' => "Institut d'Ingénierie Informatique ",
        'communes_id' => "166",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
         DB::table('etablissements')->insert([
        'name' => "Ecole Privée de Formation en Coiffure et Esthétique wa keur mame cheikh anta Fatou Diongue",
        'communes_id' => "166",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
         DB::table('etablissements')->insert([
        'name' => "Centre Claire Amitié Kaolack",
        'communes_id' => "166",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
         DB::table('etablissements')->insert([
        'name' => "El Hadji Hery Diouf (EHD) Ngascka Wally",
        'communes_id' => "166",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
         DB::table('etablissements')->insert([
        'name' => "Centre Consulaire de Formation Professionnelle (CCIAK)",
        'communes_id' => "166",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
         DB::table('etablissements')->insert([
        'name' => "Centre de Formation Professionnelle Technoplus du  Sine Saloum (CFPTSS)",
        'communes_id' => "166",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
         DB::table('etablissements')->insert([
        'name' => "Alliance local pour la formation d’agricultures de nouvelle génération (ALFANG)",
        'communes_id' => "166",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
         DB::table('etablissements')->insert([
        'name' => "Cours Privés 'Mbountou Sow'",
        'communes_id' => "166",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
         DB::table('etablissements')->insert([
        'name' => "ORBIT INFORMATIQUE",
        'communes_id' => "166",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
         DB::table('etablissements')->insert([
        'name' => "Techno plus du Saloum",
        'communes_id' => "166",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
         DB::table('etablissements')->insert([
        'name' => "El Hadji Hery Diouf (HED)",
        'communes_id' => "166",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
        

        DB::table('etablissements')->insert([
        'name' => "ISI DE KAFFRINE",
        'communes_id' => "133",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre de Formation Professionnelle et Technique (CFPT)",
        'communes_id' => "93",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre de Formation Agricole Ndiébel et Babou DIOUF",
        'communes_id' => "93",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
        DB::table('etablissements')->insert([
        'name' => "Institut Sénégalaise des Métiers de l'Agroalimentaire (ISMA)",
        'communes_id' => "93",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
        DB::table('etablissements')->insert([
        'name' => "Complexe Privé Source du Savoir",
        'communes_id' => "93",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
        DB::table('etablissements')->insert([
        'name' => "Centre de Formation Professionnelle et Technique de Fatick (CFPTF)",
        'communes_id' => "93",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);


        DB::table('etablissements')->insert([
        'name' => "Centre Privé de Formation Commerciale du BAOL",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "centre d'enseignement sokhna faty modou mame",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "GAYDEL COIFFURE FORMATION",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "selly-ya institut",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Complexe Cheikh Mouhamadou Fadal Pour l’Education et la Formation (CCMFEF",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole de couture Serigne Saliou MBACKE",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Complexe Sanitaire Cheikh Ahmadou BAMBA",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "CISCO ACADEMY LOCAL  MOUBARAK LEARNING CENTRE BAOL",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "INSTITUT PRIVE AL BARAKA(IPAB)",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ITM DIOURBEL",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Supérieur Africain de Formations Spécialisées (ISFOS)",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole Privée Franco-Arabe Cheikh Ahmadou Bamba MBACKE (EPCAB)",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Groupe Scolaire Fallou Gallas (GSFG)",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut de Formation Sanitaire de Mbacké (IFSAM)",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Complexe Cheikh Mouhamadou Fadal Pour l’Education et la Formation (CCMFEF",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole de couture Serigne Saliou MBACKE",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "institut professionnel de gestion et de restauration",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Gandiol Coiffure",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre d'Ecellence du Baol",
        'communes_id' => "53",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        



        DB::table('etablissements')->insert([
        'name' => "Collège Saint Michel",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ESTHOS-IMED",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Privé de Gestion  'IPG '",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 
        DB::table('etablissements')->insert([
        'name' => "SUN Hi-Tech3 Africa '",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Académie Internationale de Coiffure et d’Esthétique (EXOCOIF)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Alliance Générale des Informaticiens Formateurs (AGIF Informatique",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "AND BOOLO XAMLE (ABX)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Association des Retraités du Matériel des Armées ARMATA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ATELIER DES DELICES",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "CALEBASSE DOREE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre d’Accompagnement et de Mise à Niveau (CAMAN)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "CENTRE D'APPUI A L'INITIATIVE FEMINIE (CAIF)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "CENTRE DE TECHNOLOGIE ET d'INGENIERIE/ECOLE DES SCIENCES DU COMMERCE ET DE l'INFORMATION (CTI/ESCI)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre européenne de formation en énergie renouvelable (CEFER)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "CENTRE POLYVALENT DE FORMATION PROFESSIONNELLE EN HOTELLERIE RESTAURATION ET TOURISME (CPFP/HR)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Santé Service ISS",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "COLLECTIF SENEGALAIS POUR LA FORMATION (COSEFOR)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "COMPLEXE EVA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "CTA SAINT-MONT FORT ",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "CUIM",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "DOT HOME INSTITUT",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole des Hautes Etudes de Gestion (EHG)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole Privée Maritime (EPRIM)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ECOLE SUPERIEUR DES TECHNIQUES DE GESTION ESTG",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ECOLE SUPERIEUR INTERNATIONALE DE TOURISME ET D'HOTELLERIE / ESITH",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole Supérieure d’Electricité, de Bâtiment et des Travaux Publics (ESEBAT)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole Supérieure d’Informatique Appliquée ESIA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole Supérieure de Commerce et de Gestion ESUP",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ECOLE SUPERIEURE DE GENIES ESGE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole supérieure de management stratégique (ESMS)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ECOLE SUPERIEURE DES NOUVELLES TECHNOLOGIES (ESNT)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "FINAMA BUSINESS SCHOOL",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "HAUTE ECOLE DE MANAGEMENT ET DE L'INFORMATIQUE HEMI",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "HECM Hautes Etudes de Coaching et de Management",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "HEPO",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IFMA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut de Formation en Assurances et Gestion des Entreprises IFAGE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut de Management et de Technologie IMTECH",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "INSTITUT CESAR",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Communautaire Africain de gestion et d’ingénierie ICAGI",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut de Formation Aux Métiers Des Sports (IFM-SPORTS)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "INSTITUT DE FORMATION EN ADMINISTRATION DES AFFAIRES",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "INSTITUT DE FORMATION EN TOURISME ET DE RESTAURATION (IFTR)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut des Ingénieurs en Informatique I3T",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "INSTITUT DES METIERS DE LA MODE (I2M)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut des Sciences et Métiers de la Mode ISMOD",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "institut professionnel d'entreprise (IPE)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Sénégalais de Boulangerie et de Pâtisserie (ISBP)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Supérieur d’Entrepreneurship et de Gestion ISEG",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "INSTITUT SUPERIEUR DE COMMERCE ET DE MANAGEMENT (ISCOM)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Supérieur de Formation aux Nouveaux Métiers Informatique et Communication ( UP TECH)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Supérieur de Formation aux nouveaux Métiers informatique et communication (UNIPRO",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Supérieur de Formation et d’Appui à l’Insertion (ISFAP)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "INSTITUT SUPERIEUR DE TECHNOLOGIES (SUPTECH)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Supérieur d'Informatique « ISI »",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Supérieur Privé de Management et d’Etude Commerciales(ISMEC)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Universitaire de l’Entreprise et du Développement (IUED)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IPD Thomas Sankara",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IPROSI",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "LA SOURCE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Les Ecoles de Développement (EDD)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "LES MARMITONS",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "POROKHANE COIFFURE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "SUPGES",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "SUP-INFO",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Universat",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Polyvalent de Formation Professionnelle yasser arafatIPFP",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Technique de Commerce (ITECOM)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "CPFP ASAFIN",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut de Formation Professionnelle ' Institut Sainte Jeanne D'Arc-Post BAC",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ISCA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "SUPTEC BATIS",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "New Africa Training ( Les écoles du Développement)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "BSA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ESAS",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IFPM Rufisque",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut SABRARIFA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "XALIMA COUTURE FORMATION",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Olan CENTER ",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ESUMAQ",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre Coaching Africain",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut de génie rural et de l'environnement(IGRE)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "institut des métiers du droit et de l'immobilier(IMDI)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "AMDI",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "CEFAS",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Hautes Etudes en Technologie et Administration des Affaires(HETAA)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole Supérieure de Management (ESM)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Université Nelson Mandela (UNM)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Supérieur en Ecovillage Design",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Supérieur d'Ingénieur et de Formation",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre de Formation Fantasika",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "CERFA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Gestion des Carrières IGCP",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "institut Professionnel de Formation en Sciences de la Santé (IPFOSS)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Supérieur des Sciences de la Santé",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole de Santé Paul CORREA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Professionnel en Santé IPS",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut de santé FIDELIA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut de Santé et des Etudes Paramédicales",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut de Santé Plus Privé (ISPP)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Socio- Sanitaire d’Apprentissage Professionnel ISSAP",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "EFO SANTE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Universitaire Professionnelle en Santé",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IASM",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IFPS",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "PERFORM",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ASSAPE-CEPPE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ENSUP AFRIQUE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Groupe Consultance Conseil Formations Hautes Etudes (G2CFOR)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "2IFA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "2IM",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "COMPLEXE YACINE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "EMD",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "EPACS",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IDM",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IICA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Sénégal Business School",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IMFA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "COMPUTECH INSTITUTE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "EPISE-IMS",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Université Kéba",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IPH",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IBST",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Supérieur des Arts et des Métiers Numériques",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Bill Job Institute",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Afia Center",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "JPAC",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Maison d'Education Athena ",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "HEKIMA SANTE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Mirador Formation",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole Internationale des Affaires (EIA)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut de Formation Professionnelle en Esthétique (IFPE)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre Social d’Entraide et d’Information (CSEI)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut de Formation Hôtelière de Ouakam (IFHO)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Complexe Sokhna Assiétou/Excellence",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Enda Graf Sahel",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole de Formation en Sécurité Privée (EFSP)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole des Métiers Agro écologiques, Agroalimentaires du Sénégal (EMAAS",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "E221",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "CEFAS SANTE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Cours Privés Exponentiel",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre Socio-Educatif Keur Don Bosco (CSE-KDB)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre Trainamar de Dakar (CTD)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Dakar Air Academy (DAA)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Supérieur d’Ingénierie et de Formation-Business School (ISIF-BS)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Lycée d'Excellence Mahmady (LEM)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre Technique d' Apprentissage Saint Montfort (CTASM)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole Supérieure de Commerce et des Affaires(ESCA)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecomode-Plus (EP)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Francophone Business School-Dakar ( FBS-DAKAR)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Complexe Prince Coiffure (CPC)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Complexe Taaru Ndeye Niang (CTNN)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Cours Secondaire des Parcelles Assainies",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Dakar Business School (DBS)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole Supérieure de Logistique et des Transports (ESLOT)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole Supérieure de Management de Télécommunication d'Informatique et de Certification (ESMTIC)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Supérieur de Formation Professionnelle Ibni Academy (ISFPIA)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 
        DB::table('etablissements')->insert([
        'name' => "AMDI INGENIERIE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 
        DB::table('etablissements')->insert([
        'name' => "'Institut de Commerce et Management (ICM)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
 
        DB::table('etablissements')->insert([
        'name' => "'Institut de Formation de Secrétaires et de Comptables",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "« Ecole Supérieur de l’Immobilier »(SUP-IMMO",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "African Aviation Incoporation (2AI)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "African Business School",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "américan institute for english language and entreneurship",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ANPS",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "bakeli school of technologie",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "CABIS SCHOOL",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "centre bioforce Afrique",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre de formation aux métiers de la sécurité",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "CENTRE DE FORMATION BOKK- DIOM",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre international supérieur aux techniques de soudage (CIS)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre Privé Protestant de Formation Professionnelle",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "COMPLEXE MAWA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ECOLE INTERNATIONALE D'ESTHETIQUE (E.I.E)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole Professionnelle des Métiers de l'UPAM",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Etudes Harmonies Acoustique (EHA)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Groupe Scolaire  'LES PEDAGOGUES '",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "HEG",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IESMD",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IMAN",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Académique des Bébés (IAB)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "INSTITUT DE FORMATION AUX METIERS DE L'ENSEIGNEMENT IFMEN",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "INSTITUT DE FORMATION DE PERSONNEL NAVIGANT DE CABINE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut de Formation et d'Assistance (AFI",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut International des Sciences et de Technologie",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "INSTITUT PANAFRICAINE DE MARKETING: IPAM",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut polytechnique du sahel(IPDS)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "INSTITUT SUPERIEUR D'ADMINISTRATION ET DE GESTION",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Supérieur de Formation, d'Etudes, de conseils et de services(IFEC)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "INSTITUT SUPERIEUR D'ENSEIGNEMENT TECHNIQUE ET PROFESSIONNEL",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Supérieur d'Ingénieur et de Formation",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institution PAPA GUEYE FALL",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "International Best Sécurity",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ISCM",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ISDL",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ISIT-A",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ISPAG",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ISTE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ITTE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "La Désirade",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ma formation serrurerie et ajustage clé",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "sonatel Académy",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "SUPER 3 D",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "THYLIANE ACADEMIE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Union pour la solidarité et l'entraide/Centre Ahmadou Malick Gaye",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "UNIVERS DE LA MODE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Université Africaine de Technologie et de Gestion(UATG)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Université Europe Afrique",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Africain des Etudes du Développement (IAED)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole Supérieure Aéronautique (ESA)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Cours Privés Exponentielle (CPE)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ami Onglerie",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Mirador Formation",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "AFRICOM/av",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut International de l'Entreprise (2IE)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IT Shool",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Etablissements",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre Privé de Formation Commerciale du BAOL",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "CENTRE SOCIO CULTUREL DE FORMATION PROFESSIONNELLE /SUNUGAL",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "CENTRE D'INFORMATIQUE ET DE GESTTION APPLIQUEE (CIGA)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "COMPLEXE MAWA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "HAUTE ECOLE DE COUPE COUTURE HECC",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IACOM- PIKINE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ICONE COM",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "KER KEN CAP SUR L'AVENIR",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "MBALLANE COUTURE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre de Qualification Professionnelle CQP",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Supérieur Privé de Management",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ngayenne Coiffure Formation",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "FOYERS SHAMA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IGI",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "SENSYS-ACADEMIE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Timbereng School",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut de Formation Hôtelière (IFH)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "AMES",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut de Formation Professionnel aux métiers émergeants",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Complexe coiffure Biaritz",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut de Formation aux Carrières de Santé",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Al HAMDOULILAHI Couture",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ATAC FORMATION",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "LA REFERENCE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "CERT KEUR MASSAR",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "CFPA - ADS MBAO",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IFPT Keur Mbaye Fall",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IBS ",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IF3S",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole de Formation en santé EFSA Baobab",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole Hotellière de Gastromie Communale ",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "La plus belle",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Collège Technique  'Ibra Seck '",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "JEUNESSE CULTURE LOISIRS TECHNIQUES INTERVENTTIONS SOCIALES (JCLTIS)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "CENTRE DE FORMATION AIDA COUTURE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ECOLE DES CHANTIERS STYLE ART",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "EDITION COMMUNICATION (EDICOM)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Wa Kêr Gi '",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre International de Formation de Danses Traditionnelles et Contemporaines  ' Ecole de Sables '",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IFITSA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Complexe Sagesse (Coiffure-Couture)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "centre privé de formaton professionnelle des enseignants(CPFPE)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "auto académie",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole Internationale de Biologie Appliquée EIBA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre de formation et de perfectionnement en santé de Rufisque",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IPCI",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Socio Saanitaire Professionnel aux Métiers de la Santé (ISPMS)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Complexe de Beauté Union Africaine (CBUA)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Complexe Royaume de l'Elégance (CRE)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole de Formation Professionnelle Tapis-Rouge (EFPTR)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "EFMA ECOLE DE FORMATION DES METIERS DE L'AVENIR",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Groupe Scolaire la Maïeutique (GSM)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Africain des Sciences Sociales Mame Diarra Bousso (IASSMDB)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre de Formation Professionnelle Complexe de Couture et Coiffure  'Idoles ' (CFPCCC)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Groupe Institut Elite-EBS Elite Business School (GIE-EBS)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Univers de la Mode",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Angelas Davis",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Groupe Scolaire Educazur (GSE)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ndjiliwene Couture (NC)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Complexe Mame Soda",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Global Energie Ecole de formation professionnelle et technique",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Brunello Bertoni",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "centre de formation professionnelle et de perfectionnement aux métiers de l'industrie",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Centre Féminin de Formation Technique Communautaire de pikine",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "COMPLEXE ADJA YACINE COIFFURE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "COMPLEXE ASSALY",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "COPEL",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Ecole des métiers de la Couture",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "ESICOM",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "GLOBAL TECHNOLOGIY ASSISTANCE (GTA)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "GROUPE SCOLAIRE LE BAOBAB",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "GROUPE SCOLAIRE MASAMBA",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "GROUPE SYNERGIE MANAGEMENT",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IACOM- PIKINE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IFCE/ PALAIS DE LA BEAUTE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "IFPM",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Hair Universal",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "institut supérieur et professionnel de l'emploi(ISPE)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "LA RIVE DU SAVOIR",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "LA RUAH",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "LA SOSSO",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "TECHNISYS INFORMATIQUE",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);

        DB::table('etablissements')->insert([
        'name' => "Institut Africain Futurs Métiers (IAFM)",
        'communes_id' => "1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]); */
    }
}
