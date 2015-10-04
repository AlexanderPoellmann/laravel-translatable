<?php namespace vendocrat\Translatable\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface TranslatableInterface
 * @package vendocrat\Translatable\Contracts
 */
interface TranslatableInterface
{
	/**
	 * @param  Model  $model
	 * @param  string $locale The locale $model is translated to
	 * @return $this
	 */
	public function translates( Model $model, $locale );
}