<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * 
 * @property int $id
 * @property string $uuid
 * @property string|null $civilite
 * @property string|null $firstname
 * @property string|null $name
 * @property string|null $username
 * @property string|null $email
 * @property string|null $telephone
 * @property string|null $fixe
 * @property string|null $sexe
 * @property Carbon|null $date_naissance
 * @property string|null $lieu_naissance
 * @property string|null $adresse
 * @property string|null $bp
 * @property string|null $fax
 * @property Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $image
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property int|null $professionnelles_id
 * @property int|null $familiales_id
 * @property string|null $remember_token
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Familiale|null $familiale
 * @property Professionnelle|null $professionnelle
 * @property Collection|Administrateur[] $administrateurs
 * @property Collection|Agent[] $agents
 * @property Collection|Beneficiaire[] $beneficiaires
 * @property Collection|Coment[] $coments
 * @property Collection|Commentaire[] $commentaires
 * @property Collection|Commentere[] $commenteres
 * @property Collection|Comment[] $comments
 * @property Collection|Comptable[] $comptables
 * @property Collection|Courrier[] $courriers
 * @property Collection|Demandeur[] $demandeurs
 * @property Collection|Employee[] $employees
 * @property Collection|Etablissement[] $etablissements
 * @property Collection|Gestionnaire[] $gestionnaires
 * @property Collection|Operateur[] $operateurs
 * @property Collection|Poste[] $postes
 * @property Collection|Profile[] $profiles
 * @property Collection|Imputation[] $imputations
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;
	use HasRoles;
	use SoftDeletes;
	use \App\Helpers\UuidForKey;
	protected $table = 'users';

	protected $casts = [
		'professionnelles_id' => 'int',
		'familiales_id' => 'int'
	];

	protected $dates = [
		'date_naissance',
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'uuid',
		'civilite',
		'firstname',
		'name',
		'username',
		'email',
		'telephone',
		'fixe',
		'sexe',
		'date_naissance',
		'lieu_naissance',
		'adresse',
		'bp',
		'fax',
		'email_verified_at',
		'password',
		'image',
		'created_by',
		'updated_by',
		'deleted_by',
		'professionnelles_id',
		'familiales_id',
		'remember_token'
	];

	protected static function boot(){
		parent::boot();
		static::created(function ($user){
			$user->profile()->create([
				'titre'	=>	'',
				'description'	=>	'',
				'url'	=>	''
			]);
		});
	} 

	public function getRouteKeyName()
	{
		return 'username';
	}

	public function familiale()
	{
		return $this->belongsTo(Familiale::class, 'familiales_id');
	}

	public function professionnelle()
	{
		return $this->belongsTo(Professionnelle::class, 'professionnelles_id');
	}

	public function administrateur()
	{
		return $this->hasOne(Administrateur::class, 'users_id');
	}

	public function agent()
	{
		return $this->hasOne(Agent::class, 'users_id');
	}

	public function beneficiaire()
	{
		return $this->hasOne(Beneficiaire::class, 'users_id');
	}

	public function coment()
	{
		return $this->hasOne(Coment::class, 'users_id');
	}

	public function commentaire()
	{
		return $this->hasOne(Commentaire::class, 'users_id');
	}

	public function commentere()
	{
		return $this->hasOne(Commentere::class, 'users_id');
	}

	public function comments()
	{
		return $this->morphMany(Comment::class, 'commentable')->latest();
	}

	public function comptable()
	{
		return $this->hasOne(Comptable::class, 'users_id');
	}

	public function courriers()
	{
		return $this->hasMany(Courrier::class, 'users_id')->latest();
	}

	public function demandeur()
	{
		return $this->hasOne(Demandeur::class, 'users_id')->latest();
	}

	public function employee()
	{
		return $this->hasOne(Employee::class, 'users_id')->latest()->latest();
	}

	public function etablissement()
	{
		return $this->hasOne(Etablissement::class, 'users_id');
	}
	
	public function gestionnaire()
	{
		return $this->hasOne(Gestionnaire::class, 'users_id');
	}

	public function operateur()
	{
		return $this->hasOne(Operateur::class, 'users_id')->latest();
	}

	public function postes()
	{
		return $this->hasMany(Poste::class, 'users_id')->latest();
	}

	public function profile()
	{
		return $this->hasOne(Profile::class, 'users_id');
	}

	public function imputations()
	{
		return $this->belongsToMany(Imputation::class, 'usersimputations', 'users_id', 'imputations_id')
					->withPivot('id', 'deleted_at')
					->withTimestamps();
	}
}
