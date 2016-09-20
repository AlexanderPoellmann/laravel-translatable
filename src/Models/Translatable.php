<?php namespace vendocrat\Translatable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Translatable
 * @package vendocrat\Translatable\Models
 */
class Translatable extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'translatables';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'language_id',
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
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Get translateable
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function translatable()
	{
		return $this->morphTo();
	}

	/**
	 * Get translation
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function translation()
	{
		return $this->morphTo();
	}

	/**
	 * @param  $query
	 * @param  Model $model
	 * @return mixed
	 */
	public function scopeTranslatables( $query, Model $model )
	{
		return $query->where( 'translatable_id',   $model->id )
					 ->where( 'translatable_type', get_class($model) );
	}
}