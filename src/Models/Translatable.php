<?php namespace vendocrat\Translatable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Translatable extends Model
{
	use SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'translatable';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'locale',
		'translatable_id',
		'translatable_type',
		'translation_id',
		'translation_type',
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [];

	/**
	 * Get translateable
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function translateable()
	{
		return $this->belongsTo($this->translateable_type);
	}

	/**
	 * Get translation
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function translation()
	{
		return $this->belongsTo($this->translation_type);
	}
}