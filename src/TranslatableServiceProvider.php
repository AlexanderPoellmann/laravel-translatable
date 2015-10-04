<?php namespace vendocrat\Translatable;

use Illuminate\Support\ServiceProvider;

class TranslatableServiceProvider extends ServiceProvider
{
	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__ .'/../config/config.php' => config_path('translatable.php')
		], 'config');

		if ( ! class_exists('CreateTranslatableTable') ) {
			$timestamp = date('Y_m_d_His', time());

			$this->publishes([
				__DIR__ .'/../database/migrations/create_translatable_table.php.stub' =>
					database_path('migrations/'. $timestamp .'_create_translatable_table.php')
			], 'migrations');
		}
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(
			__DIR__ .'/../config/config.php',
			'translatable'
		);

		$this->app->singleton(Translation::class);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return string[]
	 */
	public function provides()
	{
		return [
			Translation::class
		];
	}
}
