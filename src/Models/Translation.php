<?php namespace Lecturize\Translatable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Translation
 * @package Lecturize\Translatable\Models
 */
class Translation extends Model
{
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
     * @inheritdoc
     */
    public function __construct()
    {
        parent::__construct();

        $this->table = config('lecturize.translations.table', 'translations');
    }

    /**
     * Get the translateable.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function translatable()
    {
        return $this->morphTo();
    }

    /**
     * Get the translation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function translation()
    {
        return $this->morphTo();
    }

    /**
     * Scope translatables.
     *
     * @param  mixed  $query
     * @param  Model  $model
     * @return mixed
     */
    public function scopeTranslatables($query, Model $model)
    {
        return $query->where('translatable_id',   $model->id)
                     ->where('translatable_type', get_class($model));
    }
}