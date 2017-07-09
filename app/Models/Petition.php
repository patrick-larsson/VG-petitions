<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Jul 2017 18:24:10 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Petition
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $petitions_entries
 *
 * @package App\Models
 */
class Petition extends Eloquent
{
	protected $fillable = [
		'name',
		'description'
	];

	public function petitions_entries()
	{
		return $this->hasMany(\App\Models\PetitionsEntry::class);
	}
}
