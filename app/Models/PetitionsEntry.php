<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Jul 2017 18:24:10 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PetitionsEntry
 * 
 * @property int $id
 * @property int $petition_id
 * @property bool $gender
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Petition $petition
 *
 * @package App\Models
 */
class PetitionsEntry extends Eloquent
{
	protected $casts = [
		'petition_id' => 'int',
		'gender' => 'char'
	];

	protected $fillable = [
		'petition_id',
		'gender',
		'email',
		'first_name',
		'last_name'
	];

	public function petition()
	{
		return $this->belongsTo(\App\Models\Petition::class);
	}
}
