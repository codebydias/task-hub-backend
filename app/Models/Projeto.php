<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Projeto
 * 
 * @property int $id
 * @property string $nome
 * @property string|null $descricao
 * @property int $dono_id
 * @property Carbon|null $criado_em
 * @property Carbon|null $atualizado_em
 * 
 * @property Usuario $usuario
 * @property Collection|Usuario[] $usuarios
 * @property Collection|Tarefa[] $tarefas
 *
 * @package App\Models
 */
class Projeto extends Model
{
	protected $table = 'projetos';
	public $timestamps = false;

	protected $casts = [
		'dono_id' => 'int',
		'criado_em' => 'datetime',
		'atualizado_em' => 'datetime'
	];

	protected $fillable = [
		'nome',
		'descricao',
		'dono_id',
		'criado_em',
		'atualizado_em'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'dono_id');
	}

	public function usuarios()
	{
		return $this->belongsToMany(Usuario::class)
					->withPivot('papel');
	}

	public function tarefas()
	{
		return $this->hasMany(Tarefa::class);
	}
}
