<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class Usuario
 * 
 * @property int $id
 * @property string $nome
 * @property string $email
 * @property string $senha
 * @property string|null $papel
 * @property Carbon|null $criado_em
 * @property Carbon|null $atualizado_em
 * 
 * @property Collection|Comentario[] $comentarios
 * @property Collection|Projeto[] $projetos
 * @property Collection|Tarefa[] $tarefas
 *
 * @package App\Models
 */
class Usuario extends Model implements JWTSubject
{
	protected $table = 'usuarios';
	public $timestamps = ['atualizado_em', true];


	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	public function getJWTCustomClaims()
	{
		return [
			'nome' => $this->nome,
			'email' => $this->email,
			'papel' => $this->papel ?? 'membro',
		];
	}

	protected $casts = [
		'criado_em' => 'datetime',
		'atualizado_em' => 'datetime'
	];

	protected $fillable = [
		'nome',
		'email',
		'senha',
		'papel',
		'criado_em',
		'atualizado_em'
	];

	public function comentarios()
	{
		return $this->hasMany(Comentario::class);
	}

	public function projetos()
	{
		return $this->hasMany(Projeto::class, 'dono_id');
	}

	public function tarefas()
	{
		return $this->hasMany(Tarefa::class, 'responsavel_id');
	}
}
