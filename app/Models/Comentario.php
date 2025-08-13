<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comentario
 * 
 * @property int $id
 * @property int $tarefa_id
 * @property int $usuario_id
 * @property string $conteudo
 * @property Carbon|null $criado_em
 * 
 * @property Tarefa $tarefa
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class Comentario extends Model
{
	protected $table = 'comentarios';
	public $timestamps = false;

	protected $casts = [
		'tarefa_id' => 'int',
		'usuario_id' => 'int',
		'criado_em' => 'datetime'
	];

	protected $fillable = [
		'tarefa_id',
		'usuario_id',
		'conteudo',
		'criado_em'
	];

	public function tarefa()
	{
		return $this->belongsTo(Tarefa::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}
}
