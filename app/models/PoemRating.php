<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoemRating extends Poem {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'poem_ratings';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}
