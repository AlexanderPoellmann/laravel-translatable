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
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function translations()
	{
		return $this->morphMany(Translatable::class, 'translatable');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphOne
	 */
	public function translatable()
	{
		return $this->morphOne(Translatable::class, 'translation');
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
		$translatable->translatable()->associate($model);
		$translatable->translation()->associate($this);
		$translatable->save();

		return $this;
	}

	/**
	 * @return $this
	 */
	public function getTranslations()
	{
		$translations = [];
		foreach ( $this->translations as $t ) {
			$translations[] = $t->translation()->first();
		}

		return collect($translations);
	}

	/**
	 * @return $this
	 */
	public function getTranslatable()
	{
		if ( $translatable = $this->translatable )
			return $translatable->translatable()->first();

		return null;
	}
}