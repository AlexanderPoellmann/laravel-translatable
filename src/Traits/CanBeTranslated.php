<?php namespace Lecturize\Translatable\Traits;

use Illuminate\Database\Eloquent\Model;
use Lecturize\Translatable\Models\Translation;

/**
 * Trait CanBeTranslated
 * @package Lecturize\Translatable\Traits
 */
trait CanBeTranslated
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function translatable()
    {
        return $this->morphOne(Translation::class, 'translation');
    }

    /**
     * @param  Model  $model
     * @param  string $locale The locale $model is translated to
     * @return $this
     */
    public function translates(Model $model, $locale)
    {
        // check if target translation is source translation
        if ($this->language == $model->language)
            return $this;

        // associate the translations
        if (Translation::translatables($this)->first()) {
            // $this is the translatable model
            Translation::firstOrCreate([
                'locale'            => $locale,
                'translatable_id'   => $this->id,
                'translatable_type' => get_class($this),
                'translation_id'    => $model->id,
                'translation_type'  => get_class($model),
            ]);
        } else {
            // $this is the translation model
            Translation::firstOrCreate([
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
        if ($translatable = $this->getTranslatable()) {
            $translations[] = $translatable;
            foreach ($translatable->translations as $t) {
                $translations[] = $t->translation()->first();
            }
        } else {
            $translations = [];
            foreach ($this->translations as $t) {
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
        if ($translatable = $this->translatable)
            return $translatable->translatable()->first();

        return null;
    }
}