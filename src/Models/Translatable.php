<?php namespace Lecturize\Translatable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Translatable
 * @package Lecturize\Translatable\Models
 */
class Translatable extends Model
{
	/**
     * @todo make this editable via config file
     * @inheritdoc
	 */
	protected $table = 'translatables';

	/**
     * @inheritdoc
	 */
	protected $fillable = [
		'language_id',
		'translatable_id',
		'translatable_type',
		'translation_id',
		'translation_type',
	];

	/**
     * @inheritdoc
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