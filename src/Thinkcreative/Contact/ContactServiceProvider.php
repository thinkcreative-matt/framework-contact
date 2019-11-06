<?php 

namespace Thinkcreative\Contact;

use Illuminate\Support\ServiceProvider;

// use Thinkcreative\Contact\Http\Requests\StoreBlogPost;
use Thinkcreative\Contact\TCModule;

class ContactServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
	public function boot() 
	{
		
		$this->publishes([
			__DIR__ . '/../../config/contact.php' => config_path('contact.php')
		]);

		// Register any CSS
		// $this->publishes([
		// 	__DIR__.'/../../resources/css' => public_path('vendor/packagename')
		// ], 'public');

		// Register and JS. 
		$this->publishes([
			__DIR__ . '/../../resources/js' => public_path('thinkcreative/contact')
		], 'TCContact');

		//  Register any images
		// $this->publishes([
		// 	__DIR__.'/resources/images' => public_path('vendor/packagename')
		// ], 'public');


		$this->loadRoutesFrom(__DIR__ . '/../../routes/routes.php');

		$this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

		$this->loadViewsFrom(__DIR__.'/../../resources/views/front', 'contact');

		$this->loadViewsFrom(__DIR__.'/../../resources/views/admin', 'admin-contact');

		$this->publishes([
            __DIR__ . '/../../resources/views/front' => base_path('resources/views/vendor/front')
        ]);

        $this->publishes([
            __DIR__ . '/../../resources/views/admin' => base_path('resources/views/vendor/admin')
        ]);

		// Register any commands for use in the CLI
		// Uncomment for use.
		
		// if($this->app->runningInConsole())
		// {
		// 	$this->commands([
		// 		FooCommand::class,
		// 		BarCommand::class
		// 	]);
		// }

	}

	/**
     * Register the application services.
     *
     * @return void
     */
	public function register()
	{

		$this->app->singleton(Contact::class, function() {
			return new Contact();
		});
		//  This can be used to register validations requests etc etc.. .
		  
		// $this->app->singleton(StoreBlogPost::class, function() {
		// 	return new StoreBlogPost();
		// });

		$this->app->alias(Contact::class, 'contact');
	}

}