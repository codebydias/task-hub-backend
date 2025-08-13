<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjetoUsuario
 * 
 * @property int $projeto_id
 * @property int $usuario_id
 * @property string|null $papel
 * 
 * @property Projeto $projeto
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class ProjetoUsuario extends Model
{
	protected $table = 'projeto_usuario';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'projeto_id' => 'int',
		'usuario_id' => 'int'
	];

	protected $fillable = [
		'papel'
	];

	public function projeto()
	{
		return $this->belongsTo(Projeto::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}
}
