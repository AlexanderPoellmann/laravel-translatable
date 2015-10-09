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
		if ( $this->language == $model->language )
			return $this;

		// associate the translations
		if ( Translatable::translatables($this)->first() ) {
			// $this is the translatable model
			Translatable::firstOrCreate([
				'locale'            => $locale,
				'translatable_id'   => $this->id,
				'translatable_type' => get_class($this),
				'translation_id'    => $model->id,
				'translation_type'  => get_class($model),
			]);
		} else {
			// $this is the translation model
			Translatable::firstOrCreate([
				'locale'            => $locale,
				'translatable_id'   => $model->id,
				'translatable_type' => get_class($model),
				'translation_id'    => $this->id,
				'translation_type'  => get_class($this),
			]);
		}

		return $this;
	}

	/**
	 * @return array
	 */
	public function getTranslations()
	{
		if ( $translatable = $this->getTranslatable() ) {
			$translations[] = $translatable;
			foreach ( $translatable->translations as $t ) {
				$translations[] = $t->translation()->first();
			}
		} else {
			$translations = [];
			foreach ( $this->translations as $t ) {
				$translations[] = $t->translation()->first();
			}
		}

		return collect($translations);
	}

	/**
	 * @return array
	 */
	public function getTranslatable()
	{
		if ( $translatable = $this->translatable )
			return $translatable->translatable()->first();

		return null;
	}

	/**
	 * Get translations as linked array
	 *
	 * @return null|array
	 */
	public function getTranslationsArray()
	{
		$translations = $this->getTranslations();

		if ( count($translations) > 0 ) {
			$list = [];
			foreach ( $translations as $translation ) {
				if ( $translation->language == $this->language )
					continue;

				$t = '<a href="'. get_post_url($translation) .'" title="'. $translation->title .'">';
				$t.= $translation->language->name;
				$t.= '</a>';

				$list[] = $t;
			}

			return $list;
		}

		return null;
	}
}