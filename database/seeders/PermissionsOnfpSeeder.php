<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsOnfpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'courrier-list']);
        Permission::create(['name' => 'courrier-create']);
        Permission::create(['name' => 'courrier-edit']);
        Permission::create(['name' => 'courrier-delete']);

        Permission::create(['name' => 'profil-list']);

        Permission::create(['name' => 'facture-list']);
        Permission::create(['name' => 'facture-create']);
        Permission::create(['name' => 'facture-edit']);
        Permission::create(['name' => 'facture-delete']);

        Permission::create(['name' => 'module-list']);
        Permission::create(['name' => 'module-create']);
        Permission::create(['name' => 'module-edit']);
        Permission::create(['name' => 'module-delete']);

        Permission::create(['name' => 'formation-list']);
        Permission::create(['name' => 'formation-create']);
        Permission::create(['name' => 'formation-edit']);
        Permission::create(['name' => 'formation-delete']);
 
        Permission::create(['name' => 'role-list']);
        Permission::create(['name' => 'role-create']);
        Permission::create(['name' => 'role-edit']);
        Permission::create(['name' => 'role-delete']);
 
        Permission::create(['name' => 'user-list']);
        Permission::create(['name' => 'user-create']);
        Permission::create(['name' => 'user-edit']);
        Permission::create(['name' => 'user-delete']);
 
        Permission::create(['name' => 'comment-list']);
        Permission::create(['name' => 'comment-create']);
        Permission::create(['name' => 'comment-edit']);
        Permission::create(['name' => 'comment-delete']);
 
        Permission::create(['name' => 'coment-list']);
        Permission::create(['name' => 'coment-create']);
        Permission::create(['name' => 'coment-edit']);
        Permission::create(['name' => 'coment-delete']);
 
        Permission::create(['name' => 'commentaire-list']);
        Permission::create(['name' => 'commentaire-create']);
        Permission::create(['name' => 'commentaire-edit']);
        Permission::create(['name' => 'commentaire-delete']);
 
        Permission::create(['name' => 'commentere-list']);
        Permission::create(['name' => 'commentere-create']);
        Permission::create(['name' => 'commentere-edit']);
        Permission::create(['name' => 'commentere-delete']);
        
        Permission::create(['name' => 'demande-list']);
        Permission::create(['name' => 'demande-create']);
        Permission::create(['name' => 'demande-edit']);
        Permission::create(['name' => 'demande-delete']);
        
        Permission::create(['name' => 'operateur-list']);
        Permission::create(['name' => 'operateur-create']);
        Permission::create(['name' => 'operateur-edit']);
        Permission::create(['name' => 'operateur-delete']);
        
        Permission::create(['name' => 'ingenieur-list']);
        Permission::create(['name' => 'ingenieur-create']);
        Permission::create(['name' => 'ingenieur-edit']);
        Permission::create(['name' => 'ingenieur-delete']);

        Permission::create(['name' => 'evaluation-list']);
        Permission::create(['name' => 'evaluation-create']);
        Permission::create(['name' => 'evaluation-edit']);
        Permission::create(['name' => 'evaluation-delete']);

        Permission::create(['name' => 'etablissement-list']);
        Permission::create(['name' => 'etablissement-create']);
        Permission::create(['name' => 'etablissement-edit']);
        Permission::create(['name' => 'etablissement-delete']);

        Permission::create(['name' => 'projet-list']);
        Permission::create(['name' => 'projet-create']);
        Permission::create(['name' => 'projet-edit']);
        Permission::create(['name' => 'projet-delete']);

        Permission::create(['name' => 'pcharge-list']);
        Permission::create(['name' => 'pcharge-create']);
        Permission::create(['name' => 'pcharge-edit']);
        Permission::create(['name' => 'pcharge-delete']);
 
        Permission::create(['name' => 'employee-list']);
        Permission::create(['name' => 'employee-create']);
        Permission::create(['name' => 'employee-edit']);
        Permission::create(['name' => 'employee-delete']);
 
        Permission::create(['name' => 'individuelle-list']);
        Permission::create(['name' => 'individuelle-create']);
        Permission::create(['name' => 'individuelle-edit']);
        Permission::create(['name' => 'individuelle-delete']);
 
        Permission::create(['name' => 'collective-list']);
        Permission::create(['name' => 'collective-create']);
        Permission::create(['name' => 'collective-edit']);
        Permission::create(['name' => 'collective-delete']);
 
        // create roles and assign created permissions
 
        // this can be done as separate statements
        $role = Role::create(['name' => 'Beneficiaire']);
        $role->givePermissionTo('demande-list', 'demande-edit', 'demande-delete', 'module-list');

        $role = Role::create(['name' => 'Ageroute']);
        $role->givePermissionTo('demande-list', 'demande-create', 'demande-edit', 'module-list');
 
        // or may be done by chaining
        $role = Role::create(['name' => 'Courrier']);
        $role->givePermissionTo(['courrier-list', 'courrier-create', 'courrier-edit', 'courrier-delete', 'demande-list',  'demande-create', 'demande-edit', 'module-list']);

        $role = Role::create(['name' => 'ACourrier']);
        $role->givePermissionTo(['courrier-list', 'courrier-create', 'courrier-edit', 'module-list']);
 
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Administrateur']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'DG']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Gestionnaire']);
        $role->givePermissionTo(['courrier-list', 'courrier-create', 'courrier-edit', 'courrier-delete', 'demande-list',  'demande-create', 'demande-list', 'demande-edit', 'demande-delete', 'module-list']);

        $role = Role::create(['name' => 'Demandeur']);
        $role->givePermissionTo(['pcharge-list', 'pcharge-create', 'pcharge-edit', 'individuelle-list', 'individuelle-create', 'individuelle-edit', 'collective-list', 'collective-create', 'collective-edit']);


        $role = Role::create(['name' => 'Etablissement']);
        $role->givePermissionTo(['etablissement-list', 'etablissement-create', 'etablissement-edit', 'etablissement-delete']);

        $role = Role::create(['name' => 'Operateur']);

        $role = Role::create(['name' => 'Individuelle']);
        $role->givePermissionTo(['individuelle-list', 'individuelle-create', 'individuelle-edit']);

        $role = Role::create(['name' => 'Collective']);
        $role->givePermissionTo(['collective-list', 'collective-create', 'collective-edit']);
        
        $role = Role::create(['name' => 'Pcharge']);
        $role->givePermissionTo(['pcharge-list', 'pcharge-create', 'pcharge-edit']);

        $role = Role::create(['name' => 'Comptable']);
        $role->givePermissionTo('facture-list', 'facture-create', 'facture-edit', 'facture-delete', 'formation-list', 'operateur-list', 'module-list');

        $role = Role::create(['name' => 'AComptable']);
        $role->givePermissionTo('facture-list', 'facture-create', 'facture-edit', 'formation-list', 'operateur-list', 'module-list');

        $role = Role::create(['name' => 'DIOF']);
        $role->givePermissionTo('ingenieur-list', 'ingenieur-create', 'ingenieur-edit', 'ingenieur-delete', 'formation-list', 'formation-create', 'formation-edit', 'formation-delete', 'pcharge-list', 'pcharge-create', 'pcharge-edit', 'pcharge-delete', 'etablissement-list', 'etablissement-create', 'etablissement-edit', 'etablissement-delete', 'projet-list', 'module-list');

        $role = Role::create(['name' => 'PCDIOF']);
        $role->givePermissionTo('pcharge-list', 'pcharge-create', 'pcharge-edit', 'pcharge-delete', 'etablissement-list', 'etablissement-create', 'etablissement-edit', 'etablissement-delete', 'module-list');

        $role = Role::create(['name' => 'ADIOF']);
        $role->givePermissionTo('formation-list', 'formation-edit', 'module-list');

        $role = Role::create(['name' => 'DEC']);
        $role->givePermissionTo('evaluation-list', 'evaluation-create', 'evaluation-edit', 'evaluation-delete', 'operateur-list', 'operateur-create', 'operateur-edit', 'operateur-delete', 'formation-list', 'projet-list', 'module-list');

        $role = Role::create(['name' => 'ADEC']);
        $role->givePermissionTo('evaluation-list', 'evaluation-create', 'evaluation-edit', 'operateur-list', 'operateur-create', 'operateur-edit', 'formation-list', 'module-list');

        $role = Role::create(['name' => 'Ingenieur']);
        $role->givePermissionTo('formation-list', 'formation-edit', 'module-list');

        $role = Role::create(['name' => 'COM']);
        $role->givePermissionTo('formation-list', 'projet-list', 'evaluation-list', 'module-list');

        $role = Role::create(['name' => 'ACOM']);
        $role->givePermissionTo('formation-list', 'projet-list', 'evaluation-list', 'module-list');

        $role = Role::create(['name' => 'Visiteur']);
        $role->givePermissionTo('formation-list', 'projet-list', 'module-list', 'module-list');

        $role = Role::create(['name' => 'DAF']);
        $role->givePermissionTo(['courrier-list', 'courrier-create', 'courrier-edit', 'courrier-delete', 'demande-list', 'employee-list',  'employee-create', 'employee-edit', 'employee-delete', 'projet-list', 'pcharge-list', 'module-list']);

        $role = Role::create(['name' => 'FDAF']);
        $role->givePermissionTo(['courrier-list', 'courrier-create', 'courrier-edit', 'courrier-delete', 'demande-list'], 'module-list');

        $role = Role::create(['name' => 'RHDAF']);
        $role->givePermissionTo(['courrier-list', 'courrier-create', 'courrier-edit', 'courrier-delete', 'demande-list', 'employee-list',  'employee-create', 'employee-edit', 'employee-delete', 'module-list']);

        $role = Role::create(['name' => 'LOGDAF']);
        $role->givePermissionTo(['courrier-list', 'courrier-create', 'courrier-edit', 'courrier-delete', 'demande-list'], 'module-list');
        
        $role = Role::create(['name' => 'DPP']);
        $role->givePermissionTo('formation-list', 'operateur-list', 'projet-list', 'projet-create', 'projet-edit', 'projet-delete', 'etablissement-list', 'module-list');

        $role = Role::create(['name' => 'ADPP']);
        $role->givePermissionTo('formation-list', 'operateur-list', 'module-list');

        $role = Role::create(['name' => 'PRDPP']);
        $role->givePermissionTo('formation-list', 'operateur-list', 'projet-list', 'projet-create', 'projet-edit', 'projet-delete', 'module-list');

        $role = Role::create(['name' => 'PLDPP']);
        $role->givePermissionTo('formation-list', 'operateur-list', 'projet-list', 'module-list');

        $role = Role::create(['name' => 'Consultant']);
        $role->givePermissionTo('formation-list', 'operateur-list', 'module-list');

        $role = Role::create(['name' => 'SUIVI']);
        $role->givePermissionTo('formation-list', 'operateur-list', 'module-list');

        $role = Role::create(['name' => 'EVDEC']);
        $role->givePermissionTo('formation-list', 'operateur-list', 'module-list');

        $role = Role::create(['name' => 'SAOS']);
        $role->givePermissionTo('pcharge-list', 'pcharge-create', 'pcharge-edit', 'pcharge-delete');

        $role = Role::create(['name' => 'ASAOS']);
        $role->givePermissionTo('pcharge-list', 'pcharge-create', 'pcharge-edit');

        $role = Role::create(['name' => 'Nologin']);
    }
}
