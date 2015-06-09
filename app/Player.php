<?php namespace Fantasee;

use Illuminate\Database\Eloquent\Model;

class Player extends Model {

		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */
		protected $table = 'players';

		/**
		 * The attributes that are mass assignable.
		 *
		 * @var array
		 */
		protected $fillable = ['site_id', 'name'];

		/**
		 * The attributes excluded from the model's JSON form.
		 *
		 * @var array
		 */
		protected $hidden = [];

}
