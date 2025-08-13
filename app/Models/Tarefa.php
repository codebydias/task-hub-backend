<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tarefa
 * 
 * @property int $id
 * @property int $projeto_id
 * @property string $titulo
 * @property string|null $descricao
 * @property string|null $status
 * @property string|null $prioridade
 * @property int|null $responsavel_id
 * @property Carbon|null $data_entrega
 * @property Carbon|null $criado_em
 * @property Carbon|null $atualizado_em
 * 
 * @property Projeto $projeto
 * @property Usuario|null $usuario
 * @property Collection|Comentario[] $comentarios
 *
 * @package App\Models
 */
class Tarefa extends Model
{
	protected $table = 'tarefas';
	public $timestamps = false;

	protected $casts = [
		'projeto_id' => 'int',
		'responsavel_id' => 'int',
		'data_entrega' => 'datetime',
		'criado_em' => 'datetime',
		'atualizado_em' => 'datetime'
	];

	protected $fillable = [
		'projeto_id',
		'titulo',
		'descricao',
		'status',
		'prioridade',
		'responsavel_id',
		'data_entrega',
		'criado_em',
		'atualizado_em'
	];

	public function projeto()
	{
		return $this->belongsTo(Projeto::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'responsavel_id');
	}

	public function comentarios()
	{
		return $this->hasMany(Comentario::class);
	}
}
