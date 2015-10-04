<?php namespace vendocrat\Translatable\Traits;

use Illuminate\Database\Eloquent\Model;
use vendocrat\Translatable\Models\Translatable;

/**
 * Class TranslatableTrait
 * @package vendocrat\Translatable\Contracts
 */
trait TranslatableTrait
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function translations()
	{
		return $this->morphMany(get_class($this), 'translation');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function translateable()
	{
		return $this->morphMany(get_class($this), 'translateable');
	}

	/**
	 * @param  Model  $model
	 * @param  string $locale The locale $model is translated to
	 * @return $this
	 */
	public function translates( Model $model, $locale )
	{
		// check if target translation is source translation

		// associate the translations
		$translatable = new Translatable();
		$translatable->locale = $locale;
		$translatable->translateable()->associate($model);
		$translatable->translation()->associate($this);
		$translatable->save();

		return $this;
	}
}