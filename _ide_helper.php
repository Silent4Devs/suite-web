<?php
/* @noinspection ALL */
// @formatter:off
// phpcs:ignoreFile

/**
 * A helper file for Laravel, to provide autocomplete information to your IDE
 * Generated for Laravel 11.38.2.
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 * @see https://github.com/barryvdh/laravel-ide-helper
 */
namespace Illuminate\Support\Facades {
    /**
     *
     *
     * @see \Illuminate\Foundation\Application
     */
    class App {
        /**
         * Begin configuring a new Laravel application instance.
         *
         * @param string|null $basePath
         * @return \Illuminate\Foundation\Configuration\ApplicationBuilder
         * @static
         */
        public static function configure($basePath = null)
        {
            return \Illuminate\Foundation\Application::configure($basePath);
        }

        /**
         * Infer the application's base directory from the environment.
         *
         * @return string
         * @static
         */
        public static function inferBasePath()
        {
            return \Illuminate\Foundation\Application::inferBasePath();
        }

        /**
         * Get the version number of the application.
         *
         * @return string
         * @static
         */
        public static function version()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->version();
        }

        /**
         * Run the given array of bootstrap classes.
         *
         * @param string[] $bootstrappers
         * @return void
         * @static
         */
        public static function bootstrapWith($bootstrappers)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->bootstrapWith($bootstrappers);
        }

        /**
         * Register a callback to run after loading the environment.
         *
         * @param \Closure $callback
         * @return void
         * @static
         */
        public static function afterLoadingEnvironment($callback)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->afterLoadingEnvironment($callback);
        }

        /**
         * Register a callback to run before a bootstrapper.
         *
         * @param string $bootstrapper
         * @param \Closure $callback
         * @return void
         * @static
         */
        public static function beforeBootstrapping($bootstrapper, $callback)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->beforeBootstrapping($bootstrapper, $callback);
        }

        /**
         * Register a callback to run after a bootstrapper.
         *
         * @param string $bootstrapper
         * @param \Closure $callback
         * @return void
         * @static
         */
        public static function afterBootstrapping($bootstrapper, $callback)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->afterBootstrapping($bootstrapper, $callback);
        }

        /**
         * Determine if the application has been bootstrapped before.
         *
         * @return bool
         * @static
         */
        public static function hasBeenBootstrapped()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->hasBeenBootstrapped();
        }

        /**
         * Set the base path for the application.
         *
         * @param string $basePath
         * @return \Illuminate\Foundation\Application
         * @static
         */
        public static function setBasePath($basePath)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->setBasePath($basePath);
        }

        /**
         * Get the path to the application "app" directory.
         *
         * @param string $path
         * @return string
         * @static
         */
        public static function path($path = '')
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->path($path);
        }

        /**
         * Set the application directory.
         *
         * @param string $path
         * @return \Illuminate\Foundation\Application
         * @static
         */
        public static function useAppPath($path)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->useAppPath($path);
        }

        /**
         * Get the base path of the Laravel installation.
         *
         * @param string $path
         * @return string
         * @static
         */
        public static function basePath($path = '')
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->basePath($path);
        }

        /**
         * Get the path to the bootstrap directory.
         *
         * @param string $path
         * @return string
         * @static
         */
        public static function bootstrapPath($path = '')
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->bootstrapPath($path);
        }

        /**
         * Get the path to the service provider list in the bootstrap directory.
         *
         * @return string
         * @static
         */
        public static function getBootstrapProvidersPath()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->getBootstrapProvidersPath();
        }

        /**
         * Set the bootstrap file directory.
         *
         * @param string $path
         * @return \Illuminate\Foundation\Application
         * @static
         */
        public static function useBootstrapPath($path)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->useBootstrapPath($path);
        }

        /**
         * Get the path to the application configuration files.
         *
         * @param string $path
         * @return string
         * @static
         */
        public static function configPath($path = '')
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->configPath($path);
        }

        /**
         * Set the configuration directory.
         *
         * @param string $path
         * @return \Illuminate\Foundation\Application
         * @static
         */
        public static function useConfigPath($path)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->useConfigPath($path);
        }

        /**
         * Get the path to the database directory.
         *
         * @param string $path
         * @return string
         * @static
         */
        public static function databasePath($path = '')
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->databasePath($path);
        }

        /**
         * Set the database directory.
         *
         * @param string $path
         * @return \Illuminate\Foundation\Application
         * @static
         */
        public static function useDatabasePath($path)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->useDatabasePath($path);
        }

        /**
         * Get the path to the language files.
         *
         * @param string $path
         * @return string
         * @static
         */
        public static function langPath($path = '')
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->langPath($path);
        }

        /**
         * Set the language file directory.
         *
         * @param string $path
         * @return \Illuminate\Foundation\Application
         * @static
         */
        public static function useLangPath($path)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->useLangPath($path);
        }

        /**
         * Get the path to the public / web directory.
         *
         * @param string $path
         * @return string
         * @static
         */
        public static function publicPath($path = '')
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->publicPath($path);
        }

        /**
         * Set the public / web directory.
         *
         * @param string $path
         * @return \Illuminate\Foundation\Application
         * @static
         */
        public static function usePublicPath($path)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->usePublicPath($path);
        }

        /**
         * Get the path to the storage directory.
         *
         * @param string $path
         * @return string
         * @static
         */
        public static function storagePath($path = '')
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->storagePath($path);
        }

        /**
         * Set the storage directory.
         *
         * @param string $path
         * @return \Illuminate\Foundation\Application
         * @static
         */
        public static function useStoragePath($path)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->useStoragePath($path);
        }

        /**
         * Get the path to the resources directory.
         *
         * @param string $path
         * @return string
         * @static
         */
        public static function resourcePath($path = '')
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->resourcePath($path);
        }

        /**
         * Get the path to the views directory.
         *
         * This method returns the first configured path in the array of view paths.
         *
         * @param string $path
         * @return string
         * @static
         */
        public static function viewPath($path = '')
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->viewPath($path);
        }

        /**
         * Join the given paths together.
         *
         * @param string $basePath
         * @param string $path
         * @return string
         * @static
         */
        public static function joinPaths($basePath, $path = '')
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->joinPaths($basePath, $path);
        }

        /**
         * Get the path to the environment file directory.
         *
         * @return string
         * @static
         */
        public static function environmentPath()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->environmentPath();
        }

        /**
         * Set the directory for the environment file.
         *
         * @param string $path
         * @return \Illuminate\Foundation\Application
         * @static
         */
        public static function useEnvironmentPath($path)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->useEnvironmentPath($path);
        }

        /**
         * Set the environment file to be loaded during bootstrapping.
         *
         * @param string $file
         * @return \Illuminate\Foundation\Application
         * @static
         */
        public static function loadEnvironmentFrom($file)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->loadEnvironmentFrom($file);
        }

        /**
         * Get the environment file the application is using.
         *
         * @return string
         * @static
         */
        public static function environmentFile()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->environmentFile();
        }

        /**
         * Get the fully qualified path to the environment file.
         *
         * @return string
         * @static
         */
        public static function environmentFilePath()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->environmentFilePath();
        }

        /**
         * Get or check the current application environment.
         *
         * @param string|array $environments
         * @return string|bool
         * @static
         */
        public static function environment(...$environments)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->environment(...$environments);
        }

        /**
         * Determine if the application is in the local environment.
         *
         * @return bool
         * @static
         */
        public static function isLocal()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->isLocal();
        }

        /**
         * Determine if the application is in the production environment.
         *
         * @return bool
         * @static
         */
        public static function isProduction()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->isProduction();
        }

        /**
         * Detect the application's current environment.
         *
         * @param \Closure $callback
         * @return string
         * @static
         */
        public static function detectEnvironment($callback)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->detectEnvironment($callback);
        }

        /**
         * Determine if the application is running in the console.
         *
         * @return bool
         * @static
         */
        public static function runningInConsole()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->runningInConsole();
        }

        /**
         * Determine if the application is running any of the given console commands.
         *
         * @param string|array $commands
         * @return bool
         * @static
         */
        public static function runningConsoleCommand(...$commands)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->runningConsoleCommand(...$commands);
        }

        /**
         * Determine if the application is running unit tests.
         *
         * @return bool
         * @static
         */
        public static function runningUnitTests()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->runningUnitTests();
        }

        /**
         * Determine if the application is running with debug mode enabled.
         *
         * @return bool
         * @static
         */
        public static function hasDebugModeEnabled()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->hasDebugModeEnabled();
        }

        /**
         * Register a new registered listener.
         *
         * @param callable $callback
         * @return void
         * @static
         */
        public static function registered($callback)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->registered($callback);
        }

        /**
         * Register all of the configured providers.
         *
         * @return void
         * @static
         */
        public static function registerConfiguredProviders()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->registerConfiguredProviders();
        }

        /**
         * Register a service provider with the application.
         *
         * @param \Illuminate\Support\ServiceProvider|string $provider
         * @param bool $force
         * @return \Illuminate\Support\ServiceProvider
         * @static
         */
        public static function register($provider, $force = false)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->register($provider, $force);
        }

        /**
         * Get the registered service provider instance if it exists.
         *
         * @param \Illuminate\Support\ServiceProvider|string $provider
         * @return \Illuminate\Support\ServiceProvider|null
         * @static
         */
        public static function getProvider($provider)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->getProvider($provider);
        }

        /**
         * Get the registered service provider instances if any exist.
         *
         * @param \Illuminate\Support\ServiceProvider|string $provider
         * @return array
         * @static
         */
        public static function getProviders($provider)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->getProviders($provider);
        }

        /**
         * Resolve a service provider instance from the class name.
         *
         * @param string $provider
         * @return \Illuminate\Support\ServiceProvider
         * @static
         */
        public static function resolveProvider($provider)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->resolveProvider($provider);
        }

        /**
         * Load and boot all of the remaining deferred providers.
         *
         * @return void
         * @static
         */
        public static function loadDeferredProviders()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->loadDeferredProviders();
        }

        /**
         * Load the provider for a deferred service.
         *
         * @param string $service
         * @return void
         * @static
         */
        public static function loadDeferredProvider($service)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->loadDeferredProvider($service);
        }

        /**
         * Register a deferred provider and service.
         *
         * @param string $provider
         * @param string|null $service
         * @return void
         * @static
         */
        public static function registerDeferredProvider($provider, $service = null)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->registerDeferredProvider($provider, $service);
        }

        /**
         * Resolve the given type from the container.
         *
         * @param string $abstract
         * @param array $parameters
         * @return mixed
         * @throws \Illuminate\Contracts\Container\BindingResolutionException
         * @static
         */
        public static function make($abstract, $parameters = [])
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->make($abstract, $parameters);
        }

        /**
         * Determine if the given abstract type has been bound.
         *
         * @param string $abstract
         * @return bool
         * @static
         */
        public static function bound($abstract)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->bound($abstract);
        }

        /**
         * Determine if the application has booted.
         *
         * @return bool
         * @static
         */
        public static function isBooted()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->isBooted();
        }

        /**
         * Boot the application's service providers.
         *
         * @return void
         * @static
         */
        public static function boot()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->boot();
        }

        /**
         * Register a new boot listener.
         *
         * @param callable $callback
         * @return void
         * @static
         */
        public static function booting($callback)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->booting($callback);
        }

        /**
         * Register a new "booted" listener.
         *
         * @param callable $callback
         * @return void
         * @static
         */
        public static function booted($callback)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->booted($callback);
        }

        /**
         * {@inheritdoc}
         *
         * @return \Symfony\Component\HttpFoundation\Response
         * @static
         */
        public static function handle($request, $type = 1, $catch = true)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->handle($request, $type, $catch);
        }

        /**
         * Handle the incoming HTTP request and send the response to the browser.
         *
         * @param \Illuminate\Http\Request $request
         * @return void
         * @static
         */
        public static function handleRequest($request)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->handleRequest($request);
        }

        /**
         * Handle the incoming Artisan command.
         *
         * @param \Symfony\Component\Console\Input\InputInterface $input
         * @return int
         * @static
         */
        public static function handleCommand($input)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->handleCommand($input);
        }

        /**
         * Determine if the framework's base configuration should be merged.
         *
         * @return bool
         * @static
         */
        public static function shouldMergeFrameworkConfiguration()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->shouldMergeFrameworkConfiguration();
        }

        /**
         * Indicate that the framework's base configuration should not be merged.
         *
         * @return \Illuminate\Foundation\Application
         * @static
         */
        public static function dontMergeFrameworkConfiguration()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->dontMergeFrameworkConfiguration();
        }

        /**
         * Determine if middleware has been disabled for the application.
         *
         * @return bool
         * @static
         */
        public static function shouldSkipMiddleware()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->shouldSkipMiddleware();
        }

        /**
         * Get the path to the cached services.php file.
         *
         * @return string
         * @static
         */
        public static function getCachedServicesPath()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->getCachedServicesPath();
        }

        /**
         * Get the path to the cached packages.php file.
         *
         * @return string
         * @static
         */
        public static function getCachedPackagesPath()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->getCachedPackagesPath();
        }

        /**
         * Determine if the application configuration is cached.
         *
         * @return bool
         * @static
         */
        public static function configurationIsCached()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->configurationIsCached();
        }

        /**
         * Get the path to the configuration cache file.
         *
         * @return string
         * @static
         */
        public static function getCachedConfigPath()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->getCachedConfigPath();
        }

        /**
         * Determine if the application routes are cached.
         *
         * @return bool
         * @static
         */
        public static function routesAreCached()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->routesAreCached();
        }

        /**
         * Get the path to the routes cache file.
         *
         * @return string
         * @static
         */
        public static function getCachedRoutesPath()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->getCachedRoutesPath();
        }

        /**
         * Determine if the application events are cached.
         *
         * @return bool
         * @static
         */
        public static function eventsAreCached()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->eventsAreCached();
        }

        /**
         * Get the path to the events cache file.
         *
         * @return string
         * @static
         */
        public static function getCachedEventsPath()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->getCachedEventsPath();
        }

        /**
         * Add new prefix to list of absolute path prefixes.
         *
         * @param string $prefix
         * @return \Illuminate\Foundation\Application
         * @static
         */
        public static function addAbsoluteCachePathPrefix($prefix)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->addAbsoluteCachePathPrefix($prefix);
        }

        /**
         * Get an instance of the maintenance mode manager implementation.
         *
         * @return \Illuminate\Contracts\Foundation\MaintenanceMode
         * @static
         */
        public static function maintenanceMode()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->maintenanceMode();
        }

        /**
         * Determine if the application is currently down for maintenance.
         *
         * @return bool
         * @static
         */
        public static function isDownForMaintenance()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->isDownForMaintenance();
        }

        /**
         * Throw an HttpException with the given data.
         *
         * @param int $code
         * @param string $message
         * @param array $headers
         * @return never
         * @throws \Symfony\Component\HttpKernel\Exception\HttpException
         * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
         * @static
         */
        public static function abort($code, $message = '', $headers = [])
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->abort($code, $message, $headers);
        }

        /**
         * Register a terminating callback with the application.
         *
         * @param callable|string $callback
         * @return \Illuminate\Foundation\Application
         * @static
         */
        public static function terminating($callback)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->terminating($callback);
        }

        /**
         * Terminate the application.
         *
         * @return void
         * @static
         */
        public static function terminate()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->terminate();
        }

        /**
         * Get the service providers that have been loaded.
         *
         * @return array<string, bool>
         * @static
         */
        public static function getLoadedProviders()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->getLoadedProviders();
        }

        /**
         * Determine if the given service provider is loaded.
         *
         * @param string $provider
         * @return bool
         * @static
         */
        public static function providerIsLoaded($provider)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->providerIsLoaded($provider);
        }

        /**
         * Get the application's deferred services.
         *
         * @return array
         * @static
         */
        public static function getDeferredServices()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->getDeferredServices();
        }

        /**
         * Set the application's deferred services.
         *
         * @param array $services
         * @return void
         * @static
         */
        public static function setDeferredServices($services)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->setDeferredServices($services);
        }

        /**
         * Determine if the given service is a deferred service.
         *
         * @param string $service
         * @return bool
         * @static
         */
        public static function isDeferredService($service)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->isDeferredService($service);
        }

        /**
         * Add an array of services to the application's deferred services.
         *
         * @param array $services
         * @return void
         * @static
         */
        public static function addDeferredServices($services)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->addDeferredServices($services);
        }

        /**
         * Remove an array of services from the application's deferred services.
         *
         * @param array $services
         * @return void
         * @static
         */
        public static function removeDeferredServices($services)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->removeDeferredServices($services);
        }

        /**
         * Configure the real-time facade namespace.
         *
         * @param string $namespace
         * @return void
         * @static
         */
        public static function provideFacades($namespace)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->provideFacades($namespace);
        }

        /**
         * Get the current application locale.
         *
         * @return string
         * @static
         */
        public static function getLocale()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->getLocale();
        }

        /**
         * Get the current application locale.
         *
         * @return string
         * @static
         */
        public static function currentLocale()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->currentLocale();
        }

        /**
         * Get the current application fallback locale.
         *
         * @return string
         * @static
         */
        public static function getFallbackLocale()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->getFallbackLocale();
        }

        /**
         * Set the current application locale.
         *
         * @param string $locale
         * @return void
         * @static
         */
        public static function setLocale($locale)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->setLocale($locale);
        }

        /**
         * Set the current application fallback locale.
         *
         * @param string $fallbackLocale
         * @return void
         * @static
         */
        public static function setFallbackLocale($fallbackLocale)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->setFallbackLocale($fallbackLocale);
        }

        /**
         * Determine if the application locale is the given locale.
         *
         * @param string $locale
         * @return bool
         * @static
         */
        public static function isLocale($locale)
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->isLocale($locale);
        }

        /**
         * Register the core class aliases in the container.
         *
         * @return void
         * @static
         */
        public static function registerCoreContainerAliases()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->registerCoreContainerAliases();
        }

        /**
         * Flush the container of all bindings and resolved instances.
         *
         * @return void
         * @static
         */
        public static function flush()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->flush();
        }

        /**
         * Get the application namespace.
         *
         * @return string
         * @throws \RuntimeException
         * @static
         */
        public static function getNamespace()
        {
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->getNamespace();
        }

        /**
         * Define a contextual binding.
         *
         * @param array|string $concrete
         * @return \Illuminate\Contracts\Container\ContextualBindingBuilder
         * @static
         */
        public static function when($concrete)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->when($concrete);
        }

        /**
         * Define a contextual binding based on an attribute.
         *
         * @param string $attribute
         * @param \Closure $handler
         * @return void
         * @static
         */
        public static function whenHasAttribute($attribute, $handler)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->whenHasAttribute($attribute, $handler);
        }

        /**
         * Returns true if the container can return an entry for the given identifier.
         *
         * Returns false otherwise.
         *
         * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
         * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
         *
         * @return bool
         * @param string $id Identifier of the entry to look for.
         * @return bool
         * @static
         */
        public static function has($id)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->has($id);
        }

        /**
         * Determine if the given abstract type has been resolved.
         *
         * @param string $abstract
         * @return bool
         * @static
         */
        public static function resolved($abstract)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->resolved($abstract);
        }

        /**
         * Determine if a given type is shared.
         *
         * @param string $abstract
         * @return bool
         * @static
         */
        public static function isShared($abstract)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->isShared($abstract);
        }

        /**
         * Determine if a given string is an alias.
         *
         * @param string $name
         * @return bool
         * @static
         */
        public static function isAlias($name)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->isAlias($name);
        }

        /**
         * Register a binding with the container.
         *
         * @param string $abstract
         * @param \Closure|string|null $concrete
         * @param bool $shared
         * @return void
         * @throws \TypeError
         * @static
         */
        public static function bind($abstract, $concrete = null, $shared = false)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->bind($abstract, $concrete, $shared);
        }

        /**
         * Determine if the container has a method binding.
         *
         * @param string $method
         * @return bool
         * @static
         */
        public static function hasMethodBinding($method)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->hasMethodBinding($method);
        }

        /**
         * Bind a callback to resolve with Container::call.
         *
         * @param array|string $method
         * @param \Closure $callback
         * @return void
         * @static
         */
        public static function bindMethod($method, $callback)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->bindMethod($method, $callback);
        }

        /**
         * Get the method binding for the given method.
         *
         * @param string $method
         * @param mixed $instance
         * @return mixed
         * @static
         */
        public static function callMethodBinding($method, $instance)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->callMethodBinding($method, $instance);
        }

        /**
         * Add a contextual binding to the container.
         *
         * @param string $concrete
         * @param string $abstract
         * @param \Closure|string $implementation
         * @return void
         * @static
         */
        public static function addContextualBinding($concrete, $abstract, $implementation)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->addContextualBinding($concrete, $abstract, $implementation);
        }

        /**
         * Register a binding if it hasn't already been registered.
         *
         * @param string $abstract
         * @param \Closure|string|null $concrete
         * @param bool $shared
         * @return void
         * @static
         */
        public static function bindIf($abstract, $concrete = null, $shared = false)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->bindIf($abstract, $concrete, $shared);
        }

        /**
         * Register a shared binding in the container.
         *
         * @param string $abstract
         * @param \Closure|string|null $concrete
         * @return void
         * @static
         */
        public static function singleton($abstract, $concrete = null)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->singleton($abstract, $concrete);
        }

        /**
         * Register a shared binding if it hasn't already been registered.
         *
         * @param string $abstract
         * @param \Closure|string|null $concrete
         * @return void
         * @static
         */
        public static function singletonIf($abstract, $concrete = null)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->singletonIf($abstract, $concrete);
        }

        /**
         * Register a scoped binding in the container.
         *
         * @param string $abstract
         * @param \Closure|string|null $concrete
         * @return void
         * @static
         */
        public static function scoped($abstract, $concrete = null)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->scoped($abstract, $concrete);
        }

        /**
         * Register a scoped binding if it hasn't already been registered.
         *
         * @param string $abstract
         * @param \Closure|string|null $concrete
         * @return void
         * @static
         */
        public static function scopedIf($abstract, $concrete = null)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->scopedIf($abstract, $concrete);
        }

        /**
         * "Extend" an abstract type in the container.
         *
         * @param string $abstract
         * @param \Closure $closure
         * @return void
         * @throws \InvalidArgumentException
         * @static
         */
        public static function extend($abstract, $closure)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->extend($abstract, $closure);
        }

        /**
         * Register an existing instance as shared in the container.
         *
         * @param string $abstract
         * @param mixed $instance
         * @return mixed
         * @static
         */
        public static function instance($abstract, $instance)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->instance($abstract, $instance);
        }

        /**
         * Assign a set of tags to a given binding.
         *
         * @param array|string $abstracts
         * @param array|mixed $tags
         * @return void
         * @static
         */
        public static function tag($abstracts, $tags)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->tag($abstracts, $tags);
        }

        /**
         * Resolve all of the bindings for a given tag.
         *
         * @param string $tag
         * @return iterable
         * @static
         */
        public static function tagged($tag)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->tagged($tag);
        }

        /**
         * Alias a type to a different name.
         *
         * @param string $abstract
         * @param string $alias
         * @return void
         * @throws \LogicException
         * @static
         */
        public static function alias($abstract, $alias)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->alias($abstract, $alias);
        }

        /**
         * Bind a new callback to an abstract's rebind event.
         *
         * @param string $abstract
         * @param \Closure $callback
         * @return mixed
         * @static
         */
        public static function rebinding($abstract, $callback)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->rebinding($abstract, $callback);
        }

        /**
         * Refresh an instance on the given target and method.
         *
         * @param string $abstract
         * @param mixed $target
         * @param string $method
         * @return mixed
         * @static
         */
        public static function refresh($abstract, $target, $method)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->refresh($abstract, $target, $method);
        }

        /**
         * Wrap the given closure such that its dependencies will be injected when executed.
         *
         * @param \Closure $callback
         * @param array $parameters
         * @return \Closure
         * @static
         */
        public static function wrap($callback, $parameters = [])
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->wrap($callback, $parameters);
        }

        /**
         * Call the given Closure / class@method and inject its dependencies.
         *
         * @param callable|string $callback
         * @param array<string, mixed> $parameters
         * @param string|null $defaultMethod
         * @return mixed
         * @throws \InvalidArgumentException
         * @static
         */
        public static function call($callback, $parameters = [], $defaultMethod = null)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->call($callback, $parameters, $defaultMethod);
        }

        /**
         * Get a closure to resolve the given type from the container.
         *
         * @param string $abstract
         * @return \Closure
         * @static
         */
        public static function factory($abstract)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->factory($abstract);
        }

        /**
         * An alias function name for make().
         *
         * @param string|callable $abstract
         * @param array $parameters
         * @return mixed
         * @throws \Illuminate\Contracts\Container\BindingResolutionException
         * @static
         */
        public static function makeWith($abstract, $parameters = [])
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->makeWith($abstract, $parameters);
        }

        /**
         * Finds an entry of the container by its identifier and returns it.
         *
         * @return mixed
         * @param string $id Identifier of the entry to look for.
         * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
         * @throws ContainerExceptionInterface Error while retrieving the entry.
         * @return mixed Entry.
         * @static
         */
        public static function get($id)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->get($id);
        }

        /**
         * Instantiate a concrete instance of the given type.
         *
         * @param \Closure|string $concrete
         * @return mixed
         * @throws \Illuminate\Contracts\Container\BindingResolutionException
         * @throws \Illuminate\Contracts\Container\CircularDependencyException
         * @static
         */
        public static function build($concrete)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->build($concrete);
        }

        /**
         * Resolve a dependency based on an attribute.
         *
         * @param \ReflectionAttribute $attribute
         * @return mixed
         * @static
         */
        public static function resolveFromAttribute($attribute)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->resolveFromAttribute($attribute);
        }

        /**
         * Register a new before resolving callback for all types.
         *
         * @param \Closure|string $abstract
         * @param \Closure|null $callback
         * @return void
         * @static
         */
        public static function beforeResolving($abstract, $callback = null)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->beforeResolving($abstract, $callback);
        }

        /**
         * Register a new resolving callback.
         *
         * @param \Closure|string $abstract
         * @param \Closure|null $callback
         * @return void
         * @static
         */
        public static function resolving($abstract, $callback = null)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->resolving($abstract, $callback);
        }

        /**
         * Register a new after resolving callback for all types.
         *
         * @param \Closure|string $abstract
         * @param \Closure|null $callback
         * @return void
         * @static
         */
        public static function afterResolving($abstract, $callback = null)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->afterResolving($abstract, $callback);
        }

        /**
         * Register a new after resolving attribute callback for all types.
         *
         * @param string $attribute
         * @param \Closure $callback
         * @return void
         * @static
         */
        public static function afterResolvingAttribute($attribute, $callback)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->afterResolvingAttribute($attribute, $callback);
        }

        /**
         * Fire all of the after resolving attribute callbacks.
         *
         * @param \ReflectionAttribute[] $attributes
         * @param mixed $object
         * @return void
         * @static
         */
        public static function fireAfterResolvingAttributeCallbacks($attributes, $object)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->fireAfterResolvingAttributeCallbacks($attributes, $object);
        }

        /**
         * Get the container's bindings.
         *
         * @return array
         * @static
         */
        public static function getBindings()
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->getBindings();
        }

        /**
         * Get the alias for an abstract if available.
         *
         * @param string $abstract
         * @return string
         * @static
         */
        public static function getAlias($abstract)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->getAlias($abstract);
        }

        /**
         * Remove all of the extender callbacks for a given type.
         *
         * @param string $abstract
         * @return void
         * @static
         */
        public static function forgetExtenders($abstract)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->forgetExtenders($abstract);
        }

        /**
         * Remove a resolved instance from the instance cache.
         *
         * @param string $abstract
         * @return void
         * @static
         */
        public static function forgetInstance($abstract)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->forgetInstance($abstract);
        }

        /**
         * Clear all of the instances from the container.
         *
         * @return void
         * @static
         */
        public static function forgetInstances()
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->forgetInstances();
        }

        /**
         * Clear all of the scoped instances from the container.
         *
         * @return void
         * @static
         */
        public static function forgetScopedInstances()
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->forgetScopedInstances();
        }

        /**
         * Get the globally available instance of the container.
         *
         * @return static
         * @static
         */
        public static function getInstance()
        {
            //Method inherited from \Illuminate\Container\Container
            return \Illuminate\Foundation\Application::getInstance();
        }

        /**
         * Set the shared instance of the container.
         *
         * @param \Illuminate\Contracts\Container\Container|null $container
         * @return \Illuminate\Contracts\Container\Container|static
         * @static
         */
        public static function setInstance($container = null)
        {
            //Method inherited from \Illuminate\Container\Container
            return \Illuminate\Foundation\Application::setInstance($container);
        }

        /**
         * Determine if a given offset exists.
         *
         * @param string $key
         * @return bool
         * @static
         */
        public static function offsetExists($key)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->offsetExists($key);
        }

        /**
         * Get the value at a given offset.
         *
         * @param string $key
         * @return mixed
         * @static
         */
        public static function offsetGet($key)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            return $instance->offsetGet($key);
        }

        /**
         * Set the value at a given offset.
         *
         * @param string $key
         * @param mixed $value
         * @return void
         * @static
         */
        public static function offsetSet($key, $value)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->offsetSet($key, $value);
        }

        /**
         * Unset the value at a given offset.
         *
         * @param string $key
         * @return void
         * @static
         */
        public static function offsetUnset($key)
        {
            //Method inherited from \Illuminate\Container\Container
            /** @var \Illuminate\Foundation\Application $instance */
            $instance->offsetUnset($key);
        }

        /**
         * Register a custom macro.
         *
         * @param string $name
         * @param object|callable $macro
         * @param-closure-this static  $macro
         * @return void
         * @static
         */
        public static function macro($name, $macro)
        {
            \Illuminate\Foundation\Application::macro($name, $macro);
        }

        /**
         * Mix another object into the class.
         *
         * @param object $mixin
         * @param bool $replace
         * @return void
         * @throws \ReflectionException
         * @static
         */
        public static function mixin($mixin, $replace = true)
        {
            \Illuminate\Foundation\Application::mixin($mixin, $replace);
        }

        /**
         * Checks if macro is registered.
         *
         * @param string $name
         * @return bool
         * @static
         */
        public static function hasMacro($name)
        {
            return \Illuminate\Foundation\Application::hasMacro($name);
        }

        /**
         * Flush the existing macros.
         *
         * @return void
         * @static
         */
        public static function flushMacros()
        {
            \Illuminate\Foundation\Application::flushMacros();
        }

            }
    /**
     *
     *
     * @see \Illuminate\Foundation\Console\Kernel
     */
    class Artisan {
        /**
         * Re-route the Symfony command events to their Laravel counterparts.
         *
         * @internal
         * @return \App\Console\Kernel
         * @static
         */
        public static function rerouteSymfonyCommandEvents()
        {
            //Method inherited from \Illuminate\Foundation\Console\Kernel
            /** @var \App\Console\Kernel $instance */
            return $instance->rerouteSymfonyCommandEvents();
        }

        /**
         * Run the console application.
         *
         * @param \Symfony\Component\Console\Input\InputInterface $input
         * @param \Symfony\Component\Console\Output\OutputInterface|null $output
         * @return int
         * @static
         */
        public static function handle($input, $output = null)
        {
            //Method inherited from \Illuminate\Foundation\Console\Kernel
            /** @var \App\Console\Kernel $instance */
            return $instance->handle($input, $output);
        }

        /**
         * Terminate the application.
         *
         * @param \Symfony\Component\Console\Input\InputInterface $input
         * @param int $status
         * @return void
         * @static
         */
        public static function terminate($input, $status)
        {
            //Method inherited from \Illuminate\Foundation\Console\Kernel
            /** @var \App\Console\Kernel $instance */
            $instance->terminate($input, $status);
        }

        /**
         * Register a callback to be invoked when the command lifecycle duration exceeds a given amount of time.
         *
         * @param \DateTimeInterface|\Carbon\CarbonInterval|float|int $threshold
         * @param callable $handler
         * @return void
         * @static
         */
        public static function whenCommandLifecycleIsLongerThan($threshold, $handler)
        {
            //Method inherited from \Illuminate\Foundation\Console\Kernel
            /** @var \App\Console\Kernel $instance */
            $instance->whenCommandLifecycleIsLongerThan($threshold, $handler);
        }

        /**
         * When the command being handled started.
         *
         * @return \Illuminate\Support\Carbon|null
         * @static
         */
        public static function commandStartedAt()
        {
            //Method inherited from \Illuminate\Foundation\Console\Kernel
            /** @var \App\Console\Kernel $instance */
            return $instance->commandStartedAt();
        }

        /**
         * Resolve a console schedule instance.
         *
         * @return \Illuminate\Console\Scheduling\Schedule
         * @static
         */
        public static function resolveConsoleSchedule()
        {
            //Method inherited from \Illuminate\Foundation\Console\Kernel
            /** @var \App\Console\Kernel $instance */
            return $instance->resolveConsoleSchedule();
        }

        /**
         * Register a Closure based command with the application.
         *
         * @param string $signature
         * @param \Closure $callback
         * @return \Illuminate\Foundation\Console\ClosureCommand
         * @static
         */
        public static function command($signature, $callback)
        {
            //Method inherited from \Illuminate\Foundation\Console\Kernel
            /** @var \App\Console\Kernel $instance */
            return $instance->command($signature, $callback);
        }

        /**
         * Register the given command with the console application.
         *
         * @param \Symfony\Component\Console\Command\Command $command
         * @return void
         * @static
         */
        public static function registerCommand($command)
        {
            //Method inherited from \Illuminate\Foundation\Console\Kernel
            /** @var \App\Console\Kernel $instance */
            $instance->registerCommand($command);
        }

        /**
         * Run an Artisan console command by name.
         *
         * @param string $command
         * @param array $parameters
         * @param \Symfony\Component\Console\Output\OutputInterface|null $outputBuffer
         * @return int
         * @throws \Symfony\Component\Console\Exception\CommandNotFoundException
         * @static
         */
        public static function call($command, $parameters = [], $outputBuffer = null)
        {
            //Method inherited from \Illuminate\Foundation\Console\Kernel
            /** @var \App\Console\Kernel $instance */
            return $instance->call($command, $parameters, $outputBuffer);
        }

        /**
         * Queue the given console command.
         *
         * @param string $command
         * @param array $parameters
         * @return \Illuminate\Foundation\Bus\PendingDispatch
         * @static
         */
        public static function queue($command, $parameters = [])
        {
            //Method inherited from \Illuminate\Foundation\Console\Kernel
            /** @var \App\Console\Kernel $instance */
            return $instance->queue($command, $parameters);
        }

        /**
         * Get all of the commands registered with the console.
         *
         * @return array
         * @static
         */
        public static function all()
        {
            //Method inherited from \Illuminate\Foundation\Console\Kernel
            /** @var \App\Console\Kernel $instance */
            return $instance->all();
        }

        /**
         * Get the output for the last run command.
         *
         * @return string
         * @static
         */
        public static function output()
        {
            //Method inherited from \Illuminate\Foundation\Console\Kernel
            /** @var \App\Console\Kernel $instance */
            return $instance->output();
        }

        /**
         * Bootstrap the application for artisan commands.
         *
         * @return void
         * @static
         */
        public static function bootstrap()
        {
            //Method inherited from \Illuminate\Foundation\Console\Kernel
            /** @var \App\Console\Kernel $instance */
            $instance->bootstrap();
        }

        /**
         * Bootstrap the application without booting service providers.
         *
         * @return void
         * @static
         */
        public static function bootstrapWithoutBootingProviders()
        {
            //Method inherited from \Illuminate\Foundation\Console\Kernel
            /** @var \App\Console\Kernel $instance */
            $instance->bootstrapWithoutBootingProviders();
        }

        /**
         * Set the Artisan application instance.
         *
         * @param \Illuminate\Console\Application|null $artisan
         * @return void
         * @static
         */
        public static function setArtisan($artisan)
        {
            //Method inherited from \Illuminate\Foundation\Console\Kernel
            /** @var \App\Console\Kernel $instance */
            $instance->setArtisan($artisan);
        }

        /**
         * Set the Artisan commands provided by the application.
         *
         * @param array $commands
         * @return \App\Console\Kernel
         * @static
         */
        public static function addCommands($commands)
        {
            //Method inherited from \Illuminate\Foundation\Console\Kernel
            /** @var \App\Console\Kernel $instance */
            return $instance->addCommands($commands);
        }

        /**
         * Set the paths that should have their Artisan commands automatically discovered.
         *
         * @param array $paths
         * @return \App\Console\Kernel
         * @static
         */
        public static function addCommandPaths($paths)
        {
            //Method inherited from \Illuminate\Foundation\Console\Kernel
            /** @var \App\Console\Kernel $instance */
            return $instance->addCommandPaths($paths);
        }

        /**
         * Set the paths that should have their Artisan "routes" automatically discovered.
         *
         * @param array $paths
         * @return \App\Console\Kernel
         * @static
         */
        public static function addCommandRoutePaths($paths)
        {
            //Method inherited from \Illuminate\Foundation\Console\Kernel
            /** @var \App\Console\Kernel $instance */
            return $instance->addCommandRoutePaths($paths);
        }

            }
    /**
     *
     *
     * @see \Illuminate\Auth\AuthManager
     * @see \Illuminate\Auth\SessionGuard
     */
    class Auth {
        /**
         * Attempt to get the guard from the local cache.
         *
         * @param string|null $name
         * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
         * @static
         */
        public static function guard($name = null)
        {
            /** @var \Illuminate\Auth\AuthManager $instance */
            return $instance->guard($name);
        }

        /**
         * Create a session based authentication guard.
         *
         * @param string $name
         * @param array $config
         * @return \Illuminate\Auth\SessionGuard
         * @static
         */
        public static function createSessionDriver($name, $config)
        {
            /** @var \Illuminate\Auth\AuthManager $instance */
            return $instance->createSessionDriver($name, $config);
        }

        /**
         * Create a token based authentication guard.
         *
         * @param string $name
         * @param array $config
         * @return \Illuminate\Auth\TokenGuard
         * @static
         */
        public static function createTokenDriver($name, $config)
        {
            /** @var \Illuminate\Auth\AuthManager $instance */
            return $instance->createTokenDriver($name, $config);
        }

        /**
         * Get the default authentication driver name.
         *
         * @return string
         * @static
         */
        public static function getDefaultDriver()
        {
            /** @var \Illuminate\Auth\AuthManager $instance */
            return $instance->getDefaultDriver();
        }

        /**
         * Set the default guard driver the factory should serve.
         *
         * @param string $name
         * @return void
         * @static
         */
        public static function shouldUse($name)
        {
            /** @var \Illuminate\Auth\AuthManager $instance */
            $instance->shouldUse($name);
        }

        /**
         * Set the default authentication driver name.
         *
         * @param string $name
         * @return void
         * @static
         */
        public static function setDefaultDriver($name)
        {
            /** @var \Illuminate\Auth\AuthManager $instance */
            $instance->setDefaultDriver($name);
        }

        /**
         * Register a new callback based request guard.
         *
         * @param string $driver
         * @param callable $callback
         * @return \Illuminate\Auth\AuthManager
         * @static
         */
        public static function viaRequest($driver, $callback)
        {
            /** @var \Illuminate\Auth\AuthManager $instance */
            return $instance->viaRequest($driver, $callback);
        }

        /**
         * Get the user resolver callback.
         *
         * @return \Closure
         * @static
         */
        public static function userResolver()
        {
            /** @var \Illuminate\Auth\AuthManager $instance */
            return $instance->userResolver();
        }

        /**
         * Set the callback to be used to resolve users.
         *
         * @param \Closure $userResolver
         * @return \Illuminate\Auth\AuthManager
         * @static
         */
        public static function resolveUsersUsing($userResolver)
        {
            /** @var \Illuminate\Auth\AuthManager $instance */
            return $instance->resolveUsersUsing($userResolver);
        }

        /**
         * Register a custom driver creator Closure.
         *
         * @param string $driver
         * @param \Closure $callback
         * @return \Illuminate\Auth\AuthManager
         * @static
         */
        public static function extend($driver, $callback)
        {
            /** @var \Illuminate\Auth\AuthManager $instance */
            return $instance->extend($driver, $callback);
        }

        /**
         * Register a custom provider creator Closure.
         *
         * @param string $name
         * @param \Closure $callback
         * @return \Illuminate\Auth\AuthManager
         * @static
         */
        public static function provider($name, $callback)
        {
            /** @var \Illuminate\Auth\AuthManager $instance */
            return $instance->provider($name, $callback);
        }

        /**
         * Determines if any guards have already been resolved.
         *
         * @return bool
         * @static
         */
        public static function hasResolvedGuards()
        {
            /** @var \Illuminate\Auth\AuthManager $instance */
            return $instance->hasResolvedGuards();
        }

        /**
         * Forget all of the resolved guard instances.
         *
         * @return \Illuminate\Auth\AuthManager
         * @static
         */
        public static function forgetGuards()
        {
            /** @var \Illuminate\Auth\AuthManager $instance */
            return $instance->forgetGuards();
        }

        /**
         * Set the application instance used by the manager.
         *
         * @param \Illuminate\Contracts\Foundation\Application $app
         * @return \Illuminate\Auth\AuthManager
         * @static
         */
        public static function setApplication($app)
        {
            /** @var \Illuminate\Auth\AuthManager $instance */
            return $instance->setApplication($app);
        }

        /**
         * Create the user provider implementation for the driver.
         *
         * @param string|null $provider
         * @return \Illuminate\Contracts\Auth\UserProvider|null
         * @throws \InvalidArgumentException
         * @static
         */
        public static function createUserProvider($provider = null)
        {
            /** @var \Illuminate\Auth\AuthManager $instance */
            return $instance->createUserProvider($provider);
        }

        /**
         * Get the default user provider name.
         *
         * @return string
         * @static
         */
        public static function getDefaultUserProvider()
        {
            /** @var \Illuminate\Auth\AuthManager $instance */
            return $instance->getDefaultUserProvider();
        }

        /**
         * Get the currently authenticated user.
         *
         * @return \App\Models\User|null
         * @static
         */
        public static function user()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->user();
        }

        /**
         * Get the ID for the currently authenticated user.
         *
         * @return int|string|null
         * @static
         */
        public static function id()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->id();
        }

        /**
         * Log a user into the application without sessions or cookies.
         *
         * @param array $credentials
         * @return bool
         * @static
         */
        public static function once($credentials = [])
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->once($credentials);
        }

        /**
         * Log the given user ID into the application without sessions or cookies.
         *
         * @param mixed $id
         * @return \App\Models\User|false
         * @static
         */
        public static function onceUsingId($id)
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->onceUsingId($id);
        }

        /**
         * Validate a user's credentials.
         *
         * @param array $credentials
         * @return bool
         * @static
         */
        public static function validate($credentials = [])
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->validate($credentials);
        }

        /**
         * Attempt to authenticate using HTTP Basic Auth.
         *
         * @param string $field
         * @param array $extraConditions
         * @return \Symfony\Component\HttpFoundation\Response|null
         * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
         * @static
         */
        public static function basic($field = 'email', $extraConditions = [])
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->basic($field, $extraConditions);
        }

        /**
         * Perform a stateless HTTP Basic login attempt.
         *
         * @param string $field
         * @param array $extraConditions
         * @return \Symfony\Component\HttpFoundation\Response|null
         * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
         * @static
         */
        public static function onceBasic($field = 'email', $extraConditions = [])
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->onceBasic($field, $extraConditions);
        }

        /**
         * Attempt to authenticate a user using the given credentials.
         *
         * @param array $credentials
         * @param bool $remember
         * @return bool
         * @static
         */
        public static function attempt($credentials = [], $remember = false)
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->attempt($credentials, $remember);
        }

        /**
         * Attempt to authenticate a user with credentials and additional callbacks.
         *
         * @param array $credentials
         * @param array|callable|null $callbacks
         * @param bool $remember
         * @return bool
         * @static
         */
        public static function attemptWhen($credentials = [], $callbacks = null, $remember = false)
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->attemptWhen($credentials, $callbacks, $remember);
        }

        /**
         * Log the given user ID into the application.
         *
         * @param mixed $id
         * @param bool $remember
         * @return \App\Models\User|false
         * @static
         */
        public static function loginUsingId($id, $remember = false)
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->loginUsingId($id, $remember);
        }

        /**
         * Log a user into the application.
         *
         * @param \Illuminate\Contracts\Auth\Authenticatable $user
         * @param bool $remember
         * @return void
         * @static
         */
        public static function login($user, $remember = false)
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            $instance->login($user, $remember);
        }

        /**
         * Log the user out of the application.
         *
         * @return void
         * @static
         */
        public static function logout()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            $instance->logout();
        }

        /**
         * Log the user out of the application on their current device only.
         *
         * This method does not cycle the "remember" token.
         *
         * @return void
         * @static
         */
        public static function logoutCurrentDevice()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            $instance->logoutCurrentDevice();
        }

        /**
         * Invalidate other sessions for the current user.
         *
         * The application must be using the AuthenticateSession middleware.
         *
         * @param string $password
         * @return \App\Models\User|null
         * @throws \Illuminate\Auth\AuthenticationException
         * @static
         */
        public static function logoutOtherDevices($password)
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->logoutOtherDevices($password);
        }

        /**
         * Register an authentication attempt event listener.
         *
         * @param mixed $callback
         * @return void
         * @static
         */
        public static function attempting($callback)
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            $instance->attempting($callback);
        }

        /**
         * Get the last user we attempted to authenticate.
         *
         * @return \App\Models\User
         * @static
         */
        public static function getLastAttempted()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->getLastAttempted();
        }

        /**
         * Get a unique identifier for the auth session value.
         *
         * @return string
         * @static
         */
        public static function getName()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->getName();
        }

        /**
         * Get the name of the cookie used to store the "recaller".
         *
         * @return string
         * @static
         */
        public static function getRecallerName()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->getRecallerName();
        }

        /**
         * Determine if the user was authenticated via "remember me" cookie.
         *
         * @return bool
         * @static
         */
        public static function viaRemember()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->viaRemember();
        }

        /**
         * Set the number of minutes the remember me cookie should be valid for.
         *
         * @param int $minutes
         * @return \Illuminate\Auth\SessionGuard
         * @static
         */
        public static function setRememberDuration($minutes)
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->setRememberDuration($minutes);
        }

        /**
         * Get the cookie creator instance used by the guard.
         *
         * @return \Illuminate\Contracts\Cookie\QueueingFactory
         * @throws \RuntimeException
         * @static
         */
        public static function getCookieJar()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->getCookieJar();
        }

        /**
         * Set the cookie creator instance used by the guard.
         *
         * @param \Illuminate\Contracts\Cookie\QueueingFactory $cookie
         * @return void
         * @static
         */
        public static function setCookieJar($cookie)
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            $instance->setCookieJar($cookie);
        }

        /**
         * Get the event dispatcher instance.
         *
         * @return \Illuminate\Contracts\Events\Dispatcher
         * @static
         */
        public static function getDispatcher()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->getDispatcher();
        }

        /**
         * Set the event dispatcher instance.
         *
         * @param \Illuminate\Contracts\Events\Dispatcher $events
         * @return void
         * @static
         */
        public static function setDispatcher($events)
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            $instance->setDispatcher($events);
        }

        /**
         * Get the session store used by the guard.
         *
         * @return \Illuminate\Contracts\Session\Session
         * @static
         */
        public static function getSession()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->getSession();
        }

        /**
         * Return the currently cached user.
         *
         * @return \App\Models\User|null
         * @static
         */
        public static function getUser()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->getUser();
        }

        /**
         * Set the current user.
         *
         * @param \Illuminate\Contracts\Auth\Authenticatable $user
         * @return \Illuminate\Auth\SessionGuard
         * @static
         */
        public static function setUser($user)
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->setUser($user);
        }

        /**
         * Get the current request instance.
         *
         * @return \Symfony\Component\HttpFoundation\Request
         * @static
         */
        public static function getRequest()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->getRequest();
        }

        /**
         * Set the current request instance.
         *
         * @param \Symfony\Component\HttpFoundation\Request $request
         * @return \Illuminate\Auth\SessionGuard
         * @static
         */
        public static function setRequest($request)
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->setRequest($request);
        }

        /**
         * Get the timebox instance used by the guard.
         *
         * @return \Illuminate\Support\Timebox
         * @static
         */
        public static function getTimebox()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->getTimebox();
        }

        /**
         * Determine if the current user is authenticated. If not, throw an exception.
         *
         * @return \App\Models\User
         * @throws \Illuminate\Auth\AuthenticationException
         * @static
         */
        public static function authenticate()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->authenticate();
        }

        /**
         * Determine if the guard has a user instance.
         *
         * @return bool
         * @static
         */
        public static function hasUser()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->hasUser();
        }

        /**
         * Determine if the current user is authenticated.
         *
         * @return bool
         * @static
         */
        public static function check()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->check();
        }

        /**
         * Determine if the current user is a guest.
         *
         * @return bool
         * @static
         */
        public static function guest()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->guest();
        }

        /**
         * Forget the current user.
         *
         * @return \Illuminate\Auth\SessionGuard
         * @static
         */
        public static function forgetUser()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->forgetUser();
        }

        /**
         * Get the user provider used by the guard.
         *
         * @return \Illuminate\Contracts\Auth\UserProvider
         * @static
         */
        public static function getProvider()
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            return $instance->getProvider();
        }

        /**
         * Set the user provider used by the guard.
         *
         * @param \Illuminate\Contracts\Auth\UserProvider $provider
         * @return void
         * @static
         */
        public static function setProvider($provider)
        {
            /** @var \Illuminate\Auth\SessionGuard $instance */
            $instance->setProvider($provider);
        }

        /**
         * Register a custom macro.
         *
         * @param string $name
         * @param object|callable $macro
         * @param-closure-this static  $macro
         * @return void
         * @static
         */
        public static function macro($name, $macro)
        {
            \Illuminate\Auth\SessionGuard::macro($name, $macro);
        }

        /**
         * Mix another object into the class.
         *
         * @param object $mixin
         * @param bool $replace
         * @return void
         * @throws \ReflectionException
         * @static
         */
        public static function mixin($mixin, $replace = true)
        {
            \Illuminate\Auth\SessionGuard::mixin($mixin, $replace);
        }

        /**
         * Checks if macro is registered.
         *
         * @param string $name
         * @return bool
         * @static
         */
        public static function hasMacro($name)
        {
            return \Illuminate\Auth\SessionGuard::hasMacro($name);
        }

        /**
         * Flush the existing macros.
         *
         * @return void
         * @static
         */
        public static function flushMacros()
        {
            \Illuminate\Auth\SessionGuard::flushMacros();
        }

            }
    /**
     *
     *
     * @see \Illuminate\View\Compilers\BladeCompiler
     */
    class Blade {
        /**
         * Compile the view at the given path.
         *
         * @param string|null $path
         * @return void
         * @static
         */
        public static function compile($path = null)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->compile($path);
        }

        /**
         * Get the path currently being compiled.
         *
         * @return string
         * @static
         */
        public static function getPath()
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            return $instance->getPath();
        }

        /**
         * Set the path currently being compiled.
         *
         * @param string $path
         * @return void
         * @static
         */
        public static function setPath($path)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->setPath($path);
        }

        /**
         * Compile the given Blade template contents.
         *
         * @param string $value
         * @return string
         * @static
         */
        public static function compileString($value)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            return $instance->compileString($value);
        }

        /**
         * Evaluate and render a Blade string to HTML.
         *
         * @param string $string
         * @param array $data
         * @param bool $deleteCachedView
         * @return string
         * @static
         */
        public static function render($string, $data = [], $deleteCachedView = false)
        {
            return \Illuminate\View\Compilers\BladeCompiler::render($string, $data, $deleteCachedView);
        }

        /**
         * Render a component instance to HTML.
         *
         * @param \Illuminate\View\Component $component
         * @return string
         * @static
         */
        public static function renderComponent($component)
        {
            return \Illuminate\View\Compilers\BladeCompiler::renderComponent($component);
        }

        /**
         * Strip the parentheses from the given expression.
         *
         * @param string $expression
         * @return string
         * @static
         */
        public static function stripParentheses($expression)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            return $instance->stripParentheses($expression);
        }

        /**
         * Register a custom Blade compiler.
         *
         * @param callable $compiler
         * @return void
         * @static
         */
        public static function extend($compiler)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->extend($compiler);
        }

        /**
         * Get the extensions used by the compiler.
         *
         * @return array
         * @static
         */
        public static function getExtensions()
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            return $instance->getExtensions();
        }

        /**
         * Register an "if" statement directive.
         *
         * @param string $name
         * @param callable $callback
         * @return void
         * @static
         */
        public static function if($name, $callback)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->if($name, $callback);
        }

        /**
         * Check the result of a condition.
         *
         * @param string $name
         * @param mixed $parameters
         * @return bool
         * @static
         */
        public static function check($name, ...$parameters)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            return $instance->check($name, ...$parameters);
        }

        /**
         * Register a class-based component alias directive.
         *
         * @param string $class
         * @param string|null $alias
         * @param string $prefix
         * @return void
         * @static
         */
        public static function component($class, $alias = null, $prefix = '')
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->component($class, $alias, $prefix);
        }

        /**
         * Register an array of class-based components.
         *
         * @param array $components
         * @param string $prefix
         * @return void
         * @static
         */
        public static function components($components, $prefix = '')
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->components($components, $prefix);
        }

        /**
         * Get the registered class component aliases.
         *
         * @return array
         * @static
         */
        public static function getClassComponentAliases()
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            return $instance->getClassComponentAliases();
        }

        /**
         * Register a new anonymous component path.
         *
         * @param string $path
         * @param string|null $prefix
         * @return void
         * @static
         */
        public static function anonymousComponentPath($path, $prefix = null)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->anonymousComponentPath($path, $prefix);
        }

        /**
         * Register an anonymous component namespace.
         *
         * @param string $directory
         * @param string|null $prefix
         * @return void
         * @static
         */
        public static function anonymousComponentNamespace($directory, $prefix = null)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->anonymousComponentNamespace($directory, $prefix);
        }

        /**
         * Register a class-based component namespace.
         *
         * @param string $namespace
         * @param string $prefix
         * @return void
         * @static
         */
        public static function componentNamespace($namespace, $prefix)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->componentNamespace($namespace, $prefix);
        }

        /**
         * Get the registered anonymous component paths.
         *
         * @return array
         * @static
         */
        public static function getAnonymousComponentPaths()
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            return $instance->getAnonymousComponentPaths();
        }

        /**
         * Get the registered anonymous component namespaces.
         *
         * @return array
         * @static
         */
        public static function getAnonymousComponentNamespaces()
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            return $instance->getAnonymousComponentNamespaces();
        }

        /**
         * Get the registered class component namespaces.
         *
         * @return array
         * @static
         */
        public static function getClassComponentNamespaces()
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            return $instance->getClassComponentNamespaces();
        }

        /**
         * Register a component alias directive.
         *
         * @param string $path
         * @param string|null $alias
         * @return void
         * @static
         */
        public static function aliasComponent($path, $alias = null)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->aliasComponent($path, $alias);
        }

        /**
         * Register an include alias directive.
         *
         * @param string $path
         * @param string|null $alias
         * @return void
         * @static
         */
        public static function include($path, $alias = null)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->include($path, $alias);
        }

        /**
         * Register an include alias directive.
         *
         * @param string $path
         * @param string|null $alias
         * @return void
         * @static
         */
        public static function aliasInclude($path, $alias = null)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->aliasInclude($path, $alias);
        }

        /**
         * Register a handler for custom directives, binding the handler to the compiler.
         *
         * @param string $name
         * @param callable $handler
         * @return void
         * @throws \InvalidArgumentException
         * @static
         */
        public static function bindDirective($name, $handler)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->bindDirective($name, $handler);
        }

        /**
         * Register a handler for custom directives.
         *
         * @param string $name
         * @param callable $handler
         * @param bool $bind
         * @return void
         * @throws \InvalidArgumentException
         * @static
         */
        public static function directive($name, $handler, $bind = false)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->directive($name, $handler, $bind);
        }

        /**
         * Get the list of custom directives.
         *
         * @return array
         * @static
         */
        public static function getCustomDirectives()
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            return $instance->getCustomDirectives();
        }

        /**
         * Indicate that the following callable should be used to prepare strings for compilation.
         *
         * @param callable $callback
         * @return \Illuminate\View\Compilers\BladeCompiler
         * @static
         */
        public static function prepareStringsForCompilationUsing($callback)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            return $instance->prepareStringsForCompilationUsing($callback);
        }

        /**
         * Register a new precompiler.
         *
         * @param callable $precompiler
         * @return void
         * @static
         */
        public static function precompiler($precompiler)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->precompiler($precompiler);
        }

        /**
         * Set the echo format to be used by the compiler.
         *
         * @param string $format
         * @return void
         * @static
         */
        public static function setEchoFormat($format)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->setEchoFormat($format);
        }

        /**
         * Set the "echo" format to double encode entities.
         *
         * @return void
         * @static
         */
        public static function withDoubleEncoding()
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->withDoubleEncoding();
        }

        /**
         * Set the "echo" format to not double encode entities.
         *
         * @return void
         * @static
         */
        public static function withoutDoubleEncoding()
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->withoutDoubleEncoding();
        }

        /**
         * Indicate that component tags should not be compiled.
         *
         * @return void
         * @static
         */
        public static function withoutComponentTags()
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->withoutComponentTags();
        }

        /**
         * Get the path to the compiled version of a view.
         *
         * @param string $path
         * @return string
         * @static
         */
        public static function getCompiledPath($path)
        {
            //Method inherited from \Illuminate\View\Compilers\Compiler
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            return $instance->getCompiledPath($path);
        }

        /**
         * Determine if the view at the given path is expired.
         *
         * @param string $path
         * @return bool
         * @throws \ErrorException
         * @static
         */
        public static function isExpired($path)
        {
            //Method inherited from \Illuminate\View\Compilers\Compiler
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            return $instance->isExpired($path);
        }

        /**
         * Get a new component hash for a component name.
         *
         * @param string $component
         * @return string
         * @static
         */
        public static function newComponentHash($component)
        {
            return \Illuminate\View\Compilers\BladeCompiler::newComponentHash($component);
        }

        /**
         * Compile a class component opening.
         *
         * @param string $component
         * @param string $alias
         * @param string $data
         * @param string $hash
         * @return string
         * @static
         */
        public static function compileClassComponentOpening($component, $alias, $data, $hash)
        {
            return \Illuminate\View\Compilers\BladeCompiler::compileClassComponentOpening($component, $alias, $data, $hash);
        }

        /**
         * Compile the end-component statements into valid PHP.
         *
         * @return string
         * @static
         */
        public static function compileEndComponentClass()
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            return $instance->compileEndComponentClass();
        }

        /**
         * Sanitize the given component attribute value.
         *
         * @param mixed $value
         * @return mixed
         * @static
         */
        public static function sanitizeComponentAttribute($value)
        {
            return \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($value);
        }

        /**
         * Compile an end-once block into valid PHP.
         *
         * @return string
         * @static
         */
        public static function compileEndOnce()
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            return $instance->compileEndOnce();
        }

        /**
         * Add a handler to be executed before echoing a given class.
         *
         * @param string|callable $class
         * @param callable|null $handler
         * @return void
         * @static
         */
        public static function stringable($class, $handler = null)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            $instance->stringable($class, $handler);
        }

        /**
         * Compile Blade echos into valid PHP.
         *
         * @param string $value
         * @return string
         * @static
         */
        public static function compileEchos($value)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            return $instance->compileEchos($value);
        }

        /**
         * Apply the echo handler for the value if it exists.
         *
         * @param string $value
         * @return string
         * @static
         */
        public static function applyEchoHandler($value)
        {
            /** @var \Illuminate\View\Compilers\BladeCompiler $instance */
            return $instance->applyEchoHandler($value);
        }

            }
    /**
     *
     *
     * @method static mixed auth(\Illuminate\Http\Request $request)
     * @method static mixed validAuthenticationResponse(\Illuminate\Http\Request $request, mixed $result)
     * @method static void broadcast(array $channels, string $event, array $payload = [])
     * @method static array|null resolveAuthenticatedUser(\Illuminate\Http\Request $request)
     * @method static void resolveAuthenticatedUserUsing(\Closure $callback)
     * @method static \Illuminate\Broadcasting\Broadcasters\Broadcaster channel(\Illuminate\Contracts\Broadcasting\HasBroadcastChannel|string $channel, callable|string $callback, array $options = [])
     * @method static \Illuminate\Support\Collection getChannels()
     * @see \Illuminate\Broadcasting\BroadcastManager
     * @see \Illuminate\Broadcasting\Broadcasters\Broadcaster
     */
    class Broadcast {
        /**
         * Register the routes for handling broadcast channel authentication and sockets.
         *
         * @param array|null $attributes
         * @return void
         * @static
         */
        public static function routes($attributes = null)
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            $instance->routes($attributes);
        }

        /**
         * Register the routes for handling broadcast user authentication.
         *
         * @param array|null $attributes
         * @return void
         * @static
         */
        public static function userRoutes($attributes = null)
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            $instance->userRoutes($attributes);
        }

        /**
         * Register the routes for handling broadcast authentication and sockets.
         *
         * Alias of "routes" method.
         *
         * @param array|null $attributes
         * @return void
         * @static
         */
        public static function channelRoutes($attributes = null)
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            $instance->channelRoutes($attributes);
        }

        /**
         * Get the socket ID for the given request.
         *
         * @param \Illuminate\Http\Request|null $request
         * @return string|null
         * @static
         */
        public static function socket($request = null)
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            return $instance->socket($request);
        }

        /**
         * Begin sending an anonymous broadcast to the given channels.
         *
         * @static
         */
        public static function on($channels)
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            return $instance->on($channels);
        }

        /**
         * Begin sending an anonymous broadcast to the given private channels.
         *
         * @static
         */
        public static function private($channel)
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            return $instance->private($channel);
        }

        /**
         * Begin sending an anonymous broadcast to the given presence channels.
         *
         * @static
         */
        public static function presence($channel)
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            return $instance->presence($channel);
        }

        /**
         * Begin broadcasting an event.
         *
         * @param mixed|null $event
         * @return \Illuminate\Broadcasting\PendingBroadcast
         * @static
         */
        public static function event($event = null)
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            return $instance->event($event);
        }

        /**
         * Queue the given event for broadcast.
         *
         * @param mixed $event
         * @return void
         * @static
         */
        public static function queue($event)
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            $instance->queue($event);
        }

        /**
         * Get a driver instance.
         *
         * @param string|null $driver
         * @return mixed
         * @static
         */
        public static function connection($driver = null)
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            return $instance->connection($driver);
        }

        /**
         * Get a driver instance.
         *
         * @param string|null $name
         * @return mixed
         * @static
         */
        public static function driver($name = null)
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            return $instance->driver($name);
        }

        /**
         * Get a Pusher instance for the given configuration.
         *
         * @param array $config
         * @return \Pusher\Pusher
         * @static
         */
        public static function pusher($config)
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            return $instance->pusher($config);
        }

        /**
         * Get an Ably instance for the given configuration.
         *
         * @param array $config
         * @return \Ably\AblyRest
         * @static
         */
        public static function ably($config)
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            return $instance->ably($config);
        }

        /**
         * Get the default driver name.
         *
         * @return string
         * @static
         */
        public static function getDefaultDriver()
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            return $instance->getDefaultDriver();
        }

        /**
         * Set the default driver name.
         *
         * @param string $name
         * @return void
         * @static
         */
        public static function setDefaultDriver($name)
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            $instance->setDefaultDriver($name);
        }

        /**
         * Disconnect the given disk and remove from local cache.
         *
         * @param string|null $name
         * @return void
         * @static
         */
        public static function purge($name = null)
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            $instance->purge($name);
        }

        /**
         * Register a custom driver creator Closure.
         *
         * @param string $driver
         * @param \Closure $callback
         * @return \Illuminate\Broadcasting\BroadcastManager
         * @static
         */
        public static function extend($driver, $callback)
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            return $instance->extend($driver, $callback);
        }

        /**
         * Get the application instance used by the manager.
         *
         * @return \Illuminate\Contracts\Foundation\Application
         * @static
         */
        public static function getApplication()
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            return $instance->getApplication();
        }

        /**
         * Set the application instance used by the manager.
         *
         * @param \Illuminate\Contracts\Foundation\Application $app
         * @return \Illuminate\Broadcasting\BroadcastManager
         * @static
         */
        public static function setApplication($app)
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            return $instance->setApplication($app);
        }

        /**
         * Forget all of the resolved driver instances.
         *
         * @return \Illuminate\Broadcasting\BroadcastManager
         * @static
         */
        public static function forgetDrivers()
        {
            /** @var \Illuminate\Broadcasting\BroadcastManager $instance */
            return $instance->forgetDrivers();
        }

            }
    /**
     *
     *
     * @see \Illuminate\Bus\Dispatcher
     * @see \Illuminate\Support\Testing\Fakes\BusFake
     */
    class Bus {
        /**
         * Dispatch a command to its appropriate handler.
         *
         * @param mixed $command
         * @return mixed
         * @static
         */
        public static function dispatch($command)
        {
            /** @var \Illuminate\Bus\Dispatcher $instance */
            return $instance->dispatch($command);
        }

        /**
         * Dispatch a command to its appropriate handler in the current process.
         *
         * Queueable jobs will be dispatched to the "sync" queue.
         *
         * @param mixed $command
         * @param mixed $handler
         * @return mixed
         * @static
         */
        public static function dispatchSync($command, $handler = null)
        {
            /** @var \Illuminate\Bus\Dispatcher $instance */
            return $instance->dispatchSync($command, $handler);
        }

        /**
         * Dispatch a command to its appropriate handler in the current process without using the synchronous queue.
         *
         * @param mixed $command
         * @param mixed $handler
         * @return mixed
         * @static
         */
        public static function dispatchNow($command, $handler = null)
        {
            /** @var \Illuminate\Bus\Dispatcher $instance */
            return $instance->dispatchNow($command, $handler);
        }

        /**
         * Attempt to find the batch with the given ID.
         *
         * @param string $batchId
         * @return \Illuminate\Bus\Batch|null
         * @static
         */
        public static function findBatch($batchId)
        {
            /** @var \Illuminate\Bus\Dispatcher $instance */
            return $instance->findBatch($batchId);
        }

        /**
         * Create a new batch of queueable jobs.
         *
         * @param \Illuminate\Support\Collection|array|mixed $jobs
         * @return \Illuminate\Bus\PendingBatch
         * @static
         */
        public static function batch($jobs)
        {
            /** @var \Illuminate\Bus\Dispatcher $instance */
            return $instance->batch($jobs);
        }

        /**
         * Create a new chain of queueable jobs.
         *
         * @param \Illuminate\Support\Collection|array $jobs
         * @return \Illuminate\Foundation\Bus\PendingChain
         * @static
         */
        public static function chain($jobs)
        {
            /** @var \Illuminate\Bus\Dispatcher $instance */
            return $instance->chain($jobs);
        }

        /**
         * Determine if the given command has a handler.
         *
         * @param mixed $command
         * @return bool
         * @static
         */
        public static function hasCommandHandler($command)
        {
            /** @var \Illuminate\Bus\Dispatcher $instance */
            return $instance->hasCommandHandler($command);
        }

        /**
         * Retrieve the handler for a command.
         *
         * @param mixed $command
         * @return bool|mixed
         * @static
         */
        public static function getCommandHandler($command)
        {
            /** @var \Illuminate\Bus\Dispatcher $instance */
            return $instance->getCommandHandler($command);
        }

        /**
         * Dispatch a command to its appropriate handler behind a queue.
         *
         * @param mixed $command
         * @return mixed
         * @throws \RuntimeException
         * @static
         */
        public static function dispatchToQueue($command)
        {
            /** @var \Illuminate\Bus\Dispatcher $instance */
            return $instance->dispatchToQueue($command);
        }

        /**
         * Dispatch a command to its appropriate handler after the current process.
         *
         * @param mixed $command
         * @param mixed $handler
         * @return void
         * @static
         */
        public static function dispatchAfterResponse($command, $handler = null)
        {
            /** @var \Illuminate\Bus\Dispatcher $instance */
            $instance->dispatchAfterResponse($command, $handler);
        }

        /**
         * Set the pipes through which commands should be piped before dispatching.
         *
         * @param array $pipes
         * @return \Illuminate\Bus\Dispatcher
         * @static
         */
        public static function pipeThrough($pipes)
        {
            /** @var \Illuminate\Bus\Dispatcher $instance */
            return $instance->pipeThrough($pipes);
        }

        /**
         * Map a command to a handler.
         *
         * @param array $map
         * @return \Illuminate\Bus\Dispatcher
         * @static
         */
        public static function map($map)
        {
            /** @var \Illuminate\Bus\Dispatcher $instance */
            return $instance->map($map);
        }

        /**
         * Specify the jobs that should be dispatched instead of faked.
         *
         * @param array|string $jobsToDispatch
         * @return \Illuminate\Support\Testing\Fakes\BusFake
         * @static
         */
        public static function except($jobsToDispatch)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            return $instance->except($jobsToDispatch);
        }

        /**
         * Assert if a job was dispatched based on a truth-test callback.
         *
         * @param string|\Closure $command
         * @param callable|int|null $callback
         * @return void
         * @static
         */
        public static function assertDispatched($command, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            $instance->assertDispatched($command, $callback);
        }

        /**
         * Assert if a job was pushed a number of times.
         *
         * @param string|\Closure $command
         * @param int $times
         * @return void
         * @static
         */
        public static function assertDispatchedTimes($command, $times = 1)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            $instance->assertDispatchedTimes($command, $times);
        }

        /**
         * Determine if a job was dispatched based on a truth-test callback.
         *
         * @param string|\Closure $command
         * @param callable|null $callback
         * @return void
         * @static
         */
        public static function assertNotDispatched($command, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            $instance->assertNotDispatched($command, $callback);
        }

        /**
         * Assert that no jobs were dispatched.
         *
         * @return void
         * @static
         */
        public static function assertNothingDispatched()
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            $instance->assertNothingDispatched();
        }

        /**
         * Assert if a job was explicitly dispatched synchronously based on a truth-test callback.
         *
         * @param string|\Closure $command
         * @param callable|int|null $callback
         * @return void
         * @static
         */
        public static function assertDispatchedSync($command, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            $instance->assertDispatchedSync($command, $callback);
        }

        /**
         * Assert if a job was pushed synchronously a number of times.
         *
         * @param string|\Closure $command
         * @param int $times
         * @return void
         * @static
         */
        public static function assertDispatchedSyncTimes($command, $times = 1)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            $instance->assertDispatchedSyncTimes($command, $times);
        }

        /**
         * Determine if a job was dispatched based on a truth-test callback.
         *
         * @param string|\Closure $command
         * @param callable|null $callback
         * @return void
         * @static
         */
        public static function assertNotDispatchedSync($command, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            $instance->assertNotDispatchedSync($command, $callback);
        }

        /**
         * Assert if a job was dispatched after the response was sent based on a truth-test callback.
         *
         * @param string|\Closure $command
         * @param callable|int|null $callback
         * @return void
         * @static
         */
        public static function assertDispatchedAfterResponse($command, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            $instance->assertDispatchedAfterResponse($command, $callback);
        }

        /**
         * Assert if a job was pushed after the response was sent a number of times.
         *
         * @param string|\Closure $command
         * @param int $times
         * @return void
         * @static
         */
        public static function assertDispatchedAfterResponseTimes($command, $times = 1)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            $instance->assertDispatchedAfterResponseTimes($command, $times);
        }

        /**
         * Determine if a job was dispatched based on a truth-test callback.
         *
         * @param string|\Closure $command
         * @param callable|null $callback
         * @return void
         * @static
         */
        public static function assertNotDispatchedAfterResponse($command, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            $instance->assertNotDispatchedAfterResponse($command, $callback);
        }

        /**
         * Assert if a chain of jobs was dispatched.
         *
         * @param array $expectedChain
         * @return void
         * @static
         */
        public static function assertChained($expectedChain)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            $instance->assertChained($expectedChain);
        }

        /**
         * Assert no chained jobs was dispatched.
         *
         * @return void
         * @static
         */
        public static function assertNothingChained()
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            $instance->assertNothingChained();
        }

        /**
         * Assert if a job was dispatched with an empty chain based on a truth-test callback.
         *
         * @param string|\Closure $command
         * @param callable|null $callback
         * @return void
         * @static
         */
        public static function assertDispatchedWithoutChain($command, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            $instance->assertDispatchedWithoutChain($command, $callback);
        }

        /**
         * Create a new assertion about a chained batch.
         *
         * @param \Closure $callback
         * @return \Illuminate\Support\Testing\Fakes\ChainedBatchTruthTest
         * @static
         */
        public static function chainedBatch($callback)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            return $instance->chainedBatch($callback);
        }

        /**
         * Assert if a batch was dispatched based on a truth-test callback.
         *
         * @param callable $callback
         * @return void
         * @static
         */
        public static function assertBatched($callback)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            $instance->assertBatched($callback);
        }

        /**
         * Assert the number of batches that have been dispatched.
         *
         * @param int $count
         * @return void
         * @static
         */
        public static function assertBatchCount($count)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            $instance->assertBatchCount($count);
        }

        /**
         * Assert that no batched jobs were dispatched.
         *
         * @return void
         * @static
         */
        public static function assertNothingBatched()
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            $instance->assertNothingBatched();
        }

        /**
         * Assert that no jobs were dispatched, chained, or batched.
         *
         * @return void
         * @static
         */
        public static function assertNothingPlaced()
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            $instance->assertNothingPlaced();
        }

        /**
         * Get all of the jobs matching a truth-test callback.
         *
         * @param string $command
         * @param callable|null $callback
         * @return \Illuminate\Support\Collection
         * @static
         */
        public static function dispatched($command, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            return $instance->dispatched($command, $callback);
        }

        /**
         * Get all of the jobs dispatched synchronously matching a truth-test callback.
         *
         * @param string $command
         * @param callable|null $callback
         * @return \Illuminate\Support\Collection
         * @static
         */
        public static function dispatchedSync($command, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            return $instance->dispatchedSync($command, $callback);
        }

        /**
         * Get all of the jobs dispatched after the response was sent matching a truth-test callback.
         *
         * @param string $command
         * @param callable|null $callback
         * @return \Illuminate\Support\Collection
         * @static
         */
        public static function dispatchedAfterResponse($command, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            return $instance->dispatchedAfterResponse($command, $callback);
        }

        /**
         * Get all of the pending batches matching a truth-test callback.
         *
         * @param callable $callback
         * @return \Illuminate\Support\Collection
         * @static
         */
        public static function batched($callback)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            return $instance->batched($callback);
        }

        /**
         * Determine if there are any stored commands for a given class.
         *
         * @param string $command
         * @return bool
         * @static
         */
        public static function hasDispatched($command)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            return $instance->hasDispatched($command);
        }

        /**
         * Determine if there are any stored commands for a given class.
         *
         * @param string $command
         * @return bool
         * @static
         */
        public static function hasDispatchedSync($command)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            return $instance->hasDispatchedSync($command);
        }

        /**
         * Determine if there are any stored commands for a given class.
         *
         * @param string $command
         * @return bool
         * @static
         */
        public static function hasDispatchedAfterResponse($command)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            return $instance->hasDispatchedAfterResponse($command);
        }

        /**
         * Dispatch an empty job batch for testing.
         *
         * @param string $name
         * @return \Illuminate\Bus\Batch
         * @static
         */
        public static function dispatchFakeBatch($name = '')
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            return $instance->dispatchFakeBatch($name);
        }

        /**
         * Record the fake pending batch dispatch.
         *
         * @param \Illuminate\Bus\PendingBatch $pendingBatch
         * @return \Illuminate\Bus\Batch
         * @static
         */
        public static function recordPendingBatch($pendingBatch)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            return $instance->recordPendingBatch($pendingBatch);
        }

        /**
         * Specify if commands should be serialized and restored when being batched.
         *
         * @param bool $serializeAndRestore
         * @return \Illuminate\Support\Testing\Fakes\BusFake
         * @static
         */
        public static function serializeAndRestore($serializeAndRestore = true)
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            return $instance->serializeAndRestore($serializeAndRestore);
        }

        /**
         * Get the batches that have been dispatched.
         *
         * @return array
         * @static
         */
        public static function dispatchedBatches()
        {
            /** @var \Illuminate\Support\Testing\Fakes\BusFake $instance */
            return $instance->dispatchedBatches();
        }

            }
    /**
     *
     *
     * @see \Illuminate\Cache\CacheManager
     * @see \Illuminate\Cache\Repository
     */
    class Cache {
        /**
         * Get a cache store instance by name, wrapped in a repository.
         *
         * @param string|null $name
         * @return \Illuminate\Contracts\Cache\Repository
         * @static
         */
        public static function store($name = null)
        {
            /** @var \Illuminate\Cache\CacheManager $instance */
            return $instance->store($name);
        }

        /**
         * Get a cache driver instance.
         *
         * @param string|null $driver
         * @return \Illuminate\Contracts\Cache\Repository
         * @static
         */
        public static function driver($driver = null)
        {
            /** @var \Illuminate\Cache\CacheManager $instance */
            return $instance->driver($driver);
        }

        /**
         * Resolve the given store.
         *
         * @param string $name
         * @return \Illuminate\Contracts\Cache\Repository
         * @throws \InvalidArgumentException
         * @static
         */
        public static function resolve($name)
        {
            /** @var \Illuminate\Cache\CacheManager $instance */
            return $instance->resolve($name);
        }

        /**
         * Build a cache repository with the given configuration.
         *
         * @param array $config
         * @return \Illuminate\Cache\Repository
         * @static
         */
        public static function build($config)
        {
            /** @var \Illuminate\Cache\CacheManager $instance */
            return $instance->build($config);
        }

        /**
         * Create a new cache repository with the given implementation.
         *
         * @param \Illuminate\Contracts\Cache\Store $store
         * @param array $config
         * @return \Illuminate\Cache\Repository
         * @static
         */
        public static function repository($store, $config = [])
        {
            /** @var \Illuminate\Cache\CacheManager $instance */
            return $instance->repository($store, $config);
        }

        /**
         * Re-set the event dispatcher on all resolved cache repositories.
         *
         * @return void
         * @static
         */
        public static function refreshEventDispatcher()
        {
            /** @var \Illuminate\Cache\CacheManager $instance */
            $instance->refreshEventDispatcher();
        }

        /**
         * Get the default cache driver name.
         *
         * @return string
         * @static
         */
        public static function getDefaultDriver()
        {
            /** @var \Illuminate\Cache\CacheManager $instance */
            return $instance->getDefaultDriver();
        }

        /**
         * Set the default cache driver name.
         *
         * @param string $name
         * @return void
         * @static
         */
        public static function setDefaultDriver($name)
        {
            /** @var \Illuminate\Cache\CacheManager $instance */
            $instance->setDefaultDriver($name);
        }

        /**
         * Unset the given driver instances.
         *
         * @param array|string|null $name
         * @return \Illuminate\Cache\CacheManager
         * @static
         */
        public static function forgetDriver($name = null)
        {
            /** @var \Illuminate\Cache\CacheManager $instance */
            return $instance->forgetDriver($name);
        }

        /**
         * Disconnect the given driver and remove from local cache.
         *
         * @param string|null $name
         * @return void
         * @static
         */
        public static function purge($name = null)
        {
            /** @var \Illuminate\Cache\CacheManager $instance */
            $instance->purge($name);
        }

        /**
         * Register a custom driver creator Closure.
         *
         * @param string $driver
         * @param \Closure $callback
         * @return \Illuminate\Cache\CacheManager
         * @static
         */
        public static function extend($driver, $callback)
        {
            /** @var \Illuminate\Cache\CacheManager $instance */
            return $instance->extend($driver, $callback);
        }

        /**
         * Set the application instance used by the manager.
         *
         * @param \Illuminate\Contracts\Foundation\Application $app
         * @return \Illuminate\Cache\CacheManager
         * @static
         */
        public static function setApplication($app)
        {
            /** @var \Illuminate\Cache\CacheManager $instance */
            return $instance->setApplication($app);
        }

        /**
         * Determine if an item exists in the cache.
         *
         * @param array|string $key
         * @return bool
         * @static
         */
        public static function has($key)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->has($key);
        }

        /**
         * Determine if an item doesn't exist in the cache.
         *
         * @param string $key
         * @return bool
         * @static
         */
        public static function missing($key)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->missing($key);
        }

        /**
         * Retrieve an item from the cache by key.
         *
         * @param array|string $key
         * @param mixed $default
         * @return mixed
         * @static
         */
        public static function get($key, $default = null)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->get($key, $default);
        }

        /**
         * Retrieve multiple items from the cache by key.
         *
         * Items not found in the cache will have a null value.
         *
         * @param array $keys
         * @return array
         * @static
         */
        public static function many($keys)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->many($keys);
        }

        /**
         * Obtains multiple cache items by their unique keys.
         *
         * @return iterable
         * @param iterable<string> $keys A list of keys that can be obtained in a single operation.
         * @param mixed $default Default value to return for keys that do not exist.
         * @return iterable<string, mixed> A list of key => value pairs. Cache keys that do not exist or are stale will have $default as value.
         * @throws \Psr\SimpleCache\InvalidArgumentException
         *   MUST be thrown if $keys is neither an array nor a Traversable,
         *   or if any of the $keys are not a legal value.
         * @static
         */
        public static function getMultiple($keys, $default = null)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->getMultiple($keys, $default);
        }

        /**
         * Retrieve an item from the cache and delete it.
         *
         * @param array|string $key
         * @param mixed $default
         * @return mixed
         * @static
         */
        public static function pull($key, $default = null)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->pull($key, $default);
        }

        /**
         * Store an item in the cache.
         *
         * @param array|string $key
         * @param mixed $value
         * @param \DateTimeInterface|\DateInterval|int|null $ttl
         * @return bool
         * @static
         */
        public static function put($key, $value, $ttl = null)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->put($key, $value, $ttl);
        }

        /**
         * Persists data in the cache, uniquely referenced by a key with an optional expiration TTL time.
         *
         * @return bool
         * @param string $key The key of the item to store.
         * @param mixed $value The value of the item to store, must be serializable.
         * @param null|int|\DateInterval $ttl Optional. The TTL value of this item. If no value is sent and
         *                                      the driver supports TTL then the library may set a default value
         *                                      for it or let the driver take care of that.
         * @return bool True on success and false on failure.
         * @throws \Psr\SimpleCache\InvalidArgumentException
         *   MUST be thrown if the $key string is not a legal value.
         * @static
         */
        public static function set($key, $value, $ttl = null)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->set($key, $value, $ttl);
        }

        /**
         * Store multiple items in the cache for a given number of seconds.
         *
         * @param array $values
         * @param \DateTimeInterface|\DateInterval|int|null $ttl
         * @return bool
         * @static
         */
        public static function putMany($values, $ttl = null)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->putMany($values, $ttl);
        }

        /**
         * Persists a set of key => value pairs in the cache, with an optional TTL.
         *
         * @return bool
         * @param iterable $values A list of key => value pairs for a multiple-set operation.
         * @param null|int|\DateInterval $ttl Optional. The TTL value of this item. If no value is sent and
         *                                       the driver supports TTL then the library may set a default value
         *                                       for it or let the driver take care of that.
         * @return bool True on success and false on failure.
         * @throws \Psr\SimpleCache\InvalidArgumentException
         *   MUST be thrown if $values is neither an array nor a Traversable,
         *   or if any of the $values are not a legal value.
         * @static
         */
        public static function setMultiple($values, $ttl = null)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->setMultiple($values, $ttl);
        }

        /**
         * Store an item in the cache if the key does not exist.
         *
         * @param string $key
         * @param mixed $value
         * @param \DateTimeInterface|\DateInterval|int|null $ttl
         * @return bool
         * @static
         */
        public static function add($key, $value, $ttl = null)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->add($key, $value, $ttl);
        }

        /**
         * Increment the value of an item in the cache.
         *
         * @param string $key
         * @param mixed $value
         * @return int|bool
         * @static
         */
        public static function increment($key, $value = 1)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->increment($key, $value);
        }

        /**
         * Decrement the value of an item in the cache.
         *
         * @param string $key
         * @param mixed $value
         * @return int|bool
         * @static
         */
        public static function decrement($key, $value = 1)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->decrement($key, $value);
        }

        /**
         * Store an item in the cache indefinitely.
         *
         * @param string $key
         * @param mixed $value
         * @return bool
         * @static
         */
        public static function forever($key, $value)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->forever($key, $value);
        }

        /**
         * Get an item from the cache, or execute the given Closure and store the result.
         *
         * @template TCacheValue
         * @param string $key
         * @param \Closure|\DateTimeInterface|\DateInterval|int|null $ttl
         * @param \Closure():  TCacheValue  $callback
         * @return TCacheValue
         * @static
         */
        public static function remember($key, $ttl, $callback)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->remember($key, $ttl, $callback);
        }

        /**
         * Get an item from the cache, or execute the given Closure and store the result forever.
         *
         * @template TCacheValue
         * @param string $key
         * @param \Closure():  TCacheValue  $callback
         * @return TCacheValue
         * @static
         */
        public static function sear($key, $callback)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->sear($key, $callback);
        }

        /**
         * Get an item from the cache, or execute the given Closure and store the result forever.
         *
         * @template TCacheValue
         * @param string $key
         * @param \Closure():  TCacheValue  $callback
         * @return TCacheValue
         * @static
         */
        public static function rememberForever($key, $callback)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->rememberForever($key, $callback);
        }

        /**
         * Retrieve an item from the cache by key, refreshing it in the background if it is stale.
         *
         * @template TCacheValue
         * @param string $key
         * @param \Illuminate\Cache\array{  0: \DateTimeInterface|\DateInterval|int, 1: \DateTimeInterface|\DateInterval|int }  $ttl
         * @param (callable(): TCacheValue) $callback
         * @param \Illuminate\Cache\array{  seconds?: int, owner?: string }|null  $lock
         * @return TCacheValue
         * @static
         */
        public static function flexible($key, $ttl, $callback, $lock = null)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->flexible($key, $ttl, $callback, $lock);
        }

        /**
         * Remove an item from the cache.
         *
         * @param string $key
         * @return bool
         * @static
         */
        public static function forget($key)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->forget($key);
        }

        /**
         * Delete an item from the cache by its unique key.
         *
         * @return bool
         * @param string $key The unique cache key of the item to delete.
         * @return bool True if the item was successfully removed. False if there was an error.
         * @throws \Psr\SimpleCache\InvalidArgumentException
         *   MUST be thrown if the $key string is not a legal value.
         * @static
         */
        public static function delete($key)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->delete($key);
        }

        /**
         * Deletes multiple cache items in a single operation.
         *
         * @return bool
         * @param iterable<string> $keys A list of string-based keys to be deleted.
         * @return bool True if the items were successfully removed. False if there was an error.
         * @throws \Psr\SimpleCache\InvalidArgumentException
         *   MUST be thrown if $keys is neither an array nor a Traversable,
         *   or if any of the $keys are not a legal value.
         * @static
         */
        public static function deleteMultiple($keys)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->deleteMultiple($keys);
        }

        /**
         * Wipes clean the entire cache's keys.
         *
         * @return bool
         * @return bool True on success and false on failure.
         * @static
         */
        public static function clear()
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->clear();
        }

        /**
         * Begin executing a new tags operation if the store supports it.
         *
         * @param array|mixed $names
         * @return \Illuminate\Cache\TaggedCache
         * @throws \BadMethodCallException
         * @static
         */
        public static function tags($names)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->tags($names);
        }

        /**
         * Determine if the current store supports tags.
         *
         * @return bool
         * @static
         */
        public static function supportsTags()
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->supportsTags();
        }

        /**
         * Get the default cache time.
         *
         * @return int|null
         * @static
         */
        public static function getDefaultCacheTime()
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->getDefaultCacheTime();
        }

        /**
         * Set the default cache time in seconds.
         *
         * @param int|null $seconds
         * @return \Illuminate\Cache\Repository
         * @static
         */
        public static function setDefaultCacheTime($seconds)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->setDefaultCacheTime($seconds);
        }

        /**
         * Get the cache store implementation.
         *
         * @return \Illuminate\Contracts\Cache\Store
         * @static
         */
        public static function getStore()
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->getStore();
        }

        /**
         * Set the cache store implementation.
         *
         * @param \Illuminate\Contracts\Cache\Store $store
         * @return static
         * @static
         */
        public static function setStore($store)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->setStore($store);
        }

        /**
         * Get the event dispatcher instance.
         *
         * @return \Illuminate\Contracts\Events\Dispatcher|null
         * @static
         */
        public static function getEventDispatcher()
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->getEventDispatcher();
        }

        /**
         * Set the event dispatcher instance.
         *
         * @param \Illuminate\Contracts\Events\Dispatcher $events
         * @return void
         * @static
         */
        public static function setEventDispatcher($events)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            $instance->setEventDispatcher($events);
        }

        /**
         * Determine if a cached value exists.
         *
         * @param string $key
         * @return bool
         * @static
         */
        public static function offsetExists($key)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->offsetExists($key);
        }

        /**
         * Retrieve an item from the cache by key.
         *
         * @param string $key
         * @return mixed
         * @static
         */
        public static function offsetGet($key)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->offsetGet($key);
        }

        /**
         * Store an item in the cache for the default time.
         *
         * @param string $key
         * @param mixed $value
         * @return void
         * @static
         */
        public static function offsetSet($key, $value)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            $instance->offsetSet($key, $value);
        }

        /**
         * Remove an item from the cache.
         *
         * @param string $key
         * @return void
         * @static
         */
        public static function offsetUnset($key)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            $instance->offsetUnset($key);
        }

        /**
         * Register a custom macro.
         *
         * @param string $name
         * @param object|callable $macro
         * @param-closure-this static  $macro
         * @return void
         * @static
         */
        public static function macro($name, $macro)
        {
            \Illuminate\Cache\Repository::macro($name, $macro);
        }

        /**
         * Mix another object into the class.
         *
         * @param object $mixin
         * @param bool $replace
         * @return void
         * @throws \ReflectionException
         * @static
         */
        public static function mixin($mixin, $replace = true)
        {
            \Illuminate\Cache\Repository::mixin($mixin, $replace);
        }

        /**
         * Checks if macro is registered.
         *
         * @param string $name
         * @return bool
         * @static
         */
        public static function hasMacro($name)
        {
            return \Illuminate\Cache\Repository::hasMacro($name);
        }

        /**
         * Flush the existing macros.
         *
         * @return void
         * @static
         */
        public static function flushMacros()
        {
            \Illuminate\Cache\Repository::flushMacros();
        }

        /**
         * Dynamically handle calls to the class.
         *
         * @param string $method
         * @param array $parameters
         * @return mixed
         * @throws \BadMethodCallException
         * @static
         */
        public static function macroCall($method, $parameters)
        {
            /** @var \Illuminate\Cache\Repository $instance */
            return $instance->macroCall($method, $parameters);
        }

        /**
         * Get a lock instance.
         *
         * @param string $name
         * @param int $seconds
         * @param string|null $owner
         * @return \Illuminate\Contracts\Cache\Lock
         * @static
         */
        public static function lock($name, $seconds = 0, $owner = null)
        {
            /** @var \Illuminate\Cache\FileStore $instance */
            return $instance->lock($name, $seconds, $owner);
        }

        /**
         * Restore a lock instance using the owner identifier.
         *
         * @param string $name
         * @param string $owner
         * @return \Illuminate\Contracts\Cache\Lock
         * @static
         */
        public static function restoreLock($name, $owner)
        {
            /** @var \Illuminate\Cache\FileStore $instance */
            return $instance->restoreLock($name, $owner);
        }

        /**
         * Remove all items from the cache.
         *
         * @return bool
         * @static
         */
        public static function flush()
        {
            /** @var \Illuminate\Cache\FileStore $instance */
            return $instance->flush();
        }

        /**
         * Get the full path for the given cache key.
         *
         * @param string $key
         * @return string
         * @static
         */
        public static function path($key)
        {
            /** @var \Illuminate\Cache\FileStore $instance */
            return $instance->path($key);
        }

        /**
         * Get the Filesystem instance.
         *
         * @return \Illuminate\Filesystem\Filesystem
         * @static
         */
        public static function getFilesystem()
        {
            /** @var \Illuminate\Cache\FileStore $instance */
            return $instance->getFilesystem();
        }

        /**
         * Get the working directory of the cache.
         *
         * @return string
         * @static
         */
        public static function getDirectory()
        {
            /** @var \Illuminate\Cache\FileStore $instance */
            return $instance->getDirectory();
        }

        /**
         * Set the working directory of the cache.
         *
         * @param string $directory
         * @return \Illuminate\Cache\FileStore
         * @static
         */
        public static function setDirectory($directory)
        {
            /** @var \Illuminate\Cache\FileStore $instance */
            return $instance->setDirectory($directory);
        }

        /**
         * Set the cache directory where locks should be stored.
         *
         * @param string|null $lockDirectory
         * @return \Illuminate\Cache\FileStore
         * @static
         */
        public static function setLockDirectory($lockDirectory)
        {
            /** @var \Illuminate\Cache\FileStore $instance */
            return $instance->setLockDirectory($lockDirectory);
        }

        /**
         * Get the cache key prefix.
         *
         * @return string
         * @static
         */
        public static function getPrefix()
        {
            /** @var \Illuminate\Cache\FileStore $instance */
            return $instance->getPrefix();
        }

            }
    /**
     *
     *
     * @see \Illuminate\Config\Repository
     */
    class Config {
        /**
         * Determine if the given configuration value exists.
         *
         * @param string $key
         * @return bool
         * @static
         */
        public static function has($key)
        {
            /** @var \Illuminate\Config\Repository $instance */
            return $instance->has($key);
        }

        /**
         * Get the specified configuration value.
         *
         * @param array|string $key
         * @param mixed $default
         * @return mixed
         * @static
         */
        public static function get($key, $default = null)
        {
            /** @var \Illuminate\Config\Repository $instance */
            return $instance->get($key, $default);
        }

        /**
         * Get many configuration values.
         *
         * @param array<string|int,mixed> $keys
         * @return array<string,mixed>
         * @static
         */
        public static function getMany($keys)
        {
            /** @var \Illuminate\Config\Repository $instance */
            return $instance->getMany($keys);
        }

        /**
         * Get the specified string configuration value.
         *
         * @param string $key
         * @param (\Closure():(string|null))|string|null $default
         * @return string
         * @static
         */
        public static function string($key, $default = null)
        {
            /** @var \Illuminate\Config\Repository $instance */
            return $instance->string($key, $default);
        }

        /**
         * Get the specified integer configuration value.
         *
         * @param string $key
         * @param (\Closure():(int|null))|int|null $default
         * @return int
         * @static
         */
        public static function integer($key, $default = null)
        {
            /** @var \Illuminate\Config\Repository $instance */
            return $instance->integer($key, $default);
        }

        /**
         * Get the specified float configuration value.
         *
         * @param string $key
         * @param (\Closure():(float|null))|float|null $default
         * @return float
         * @static
         */
        public static function float($key, $default = null)
        {
            /** @var \Illuminate\Config\Repository $instance */
            return $instance->float($key, $default);
        }

        /**
         * Get the specified boolean configuration value.
         *
         * @param string $key
         * @param (\Closure():(bool|null))|bool|null $default
         * @return bool
         * @static
         */
        public static function boolean($key, $default = null)
        {
            /** @var \Illuminate\Config\Repository $instance */
            return $instance->boolean($key, $default);
        }

        /**
         * Get the specified array configuration value.
         *
         * @param string $key
         * @param (\Closure():(array<array-key, mixed>|null))|array<array-key, mixed>|null $default
         * @return array<array-key, mixed>
         * @static
         */
        public static function array($key, $default = null)
        {
            /** @var \Illuminate\Config\Repository $instance */
            return $instance->array($key, $default);
        }

        /**
         * Set a given configuration value.
         *
         * @param array|string $key
         * @param mixed $value
         * @return void
         * @static
         */
        public static function set($key, $value = null)
        {
            /** @var \Illuminate\Config\Repository $instance */
            $instance->set($key, $value);
        }

        /**
         * Prepend a value onto an array configuration value.
         *
         * @param string $key
         * @param mixed $value
         * @return void
         * @static
         */
        public static function prepend($key, $value)
        {
            /** @var \Illuminate\Config\Repository $instance */
            $instance->prepend($key, $value);
        }

        /**
         * Push a value onto an array configuration value.
         *
         * @param string $key
         * @param mixed $value
         * @return void
         * @static
         */
        public static function push($key, $value)
        {
            /** @var \Illuminate\Config\Repository $instance */
            $instance->push($key, $value);
        }

        /**
         * Get all of the configuration items for the application.
         *
         * @return array
         * @static
         */
        public static function all()
        {
            /** @var \Illuminate\Config\Repository $instance */
            return $instance->all();
        }

        /**
         * Determine if the given configuration option exists.
         *
         * @param string $key
         * @return bool
         * @static
         */
        public static function offsetExists($key)
        {
            /** @var \Illuminate\Config\Repository $instance */
            return $instance->offsetExists($key);
        }

        /**
         * Get a configuration option.
         *
         * @param string $key
         * @return mixed
         * @static
         */
        public static function offsetGet($key)
        {
            /** @var \Illuminate\Config\Repository $instance */
            return $instance->offsetGet($key);
        }

        /**
         * Set a configuration option.
         *
         * @param string $key
         * @param mixed $value
         * @return void
         * @static
         */
        public static function offsetSet($key, $value)
        {
            /** @var \Illuminate\Config\Repository $instance */
            $instance->offsetSet($key, $value);
        }

        /**
         * Unset a configuration option.
         *
         * @param string $key
         * @return void
         * @static
         */
        public static function offsetUnset($key)
        {
            /** @var \Illuminate\Config\Repository $instance */
            $instance->offsetUnset($key);
        }

        /**
         * Register a custom macro.
         *
         * @param string $name
         * @param object|callable $macro
         * @param-closure-this static  $macro
         * @return void
         * @static
         */
        public static function macro($name, $macro)
        {
            \Illuminate\Config\Repository::macro($name, $macro);
        }

        /**
         * Mix another object into the class.
         *
         * @param object $mixin
         * @param bool $replace
         * @return void
         * @throws \ReflectionException
         * @static
         */
        public static function mixin($mixin, $replace = true)
        {
            \Illuminate\Config\Repository::mixin($mixin, $replace);
        }

        /**
         * Checks if macro is registered.
         *
         * @param string $name
         * @return bool
         * @static
         */
        public static function hasMacro($name)
        {
            return \Illuminate\Config\Repository::hasMacro($name);
        }

        /**
         * Flush the existing macros.
         *
         * @return void
         * @static
         */
        public static function flushMacros()
        {
            \Illuminate\Config\Repository::flushMacros();
        }

            }
    /**
     *
     *
     * @see \Illuminate\Cookie\CookieJar
     */
    class Cookie {
        /**
         * Create a new cookie instance.
         *
         * @param string $name
         * @param string $value
         * @param int $minutes
         * @param string|null $path
         * @param string|null $domain
         * @param bool|null $secure
         * @param bool $httpOnly
         * @param bool $raw
         * @param string|null $sameSite
         * @return \Symfony\Component\HttpFoundation\Cookie
         * @static
         */
        public static function make($name, $value, $minutes = 0, $path = null, $domain = null, $secure = null, $httpOnly = true, $raw = false, $sameSite = null)
        {
            /** @var \Illuminate\Cookie\CookieJar $instance */
            return $instance->make($name, $value, $minutes, $path, $domain, $secure, $httpOnly, $raw, $sameSite);
        }

        /**
         * Create a cookie that lasts "forever" (400 days).
         *
         * @param string $name
         * @param string $value
         * @param string|null $path
         * @param string|null $domain
         * @param bool|null $secure
         * @param bool $httpOnly
         * @param bool $raw
         * @param string|null $sameSite
         * @return \Symfony\Component\HttpFoundation\Cookie
         * @static
         */
        public static function forever($name, $value, $path = null, $domain = null, $secure = null, $httpOnly = true, $raw = false, $sameSite = null)
        {
            /** @var \Illuminate\Cookie\CookieJar $instance */
            return $instance->forever($name, $value, $path, $domain, $secure, $httpOnly, $raw, $sameSite);
        }

        /**
         * Expire the given cookie.
         *
         * @param string $name
         * @param string|null $path
         * @param string|null $domain
         * @return \Symfony\Component\HttpFoundation\Cookie
         * @static
         */
        public static function forget($name, $path = null, $domain = null)
        {
            /** @var \Illuminate\Cookie\CookieJar $instance */
            return $instance->forget($name, $path, $domain);
        }

        /**
         * Determine if a cookie has been queued.
         *
         * @param string $key
         * @param string|null $path
         * @return bool
         * @static
         */
        public static function hasQueued($key, $path = null)
        {
            /** @var \Illuminate\Cookie\CookieJar $instance */
            return $instance->hasQueued($key, $path);
        }

        /**
         * Get a queued cookie instance.
         *
         * @param string $key
         * @param mixed $default
         * @param string|null $path
         * @return \Symfony\Component\HttpFoundation\Cookie|null
         * @static
         */
        public static function queued($key, $default = null, $path = null)
        {
            /** @var \Illuminate\Cookie\CookieJar $instance */
            return $instance->queued($key, $default, $path);
        }

        /**
         * Queue a cookie to send with the next response.
         *
         * @param mixed $parameters
         * @return void
         * @static
         */
        public static function queue(...$parameters)
        {
            /** @var \Illuminate\Cookie\CookieJar $instance */
            $instance->queue(...$parameters);
        }

        /**
         * Queue a cookie to expire with the next response.
         *
         * @param string $name
         * @param string|null $path
         * @param string|null $domain
         * @return void
         * @static
         */
        public static function expire($name, $path = null, $domain = null)
        {
            /** @var \Illuminate\Cookie\CookieJar $instance */
            $instance->expire($name, $path, $domain);
        }

        /**
         * Remove a cookie from the queue.
         *
         * @param string $name
         * @param string|null $path
         * @return void
         * @static
         */
        public static function unqueue($name, $path = null)
        {
            /** @var \Illuminate\Cookie\CookieJar $instance */
            $instance->unqueue($name, $path);
        }

        /**
         * Set the default path and domain for the jar.
         *
         * @param string $path
         * @param string|null $domain
         * @param bool|null $secure
         * @param string|null $sameSite
         * @return \Illuminate\Cookie\CookieJar
         * @static
         */
        public static function setDefaultPathAndDomain($path, $domain, $secure = false, $sameSite = null)
        {
            /** @var \Illuminate\Cookie\CookieJar $instance */
            return $instance->setDefaultPathAndDomain($path, $domain, $secure, $sameSite);
        }

        /**
         * Get the cookies which have been queued for the next request.
         *
         * @return \Symfony\Component\HttpFoundation\Cookie[]
         * @static
         */
        public static function getQueuedCookies()
        {
            /** @var \Illuminate\Cookie\CookieJar $instance */
            return $instance->getQueuedCookies();
        }

        /**
         * Flush the cookies which have been queued for the next request.
         *
         * @return \Illuminate\Cookie\CookieJar
         * @static
         */
        public static function flushQueuedCookies()
        {
            /** @var \Illuminate\Cookie\CookieJar $instance */
            return $instance->flushQueuedCookies();
        }

        /**
         * Register a custom macro.
         *
         * @param string $name
         * @param object|callable $macro
         * @param-closure-this static  $macro
         * @return void
         * @static
         */
        public static function macro($name, $macro)
        {
            \Illuminate\Cookie\CookieJar::macro($name, $macro);
        }

        /**
         * Mix another object into the class.
         *
         * @param object $mixin
         * @param bool $replace
         * @return void
         * @throws \ReflectionException
         * @static
         */
        public static function mixin($mixin, $replace = true)
        {
            \Illuminate\Cookie\CookieJar::mixin($mixin, $replace);
        }

        /**
         * Checks if macro is registered.
         *
         * @param string $name
         * @return bool
         * @static
         */
        public static function hasMacro($name)
        {
            return \Illuminate\Cookie\CookieJar::hasMacro($name);
        }

        /**
         * Flush the existing macros.
         *
         * @return void
         * @static
         */
        public static function flushMacros()
        {
            \Illuminate\Cookie\CookieJar::flushMacros();
        }

            }
    /**
     *
     *
     * @see \Illuminate\Encryption\Encrypter
     */
    class Crypt {
        /**
         * Determine if the given key and cipher combination is valid.
         *
         * @param string $key
         * @param string $cipher
         * @return bool
         * @static
         */
        public static function supported($key, $cipher)
        {
            return \Illuminate\Encryption\Encrypter::supported($key, $cipher);
        }

        /**
         * Create a new encryption key for the given cipher.
         *
         * @param string $cipher
         * @return string
         * @static
         */
        public static function generateKey($cipher)
        {
            return \Illuminate\Encryption\Encrypter::generateKey($cipher);
        }

        /**
         * Encrypt the given value.
         *
         * @param mixed $value
         * @param bool $serialize
         * @return string
         * @throws \Illuminate\Contracts\Encryption\EncryptException
         * @static
         */
        public static function encrypt($value, $serialize = true)
        {
            /** @var \Illuminate\Encryption\Encrypter $instance */
            return $instance->encrypt($value, $serialize);
        }

        /**
         * Encrypt a string without serialization.
         *
         * @param string $value
         * @return string
         * @throws \Illuminate\Contracts\Encryption\EncryptException
         * @static
         */
        public static function encryptString($value)
        {
            /** @var \Illuminate\Encryption\Encrypter $instance */
            return $instance->encryptString($value);
        }

        /**
         * Decrypt the given value.
         *
         * @param string $payload
         * @param bool $unserialize
         * @return mixed
         * @throws \Illuminate\Contracts\Encryption\DecryptException
         * @static
         */
        public static function decrypt($payload, $unserialize = true)
        {
            /** @var \Illuminate\Encryption\Encrypter $instance */
            return $instance->decrypt($payload, $unserialize);
        }

        /**
         * Decrypt the given string without unserialization.
         *
         * @param string $payload
         * @return string
         * @throws \Illuminate\Contracts\Encryption\DecryptException
         * @static
         */
        public static function decryptString($payload)
        {
            /** @var \Illuminate\Encryption\Encrypter $instance */
            return $instance->decryptString($payload);
        }

        /**
         * Get the encryption key that the encrypter is currently using.
         *
         * @return string
         * @static
         */
        public static function getKey()
        {
            /** @var \Illuminate\Encryption\Encrypter $instance */
            return $instance->getKey();
        }

        /**
         * Get the current encryption key and all previous encryption keys.
         *
         * @return array
         * @static
         */
        public static function getAllKeys()
        {
            /** @var \Illuminate\Encryption\Encrypter $instance */
            return $instance->getAllKeys();
        }

        /**
         * Get the previous encryption keys.
         *
         * @return array
         * @static
         */
        public static function getPreviousKeys()
        {
            /** @var \Illuminate\Encryption\Encrypter $instance */
            return $instance->getPreviousKeys();
        }

        /**
         * Set the previous / legacy encryption keys that should be utilized if decryption fails.
         *
         * @param array $keys
         * @return \Illuminate\Encryption\Encrypter
         * @static
         */
        public static function previousKeys($keys)
        {
            /** @var \Illuminate\Encryption\Encrypter $instance */
            return $instance->previousKeys($keys);
        }

            }
    /**
     *
     *
     * @see \Illuminate\Database\DatabaseManager
     */
    class DB {
        /**
         * Get a database connection instance.
         *
         * @param string|null $name
         * @return \Illuminate\Database\Connection
         * @static
         */
        public static function connection($name = null)
        {
            /** @var \Illuminate\Database\DatabaseManager $instance */
            return $instance->connection($name);
        }

        /**
         * Build a database connection instance from the given configuration.
         *
         * @param array $config
         * @return \Illuminate\Database\PostgresConnection
         * @static
         */
        public static function build($config)
        {
            /** @var \Illuminate\Database\DatabaseManager $instance */
            return $instance->build($config);
        }

        /**
         * Calculate the dynamic connection name for an on-demand connection based on its configuration.
         *
         * @param array $config
         * @return string
         * @static
         */
        public static function calculateDynamicConnectionName($config)
        {
            return \Illuminate\Database\DatabaseManager::calculateDynamicConnectionName($config);
        }

        /**
         * Get a database connection instance from the given configuration.
         *
         * @param string $name
         * @param array $config
         * @param bool $force
         * @return \Illuminate\Database\PostgresConnection
         * @static
         */
        public static function connectUsing($name, $config, $force = false)
        {
            /** @var \Illuminate\Database\DatabaseManager $instance */
            return $instance->connectUsing($name, $config, $force);
        }

        /**
         * Disconnect from the given database and remove from local cache.
         *
         * @param string|null $name
         * @return void
         * @static
         */
        public static function purge($name = null)
        {
            /** @var \Illuminate\Database\DatabaseManager $instance */
            $instance->purge($name);
        }

        /**
         * Disconnect from the given database.
         *
         * @param string|null $name
         * @return void
         * @static
         */
        public static function disconnect($name = null)
        {
            /** @var \Illuminate\Database\DatabaseManager $instance */
            $instance->disconnect($name);
        }

        /**
         * Reconnect to the given database.
         *
         * @param string|null $name
         * @return \Illuminate\Database\Connection
         * @static
         */
        public static function reconnect($name = null)
        {
            /** @var \Illuminate\Database\DatabaseManager $instance */
            return $instance->reconnect($name);
        }

        /**
         * Set the default database connection for the callback execution.
         *
         * @param string $name
         * @param callable $callback
         * @return mixed
         * @static
         */
        public static function usingConnection($name, $callback)
        {
            /** @var \Illuminate\Database\DatabaseManager $instance */
            return $instance->usingConnection($name, $callback);
        }

        /**
         * Get the default connection name.
         *
         * @return string
         * @static
         */
        public static function getDefaultConnection()
        {
            /** @var \Illuminate\Database\DatabaseManager $instance */
            return $instance->getDefaultConnection();
        }

        /**
         * Set the default connection name.
         *
         * @param string $name
         * @return void
         * @static
         */
        public static function setDefaultConnection($name)
        {
            /** @var \Illuminate\Database\DatabaseManager $instance */
            $instance->setDefaultConnection($name);
        }

        /**
         * Get all of the supported drivers.
         *
         * @return string[]
         * @static
         */
        public static function supportedDrivers()
        {
            /** @var \Illuminate\Database\DatabaseManager $instance */
            return $instance->supportedDrivers();
        }

        /**
         * Get all of the drivers that are actually available.
         *
         * @return string[]
         * @static
         */
        public static function availableDrivers()
        {
            /** @var \Illuminate\Database\DatabaseManager $instance */
            return $instance->availableDrivers();
        }

        /**
         * Register an extension connection resolver.
         *
         * @param string $name
         * @param callable $resolver
         * @return void
         * @static
         */
        public static function extend($name, $resolver)
        {
            /** @var \Illuminate\Database\DatabaseManager $instance */
            $instance->extend($name, $resolver);
        }

        /**
         * Remove an extension connection resolver.
         *
         * @param string $name
         * @return void
         * @static
         */
        public static function forgetExtension($name)
        {
            /** @var \Illuminate\Database\DatabaseManager $instance */
            $instance->forgetExtension($name);
        }

        /**
         * Return all of the created connections.
         *
         * @return array<string, \Illuminate\Database\Connection>
         * @static
         */
        public static function getConnections()
        {
            /** @var \Illuminate\Database\DatabaseManager $instance */
            return $instance->getConnections();
        }

        /**
         * Set the database reconnector callback.
         *
         * @param callable $reconnector
         * @return void
         * @static
         */
        public static function setReconnector($reconnector)
        {
            /** @var \Illuminate\Database\DatabaseManager $instance */
            $instance->setReconnector($reconnector);
        }

        /**
         * Set the application instance used by the manager.
         *
         * @param \Illuminate\Contracts\Foundation\Application $app
         * @return \Illuminate\Database\DatabaseManager
         * @static
         */
        public static function setApplication($app)
        {
            /** @var \Illuminate\Database\DatabaseManager $instance */
            return $instance->setApplication($app);
        }

        /**
         * Register a custom macro.
         *
         * @param string $name
         * @param object|callable $macro
         * @param-closure-this static  $macro
         * @return void
         * @static
         */
        public static function macro($name, $macro)
        {
            \Illuminate\Database\DatabaseManager::macro($name, $macro);
        }

        /**
         * Mix another object into the class.
         *
         * @param object $mixin
         * @param bool $replace
         * @return void
         * @throws \ReflectionException
         * @static
         */
        public static function mixin($mixin, $replace = true)
        {
            \Illuminate\Database\DatabaseManager::mixin($mixin, $replace);
        }

        /**
         * Checks if macro is registered.
         *
         * @param string $name
         * @return bool
         * @static
         */
        public static function hasMacro($name)
        {
            return \Illuminate\Database\DatabaseManager::hasMacro($name);
        }

        /**
         * Flush the existing macros.
         *
         * @return void
         * @static
         */
        public static function flushMacros()
        {
            \Illuminate\Database\DatabaseManager::flushMacros();
        }

        /**
         * Dynamically handle calls to the class.
         *
         * @param string $method
         * @param array $parameters
         * @return mixed
         * @throws \BadMethodCallException
         * @static
         */
        public static function macroCall($method, $parameters)
        {
            /** @var \Illuminate\Database\DatabaseManager $instance */
            return $instance->macroCall($method, $parameters);
        }

        /**
         * Get a human-readable name for the given connection driver.
         *
         * @return string
         * @static
         */
        public static function getDriverTitle()
        {
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getDriverTitle();
        }

        /**
         * Get a schema builder instance for the connection.
         *
         * @return \Illuminate\Database\Schema\PostgresBuilder
         * @static
         */
        public static function getSchemaBuilder()
        {
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getSchemaBuilder();
        }

        /**
         * Get the schema state for the connection.
         *
         * @param \Illuminate\Filesystem\Filesystem|null $files
         * @param callable|null $processFactory
         * @return \Illuminate\Database\Schema\PostgresSchemaState
         * @static
         */
        public static function getSchemaState($files = null, $processFactory = null)
        {
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getSchemaState($files, $processFactory);
        }

        /**
         * Set the query grammar to the default implementation.
         *
         * @return void
         * @static
         */
        public static function useDefaultQueryGrammar()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->useDefaultQueryGrammar();
        }

        /**
         * Set the schema grammar to the default implementation.
         *
         * @return void
         * @static
         */
        public static function useDefaultSchemaGrammar()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->useDefaultSchemaGrammar();
        }

        /**
         * Set the query post processor to the default implementation.
         *
         * @return void
         * @static
         */
        public static function useDefaultPostProcessor()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->useDefaultPostProcessor();
        }

        /**
         * Begin a fluent query against a database table.
         *
         * @param \Closure|\Illuminate\Database\Query\Builder|\Illuminate\Contracts\Database\Query\Expression|string $table
         * @param string|null $as
         * @return \Illuminate\Database\Query\Builder
         * @static
         */
        public static function table($table, $as = null)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->table($table, $as);
        }

        /**
         * Get a new query builder instance.
         *
         * @return \Illuminate\Database\Query\Builder
         * @static
         */
        public static function query()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->query();
        }

        /**
         * Run a select statement and return a single result.
         *
         * @param string $query
         * @param array $bindings
         * @param bool $useReadPdo
         * @return mixed
         * @static
         */
        public static function selectOne($query, $bindings = [], $useReadPdo = true)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->selectOne($query, $bindings, $useReadPdo);
        }

        /**
         * Run a select statement and return the first column of the first row.
         *
         * @param string $query
         * @param array $bindings
         * @param bool $useReadPdo
         * @return mixed
         * @throws \Illuminate\Database\MultipleColumnsSelectedException
         * @static
         */
        public static function scalar($query, $bindings = [], $useReadPdo = true)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->scalar($query, $bindings, $useReadPdo);
        }

        /**
         * Run a select statement against the database.
         *
         * @param string $query
         * @param array $bindings
         * @return array
         * @static
         */
        public static function selectFromWriteConnection($query, $bindings = [])
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->selectFromWriteConnection($query, $bindings);
        }

        /**
         * Run a select statement against the database.
         *
         * @param string $query
         * @param array $bindings
         * @param bool $useReadPdo
         * @return array
         * @static
         */
        public static function select($query, $bindings = [], $useReadPdo = true)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->select($query, $bindings, $useReadPdo);
        }

        /**
         * Run a select statement against the database and returns all of the result sets.
         *
         * @param string $query
         * @param array $bindings
         * @param bool $useReadPdo
         * @return array
         * @static
         */
        public static function selectResultSets($query, $bindings = [], $useReadPdo = true)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->selectResultSets($query, $bindings, $useReadPdo);
        }

        /**
         * Run a select statement against the database and returns a generator.
         *
         * @param string $query
         * @param array $bindings
         * @param bool $useReadPdo
         * @return \Generator<int, \stdClass>
         * @static
         */
        public static function cursor($query, $bindings = [], $useReadPdo = true)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->cursor($query, $bindings, $useReadPdo);
        }

        /**
         * Run an insert statement against the database.
         *
         * @param string $query
         * @param array $bindings
         * @return bool
         * @static
         */
        public static function insert($query, $bindings = [])
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->insert($query, $bindings);
        }

        /**
         * Run an update statement against the database.
         *
         * @param string $query
         * @param array $bindings
         * @return int
         * @static
         */
        public static function update($query, $bindings = [])
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->update($query, $bindings);
        }

        /**
         * Run a delete statement against the database.
         *
         * @param string $query
         * @param array $bindings
         * @return int
         * @static
         */
        public static function delete($query, $bindings = [])
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->delete($query, $bindings);
        }

        /**
         * Execute an SQL statement and return the boolean result.
         *
         * @param string $query
         * @param array $bindings
         * @return bool
         * @static
         */
        public static function statement($query, $bindings = [])
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->statement($query, $bindings);
        }

        /**
         * Run an SQL statement and get the number of rows affected.
         *
         * @param string $query
         * @param array $bindings
         * @return int
         * @static
         */
        public static function affectingStatement($query, $bindings = [])
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->affectingStatement($query, $bindings);
        }

        /**
         * Run a raw, unprepared query against the PDO connection.
         *
         * @param string $query
         * @return bool
         * @static
         */
        public static function unprepared($query)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->unprepared($query);
        }

        /**
         * Get the number of open connections for the database.
         *
         * @return int|null
         * @static
         */
        public static function threadCount()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->threadCount();
        }

        /**
         * Execute the given callback in "dry run" mode.
         *
         * @param \Closure $callback
         * @return array
         * @static
         */
        public static function pretend($callback)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->pretend($callback);
        }

        /**
         * Execute the given callback without "pretending".
         *
         * @param \Closure $callback
         * @return mixed
         * @static
         */
        public static function withoutPretending($callback)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->withoutPretending($callback);
        }

        /**
         * Bind values to their parameters in the given statement.
         *
         * @param \PDOStatement $statement
         * @param array $bindings
         * @return void
         * @static
         */
        public static function bindValues($statement, $bindings)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->bindValues($statement, $bindings);
        }

        /**
         * Prepare the query bindings for execution.
         *
         * @param array $bindings
         * @return array
         * @static
         */
        public static function prepareBindings($bindings)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->prepareBindings($bindings);
        }

        /**
         * Log a query in the connection's query log.
         *
         * @param string $query
         * @param array $bindings
         * @param float|null $time
         * @return void
         * @static
         */
        public static function logQuery($query, $bindings, $time = null)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->logQuery($query, $bindings, $time);
        }

        /**
         * Register a callback to be invoked when the connection queries for longer than a given amount of time.
         *
         * @param \DateTimeInterface|\Carbon\CarbonInterval|float|int $threshold
         * @param callable $handler
         * @return void
         * @static
         */
        public static function whenQueryingForLongerThan($threshold, $handler)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->whenQueryingForLongerThan($threshold, $handler);
        }

        /**
         * Allow all the query duration handlers to run again, even if they have already run.
         *
         * @return void
         * @static
         */
        public static function allowQueryDurationHandlersToRunAgain()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->allowQueryDurationHandlersToRunAgain();
        }

        /**
         * Get the duration of all run queries in milliseconds.
         *
         * @return float
         * @static
         */
        public static function totalQueryDuration()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->totalQueryDuration();
        }

        /**
         * Reset the duration of all run queries.
         *
         * @return void
         * @static
         */
        public static function resetTotalQueryDuration()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->resetTotalQueryDuration();
        }

        /**
         * Reconnect to the database if a PDO connection is missing.
         *
         * @return void
         * @static
         */
        public static function reconnectIfMissingConnection()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->reconnectIfMissingConnection();
        }

        /**
         * Register a hook to be run just before a database transaction is started.
         *
         * @param \Closure $callback
         * @return \Illuminate\Database\PostgresConnection
         * @static
         */
        public static function beforeStartingTransaction($callback)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->beforeStartingTransaction($callback);
        }

        /**
         * Register a hook to be run just before a database query is executed.
         *
         * @param \Closure $callback
         * @return \Illuminate\Database\PostgresConnection
         * @static
         */
        public static function beforeExecuting($callback)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->beforeExecuting($callback);
        }

        /**
         * Register a database query listener with the connection.
         *
         * @param \Closure $callback
         * @return void
         * @static
         */
        public static function listen($callback)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->listen($callback);
        }

        /**
         * Get a new raw query expression.
         *
         * @param mixed $value
         * @return \Illuminate\Contracts\Database\Query\Expression
         * @static
         */
        public static function raw($value)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->raw($value);
        }

        /**
         * Escape a value for safe SQL embedding.
         *
         * @param string|float|int|bool|null $value
         * @param bool $binary
         * @return string
         * @static
         */
        public static function escape($value, $binary = false)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->escape($value, $binary);
        }

        /**
         * Determine if the database connection has modified any database records.
         *
         * @return bool
         * @static
         */
        public static function hasModifiedRecords()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->hasModifiedRecords();
        }

        /**
         * Indicate if any records have been modified.
         *
         * @param bool $value
         * @return void
         * @static
         */
        public static function recordsHaveBeenModified($value = true)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->recordsHaveBeenModified($value);
        }

        /**
         * Set the record modification state.
         *
         * @param bool $value
         * @return \Illuminate\Database\PostgresConnection
         * @static
         */
        public static function setRecordModificationState($value)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->setRecordModificationState($value);
        }

        /**
         * Reset the record modification state.
         *
         * @return void
         * @static
         */
        public static function forgetRecordModificationState()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->forgetRecordModificationState();
        }

        /**
         * Indicate that the connection should use the write PDO connection for reads.
         *
         * @param bool $value
         * @return \Illuminate\Database\PostgresConnection
         * @static
         */
        public static function useWriteConnectionWhenReading($value = true)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->useWriteConnectionWhenReading($value);
        }

        /**
         * Get the current PDO connection.
         *
         * @return \PDO
         * @static
         */
        public static function getPdo()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getPdo();
        }

        /**
         * Get the current PDO connection parameter without executing any reconnect logic.
         *
         * @return \PDO|\Closure|null
         * @static
         */
        public static function getRawPdo()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getRawPdo();
        }

        /**
         * Get the current PDO connection used for reading.
         *
         * @return \PDO
         * @static
         */
        public static function getReadPdo()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getReadPdo();
        }

        /**
         * Get the current read PDO connection parameter without executing any reconnect logic.
         *
         * @return \PDO|\Closure|null
         * @static
         */
        public static function getRawReadPdo()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getRawReadPdo();
        }

        /**
         * Set the PDO connection.
         *
         * @param \PDO|\Closure|null $pdo
         * @return \Illuminate\Database\PostgresConnection
         * @static
         */
        public static function setPdo($pdo)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->setPdo($pdo);
        }

        /**
         * Set the PDO connection used for reading.
         *
         * @param \PDO|\Closure|null $pdo
         * @return \Illuminate\Database\PostgresConnection
         * @static
         */
        public static function setReadPdo($pdo)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->setReadPdo($pdo);
        }

        /**
         * Get the database connection name.
         *
         * @return string|null
         * @static
         */
        public static function getName()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getName();
        }

        /**
         * Get the database connection full name.
         *
         * @return string|null
         * @static
         */
        public static function getNameWithReadWriteType()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getNameWithReadWriteType();
        }

        /**
         * Get an option from the configuration options.
         *
         * @param string|null $option
         * @return mixed
         * @static
         */
        public static function getConfig($option = null)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getConfig($option);
        }

        /**
         * Get the PDO driver name.
         *
         * @return string
         * @static
         */
        public static function getDriverName()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getDriverName();
        }

        /**
         * Get the query grammar used by the connection.
         *
         * @return \Illuminate\Database\Query\Grammars\Grammar
         * @static
         */
        public static function getQueryGrammar()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getQueryGrammar();
        }

        /**
         * Set the query grammar used by the connection.
         *
         * @param \Illuminate\Database\Query\Grammars\Grammar $grammar
         * @return \Illuminate\Database\PostgresConnection
         * @static
         */
        public static function setQueryGrammar($grammar)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->setQueryGrammar($grammar);
        }

        /**
         * Get the schema grammar used by the connection.
         *
         * @return \Illuminate\Database\Schema\Grammars\Grammar
         * @static
         */
        public static function getSchemaGrammar()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getSchemaGrammar();
        }

        /**
         * Set the schema grammar used by the connection.
         *
         * @param \Illuminate\Database\Schema\Grammars\Grammar $grammar
         * @return \Illuminate\Database\PostgresConnection
         * @static
         */
        public static function setSchemaGrammar($grammar)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->setSchemaGrammar($grammar);
        }

        /**
         * Get the query post processor used by the connection.
         *
         * @return \Illuminate\Database\Query\Processors\Processor
         * @static
         */
        public static function getPostProcessor()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getPostProcessor();
        }

        /**
         * Set the query post processor used by the connection.
         *
         * @param \Illuminate\Database\Query\Processors\Processor $processor
         * @return \Illuminate\Database\PostgresConnection
         * @static
         */
        public static function setPostProcessor($processor)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->setPostProcessor($processor);
        }

        /**
         * Get the event dispatcher used by the connection.
         *
         * @return \Illuminate\Contracts\Events\Dispatcher
         * @static
         */
        public static function getEventDispatcher()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getEventDispatcher();
        }

        /**
         * Set the event dispatcher instance on the connection.
         *
         * @param \Illuminate\Contracts\Events\Dispatcher $events
         * @return \Illuminate\Database\PostgresConnection
         * @static
         */
        public static function setEventDispatcher($events)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->setEventDispatcher($events);
        }

        /**
         * Unset the event dispatcher for this connection.
         *
         * @return void
         * @static
         */
        public static function unsetEventDispatcher()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->unsetEventDispatcher();
        }

        /**
         * Set the transaction manager instance on the connection.
         *
         * @param \Illuminate\Database\DatabaseTransactionsManager $manager
         * @return \Illuminate\Database\PostgresConnection
         * @static
         */
        public static function setTransactionManager($manager)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->setTransactionManager($manager);
        }

        /**
         * Unset the transaction manager for this connection.
         *
         * @return void
         * @static
         */
        public static function unsetTransactionManager()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->unsetTransactionManager();
        }

        /**
         * Determine if the connection is in a "dry run".
         *
         * @return bool
         * @static
         */
        public static function pretending()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->pretending();
        }

        /**
         * Get the connection query log.
         *
         * @return array
         * @static
         */
        public static function getQueryLog()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getQueryLog();
        }

        /**
         * Get the connection query log with embedded bindings.
         *
         * @return array
         * @static
         */
        public static function getRawQueryLog()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getRawQueryLog();
        }

        /**
         * Clear the query log.
         *
         * @return void
         * @static
         */
        public static function flushQueryLog()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->flushQueryLog();
        }

        /**
         * Enable the query log on the connection.
         *
         * @return void
         * @static
         */
        public static function enableQueryLog()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->enableQueryLog();
        }

        /**
         * Disable the query log on the connection.
         *
         * @return void
         * @static
         */
        public static function disableQueryLog()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->disableQueryLog();
        }

        /**
         * Determine whether we're logging queries.
         *
         * @return bool
         * @static
         */
        public static function logging()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->logging();
        }

        /**
         * Get the name of the connected database.
         *
         * @return string
         * @static
         */
        public static function getDatabaseName()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getDatabaseName();
        }

        /**
         * Set the name of the connected database.
         *
         * @param string $database
         * @return \Illuminate\Database\PostgresConnection
         * @static
         */
        public static function setDatabaseName($database)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->setDatabaseName($database);
        }

        /**
         * Set the read / write type of the connection.
         *
         * @param string|null $readWriteType
         * @return \Illuminate\Database\PostgresConnection
         * @static
         */
        public static function setReadWriteType($readWriteType)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->setReadWriteType($readWriteType);
        }

        /**
         * Get the table prefix for the connection.
         *
         * @return string
         * @static
         */
        public static function getTablePrefix()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getTablePrefix();
        }

        /**
         * Set the table prefix in use by the connection.
         *
         * @param string $prefix
         * @return \Illuminate\Database\PostgresConnection
         * @static
         */
        public static function setTablePrefix($prefix)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->setTablePrefix($prefix);
        }

        /**
         * Set the table prefix and return the grammar.
         *
         * @template TGrammar of \Illuminate\Database\Grammar
         * @param TGrammar $grammar
         * @return TGrammar
         * @static
         */
        public static function withTablePrefix($grammar)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->withTablePrefix($grammar);
        }

        /**
         * Execute the given callback without table prefix.
         *
         * @param \Closure $callback
         * @return void
         * @static
         */
        public static function withoutTablePrefix($callback)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->withoutTablePrefix($callback);
        }

        /**
         * Get the server version for the connection.
         *
         * @return string
         * @static
         */
        public static function getServerVersion()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->getServerVersion();
        }

        /**
         * Register a connection resolver.
         *
         * @param string $driver
         * @param \Closure $callback
         * @return void
         * @static
         */
        public static function resolverFor($driver, $callback)
        {
            //Method inherited from \Illuminate\Database\Connection
            \Illuminate\Database\PostgresConnection::resolverFor($driver, $callback);
        }

        /**
         * Get the connection resolver for the given driver.
         *
         * @param string $driver
         * @return \Closure|null
         * @static
         */
        public static function getResolver($driver)
        {
            //Method inherited from \Illuminate\Database\Connection
            return \Illuminate\Database\PostgresConnection::getResolver($driver);
        }

        /**
         *
         *
         * @template TReturn of mixed
         *
         * Execute a Closure within a transaction.
         * @param (\Closure(static): TReturn) $callback
         * @param int $attempts
         * @return TReturn
         * @throws \Throwable
         * @static
         */
        public static function transaction($callback, $attempts = 1)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->transaction($callback, $attempts);
        }

        /**
         * Start a new database transaction.
         *
         * @return void
         * @throws \Throwable
         * @static
         */
        public static function beginTransaction()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->beginTransaction();
        }

        /**
         * Commit the active database transaction.
         *
         * @return void
         * @throws \Throwable
         * @static
         */
        public static function commit()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->commit();
        }

        /**
         * Rollback the active database transaction.
         *
         * @param int|null $toLevel
         * @return void
         * @throws \Throwable
         * @static
         */
        public static function rollBack($toLevel = null)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->rollBack($toLevel);
        }

        /**
         * Get the number of active transactions.
         *
         * @return int
         * @static
         */
        public static function transactionLevel()
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            return $instance->transactionLevel();
        }

        /**
         * Execute the callback after a transaction commits.
         *
         * @param callable $callback
         * @return void
         * @throws \RuntimeException
         * @static
         */
        public static function afterCommit($callback)
        {
            //Method inherited from \Illuminate\Database\Connection
            /** @var \Illuminate\Database\PostgresConnection $instance */
            $instance->afterCommit($callback);
        }

            }
    /**
     *
     *
     * @see \Illuminate\Events\Dispatcher
     * @see \Illuminate\Support\Testing\Fakes\EventFake
     */
    class Event {
        /**
         * Register an event listener with the dispatcher.
         *
         * @param \Illuminate\Events\Queued\Closure|callable|array|class-string|string $events
         * @param \Illuminate\Events\Queued\Closure|callable|array|class-string|null $listener
         * @return void
         * @static
         */
        public static function listen($events, $listener = null)
        {
            /** @var \Illuminate\Events\Dispatcher $instance */
            $instance->listen($events, $listener);
        }

        /**
         * Determine if a given event has listeners.
         *
         * @param string $eventName
         * @return bool
         * @static
         */
        public static function hasListeners($eventName)
        {
            /** @var \Illuminate\Events\Dispatcher $instance */
            return $instance->hasListeners($eventName);
        }

        /**
         * Determine if the given event has any wildcard listeners.
         *
         * @param string $eventName
         * @return bool
         * @static
         */
        public static function hasWildcardListeners($eventName)
        {
            /** @var \Illuminate\Events\Dispatcher $instance */
            return $instance->hasWildcardListeners($eventName);
        }

        /**
         * Register an event and payload to be fired later.
         *
         * @param string $event
         * @param object|array $payload
         * @return void
         * @static
         */
        public static function push($event, $payload = [])
        {
            /** @var \Illuminate\Events\Dispatcher $instance */
            $instance->push($event, $payload);
        }

        /**
         * Flush a set of pushed events.
         *
         * @param string $event
         * @return void
         * @static
         */
        public static function flush($event)
        {
            /** @var \Illuminate\Events\Dispatcher $instance */
            $instance->flush($event);
        }

        /**
         * Register an event subscriber with the dispatcher.
         *
         * @param object|string $subscriber
         * @return void
         * @static
         */
        public static function subscribe($subscriber)
        {
            /** @var \Illuminate\Events\Dispatcher $instance */
            $instance->subscribe($subscriber);
        }

        /**
         * Fire an event until the first non-null response is returned.
         *
         * @param string|object $event
         * @param mixed $payload
         * @return mixed
         * @static
         */
        public static function until($event, $payload = [])
        {
            /** @var \Illuminate\Events\Dispatcher $instance */
            return $instance->until($event, $payload);
        }

        /**
         * Fire an event and call the listeners.
         *
         * @param string|object $event
         * @param mixed $payload
         * @param bool $halt
         * @return array|null
         * @static
         */
        public static function dispatch($event, $payload = [], $halt = false)
        {
            /** @var \Illuminate\Events\Dispatcher $instance */
            return $instance->dispatch($event, $payload, $halt);
        }

        /**
         * Get all of the listeners for a given event name.
         *
         * @param string $eventName
         * @return array
         * @static
         */
        public static function getListeners($eventName)
        {
            /** @var \Illuminate\Events\Dispatcher $instance */
            return $instance->getListeners($eventName);
        }

        /**
         * Register an event listener with the dispatcher.
         *
         * @param \Closure|string|array $listener
         * @param bool $wildcard
         * @return \Closure
         * @static
         */
        public static function makeListener($listener, $wildcard = false)
        {
            /** @var \Illuminate\Events\Dispatcher $instance */
            return $instance->makeListener($listener, $wildcard);
        }

        /**
         * Create a class based listener using the IoC container.
         *
         * @param string $listener
         * @param bool $wildcard
         * @return \Closure
         * @static
         */
        public static function createClassListener($listener, $wildcard = false)
        {
            /** @var \Illuminate\Events\Dispatcher $instance */
            return $instance->createClassListener($listener, $wildcard);
        }

        /**
         * Remove a set of listeners from the dispatcher.
         *
         * @param string $event
         * @return void
         * @static
         */
        public static function forget($event)
        {
            /** @var \Illuminate\Events\Dispatcher $instance */
            $instance->forget($event);
        }

        /**
         * Forget all of the pushed listeners.
         *
         * @return void
         * @static
         */
        public static function forgetPushed()
        {
            /** @var \Illuminate\Events\Dispatcher $instance */
            $instance->forgetPushed();
        }

        /**
         * Set the queue resolver implementation.
         *
         * @param callable $resolver
         * @return \Illuminate\Events\Dispatcher
         * @static
         */
        public static function setQueueResolver($resolver)
        {
            /** @var \Illuminate\Events\Dispatcher $instance */
            return $instance->setQueueResolver($resolver);
        }

        /**
         * Set the database transaction manager resolver implementation.
         *
         * @param callable $resolver
         * @return \Illuminate\Events\Dispatcher
         * @static
         */
        public static function setTransactionManagerResolver($resolver)
        {
            /** @var \Illuminate\Events\Dispatcher $instance */
            return $instance->setTransactionManagerResolver($resolver);
        }

        /**
         * Gets the raw, unprepared listeners.
         *
         * @return array
         * @static
         */
        public static function getRawListeners()
        {
            /** @var \Illuminate\Events\Dispatcher $instance */
            return $instance->getRawListeners();
        }

        /**
         * Register a custom macro.
         *
         * @param string $name
         * @param object|callable $macro
         * @param-closure-this static  $macro
         * @return void
         * @static
         */
        public static function macro($name, $macro)
        {
            \Illuminate\Events\Dispatcher::macro($name, $macro);
        }

        /**
         * Mix another object into the class.
         *
         * @param object $mixin
         * @param bool $replace
         * @return void
         * @throws \ReflectionException
         * @static
         */
        public static function mixin($mixin, $replace = true)
        {
            \Illuminate\Events\Dispatcher::mixin($mixin, $replace);
        }

        /**
         * Checks if macro is registered.
         *
         * @param string $name
         * @return bool
         * @static
         */
        public static function hasMacro($name)
        {
            return \Illuminate\Events\Dispatcher::hasMacro($name);
        }

        /**
         * Flush the existing macros.
         *
         * @return void
         * @static
         */
        public static function flushMacros()
        {
            \Illuminate\Events\Dispatcher::flushMacros();
        }

        /**
         * Specify the events that should be dispatched instead of faked.
         *
         * @param array|string $eventsToDispatch
         * @return \Illuminate\Support\Testing\Fakes\EventFake
         * @static
         */
        public static function except($eventsToDispatch)
        {
            /** @var \Illuminate\Support\Testing\Fakes\EventFake $instance */
            return $instance->except($eventsToDispatch);
        }

        /**
         * Assert if an event has a listener attached to it.
         *
         * @param string $expectedEvent
         * @param string|array $expectedListener
         * @return void
         * @static
         */
        public static function assertListening($expectedEvent, $expectedListener)
        {
            /** @var \Illuminate\Support\Testing\Fakes\EventFake $instance */
            $instance->assertListening($expectedEvent, $expectedListener);
        }

        /**
         * Assert if an event was dispatched based on a truth-test callback.
         *
         * @param string|\Closure $event
         * @param callable|int|null $callback
         * @return void
         * @static
         */
        public static function assertDispatched($event, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\EventFake $instance */
            $instance->assertDispatched($event, $callback);
        }

        /**
         * Assert if an event was dispatched a number of times.
         *
         * @param string $event
         * @param int $times
         * @return void
         * @static
         */
        public static function assertDispatchedTimes($event, $times = 1)
        {
            /** @var \Illuminate\Support\Testing\Fakes\EventFake $instance */
            $instance->assertDispatchedTimes($event, $times);
        }

        /**
         * Determine if an event was dispatched based on a truth-test callback.
         *
         * @param string|\Closure $event
         * @param callable|null $callback
         * @return void
         * @static
         */
        public static function assertNotDispatched($event, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\EventFake $instance */
            $instance->assertNotDispatched($event, $callback);
        }

        /**
         * Assert that no events were dispatched.
         *
         * @return void
         * @static
         */
        public static function assertNothingDispatched()
        {
            /** @var \Illuminate\Support\Testing\Fakes\EventFake $instance */
            $instance->assertNothingDispatched();
        }

        /**
         * Get all of the events matching a truth-test callback.
         *
         * @param string $event
         * @param callable|null $callback
         * @return \Illuminate\Support\Collection
         * @static
         */
        public static function dispatched($event, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\EventFake $instance */
            return $instance->dispatched($event, $callback);
        }

        /**
         * Determine if the given event has been dispatched.
         *
         * @param string $event
         * @return bool
         * @static
         */
        public static function hasDispatched($event)
        {
            /** @var \Illuminate\Support\Testing\Fakes\EventFake $instance */
            return $instance->hasDispatched($event);
        }

        /**
         * Get the events that have been dispatched.
         *
         * @return array
         * @static
         */
        public static function dispatchedEvents()
        {
            /** @var \Illuminate\Support\Testing\Fakes\EventFake $instance */
            return $instance->dispatchedEvents();
        }

            }
    /**
     *
     *
     * @see \Illuminate\Filesystem\Filesystem
     */
    class File {
        /**
         * Determine if a file or directory exists.
         *
         * @param string $path
         * @return bool
         * @static
         */
        public static function exists($path)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->exists($path);
        }

        /**
         * Determine if a file or directory is missing.
         *
         * @param string $path
         * @return bool
         * @static
         */
        public static function missing($path)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->missing($path);
        }

        /**
         * Get the contents of a file.
         *
         * @param string $path
         * @param bool $lock
         * @return string
         * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
         * @static
         */
        public static function get($path, $lock = false)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->get($path, $lock);
        }

        /**
         * Get the contents of a file as decoded JSON.
         *
         * @param string $path
         * @param int $flags
         * @param bool $lock
         * @return array
         * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
         * @static
         */
        public static function json($path, $flags = 0, $lock = false)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->json($path, $flags, $lock);
        }

        /**
         * Get contents of a file with shared access.
         *
         * @param string $path
         * @return string
         * @static
         */
        public static function sharedGet($path)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->sharedGet($path);
        }

        /**
         * Get the returned value of a file.
         *
         * @param string $path
         * @param array $data
         * @return mixed
         * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
         * @static
         */
        public static function getRequire($path, $data = [])
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->getRequire($path, $data);
        }

        /**
         * Require the given file once.
         *
         * @param string $path
         * @param array $data
         * @return mixed
         * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
         * @static
         */
        public static function requireOnce($path, $data = [])
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->requireOnce($path, $data);
        }

        /**
         * Get the contents of a file one line at a time.
         *
         * @param string $path
         * @return \Illuminate\Support\LazyCollection
         * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
         * @static
         */
        public static function lines($path)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->lines($path);
        }

        /**
         * Get the hash of the file at the given path.
         *
         * @param string $path
         * @param string $algorithm
         * @return string|false
         * @static
         */
        public static function hash($path, $algorithm = 'md5')
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->hash($path, $algorithm);
        }

        /**
         * Write the contents of a file.
         *
         * @param string $path
         * @param string $contents
         * @param bool $lock
         * @return int|bool
         * @static
         */
        public static function put($path, $contents, $lock = false)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->put($path, $contents, $lock);
        }

        /**
         * Write the contents of a file, replacing it atomically if it already exists.
         *
         * @param string $path
         * @param string $content
         * @param int|null $mode
         * @return void
         * @static
         */
        public static function replace($path, $content, $mode = null)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            $instance->replace($path, $content, $mode);
        }

        /**
         * Replace a given string within a given file.
         *
         * @param array|string $search
         * @param array|string $replace
         * @param string $path
         * @return void
         * @static
         */
        public static function replaceInFile($search, $replace, $path)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            $instance->replaceInFile($search, $replace, $path);
        }

        /**
         * Prepend to a file.
         *
         * @param string $path
         * @param string $data
         * @return int
         * @static
         */
        public static function prepend($path, $data)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->prepend($path, $data);
        }

        /**
         * Append to a file.
         *
         * @param string $path
         * @param string $data
         * @param bool $lock
         * @return int
         * @static
         */
        public static function append($path, $data, $lock = false)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->append($path, $data, $lock);
        }

        /**
         * Get or set UNIX mode of a file or directory.
         *
         * @param string $path
         * @param int|null $mode
         * @return mixed
         * @static
         */
        public static function chmod($path, $mode = null)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->chmod($path, $mode);
        }

        /**
         * Delete the file at a given path.
         *
         * @param string|array $paths
         * @return bool
         * @static
         */
        public static function delete($paths)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->delete($paths);
        }

        /**
         * Move a file to a new location.
         *
         * @param string $path
         * @param string $target
         * @return bool
         * @static
         */
        public static function move($path, $target)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->move($path, $target);
        }

        /**
         * Copy a file to a new location.
         *
         * @param string $path
         * @param string $target
         * @return bool
         * @static
         */
        public static function copy($path, $target)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->copy($path, $target);
        }

        /**
         * Create a symlink to the target file or directory. On Windows, a hard link is created if the target is a file.
         *
         * @param string $target
         * @param string $link
         * @return bool|null
         * @static
         */
        public static function link($target, $link)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->link($target, $link);
        }

        /**
         * Create a relative symlink to the target file or directory.
         *
         * @param string $target
         * @param string $link
         * @return void
         * @throws \RuntimeException
         * @static
         */
        public static function relativeLink($target, $link)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            $instance->relativeLink($target, $link);
        }

        /**
         * Extract the file name from a file path.
         *
         * @param string $path
         * @return string
         * @static
         */
        public static function name($path)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->name($path);
        }

        /**
         * Extract the trailing name component from a file path.
         *
         * @param string $path
         * @return string
         * @static
         */
        public static function basename($path)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->basename($path);
        }

        /**
         * Extract the parent directory from a file path.
         *
         * @param string $path
         * @return string
         * @static
         */
        public static function dirname($path)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->dirname($path);
        }

        /**
         * Extract the file extension from a file path.
         *
         * @param string $path
         * @return string
         * @static
         */
        public static function extension($path)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->extension($path);
        }

        /**
         * Guess the file extension from the mime-type of a given file.
         *
         * @param string $path
         * @return string|null
         * @throws \RuntimeException
         * @static
         */
        public static function guessExtension($path)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->guessExtension($path);
        }

        /**
         * Get the file type of a given file.
         *
         * @param string $path
         * @return string
         * @static
         */
        public static function type($path)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->type($path);
        }

        /**
         * Get the mime-type of a given file.
         *
         * @param string $path
         * @return string|false
         * @static
         */
        public static function mimeType($path)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->mimeType($path);
        }

        /**
         * Get the file size of a given file.
         *
         * @param string $path
         * @return int
         * @static
         */
        public static function size($path)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->size($path);
        }

        /**
         * Get the file's last modification time.
         *
         * @param string $path
         * @return int
         * @static
         */
        public static function lastModified($path)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->lastModified($path);
        }

        /**
         * Determine if the given path is a directory.
         *
         * @param string $directory
         * @return bool
         * @static
         */
        public static function isDirectory($directory)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->isDirectory($directory);
        }

        /**
         * Determine if the given path is a directory that does not contain any other files or directories.
         *
         * @param string $directory
         * @param bool $ignoreDotFiles
         * @return bool
         * @static
         */
        public static function isEmptyDirectory($directory, $ignoreDotFiles = false)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->isEmptyDirectory($directory, $ignoreDotFiles);
        }

        /**
         * Determine if the given path is readable.
         *
         * @param string $path
         * @return bool
         * @static
         */
        public static function isReadable($path)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->isReadable($path);
        }

        /**
         * Determine if the given path is writable.
         *
         * @param string $path
         * @return bool
         * @static
         */
        public static function isWritable($path)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->isWritable($path);
        }

        /**
         * Determine if two files are the same by comparing their hashes.
         *
         * @param string $firstFile
         * @param string $secondFile
         * @return bool
         * @static
         */
        public static function hasSameHash($firstFile, $secondFile)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->hasSameHash($firstFile, $secondFile);
        }

        /**
         * Determine if the given path is a file.
         *
         * @param string $file
         * @return bool
         * @static
         */
        public static function isFile($file)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->isFile($file);
        }

        /**
         * Find path names matching a given pattern.
         *
         * @param string $pattern
         * @param int $flags
         * @return array
         * @static
         */
        public static function glob($pattern, $flags = 0)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->glob($pattern, $flags);
        }

        /**
         * Get an array of all files in a directory.
         *
         * @param string $directory
         * @param bool $hidden
         * @return \Symfony\Component\Finder\SplFileInfo[]
         * @static
         */
        public static function files($directory, $hidden = false)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->files($directory, $hidden);
        }

        /**
         * Get all of the files from the given directory (recursive).
         *
         * @param string $directory
         * @param bool $hidden
         * @return \Symfony\Component\Finder\SplFileInfo[]
         * @static
         */
        public static function allFiles($directory, $hidden = false)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->allFiles($directory, $hidden);
        }

        /**
         * Get all of the directories within a given directory.
         *
         * @param string $directory
         * @return array
         * @static
         */
        public static function directories($directory)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->directories($directory);
        }

        /**
         * Ensure a directory exists.
         *
         * @param string $path
         * @param int $mode
         * @param bool $recursive
         * @return void
         * @static
         */
        public static function ensureDirectoryExists($path, $mode = 493, $recursive = true)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            $instance->ensureDirectoryExists($path, $mode, $recursive);
        }

        /**
         * Create a directory.
         *
         * @param string $path
         * @param int $mode
         * @param bool $recursive
         * @param bool $force
         * @return bool
         * @static
         */
        public static function makeDirectory($path, $mode = 493, $recursive = false, $force = false)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->makeDirectory($path, $mode, $recursive, $force);
        }

        /**
         * Move a directory.
         *
         * @param string $from
         * @param string $to
         * @param bool $overwrite
         * @return bool
         * @static
         */
        public static function moveDirectory($from, $to, $overwrite = false)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->moveDirectory($from, $to, $overwrite);
        }

        /**
         * Copy a directory from one location to another.
         *
         * @param string $directory
         * @param string $destination
         * @param int|null $options
         * @return bool
         * @static
         */
        public static function copyDirectory($directory, $destination, $options = null)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->copyDirectory($directory, $destination, $options);
        }

        /**
         * Recursively delete a directory.
         *
         * The directory itself may be optionally preserved.
         *
         * @param string $directory
         * @param bool $preserve
         * @return bool
         * @static
         */
        public static function deleteDirectory($directory, $preserve = false)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->deleteDirectory($directory, $preserve);
        }

        /**
         * Remove all of the directories within a given directory.
         *
         * @param string $directory
         * @return bool
         * @static
         */
        public static function deleteDirectories($directory)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->deleteDirectories($directory);
        }

        /**
         * Empty the specified directory of all files and folders.
         *
         * @param string $directory
         * @return bool
         * @static
         */
        public static function cleanDirectory($directory)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->cleanDirectory($directory);
        }

        /**
         * Apply the callback if the given "value" is (or resolves to) truthy.
         *
         * @template TWhenParameter
         * @template TWhenReturnType
         * @param (\Closure($this): TWhenParameter)|TWhenParameter|null $value
         * @param (callable($this, TWhenParameter): TWhenReturnType)|null $callback
         * @param (callable($this, TWhenParameter): TWhenReturnType)|null $default
         * @return $this|TWhenReturnType
         * @static
         */
        public static function when($value = null, $callback = null, $default = null)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->when($value, $callback, $default);
        }

        /**
         * Apply the callback if the given "value" is (or resolves to) falsy.
         *
         * @template TUnlessParameter
         * @template TUnlessReturnType
         * @param (\Closure($this): TUnlessParameter)|TUnlessParameter|null $value
         * @param (callable($this, TUnlessParameter): TUnlessReturnType)|null $callback
         * @param (callable($this, TUnlessParameter): TUnlessReturnType)|null $default
         * @return $this|TUnlessReturnType
         * @static
         */
        public static function unless($value = null, $callback = null, $default = null)
        {
            /** @var \Illuminate\Filesystem\Filesystem $instance */
            return $instance->unless($value, $callback, $default);
        }

        /**
         * Register a custom macro.
         *
         * @param string $name
         * @param object|callable $macro
         * @param-closure-this static  $macro
         * @return void
         * @static
         */
        public static function macro($name, $macro)
        {
            \Illuminate\Filesystem\Filesystem::macro($name, $macro);
        }

        /**
         * Mix another object into the class.
         *
         * @param object $mixin
         * @param bool $replace
         * @return void
         * @throws \ReflectionException
         * @static
         */
        public static function mixin($mixin, $replace = true)
        {
            \Illuminate\Filesystem\Filesystem::mixin($mixin, $replace);
        }

        /**
         * Checks if macro is registered.
         *
         * @param string $name
         * @return bool
         * @static
         */
        public static function hasMacro($name)
        {
            return \Illuminate\Filesystem\Filesystem::hasMacro($name);
        }

        /**
         * Flush the existing macros.
         *
         * @return void
         * @static
         */
        public static function flushMacros()
        {
            \Illuminate\Filesystem\Filesystem::flushMacros();
        }

            }
    /**
     *
     *
     * @see \Illuminate\Auth\Access\Gate
     */
    class Gate {
        /**
         * Determine if a given ability has been defined.
         *
         * @param string|array $ability
         * @return bool
         * @static
         */
        public static function has($ability)
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->has($ability);
        }

        /**
         * Perform an on-demand authorization check. Throw an authorization exception if the condition or callback is false.
         *
         * @param \Illuminate\Auth\Access\Response|\Closure|bool $condition
         * @param string|null $message
         * @param string|null $code
         * @return \Illuminate\Auth\Access\Response
         * @throws \Illuminate\Auth\Access\AuthorizationException
         * @static
         */
        public static function allowIf($condition, $message = null, $code = null)
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->allowIf($condition, $message, $code);
        }

        /**
         * Perform an on-demand authorization check. Throw an authorization exception if the condition or callback is true.
         *
         * @param \Illuminate\Auth\Access\Response|\Closure|bool $condition
         * @param string|null $message
         * @param string|null $code
         * @return \Illuminate\Auth\Access\Response
         * @throws \Illuminate\Auth\Access\AuthorizationException
         * @static
         */
        public static function denyIf($condition, $message = null, $code = null)
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->denyIf($condition, $message, $code);
        }

        /**
         * Define a new ability.
         *
         * @param \BackedEnum|string $ability
         * @param callable|array|string $callback
         * @return \Illuminate\Auth\Access\Gate
         * @throws \InvalidArgumentException
         * @static
         */
        public static function define($ability, $callback)
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->define($ability, $callback);
        }

        /**
         * Define abilities for a resource.
         *
         * @param string $name
         * @param string $class
         * @param array|null $abilities
         * @return \Illuminate\Auth\Access\Gate
         * @static
         */
        public static function resource($name, $class, $abilities = null)
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->resource($name, $class, $abilities);
        }

        /**
         * Define a policy class for a given class type.
         *
         * @param string $class
         * @param string $policy
         * @return \Illuminate\Auth\Access\Gate
         * @static
         */
        public static function policy($class, $policy)
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->policy($class, $policy);
        }

        /**
         * Register a callback to run before all Gate checks.
         *
         * @param callable $callback
         * @return \Illuminate\Auth\Access\Gate
         * @static
         */
        public static function before($callback)
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->before($callback);
        }

        /**
         * Register a callback to run after all Gate checks.
         *
         * @param callable $callback
         * @return \Illuminate\Auth\Access\Gate
         * @static
         */
        public static function after($callback)
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->after($callback);
        }

        /**
         * Determine if all of the given abilities should be granted for the current user.
         *
         * @param iterable|\BackedEnum|string $ability
         * @param array|mixed $arguments
         * @return bool
         * @static
         */
        public static function allows($ability, $arguments = [])
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->allows($ability, $arguments);
        }

        /**
         * Determine if any of the given abilities should be denied for the current user.
         *
         * @param iterable|\BackedEnum|string $ability
         * @param array|mixed $arguments
         * @return bool
         * @static
         */
        public static function denies($ability, $arguments = [])
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->denies($ability, $arguments);
        }

        /**
         * Determine if all of the given abilities should be granted for the current user.
         *
         * @param iterable|\BackedEnum|string $abilities
         * @param array|mixed $arguments
         * @return bool
         * @static
         */
        public static function check($abilities, $arguments = [])
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->check($abilities, $arguments);
        }

        /**
         * Determine if any one of the given abilities should be granted for the current user.
         *
         * @param iterable|\BackedEnum|string $abilities
         * @param array|mixed $arguments
         * @return bool
         * @static
         */
        public static function any($abilities, $arguments = [])
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->any($abilities, $arguments);
        }

        /**
         * Determine if all of the given abilities should be denied for the current user.
         *
         * @param iterable|\BackedEnum|string $abilities
         * @param array|mixed $arguments
         * @return bool
         * @static
         */
        public static function none($abilities, $arguments = [])
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->none($abilities, $arguments);
        }

        /**
         * Determine if the given ability should be granted for the current user.
         *
         * @param \BackedEnum|string $ability
         * @param array|mixed $arguments
         * @return \Illuminate\Auth\Access\Response
         * @throws \Illuminate\Auth\Access\AuthorizationException
         * @static
         */
        public static function authorize($ability, $arguments = [])
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->authorize($ability, $arguments);
        }

        /**
         * Inspect the user for the given ability.
         *
         * @param \BackedEnum|string $ability
         * @param array|mixed $arguments
         * @return \Illuminate\Auth\Access\Response
         * @static
         */
        public static function inspect($ability, $arguments = [])
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->inspect($ability, $arguments);
        }

        /**
         * Get the raw result from the authorization callback.
         *
         * @param string $ability
         * @param array|mixed $arguments
         * @return mixed
         * @throws \Illuminate\Auth\Access\AuthorizationException
         * @static
         */
        public static function raw($ability, $arguments = [])
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->raw($ability, $arguments);
        }

        /**
         * Get a policy instance for a given class.
         *
         * @param object|string $class
         * @return mixed
         * @static
         */
        public static function getPolicyFor($class)
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->getPolicyFor($class);
        }

        /**
         * Specify a callback to be used to guess policy names.
         *
         * @param callable $callback
         * @return \Illuminate\Auth\Access\Gate
         * @static
         */
        public static function guessPolicyNamesUsing($callback)
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->guessPolicyNamesUsing($callback);
        }

        /**
         * Build a policy class instance of the given type.
         *
         * @param object|string $class
         * @return mixed
         * @throws \Illuminate\Contracts\Container\BindingResolutionException
         * @static
         */
        public static function resolvePolicy($class)
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->resolvePolicy($class);
        }

        /**
         * Get a gate instance for the given user.
         *
         * @param \Illuminate\Contracts\Auth\Authenticatable|mixed $user
         * @return static
         * @static
         */
        public static function forUser($user)
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->forUser($user);
        }

        /**
         * Get all of the defined abilities.
         *
         * @return array
         * @static
         */
        public static function abilities()
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->abilities();
        }

        /**
         * Get all of the defined policies.
         *
         * @return array
         * @static
         */
        public static function policies()
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->policies();
        }

        /**
         * Set the default denial response for gates and policies.
         *
         * @param \Illuminate\Auth\Access\Response $response
         * @return \Illuminate\Auth\Access\Gate
         * @static
         */
        public static function defaultDenialResponse($response)
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->defaultDenialResponse($response);
        }

        /**
         * Set the container instance used by the gate.
         *
         * @param \Illuminate\Contracts\Container\Container $container
         * @return \Illuminate\Auth\Access\Gate
         * @static
         */
        public static function setContainer($container)
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->setContainer($container);
        }

        /**
         * Deny with a HTTP status code.
         *
         * @param int $status
         * @param string|null $message
         * @param int|null $code
         * @return \Illuminate\Auth\Access\Response
         * @static
         */
        public static function denyWithStatus($status, $message = null, $code = null)
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->denyWithStatus($status, $message, $code);
        }

        /**
         * Deny with a 404 HTTP status code.
         *
         * @param string|null $message
         * @param int|null $code
         * @return \Illuminate\Auth\Access\Response
         * @static
         */
        public static function denyAsNotFound($message = null, $code = null)
        {
            /** @var \Illuminate\Auth\Access\Gate $instance */
            return $instance->denyAsNotFound($message, $code);
        }

            }
    /**
     *
     *
     * @see \Illuminate\Hashing\HashManager
     * @see \Illuminate\Hashing\AbstractHasher
     */
    class Hash {
        /**
         * Create an instance of the Bcrypt hash Driver.
         *
         * @return \Illuminate\Hashing\BcryptHasher
         * @static
         */
        public static function createBcryptDriver()
        {
            /** @var \Illuminate\Hashing\HashManager $instance */
            return $instance->createBcryptDriver();
        }

        /**
         * Create an instance of the Argon2i hash Driver.
         *
         * @return \Illuminate\Hashing\ArgonHasher
         * @static
         */
        public static function createArgonDriver()
        {
            /** @var \Illuminate\Hashing\HashManager $instance */
            return $instance->createArgonDriver();
        }

        /**
         * Create an instance of the Argon2id hash Driver.
         *
         * @return \Illuminate\Hashing\Argon2IdHasher
         * @static
         */
        public static function createArgon2idDriver()
        {
            /** @var \Illuminate\Hashing\HashManager $instance */
            return $instance->createArgon2idDriver();
        }

        /**
         * Get information about the given hashed value.
         *
         * @param string $hashedValue
         * @return array
         * @static
         */
        public static function info($hashedValue)
        {
            /** @var \Illuminate\Hashing\HashManager $instance */
            return $instance->info($hashedValue);
        }

        /**
         * Hash the given value.
         *
         * @param string $value
         * @param array $options
         * @return string
         * @static
         */
        public static function make($value, $options = [])
        {
            /** @var \Illuminate\Hashing\HashManager $instance */
            return $instance->make($value, $options);
        }

        /**
         * Check the given plain value against a hash.
         *
         * @param string $value
         * @param string $hashedValue
         * @param array $options
         * @return bool
         * @static
         */
        public static function check($value, $hashedValue, $options = [])
        {
            /** @var \Illuminate\Hashing\HashManager $instance */
            return $instance->check($value, $hashedValue, $options);
        }

        /**
         * Check if the given hash has been hashed using the given options.
         *
         * @param string $hashedValue
         * @param array $options
         * @return bool
         * @static
         */
        public static function needsRehash($hashedValue, $options = [])
        {
            /** @var \Illuminate\Hashing\HashManager $instance */
            return $instance->needsRehash($hashedValue, $options);
        }

        /**
         * Determine if a given string is already hashed.
         *
         * @param string $value
         * @return bool
         * @static
         */
        public static function isHashed($value)
        {
            /** @var \Illuminate\Hashing\HashManager $instance */
            return $instance->isHashed($value);
        }

        /**
         * Get the default driver name.
         *
         * @return string
         * @static
         */
        public static function getDefaultDriver()
        {
            /** @var \Illuminate\Hashing\HashManager $instance */
            return $instance->getDefaultDriver();
        }

        /**
         * Verifies that the configuration is less than or equal to what is configured.
         *
         * @param array $value
         * @return bool
         * @internal
         * @static
         */
        public static function verifyConfiguration($value)
        {
            /** @var \Illuminate\Hashing\HashManager $instance */
            return $instance->verifyConfiguration($value);
        }

        /**
         * Get a driver instance.
         *
         * @param string|null $driver
         * @return mixed
         * @throws \InvalidArgumentException
         * @static
         */
        public static function driver($driver = null)
        {
            //Method inherited from \Illuminate\Support\Manager
            /** @var \Illuminate\Hashing\HashManager $instance */
            return $instance->driver($driver);
        }

        /**
         * Register a custom driver creator Closure.
         *
         * @param string $driver
         * @param \Closure $callback
         * @return \Illuminate\Hashing\HashManager
         * @static
         */
        public static function extend($driver, $callback)
        {
            //Method inherited from \Illuminate\Support\Manager
            /** @var \Illuminate\Hashing\HashManager $instance */
            return $instance->extend($driver, $callback);
        }

        /**
         * Get all of the created "drivers".
         *
         * @return array
         * @static
         */
        public static function getDrivers()
        {
            //Method inherited from \Illuminate\Support\Manager
            /** @var \Illuminate\Hashing\HashManager $instance */
            return $instance->getDrivers();
        }

        /**
         * Get the container instance used by the manager.
         *
         * @return \Illuminate\Contracts\Container\Container
         * @static
         */
        public static function getContainer()
        {
            //Method inherited from \Illuminate\Support\Manager
            /** @var \Illuminate\Hashing\HashManager $instance */
            return $instance->getContainer();
        }

        /**
         * Set the container instance used by the manager.
         *
         * @param \Illuminate\Contracts\Container\Container $container
         * @return \Illuminate\Hashing\HashManager
         * @static
         */
        public static function setContainer($container)
        {
            //Method inherited from \Illuminate\Support\Manager
            /** @var \Illuminate\Hashing\HashManager $instance */
            return $instance->setContainer($container);
        }

        /**
         * Forget all of the resolved driver instances.
         *
         * @return \Illuminate\Hashing\HashManager
         * @static
         */
        public static function forgetDrivers()
        {
            //Method inherited from \Illuminate\Support\Manager
            /** @var \Illuminate\Hashing\HashManager $instance */
            return $instance->forgetDrivers();
        }

            }
    /**
     *
     *
     * @method static \Illuminate\Http\Client\PendingRequest baseUrl(string $url)
     * @method static \Illuminate\Http\Client\PendingRequest withBody(\Psr\Http\Message\StreamInterface|string $content, string $contentType = 'application/json')
     * @method static \Illuminate\Http\Client\PendingRequest asJson()
     * @method static \Illuminate\Http\Client\PendingRequest asForm()
     * @method static \Illuminate\Http\Client\PendingRequest attach(string|array $name, string|resource $contents = '', string|null $filename = null, array $headers = [])
     * @method static \Illuminate\Http\Client\PendingRequest asMultipart()
     * @method static \Illuminate\Http\Client\PendingRequest bodyFormat(string $format)
     * @method static \Illuminate\Http\Client\PendingRequest withQueryParameters(array $parameters)
     * @method static \Illuminate\Http\Client\PendingRequest contentType(string $contentType)
     * @method static \Illuminate\Http\Client\PendingRequest acceptJson()
     * @method static \Illuminate\Http\Client\PendingRequest accept(string $contentType)
     * @method static \Illuminate\Http\Client\PendingRequest withHeaders(array $headers)
     * @method static \Illuminate\Http\Client\PendingRequest withHeader(string $name, mixed $value)
     * @method static \Illuminate\Http\Client\PendingRequest replaceHeaders(array $headers)
     * @method static \Illuminate\Http\Client\PendingRequest withBasicAuth(string $username, string $password)
     * @method static \Illuminate\Http\Client\PendingRequest withDigestAuth(string $username, string $password)
     * @method static \Illuminate\Http\Client\PendingRequest withToken(string $token, string $type = 'Bearer')
     * @method static \Illuminate\Http\Client\PendingRequest withUserAgent(string|bool $userAgent)
     * @method static \Illuminate\Http\Client\PendingRequest withUrlParameters(array $parameters = [])
     * @method static \Illuminate\Http\Client\PendingRequest withCookies(array $cookies, string $domain)
     * @method static \Illuminate\Http\Client\PendingRequest maxRedirects(int $max)
     * @method static \Illuminate\Http\Client\PendingRequest withoutRedirecting()
     * @method static \Illuminate\Http\Client\PendingRequest withoutVerifying()
     * @method static \Illuminate\Http\Client\PendingRequest sink(string|resource $to)
     * @method static \Illuminate\Http\Client\PendingRequest timeout(int|float $seconds)
     * @method static \Illuminate\Http\Client\PendingRequest connectTimeout(int|float $seconds)
     * @method static \Illuminate\Http\Client\PendingRequest retry(array|int $times, \Closure|int $sleepMilliseconds = 0, callable|null $when = null, bool $throw = true)
     * @method static \Illuminate\Http\Client\PendingRequest withOptions(array $options)
     * @method static \Illuminate\Http\Client\PendingRequest withMiddleware(callable $middleware)
     * @method static \Illuminate\Http\Client\PendingRequest withRequestMiddleware(callable $middleware)
     * @method static \Illuminate\Http\Client\PendingRequest withResponseMiddleware(callable $middleware)
     * @method static \Illuminate\Http\Client\PendingRequest beforeSending(callable $callback)
     * @method static \Illuminate\Http\Client\PendingRequest throw(callable|null $callback = null)
     * @method static \Illuminate\Http\Client\PendingRequest throwIf(callable|bool $condition)
     * @method static \Illuminate\Http\Client\PendingRequest throwUnless(callable|bool $condition)
     * @method static \Illuminate\Http\Client\PendingRequest dump()
     * @method static \Illuminate\Http\Client\PendingRequest dd()
     * @method static \Illuminate\Http\Client\Response get(string $url, array|string|null $query = null)
     * @method static \Illuminate\Http\Client\Response head(string $url, array|string|null $query = null)
     * @method static \Illuminate\Http\Client\Response post(string $url, array $data = [])
     * @method static \Illuminate\Http\Client\Response patch(string $url, array $data = [])
     * @method static \Illuminate\Http\Client\Response put(string $url, array $data = [])
     * @method static \Illuminate\Http\Client\Response delete(string $url, array $data = [])
     * @method static array pool(callable $callback)
     * @method static \Illuminate\Http\Client\Response send(string $method, string $url, array $options = [])
     * @method static \GuzzleHttp\Client buildClient()
     * @method static \GuzzleHttp\Client createClient(\GuzzleHttp\HandlerStack $handlerStack)
     * @method static \GuzzleHttp\HandlerStack buildHandlerStack()
     * @method static \GuzzleHttp\HandlerStack pushHandlers(\GuzzleHttp\HandlerStack $handlerStack)
     * @method static \Closure buildBeforeSendingHandler()
     * @method static \Closure buildRecorderHandler()
     * @method static \Closure buildStubHandler()
     * @method static \GuzzleHttp\Psr7\RequestInterface runBeforeSendingCallbacks(\GuzzleHttp\Psr7\RequestInterface $request, array $options)
     * @method static array mergeOptions(array ...$options)
     * @method static \Illuminate\Http\Client\PendingRequest stub(callable $callback)
     * @method static \Illuminate\Http\Client\PendingRequest async(bool $async = true)
     * @method static \GuzzleHttp\Promise\PromiseInterface|null getPromise()
     * @method static \Illuminate\Http\Client\PendingRequest setClient(\GuzzleHttp\Client $client)
     * @method static \Illuminate\Http\Client\PendingRequest setHandler(callable $handler)
     * @method static array getOptions()
     * @method static \Illuminate\Http\Client\PendingRequest|mixed when(\Closure|mixed|null $value = null, callable|null $callback = null, callable|null $default = null)
     * @method static \Illuminate\Http\Client\PendingRequest|mixed unless(\Closure|mixed|null $value = null, callable|null $callback = null, callable|null $default = null)
     * @see \Illuminate\Http\Client\Factory
     */
    class Http {
        /**
         * Add middleware to apply to every request.
         *
         * @param callable $middleware
         * @return \Illuminate\Http\Client\Factory
         * @static
         */
        public static function globalMiddleware($middleware)
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            return $instance->globalMiddleware($middleware);
        }

        /**
         * Add request middleware to apply to every request.
         *
         * @param callable $middleware
         * @return \Illuminate\Http\Client\Factory
         * @static
         */
        public static function globalRequestMiddleware($middleware)
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            return $instance->globalRequestMiddleware($middleware);
        }

        /**
         * Add response middleware to apply to every request.
         *
         * @param callable $middleware
         * @return \Illuminate\Http\Client\Factory
         * @static
         */
        public static function globalResponseMiddleware($middleware)
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            return $instance->globalResponseMiddleware($middleware);
        }

        /**
         * Set the options to apply to every request.
         *
         * @param \Closure|array $options
         * @return \Illuminate\Http\Client\Factory
         * @static
         */
        public static function globalOptions($options)
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            return $instance->globalOptions($options);
        }

        /**
         * Create a new response instance for use during stubbing.
         *
         * @param array|string|null $body
         * @param int $status
         * @param array $headers
         * @return \GuzzleHttp\Promise\PromiseInterface
         * @static
         */
        public static function response($body = null, $status = 200, $headers = [])
        {
            return \Illuminate\Http\Client\Factory::response($body, $status, $headers);
        }

        /**
         * Create a new connection exception for use during stubbing.
         *
         * @param string|null $message
         * @return \GuzzleHttp\Promise\PromiseInterface
         * @static
         */
        public static function failedConnection($message = null)
        {
            return \Illuminate\Http\Client\Factory::failedConnection($message);
        }

        /**
         * Get an invokable object that returns a sequence of responses in order for use during stubbing.
         *
         * @param array $responses
         * @return \Illuminate\Http\Client\ResponseSequence
         * @static
         */
        public static function sequence($responses = [])
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            return $instance->sequence($responses);
        }

        /**
         * Register a stub callable that will intercept requests and be able to return stub responses.
         *
         * @param callable|array|null $callback
         * @return \Illuminate\Http\Client\Factory
         * @static
         */
        public static function fake($callback = null)
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            return $instance->fake($callback);
        }

        /**
         * Register a response sequence for the given URL pattern.
         *
         * @param string $url
         * @return \Illuminate\Http\Client\ResponseSequence
         * @static
         */
        public static function fakeSequence($url = '*')
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            return $instance->fakeSequence($url);
        }

        /**
         * Stub the given URL using the given callback.
         *
         * @param string $url
         * @param \Illuminate\Http\Client\Response|\GuzzleHttp\Promise\PromiseInterface|callable|int|string|array $callback
         * @return \Illuminate\Http\Client\Factory
         * @static
         */
        public static function stubUrl($url, $callback)
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            return $instance->stubUrl($url, $callback);
        }

        /**
         * Indicate that an exception should be thrown if any request is not faked.
         *
         * @param bool $prevent
         * @return \Illuminate\Http\Client\Factory
         * @static
         */
        public static function preventStrayRequests($prevent = true)
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            return $instance->preventStrayRequests($prevent);
        }

        /**
         * Determine if stray requests are being prevented.
         *
         * @return bool
         * @static
         */
        public static function preventingStrayRequests()
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            return $instance->preventingStrayRequests();
        }

        /**
         * Indicate that an exception should not be thrown if any request is not faked.
         *
         * @return \Illuminate\Http\Client\Factory
         * @static
         */
        public static function allowStrayRequests()
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            return $instance->allowStrayRequests();
        }

        /**
         * Record a request response pair.
         *
         * @param \Illuminate\Http\Client\Request $request
         * @param \Illuminate\Http\Client\Response|null $response
         * @return void
         * @static
         */
        public static function recordRequestResponsePair($request, $response)
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            $instance->recordRequestResponsePair($request, $response);
        }

        /**
         * Assert that a request / response pair was recorded matching a given truth test.
         *
         * @param callable $callback
         * @return void
         * @static
         */
        public static function assertSent($callback)
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            $instance->assertSent($callback);
        }

        /**
         * Assert that the given request was sent in the given order.
         *
         * @param array $callbacks
         * @return void
         * @static
         */
        public static function assertSentInOrder($callbacks)
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            $instance->assertSentInOrder($callbacks);
        }

        /**
         * Assert that a request / response pair was not recorded matching a given truth test.
         *
         * @param callable $callback
         * @return void
         * @static
         */
        public static function assertNotSent($callback)
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            $instance->assertNotSent($callback);
        }

        /**
         * Assert that no request / response pair was recorded.
         *
         * @return void
         * @static
         */
        public static function assertNothingSent()
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            $instance->assertNothingSent();
        }

        /**
         * Assert how many requests have been recorded.
         *
         * @param int $count
         * @return void
         * @static
         */
        public static function assertSentCount($count)
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            $instance->assertSentCount($count);
        }

        /**
         * Assert that every created response sequence is empty.
         *
         * @return void
         * @static
         */
        public static function assertSequencesAreEmpty()
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            $instance->assertSequencesAreEmpty();
        }

        /**
         * Get a collection of the request / response pairs matching the given truth test.
         *
         * @param callable $callback
         * @return \Illuminate\Support\Collection
         * @static
         */
        public static function recorded($callback = null)
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            return $instance->recorded($callback);
        }

        /**
         * Create a new pending request instance for this factory.
         *
         * @return \Illuminate\Http\Client\PendingRequest
         * @static
         */
        public static function createPendingRequest()
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            return $instance->createPendingRequest();
        }

        /**
         * Get the current event dispatcher implementation.
         *
         * @return \Illuminate\Contracts\Events\Dispatcher|null
         * @static
         */
        public static function getDispatcher()
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            return $instance->getDispatcher();
        }

        /**
         * Get the array of global middleware.
         *
         * @return array
         * @static
         */
        public static function getGlobalMiddleware()
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            return $instance->getGlobalMiddleware();
        }

        /**
         * Register a custom macro.
         *
         * @param string $name
         * @param object|callable $macro
         * @param-closure-this static  $macro
         * @return void
         * @static
         */
        public static function macro($name, $macro)
        {
            \Illuminate\Http\Client\Factory::macro($name, $macro);
        }

        /**
         * Mix another object into the class.
         *
         * @param object $mixin
         * @param bool $replace
         * @return void
         * @throws \ReflectionException
         * @static
         */
        public static function mixin($mixin, $replace = true)
        {
            \Illuminate\Http\Client\Factory::mixin($mixin, $replace);
        }

        /**
         * Checks if macro is registered.
         *
         * @param string $name
         * @return bool
         * @static
         */
        public static function hasMacro($name)
        {
            return \Illuminate\Http\Client\Factory::hasMacro($name);
        }

        /**
         * Flush the existing macros.
         *
         * @return void
         * @static
         */
        public static function flushMacros()
        {
            \Illuminate\Http\Client\Factory::flushMacros();
        }

        /**
         * Dynamically handle calls to the class.
         *
         * @param string $method
         * @param array $parameters
         * @return mixed
         * @throws \BadMethodCallException
         * @static
         */
        public static function macroCall($method, $parameters)
        {
            /** @var \Illuminate\Http\Client\Factory $instance */
            return $instance->macroCall($method, $parameters);
        }

            }
    /**
     *
     *
     * @see \Illuminate\Translation\Translator
     */
    class Lang {
        /**
         * Determine if a translation exists for a given locale.
         *
         * @param string $key
         * @param string|null $locale
         * @return bool
         * @static
         */
        public static function hasForLocale($key, $locale = null)
        {
            /** @var \Illuminate\Translation\Translator $instance */
            return $instance->hasForLocale($key, $locale);
        }

        /**
         * Determine if a translation exists.
         *
         * @param string $key
         * @param string|null $locale
         * @param bool $fallback
         * @return bool
         * @static
         */
        public static function has($key, $locale = null, $fallback = true)
        {
            /** @var \Illuminate\Translation\Translator $instance */
            return $instance->has($key, $locale, $fallback);
        }

        /**
         * Get the translation for the given key.
         *
         * @param string $key
         * @param array $replace
         * @param string|null $locale
         * @param bool $fallback
         * @return string|array
         * @static
         */
        public static function get($key, $replace = [], $locale = null, $fallback = true)
        {
            /** @var \Illuminate\Translation\Translator $instance */
            return $instance->get($key, $replace, $locale, $fallback);
        }

        /**
         * Get a translation according to an integer value.
         *
         * @param string $key
         * @param \Countable|int|float|array $number
         * @param array $replace
         * @param string|null $locale
         * @return string
         * @static
         */
        public static function choice($key, $number, $replace = [], $locale = null)
        {
            /** @var \Illuminate\Translation\Translator $instance */
            return $instance->choice($key, $number, $replace, $locale);
        }

        /**
         * Add translation lines to the given locale.
         *
         * @param array $lines
         * @param string $locale
         * @param string $namespace
         * @return void
         * @static
         */
        public static function addLines($lines, $locale, $namespace = '*')
        {
            /** @var \Illuminate\Translation\Translator $instance */
            $instance->addLines($lines, $locale, $namespace);
        }

        /**
         * Load the specified language group.
         *
         * @param string $namespace
         * @param string $group
         * @param string $locale
         * @return void
         * @static
         */
        public static function load($namespace, $group, $locale)
        {
            /** @var \Illuminate\Translation\Translator $instance */
            $instance->load($namespace, $group, $locale);
        }

        /**
         * Register a callback that is responsible for handling missing translation keys.
         *
         * @param callable|null $callback
         * @return static
         * @static
         */
        public static function handleMissingKeysUsing($callback)
        {
            /** @var \Illuminate\Translation\Translator $instance */
            return $instance->handleMissingKeysUsing($callback);
        }

        /**
         * Add a new namespace to the loader.
         *
         * @param string $namespace
         * @param string $hint
         * @return void
         * @static
         */
        public static function addNamespace($namespace, $hint)
        {
            /** @var \Illuminate\Translation\Translator $instance */
            $instance->addNamespace($namespace, $hint);
        }

        /**
         * Add a new JSON path to the loader.
         *
         * @param string $path
         * @return void
         * @static
         */
        public static function addJsonPath($path)
        {
            /** @var \Illuminate\Translation\Translator $instance */
            $instance->addJsonPath($path);
        }

        /**
         * Parse a key into namespace, group, and item.
         *
         * @param string $key
         * @return array
         * @static
         */
        public static function parseKey($key)
        {
            /** @var \Illuminate\Translation\Translator $instance */
            return $instance->parseKey($key);
        }

        /**
         * Specify a callback that should be invoked to determined the applicable locale array.
         *
         * @param callable $callback
         * @return void
         * @static
         */
        public static function determineLocalesUsing($callback)
        {
            /** @var \Illuminate\Translation\Translator $instance */
            $instance->determineLocalesUsing($callback);
        }

        /**
         * Get the message selector instance.
         *
         * @return \Illuminate\Translation\MessageSelector
         * @static
         */
        public static function getSelector()
        {
            /** @var \Illuminate\Translation\Translator $instance */
            return $instance->getSelector();
        }

        /**
         * Set the message selector instance.
         *
         * @param \Illuminate\Translation\MessageSelector $selector
         * @return void
         * @static
         */
        public static function setSelector($selector)
        {
            /** @var \Illuminate\Translation\Translator $instance */
            $instance->setSelector($selector);
        }

        /**
         * Get the language line loader implementation.
         *
         * @return \Illuminate\Contracts\Translation\Loader
         * @static
         */
        public static function getLoader()
        {
            /** @var \Illuminate\Translation\Translator $instance */
            return $instance->getLoader();
        }

        /**
         * Get the default locale being used.
         *
         * @return string
         * @static
         */
        public static function locale()
        {
            /** @var \Illuminate\Translation\Translator $instance */
            return $instance->locale();
        }

        /**
         * Get the default locale being used.
         *
         * @return string
         * @static
         */
        public static function getLocale()
        {
            /** @var \Illuminate\Translation\Translator $instance */
            return $instance->getLocale();
        }

        /**
         * Set the default locale.
         *
         * @param string $locale
         * @return void
         * @throws \InvalidArgumentException
         * @static
         */
        public static function setLocale($locale)
        {
            /** @var \Illuminate\Translation\Translator $instance */
            $instance->setLocale($locale);
        }

        /**
         * Get the fallback locale being used.
         *
         * @return string
         * @static
         */
        public static function getFallback()
        {
            /** @var \Illuminate\Translation\Translator $instance */
            return $instance->getFallback();
        }

        /**
         * Set the fallback locale being used.
         *
         * @param string $fallback
         * @return void
         * @static
         */
        public static function setFallback($fallback)
        {
            /** @var \Illuminate\Translation\Translator $instance */
            $instance->setFallback($fallback);
        }

        /**
         * Set the loaded translation groups.
         *
         * @param array $loaded
         * @return void
         * @static
         */
        public static function setLoaded($loaded)
        {
            /** @var \Illuminate\Translation\Translator $instance */
            $instance->setLoaded($loaded);
        }

        /**
         * Add a handler to be executed in order to format a given class to a string during translation replacements.
         *
         * @param callable|string $class
         * @param callable|null $handler
         * @return void
         * @static
         */
        public static function stringable($class, $handler = null)
        {
            /** @var \Illuminate\Translation\Translator $instance */
            $instance->stringable($class, $handler);
        }

        /**
         * Set the parsed value of a key.
         *
         * @param string $key
         * @param array $parsed
         * @return void
         * @static
         */
        public static function setParsedKey($key, $parsed)
        {
            //Method inherited from \Illuminate\Support\NamespacedItemResolver
            /** @var \Illuminate\Translation\Translator $instance */
            $instance->setParsedKey($key, $parsed);
        }

        /**
         * Flush the cache of parsed keys.
         *
         * @return void
         * @static
         */
        public static function flushParsedKeys()
        {
            //Method inherited from \Illuminate\Support\NamespacedItemResolver
            /** @var \Illuminate\Translation\Translator $instance */
            $instance->flushParsedKeys();
        }

        /**
         * Register a custom macro.
         *
         * @param string $name
         * @param object|callable $macro
         * @param-closure-this static  $macro
         * @return void
         * @static
         */
        public static function macro($name, $macro)
        {
            \Illuminate\Translation\Translator::macro($name, $macro);
        }

        /**
         * Mix another object into the class.
         *
         * @param object $mixin
         * @param bool $replace
         * @return void
         * @throws \ReflectionException
         * @static
         */
        public static function mixin($mixin, $replace = true)
        {
            \Illuminate\Translation\Translator::mixin($mixin, $replace);
        }

        /**
         * Checks if macro is registered.
         *
         * @param string $name
         * @return bool
         * @static
         */
        public static function hasMacro($name)
        {
            return \Illuminate\Translation\Translator::hasMacro($name);
        }

        /**
         * Flush the existing macros.
         *
         * @return void
         * @static
         */
        public static function flushMacros()
        {
            \Illuminate\Translation\Translator::flushMacros();
        }

            }
    /**
     *
     *
     * @method static void write(string $level, \Illuminate\Contracts\Support\Arrayable|\Illuminate\Contracts\Support\Jsonable|\Illuminate\Support\Stringable|array|string $message, array $context = [])
     * @method static \Illuminate\Log\Logger withContext(array $context = [])
     * @method static void listen(\Closure $callback)
     * @method static \Psr\Log\LoggerInterface getLogger()
     * @method static \Illuminate\Contracts\Events\Dispatcher getEventDispatcher()
     * @method static void setEventDispatcher(\Illuminate\Contracts\Events\Dispatcher $dispatcher)
     * @method static \Illuminate\Log\Logger|mixed when(\Closure|mixed|null $value = null, callable|null $callback = null, callable|null $default = null)
     * @method static \Illuminate\Log\Logger|mixed unless(\Closure|mixed|null $value = null, callable|null $callback = null, callable|null $default = null)
     * @see \Illuminate\Log\LogManager
     */
    class Log {
        /**
         * Build an on-demand log channel.
         *
         * @param array $config
         * @return \Psr\Log\LoggerInterface
         * @static
         */
        public static function build($config)
        {
            /** @var \Illuminate\Log\LogManager $instance */
            return $instance->build($config);
        }

        /**
         * Create a new, on-demand aggregate logger instance.
         *
         * @param array $channels
         * @param string|null $channel
         * @return \Psr\Log\LoggerInterface
         * @static
         */
        public static function stack($channels, $channel = null)
        {
            /** @var \Illuminate\Log\LogManager $instance */
            return $instance->stack($channels, $channel);
        }

        /**
         * Get a log channel instance.
         *
         * @param string|null $channel
         * @return \Psr\Log\LoggerInterface
         * @static
         */
        public static function channel($channel = null)
        {
            /** @var \Illuminate\Log\LogManager $instance */
            return $instance->channel($channel);
        }

        /**
         * Get a log driver instance.
         *
         * @param string|null $driver
         * @return \Psr\Log\LoggerInterface
         * @static
         */
        public static function driver($driver = null)
        {
            /** @var \Illuminate\Log\LogManager $instance */
            return $instance->driver($driver);
        }

        /**
         * Share context across channels and stacks.
         *
         * @param array $context
         * @return \Illuminate\Log\LogManager
         * @static
         */
        public static function shareContext($context)
        {
            /** @var \Illuminate\Log\LogManager $instance */
            return $instance->shareContext($context);
        }

        /**
         * The context shared across channels and stacks.
         *
         * @return array
         * @static
         */
        public static function sharedContext()
        {
            /** @var \Illuminate\Log\LogManager $instance */
            return $instance->sharedContext();
        }

        /**
         * Flush the log context on all currently resolved channels.
         *
         * @return \Illuminate\Log\LogManager
         * @static
         */
        public static function withoutContext()
        {
            /** @var \Illuminate\Log\LogManager $instance */
            return $instance->withoutContext();
        }

        /**
         * Flush the shared context.
         *
         * @return \Illuminate\Log\LogManager
         * @static
         */
        public static function flushSharedContext()
        {
            /** @var \Illuminate\Log\LogManager $instance */
            return $instance->flushSharedContext();
        }

        /**
         * Get the default log driver name.
         *
         * @return string|null
         * @static
         */
        public static function getDefaultDriver()
        {
            /** @var \Illuminate\Log\LogManager $instance */
            return $instance->getDefaultDriver();
        }

        /**
         * Set the default log driver name.
         *
         * @param string $name
         * @return void
         * @static
         */
        public static function setDefaultDriver($name)
        {
            /** @var \Illuminate\Log\LogManager $instance */
            $instance->setDefaultDriver($name);
        }

        /**
         * Register a custom driver creator Closure.
         *
         * @param string $driver
         * @param \Closure $callback
         * @return \Illuminate\Log\LogManager
         * @static
         */
        public static function extend($driver, $callback)
        {
            /** @var \Illuminate\Log\LogManager $instance */
            return $instance->extend($driver, $callback);
        }

        /**
         * Unset the given channel instance.
         *
         * @param string|null $driver
         * @return void
         * @static
         */
        public static function forgetChannel($driver = null)
        {
            /** @var \Illuminate\Log\LogManager $instance */
            $instance->forgetChannel($driver);
        }

        /**
         * Get all of the resolved log channels.
         *
         * @return array
         * @static
         */
        public static function getChannels()
        {
            /** @var \Illuminate\Log\LogManager $instance */
            return $instance->getChannels();
        }

        /**
         * System is unusable.
         *
         * @param string|\Stringable $message
         * @param array $context
         * @return void
         * @static
         */
        public static function emergency($message, $context = [])
        {
            /** @var \Illuminate\Log\LogManager $instance */
            $instance->emergency($message, $context);
        }

        /**
         * Action must be taken immediately.
         *
         * Example: Entire website down, database unavailable, etc. This should
         * trigger the SMS alerts and wake you up.
         *
         * @param string|\Stringable $message
         * @param array $context
         * @return void
         * @static
         */
        public static function alert($message, $context = [])
        {
            /** @var \Illuminate\Log\LogManager $instance */
            $instance->alert($message, $context);
        }

        /**
         * Critical conditions.
         *
         * Example: Application component unavailable, unexpected exception.
         *
         * @param string|\Stringable $message
         * @param array $context
         * @return void
         * @static
         */
        public static function critical($message, $context = [])
        {
            /** @var \Illuminate\Log\LogManager $instance */
            $instance->critical($message, $context);
        }

        /**
         * Runtime errors that do not require immediate action but should typically
         * be logged and monitored.
         *
         * @param string|\Stringable $message
         * @param array $context
         * @return void
         * @static
         */
        public static function error($message, $context = [])
        {
            /** @var \Illuminate\Log\LogManager $instance */
            $instance->error($message, $context);
        }

        /**
         * Exceptional occurrences that are not errors.
         *
         * Example: Use of deprecated APIs, poor use of an API, undesirable things
         * that are not necessarily wrong.
         *
         * @param string|\Stringable $message
         * @param array $context
         * @return void
         * @static
         */
        public static function warning($message, $context = [])
        {
            /** @var \Illuminate\Log\LogManager $instance */
            $instance->warning($message, $context);
        }

        /**
         * Normal but significant events.
         *
         * @param string|\Stringable $message
         * @param array $context
         * @return void
         * @static
         */
        public static function notice($message, $context = [])
        {
            /** @var \Illuminate\Log\LogManager $instance */
            $instance->notice($message, $context);
        }

        /**
         * Interesting events.
         *
         * Example: User logs in, SQL logs.
         *
         * @param string|\Stringable $message
         * @param array $context
         * @return void
         * @static
         */
        public static function info($message, $context = [])
        {
            /** @var \Illuminate\Log\LogManager $instance */
            $instance->info($message, $context);
        }

        /**
         * Detailed debug information.
         *
         * @param string|\Stringable $message
         * @param array $context
         * @return void
         * @static
         */
        public static function debug($message, $context = [])
        {
            /** @var \Illuminate\Log\LogManager $instance */
            $instance->debug($message, $context);
        }

        /**
         * Logs with an arbitrary level.
         *
         * @param mixed $level
         * @param string|\Stringable $message
         * @param array $context
         * @return void
         * @static
         */
        public static function log($level, $message, $context = [])
        {
            /** @var \Illuminate\Log\LogManager $instance */
            $instance->log($level, $message, $context);
        }

        /**
         * Set the application instance used by the manager.
         *
         * @param \Illuminate\Contracts\Foundation\Application $app
         * @return \Illuminate\Log\LogManager
         * @static
         */
        public static function setApplication($app)
        {
            /** @var \Illuminate\Log\LogManager $instance */
            return $instance->setApplication($app);
        }

            }
    /**
     *
     *
     * @method static void alwaysFrom(string $address, string|null $name = null)
     * @method static void alwaysReplyTo(string $address, string|null $name = null)
     * @method static void alwaysReturnPath(string $address)
     * @method static void alwaysTo(string $address, string|null $name = null)
     * @method static \Illuminate\Mail\SentMessage|null html(string $html, mixed $callback)
     * @method static \Illuminate\Mail\SentMessage|null plain(string $view, array $data, mixed $callback)
     * @method static string render(string|array $view, array $data = [])
     * @method static mixed onQueue(\BackedEnum|string|null $queue, \Illuminate\Contracts\Mail\Mailable $view)
     * @method static mixed queueOn(string $queue, \Illuminate\Contracts\Mail\Mailable $view)
     * @method static mixed laterOn(string $queue, \DateTimeInterface|\DateInterval|int $delay, \Illuminate\Contracts\Mail\Mailable $view)
     * @method static \Symfony\Component\Mailer\Transport\TransportInterface getSymfonyTransport()
     * @method static \Illuminate\Contracts\View\Factory getViewFactory()
     * @method static void setSymfonyTransport(\Symfony\Component\Mailer\Transport\TransportInterface $transport)
     * @method static \Illuminate\Mail\Mailer setQueue(\Illuminate\Contracts\Queue\Factory $queue)
     * @method static void macro(string $name, object|callable $macro)
     * @method static void mixin(object $mixin, bool $replace = true)
     * @method static bool hasMacro(string $name)
     * @method static void flushMacros()
     * @see \Illuminate\Mail\MailManager
     * @see \Illuminate\Support\Testing\Fakes\MailFake
     */
    class Mail {
        /**
         * Get a mailer instance by name.
         *
         * @param string|null $name
         * @return \Illuminate\Contracts\Mail\Mailer
         * @static
         */
        public static function mailer($name = null)
        {
            /** @var \Illuminate\Mail\MailManager $instance */
            return $instance->mailer($name);
        }

        /**
         * Get a mailer driver instance.
         *
         * @param string|null $driver
         * @return \Illuminate\Mail\Mailer
         * @static
         */
        public static function driver($driver = null)
        {
            /** @var \Illuminate\Mail\MailManager $instance */
            return $instance->driver($driver);
        }

        /**
         * Build a new mailer instance.
         *
         * @param array $config
         * @return \Illuminate\Mail\Mailer
         * @static
         */
        public static function build($config)
        {
            /** @var \Illuminate\Mail\MailManager $instance */
            return $instance->build($config);
        }

        /**
         * Create a new transport instance.
         *
         * @param array $config
         * @return \Symfony\Component\Mailer\Transport\TransportInterface
         * @throws \InvalidArgumentException
         * @static
         */
        public static function createSymfonyTransport($config)
        {
            /** @var \Illuminate\Mail\MailManager $instance */
            return $instance->createSymfonyTransport($config);
        }

        /**
         * Get the default mail driver name.
         *
         * @return string
         * @static
         */
        public static function getDefaultDriver()
        {
            /** @var \Illuminate\Mail\MailManager $instance */
            return $instance->getDefaultDriver();
        }

        /**
         * Set the default mail driver name.
         *
         * @param string $name
         * @return void
         * @static
         */
        public static function setDefaultDriver($name)
        {
            /** @var \Illuminate\Mail\MailManager $instance */
            $instance->setDefaultDriver($name);
        }

        /**
         * Disconnect the given mailer and remove from local cache.
         *
         * @param string|null $name
         * @return void
         * @static
         */
        public static function purge($name = null)
        {
            /** @var \Illuminate\Mail\MailManager $instance */
            $instance->purge($name);
        }

        /**
         * Register a custom transport creator Closure.
         *
         * @param string $driver
         * @param \Closure $callback
         * @return \Illuminate\Mail\MailManager
         * @static
         */
        public static function extend($driver, $callback)
        {
            /** @var \Illuminate\Mail\MailManager $instance */
            return $instance->extend($driver, $callback);
        }

        /**
         * Get the application instance used by the manager.
         *
         * @return \Illuminate\Contracts\Foundation\Application
         * @static
         */
        public static function getApplication()
        {
            /** @var \Illuminate\Mail\MailManager $instance */
            return $instance->getApplication();
        }

        /**
         * Set the application instance used by the manager.
         *
         * @param \Illuminate\Contracts\Foundation\Application $app
         * @return \Illuminate\Mail\MailManager
         * @static
         */
        public static function setApplication($app)
        {
            /** @var \Illuminate\Mail\MailManager $instance */
            return $instance->setApplication($app);
        }

        /**
         * Forget all of the resolved mailer instances.
         *
         * @return \Illuminate\Mail\MailManager
         * @static
         */
        public static function forgetMailers()
        {
            /** @var \Illuminate\Mail\MailManager $instance */
            return $instance->forgetMailers();
        }

        /**
         * Assert if a mailable was sent based on a truth-test callback.
         *
         * @param string|\Closure $mailable
         * @param callable|array|string|int|null $callback
         * @return void
         * @static
         */
        public static function assertSent($mailable, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            $instance->assertSent($mailable, $callback);
        }

        /**
         * Determine if a mailable was not sent or queued to be sent based on a truth-test callback.
         *
         * @param string|\Closure $mailable
         * @param callable|null $callback
         * @return void
         * @static
         */
        public static function assertNotOutgoing($mailable, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            $instance->assertNotOutgoing($mailable, $callback);
        }

        /**
         * Determine if a mailable was not sent based on a truth-test callback.
         *
         * @param string|\Closure $mailable
         * @param callable|array|string|null $callback
         * @return void
         * @static
         */
        public static function assertNotSent($mailable, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            $instance->assertNotSent($mailable, $callback);
        }

        /**
         * Assert that no mailables were sent or queued to be sent.
         *
         * @return void
         * @static
         */
        public static function assertNothingOutgoing()
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            $instance->assertNothingOutgoing();
        }

        /**
         * Assert that no mailables were sent.
         *
         * @return void
         * @static
         */
        public static function assertNothingSent()
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            $instance->assertNothingSent();
        }

        /**
         * Assert if a mailable was queued based on a truth-test callback.
         *
         * @param string|\Closure $mailable
         * @param callable|array|string|int|null $callback
         * @return void
         * @static
         */
        public static function assertQueued($mailable, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            $instance->assertQueued($mailable, $callback);
        }

        /**
         * Determine if a mailable was not queued based on a truth-test callback.
         *
         * @param string|\Closure $mailable
         * @param callable|array|string|null $callback
         * @return void
         * @static
         */
        public static function assertNotQueued($mailable, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            $instance->assertNotQueued($mailable, $callback);
        }

        /**
         * Assert that no mailables were queued.
         *
         * @return void
         * @static
         */
        public static function assertNothingQueued()
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            $instance->assertNothingQueued();
        }

        /**
         * Assert the total number of mailables that were sent.
         *
         * @param int $count
         * @return void
         * @static
         */
        public static function assertSentCount($count)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            $instance->assertSentCount($count);
        }

        /**
         * Assert the total number of mailables that were queued.
         *
         * @param int $count
         * @return void
         * @static
         */
        public static function assertQueuedCount($count)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            $instance->assertQueuedCount($count);
        }

        /**
         * Assert the total number of mailables that were sent or queued.
         *
         * @param int $count
         * @return void
         * @static
         */
        public static function assertOutgoingCount($count)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            $instance->assertOutgoingCount($count);
        }

        /**
         * Get all of the mailables matching a truth-test callback.
         *
         * @param string|\Closure $mailable
         * @param callable|null $callback
         * @return \Illuminate\Support\Collection
         * @static
         */
        public static function sent($mailable, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            return $instance->sent($mailable, $callback);
        }

        /**
         * Determine if the given mailable has been sent.
         *
         * @param string $mailable
         * @return bool
         * @static
         */
        public static function hasSent($mailable)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            return $instance->hasSent($mailable);
        }

        /**
         * Get all of the queued mailables matching a truth-test callback.
         *
         * @param string|\Closure $mailable
         * @param callable|null $callback
         * @return \Illuminate\Support\Collection
         * @static
         */
        public static function queued($mailable, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            return $instance->queued($mailable, $callback);
        }

        /**
         * Determine if the given mailable has been queued.
         *
         * @param string $mailable
         * @return bool
         * @static
         */
        public static function hasQueued($mailable)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            return $instance->hasQueued($mailable);
        }

        /**
         * Begin the process of mailing a mailable class instance.
         *
         * @param mixed $users
         * @return \Illuminate\Mail\PendingMail
         * @static
         */
        public static function to($users)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            return $instance->to($users);
        }

        /**
         * Begin the process of mailing a mailable class instance.
         *
         * @param mixed $users
         * @return \Illuminate\Mail\PendingMail
         * @static
         */
        public static function cc($users)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            return $instance->cc($users);
        }

        /**
         * Begin the process of mailing a mailable class instance.
         *
         * @param mixed $users
         * @return \Illuminate\Mail\PendingMail
         * @static
         */
        public static function bcc($users)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            return $instance->bcc($users);
        }

        /**
         * Send a new message with only a raw text part.
         *
         * @param string $text
         * @param \Closure|string $callback
         * @return void
         * @static
         */
        public static function raw($text, $callback)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            $instance->raw($text, $callback);
        }

        /**
         * Send a new message using a view.
         *
         * @param \Illuminate\Contracts\Mail\Mailable|string|array $view
         * @param array $data
         * @param \Closure|string|null $callback
         * @return mixed|void
         * @static
         */
        public static function send($view, $data = [], $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            return $instance->send($view, $data, $callback);
        }

        /**
         * Send a new message synchronously using a view.
         *
         * @param \Illuminate\Contracts\Mail\Mailable|string|array $mailable
         * @param array $data
         * @param \Closure|string|null $callback
         * @return void
         * @static
         */
        public static function sendNow($mailable, $data = [], $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            $instance->sendNow($mailable, $data, $callback);
        }

        /**
         * Queue a new message for sending.
         *
         * @param \Illuminate\Contracts\Mail\Mailable|string|array $view
         * @param string|null $queue
         * @return mixed
         * @static
         */
        public static function queue($view, $queue = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            return $instance->queue($view, $queue);
        }

        /**
         * Queue a new e-mail message for sending after (n) seconds.
         *
         * @param \DateTimeInterface|\DateInterval|int $delay
         * @param \Illuminate\Contracts\Mail\Mailable|string|array $view
         * @param string|null $queue
         * @return mixed
         * @static
         */
        public static function later($delay, $view, $queue = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\MailFake $instance */
            return $instance->later($delay, $view, $queue);
        }

            }
    /**
     *
     *
     * @see \Illuminate\Notifications\ChannelManager
     * @see \Illuminate\Support\Testing\Fakes\NotificationFake
     */
    class Notification {
        /**
         * Send the given notification to the given notifiable entities.
         *
         * @param \Illuminate\Support\Collection|array|mixed $notifiables
         * @param mixed $notification
         * @return void
         * @static
         */
        public static function send($notifiables, $notification)
        {
            /** @var \Illuminate\Notifications\ChannelManager $instance */
            $instance->send($notifiables, $notification);
        }

        /**
         * Send the given notification immediately.
         *
         * @param \Illuminate\Support\Collection|array|mixed $notifiables
         * @param mixed $notification
         * @param array|null $channels
         * @return void
         * @static
         */
        public static function sendNow($notifiables, $notification, $channels = null)
        {
            /** @var \Illuminate\Notifications\ChannelManager $instance */
            $instance->sendNow($notifiables, $notification, $channels);
        }

        /**
         * Get a channel instance.
         *
         * @param string|null $name
         * @return mixed
         * @static
         */
        public static function channel($name = null)
        {
            /** @var \Illuminate\Notifications\ChannelManager $instance */
            return $instance->channel($name);
        }

        /**
         * Get the default channel driver name.
         *
         * @return string
         * @static
         */
        public static function getDefaultDriver()
        {
            /** @var \Illuminate\Notifications\ChannelManager $instance */
            return $instance->getDefaultDriver();
        }

        /**
         * Get the default channel driver name.
         *
         * @return string
         * @static
         */
        public static function deliversVia()
        {
            /** @var \Illuminate\Notifications\ChannelManager $instance */
            return $instance->deliversVia();
        }

        /**
         * Set the default channel driver name.
         *
         * @param string $channel
         * @return void
         * @static
         */
        public static function deliverVia($channel)
        {
            /** @var \Illuminate\Notifications\ChannelManager $instance */
            $instance->deliverVia($channel);
        }

        /**
         * Set the locale of notifications.
         *
         * @param string $locale
         * @return \Illuminate\Notifications\ChannelManager
         * @static
         */
        public static function locale($locale)
        {
            /** @var \Illuminate\Notifications\ChannelManager $instance */
            return $instance->locale($locale);
        }

        /**
         * Get a driver instance.
         *
         * @param string|null $driver
         * @return mixed
         * @throws \InvalidArgumentException
         * @static
         */
        public static function driver($driver = null)
        {
            //Method inherited from \Illuminate\Support\Manager
            /** @var \Illuminate\Notifications\ChannelManager $instance */
            return $instance->driver($driver);
        }

        /**
         * Register a custom driver creator Closure.
         *
         * @param string $driver
         * @param \Closure $callback
         * @return \Illuminate\Notifications\ChannelManager
         * @static
         */
        public static function extend($driver, $callback)
        {
            //Method inherited from \Illuminate\Support\Manager
            /** @var \Illuminate\Notifications\ChannelManager $instance */
            return $instance->extend($driver, $callback);
        }

        /**
         * Get all of the created "drivers".
         *
         * @return array
         * @static
         */
        public static function getDrivers()
        {
            //Method inherited from \Illuminate\Support\Manager
            /** @var \Illuminate\Notifications\ChannelManager $instance */
            return $instance->getDrivers();
        }

        /**
         * Get the container instance used by the manager.
         *
         * @return \Illuminate\Contracts\Container\Container
         * @static
         */
        public static function getContainer()
        {
            //Method inherited from \Illuminate\Support\Manager
            /** @var \Illuminate\Notifications\ChannelManager $instance */
            return $instance->getContainer();
        }

        /**
         * Set the container instance used by the manager.
         *
         * @param \Illuminate\Contracts\Container\Container $container
         * @return \Illuminate\Notifications\ChannelManager
         * @static
         */
        public static function setContainer($container)
        {
            //Method inherited from \Illuminate\Support\Manager
            /** @var \Illuminate\Notifications\ChannelManager $instance */
            return $instance->setContainer($container);
        }

        /**
         * Forget all of the resolved driver instances.
         *
         * @return \Illuminate\Notifications\ChannelManager
         * @static
         */
        public static function forgetDrivers()
        {
            //Method inherited from \Illuminate\Support\Manager
            /** @var \Illuminate\Notifications\ChannelManager $instance */
            return $instance->forgetDrivers();
        }

        /**
         * Assert if a notification was sent on-demand based on a truth-test callback.
         *
         * @param string|\Closure $notification
         * @param callable|null $callback
         * @return void
         * @throws \Exception
         * @static
         */
        public static function assertSentOnDemand($notification, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\NotificationFake $instance */
            $instance->assertSentOnDemand($notification, $callback);
        }

        /**
         * Assert if a notification was sent based on a truth-test callback.
         *
         * @param mixed $notifiable
         * @param string|\Closure $notification
         * @param callable|null $callback
         * @return void
         * @throws \Exception
         * @static
         */
        public static function assertSentTo($notifiable, $notification, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\NotificationFake $instance */
            $instance->assertSentTo($notifiable, $notification, $callback);
        }

        /**
         * Assert if a notification was sent on-demand a number of times.
         *
         * @param string $notification
         * @param int $times
         * @return void
         * @static
         */
        public static function assertSentOnDemandTimes($notification, $times = 1)
        {
            /** @var \Illuminate\Support\Testing\Fakes\NotificationFake $instance */
            $instance->assertSentOnDemandTimes($notification, $times);
        }

        /**
         * Assert if a notification was sent a number of times.
         *
         * @param mixed $notifiable
         * @param string $notification
         * @param int $times
         * @return void
         * @static
         */
        public static function assertSentToTimes($notifiable, $notification, $times = 1)
        {
            /** @var \Illuminate\Support\Testing\Fakes\NotificationFake $instance */
            $instance->assertSentToTimes($notifiable, $notification, $times);
        }

        /**
         * Determine if a notification was sent based on a truth-test callback.
         *
         * @param mixed $notifiable
         * @param string|\Closure $notification
         * @param callable|null $callback
         * @return void
         * @throws \Exception
         * @static
         */
        public static function assertNotSentTo($notifiable, $notification, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\NotificationFake $instance */
            $instance->assertNotSentTo($notifiable, $notification, $callback);
        }

        /**
         * Assert that no notifications were sent.
         *
         * @return void
         * @static
         */
        public static function assertNothingSent()
        {
            /** @var \Illuminate\Support\Testing\Fakes\NotificationFake $instance */
            $instance->assertNothingSent();
        }

        /**
         * Assert that no notifications were sent to the given notifiable.
         *
         * @param mixed $notifiable
         * @return void
         * @throws \Exception
         * @static
         */
        public static function assertNothingSentTo($notifiable)
        {
            /** @var \Illuminate\Support\Testing\Fakes\NotificationFake $instance */
            $instance->assertNothingSentTo($notifiable);
        }

        /**
         * Assert the total amount of times a notification was sent.
         *
         * @param string $notification
         * @param int $expectedCount
         * @return void
         * @static
         */
        public static function assertSentTimes($notification, $expectedCount)
        {
            /** @var \Illuminate\Support\Testing\Fakes\NotificationFake $instance */
            $instance->assertSentTimes($notification, $expectedCount);
        }

        /**
         * Assert the total count of notification that were sent.
         *
         * @param int $expectedCount
         * @return void
         * @static
         */
        public static function assertCount($expectedCount)
        {
            /** @var \Illuminate\Support\Testing\Fakes\NotificationFake $instance */
            $instance->assertCount($expectedCount);
        }

        /**
         * Get all of the notifications matching a truth-test callback.
         *
         * @param mixed $notifiable
         * @param string $notification
         * @param callable|null $callback
         * @return \Illuminate\Support\Collection
         * @static
         */
        public static function sent($notifiable, $notification, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\NotificationFake $instance */
            return $instance->sent($notifiable, $notification, $callback);
        }

        /**
         * Determine if there are more notifications left to inspect.
         *
         * @param mixed $notifiable
         * @param string $notification
         * @return bool
         * @static
         */
        public static function hasSent($notifiable, $notification)
        {
            /** @var \Illuminate\Support\Testing\Fakes\NotificationFake $instance */
            return $instance->hasSent($notifiable, $notification);
        }

        /**
         * Specify if notification should be serialized and restored when being "pushed" to the queue.
         *
         * @param bool $serializeAndRestore
         * @return \Illuminate\Support\Testing\Fakes\NotificationFake
         * @static
         */
        public static function serializeAndRestore($serializeAndRestore = true)
        {
            /** @var \Illuminate\Support\Testing\Fakes\NotificationFake $instance */
            return $instance->serializeAndRestore($serializeAndRestore);
        }

        /**
         * Get the notifications that have been sent.
         *
         * @return array
         * @static
         */
        public static function sentNotifications()
        {
            /** @var \Illuminate\Support\Testing\Fakes\NotificationFake $instance */
            return $instance->sentNotifications();
        }

        /**
         * Register a custom macro.
         *
         * @param string $name
         * @param object|callable $macro
         * @param-closure-this static  $macro
         * @return void
         * @static
         */
        public static function macro($name, $macro)
        {
            \Illuminate\Support\Testing\Fakes\NotificationFake::macro($name, $macro);
        }

        /**
         * Mix another object into the class.
         *
         * @param object $mixin
         * @param bool $replace
         * @return void
         * @throws \ReflectionException
         * @static
         */
        public static function mixin($mixin, $replace = true)
        {
            \Illuminate\Support\Testing\Fakes\NotificationFake::mixin($mixin, $replace);
        }

        /**
         * Checks if macro is registered.
         *
         * @param string $name
         * @return bool
         * @static
         */
        public static function hasMacro($name)
        {
            return \Illuminate\Support\Testing\Fakes\NotificationFake::hasMacro($name);
        }

        /**
         * Flush the existing macros.
         *
         * @return void
         * @static
         */
        public static function flushMacros()
        {
            \Illuminate\Support\Testing\Fakes\NotificationFake::flushMacros();
        }

            }
    /**
     *
     *
     * @method static string sendResetLink(array $credentials, \Closure|null $callback = null)
     * @method static mixed reset(array $credentials, \Closure $callback)
     * @method static \Illuminate\Contracts\Auth\CanResetPassword|null getUser(array $credentials)
     * @method static string createToken(\Illuminate\Contracts\Auth\CanResetPassword $user)
     * @method static void deleteToken(\Illuminate\Contracts\Auth\CanResetPassword $user)
     * @method static bool tokenExists(\Illuminate\Contracts\Auth\CanResetPassword $user, string $token)
     * @method static \Illuminate\Auth\Passwords\TokenRepositoryInterface getRepository()
     * @see \Illuminate\Auth\Passwords\PasswordBrokerManager
     * @see \Illuminate\Auth\Passwords\PasswordBroker
     */
    class Password {
        /**
         * Attempt to get the broker from the local cache.
         *
         * @param string|null $name
         * @return \Illuminate\Contracts\Auth\PasswordBroker
         * @static
         */
        public static function broker($name = null)
        {
            /** @var \Illuminate\Auth\Passwords\PasswordBrokerManager $instance */
            return $instance->broker($name);
        }

        /**
         * Get the default password broker name.
         *
         * @return string
         * @static
         */
        public static function getDefaultDriver()
        {
            /** @var \Illuminate\Auth\Passwords\PasswordBrokerManager $instance */
            return $instance->getDefaultDriver();
        }

        /**
         * Set the default password broker name.
         *
         * @param string $name
         * @return void
         * @static
         */
        public static function setDefaultDriver($name)
        {
            /** @var \Illuminate\Auth\Passwords\PasswordBrokerManager $instance */
            $instance->setDefaultDriver($name);
        }

            }
    /**
     *
     *
     * @see \Illuminate\Queue\QueueManager
     * @see \Illuminate\Queue\Queue
     * @see \Illuminate\Support\Testing\Fakes\QueueFake
     */
    class Queue {
        /**
         * Register an event listener for the before job event.
         *
         * @param mixed $callback
         * @return void
         * @static
         */
        public static function before($callback)
        {
            /** @var \Illuminate\Queue\QueueManager $instance */
            $instance->before($callback);
        }

        /**
         * Register an event listener for the after job event.
         *
         * @param mixed $callback
         * @return void
         * @static
         */
        public static function after($callback)
        {
            /** @var \Illuminate\Queue\QueueManager $instance */
            $instance->after($callback);
        }

        /**
         * Register an event listener for the exception occurred job event.
         *
         * @param mixed $callback
         * @return void
         * @static
         */
        public static function exceptionOccurred($callback)
        {
            /** @var \Illuminate\Queue\QueueManager $instance */
            $instance->exceptionOccurred($callback);
        }

        /**
         * Register an event listener for the daemon queue loop.
         *
         * @param mixed $callback
         * @return void
         * @static
         */
        public static function looping($callback)
        {
            /** @var \Illuminate\Queue\QueueManager $instance */
            $instance->looping($callback);
        }

        /**
         * Register an event listener for the failed job event.
         *
         * @param mixed $callback
         * @return void
         * @static
         */
        public static function failing($callback)
        {
            /** @var \Illuminate\Queue\QueueManager $instance */
            $instance->failing($callback);
        }

        /**
         * Register an event listener for the daemon queue stopping.
         *
         * @param mixed $callback
         * @return void
         * @static
         */
        public static function stopping($callback)
        {
            /** @var \Illuminate\Queue\QueueManager $instance */
            $instance->stopping($callback);
        }

        /**
         * Determine if the driver is connected.
         *
         * @param string|null $name
         * @return bool
         * @static
         */
        public static function connected($name = null)
        {
            /** @var \Illuminate\Queue\QueueManager $instance */
            return $instance->connected($name);
        }

        /**
         * Resolve a queue connection instance.
         *
         * @param string|null $name
         * @return \Illuminate\Contracts\Queue\Queue
         * @static
         */
        public static function connection($name = null)
        {
            /** @var \Illuminate\Queue\QueueManager $instance */
            return $instance->connection($name);
        }

        /**
         * Add a queue connection resolver.
         *
         * @param string $driver
         * @param \Closure $resolver
         * @return void
         * @static
         */
        public static function extend($driver, $resolver)
        {
            /** @var \Illuminate\Queue\QueueManager $instance */
            $instance->extend($driver, $resolver);
        }

        /**
         * Add a queue connection resolver.
         *
         * @param string $driver
         * @param \Closure $resolver
         * @return void
         * @static
         */
        public static function addConnector($driver, $resolver)
        {
            /** @var \Illuminate\Queue\QueueManager $instance */
            $instance->addConnector($driver, $resolver);
        }

        /**
         * Get the name of the default queue connection.
         *
         * @return string
         * @static
         */
        public static function getDefaultDriver()
        {
            /** @var \Illuminate\Queue\QueueManager $instance */
            return $instance->getDefaultDriver();
        }

        /**
         * Set the name of the default queue connection.
         *
         * @param string $name
         * @return void
         * @static
         */
        public static function setDefaultDriver($name)
        {
            /** @var \Illuminate\Queue\QueueManager $instance */
            $instance->setDefaultDriver($name);
        }

        /**
         * Get the full name for the given connection.
         *
         * @param string|null $connection
         * @return string
         * @static
         */
        public static function getName($connection = null)
        {
            /** @var \Illuminate\Queue\QueueManager $instance */
            return $instance->getName($connection);
        }

        /**
         * Get the application instance used by the manager.
         *
         * @return \Illuminate\Contracts\Foundation\Application
         * @static
         */
        public static function getApplication()
        {
            /** @var \Illuminate\Queue\QueueManager $instance */
            return $instance->getApplication();
        }

        /**
         * Set the application instance used by the manager.
         *
         * @param \Illuminate\Contracts\Foundation\Application $app
         * @return \Illuminate\Queue\QueueManager
         * @static
         */
        public static function setApplication($app)
        {
            /** @var \Illuminate\Queue\QueueManager $instance */
            return $instance->setApplication($app);
        }

        /**
         * Specify the jobs that should be queued instead of faked.
         *
         * @param array|string $jobsToBeQueued
         * @return \Illuminate\Support\Testing\Fakes\QueueFake
         * @static
         */
        public static function except($jobsToBeQueued)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            return $instance->except($jobsToBeQueued);
        }

        /**
         * Assert if a job was pushed based on a truth-test callback.
         *
         * @param string|\Closure $job
         * @param callable|int|null $callback
         * @return void
         * @static
         */
        public static function assertPushed($job, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            $instance->assertPushed($job, $callback);
        }

        /**
         * Assert if a job was pushed based on a truth-test callback.
         *
         * @param string $queue
         * @param string|\Closure $job
         * @param callable|null $callback
         * @return void
         * @static
         */
        public static function assertPushedOn($queue, $job, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            $instance->assertPushedOn($queue, $job, $callback);
        }

        /**
         * Assert if a job was pushed with chained jobs based on a truth-test callback.
         *
         * @param string $job
         * @param array $expectedChain
         * @param callable|null $callback
         * @return void
         * @static
         */
        public static function assertPushedWithChain($job, $expectedChain = [], $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            $instance->assertPushedWithChain($job, $expectedChain, $callback);
        }

        /**
         * Assert if a job was pushed with an empty chain based on a truth-test callback.
         *
         * @param string $job
         * @param callable|null $callback
         * @return void
         * @static
         */
        public static function assertPushedWithoutChain($job, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            $instance->assertPushedWithoutChain($job, $callback);
        }

        /**
         * Assert if a closure was pushed based on a truth-test callback.
         *
         * @param callable|int|null $callback
         * @return void
         * @static
         */
        public static function assertClosurePushed($callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            $instance->assertClosurePushed($callback);
        }

        /**
         * Assert that a closure was not pushed based on a truth-test callback.
         *
         * @param callable|null $callback
         * @return void
         * @static
         */
        public static function assertClosureNotPushed($callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            $instance->assertClosureNotPushed($callback);
        }

        /**
         * Determine if a job was pushed based on a truth-test callback.
         *
         * @param string|\Closure $job
         * @param callable|null $callback
         * @return void
         * @static
         */
        public static function assertNotPushed($job, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            $instance->assertNotPushed($job, $callback);
        }

        /**
         * Assert the total count of jobs that were pushed.
         *
         * @param int $expectedCount
         * @return void
         * @static
         */
        public static function assertCount($expectedCount)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            $instance->assertCount($expectedCount);
        }

        /**
         * Assert that no jobs were pushed.
         *
         * @return void
         * @static
         */
        public static function assertNothingPushed()
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            $instance->assertNothingPushed();
        }

        /**
         * Get all of the jobs matching a truth-test callback.
         *
         * @param string $job
         * @param callable|null $callback
         * @return \Illuminate\Support\Collection
         * @static
         */
        public static function pushed($job, $callback = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            return $instance->pushed($job, $callback);
        }

        /**
         * Determine if there are any stored jobs for a given class.
         *
         * @param string $job
         * @return bool
         * @static
         */
        public static function hasPushed($job)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            return $instance->hasPushed($job);
        }

        /**
         * Get the size of the queue.
         *
         * @param string|null $queue
         * @return int
         * @static
         */
        public static function size($queue = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            return $instance->size($queue);
        }

        /**
         * Push a new job onto the queue.
         *
         * @param string|object $job
         * @param mixed $data
         * @param string|null $queue
         * @return mixed
         * @static
         */
        public static function push($job, $data = '', $queue = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            return $instance->push($job, $data, $queue);
        }

        /**
         * Determine if a job should be faked or actually dispatched.
         *
         * @param object $job
         * @return bool
         * @static
         */
        public static function shouldFakeJob($job)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            return $instance->shouldFakeJob($job);
        }

        /**
         * Push a raw payload onto the queue.
         *
         * @param string $payload
         * @param string|null $queue
         * @param array $options
         * @return mixed
         * @static
         */
        public static function pushRaw($payload, $queue = null, $options = [])
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            return $instance->pushRaw($payload, $queue, $options);
        }

        /**
         * Push a new job onto the queue after (n) seconds.
         *
         * @param \DateTimeInterface|\DateInterval|int $delay
         * @param string|object $job
         * @param mixed $data
         * @param string|null $queue
         * @return mixed
         * @static
         */
        public static function later($delay, $job, $data = '', $queue = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            return $instance->later($delay, $job, $data, $queue);
        }

        /**
         * Push a new job onto the queue.
         *
         * @param string $queue
         * @param string|object $job
         * @param mixed $data
         * @return mixed
         * @static
         */
        public static function pushOn($queue, $job, $data = '')
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            return $instance->pushOn($queue, $job, $data);
        }

        /**
         * Push a new job onto a specific queue after (n) seconds.
         *
         * @param string $queue
         * @param \DateTimeInterface|\DateInterval|int $delay
         * @param string|object $job
         * @param mixed $data
         * @return mixed
         * @static
         */
        public static function laterOn($queue, $delay, $job, $data = '')
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            return $instance->laterOn($queue, $delay, $job, $data);
        }

        /**
         * Pop the next job off of the queue.
         *
         * @param string|null $queue
         * @return \Illuminate\Contracts\Queue\Job|null
         * @static
         */
        public static function pop($queue = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            return $instance->pop($queue);
        }

        /**
         * Push an array of jobs onto the queue.
         *
         * @param array $jobs
         * @param mixed $data
         * @param string|null $queue
         * @return mixed
         * @static
         */
        public static function bulk($jobs, $data = '', $queue = null)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            return $instance->bulk($jobs, $data, $queue);
        }

        /**
         * Get the jobs that have been pushed.
         *
         * @return array
         * @static
         */
        public static function pushedJobs()
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            return $instance->pushedJobs();
        }

        /**
         * Specify if jobs should be serialized and restored when being "pushed" to the queue.
         *
         * @param bool $serializeAndRestore
         * @return \Illuminate\Support\Testing\Fakes\QueueFake
         * @static
         */
        public static function serializeAndRestore($serializeAndRestore = true)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            return $instance->serializeAndRestore($serializeAndRestore);
        }

        /**
         * Get the connection name for the queue.
         *
         * @return string
         * @static
         */
        public static function getConnectionName()
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            return $instance->getConnectionName();
        }

        /**
         * Set the connection name for the queue.
         *
         * @param string $name
         * @return \Illuminate\Support\Testing\Fakes\QueueFake
         * @static
         */
        public static function setConnectionName($name)
        {
            /** @var \Illuminate\Support\Testing\Fakes\QueueFake $instance */
            return $instance->setConnectionName($name);
        }

        /**
         * Get the maximum number of attempts for an object-based queue handler.
         *
         * @param mixed $job
         * @return mixed
         * @static
         */
        public static function getJobTries($job)
        {
            //Method inherited from \Illuminate\Queue\Queue
            /** @var \Illuminate\Queue\SyncQueue $instance */
            return $instance->getJobTries($job);
        }

        /**
         * Get the backoff for an object-based queue handler.
         *
         * @param mixed $job
         * @return mixed
         * @static
         */
        public static function getJobBackoff($job)
        {
            //Method inherited from \Illuminate\Queue\Queue
            /** @var \Illuminate\Queue\SyncQueue $instance */
            return $instance->getJobBackoff($job);
        }

        /**
         * Get the expiration timestamp for an object-based queue handler.
         *
         * @param mixed $job
         * @return mixed
         * @static
         */
        public static function getJobExpiration($job)
        {
            //Method inherited from \Illuminate\Queue\Queue
            /** @var \Illuminate\Queue\SyncQueue $instance */
            return $instance->getJobExpiration($job);
        }

        /**
         * Register a callback to be executed when creating job payloads.
         *
         * @param callable|null $callback
         * @return void
         * @static
         */
        public static function createPayloadUsing($callback)
        {
            //Method inherited from \Illuminate\Queue\Queue
            \Illuminate\Queue\SyncQueue::createPayloadUsing($callback);
        }

        /**
         * Get the container instance being used by the connection.
         *
         * @return \Illuminate\Container\Container
         * @static
         */
        public static function getContainer()
        {
            //Method inherited from \Illuminate\Queue\Queue
            /** @var \Illuminate\Queue\SyncQueue $instance */
            return $instance->getContainer();
        }

        /**
         * Set the IoC container instance.
         *
         * @param \Illuminate\Container\Container $container
         * @return void
         * @static
         */
        public static function setContainer($container)
        {
            //Method inherited from \Illuminate\Queue\Queue
            /** @var \Illuminate\Queue\SyncQueue $instance */
            $instance->setContainer($container);
        }

            }
    /**
     *
     *
     * @see \Illuminate\Routing\Redirector
     */
    class Redirect {
        /**
         * Create a new redirect response to the previous location.
         *
         * @param int $status
         * @param array $headers
         * @param mixed $fallback
         * @return \Illuminate\Http\RedirectResponse
         * @static
         */
        public static function back($status = 302, $headers = [], $fallback = false)
        {
            /** @var \Illuminate\Routing\Redirector $instance */
            return $instance->back($status, $headers, $fallback);
        }

        /**
         * Create a new redirect response to the current URI.
         *
         * @param int $status
         * @param array $headers
         * @return \Illuminate\Http\RedirectResponse
         * @static
         */
        public static function refresh($status = 302, $headers = [])
        {
            /** @var \Illuminate\Routing\Redirector $instance */
            return $instance->refresh($status, $headers);
        }

        /**
         * Create a new redirect response, while putting the current URL in the session.
         *
         * @param string $path
         * @param int $status
         * @param array $headers
         * @param bool|null $secure
         * @return \Illuminate\Http\RedirectResponse
         * @static
         */
        public static function guest($path, $status = 302, $headers = [], $secure = null)
        {
            /** @var \Illuminate\Routing\Redirector $instance */
            return $instance->guest($path, $status, $headers, $secure);
        }

        /**
         * Create a new redirect response to the previously intended location.
         *
         * @param mixed $default
         * @param int $status
         * @param array $headers
         * @param bool|null $secure
         * @return \Illuminate\Http\RedirectResponse
         * @static
         */
        public static function intended($default = '/', $status = 302, $headers = [], $secure = null)
        {
            /** @var \Illuminate\Routing\Redirector $instance */
            return $instance->intended($default, $status, $headers, $secure);
        }

        /**
         * Create a new redirect response to the given path.
         *
         * @param string $path
         * @param int $status
         * @param array $headers
         * @param bool|null $secure
         * @return \Illuminate\Http\RedirectResponse
         * @static
         */
        public static function to($path, $status = 302, $headers = [], $secure = null)
        {
            /** @var \Illuminate\Routing\Redirector $instance */
            return $instance->to($path, $status, $headers, $secure);
        }

        /**
         * Create a new redirect response to an external URL (no validation).
         *
         * @param string $path
         * @param int $status
         * @param array $headers
         * @return \Illuminate\Http\RedirectResponse
         * @static
         */
        public static function away($path, $status = 302, $headers = [])
        {
            /** @var \Illuminate\Routing\Redirector $instance */
            return $instance->away($path, $status, $headers);
        }

        /**
         * Create a new redirect response to the given HTTPS path.
         *
         * @param string $path
         * @param int $status
         * @param array $headers
         * @return \Illuminate\Http\RedirectResponse
         * @static
         */
        public static function secure($path, $status = 302, $headers = [])
        {
            /** @var \Illuminate\Routing\Redirector $instance */
            return $instance->secure($path, $status, $headers);
        }

        /**
         * Create a new redirect response to a named route.
         *
         * @param \BackedEnum|string $route
         * @param mixed $parameters
         * @param int $status
         * @param array $headers
         * @return \Illuminate\Http\RedirectResponse
         * @static
         */
        public static function route($route, $parameters = [], $status = 302, $headers = [])
        {
            /** @var \Illuminate\Routing\Redirector $instance */
            return $instance->route($route, $parameters, $status, $headers);
        }

        /**
         * Create a new redirect response to a signed named route.
         *
         * @param \BackedEnum|string $route
         * @param mixed $parameters
         * @param \DateTimeInterface|\DateInterval|int|null $expiration
         * @param int $status
         * @param array $headers
         * @return \Illuminate\Http\RedirectResponse
         * @static
         */
        public static function signedRoute($route, $parameters = [], $expiration = null, $status = 302, $headers = [])
        {
            /** @var \Illuminate\Routing\Redirector $instance */
            return $instance->signedRoute($route, $parameters, $expiration, $status, $headers);
        }

        /**
         * Create a new redirect response to a signed named route.
         *
         * @param \BackedEnum|string $route
         * @param \DateTimeInterface|\DateInterval|int|null $expiration
         * @param mixed $parameters
         * @param int $status
         * @param array $headers
         * @return \Illuminate\Http\RedirectResponse
         * @static
         */
        public static function temporarySignedRoute($route, $expiration, $parameters = [], $status = 302, $headers = [])
        {
            /** @var \Illuminate\Routing\Redirector $instance */
            return $instance->temporarySignedRoute($route, $expiration, $parameters, $status, $headers);
        }

        /**
         * Create a new redirect response to a controller action.
         *
         * @param string|array $action
         * @param mixed $parameters
         * @param int $status
         * @param array $headers
         * @return \Illuminate\Http\RedirectResponse
         * @static
         */
        public static function action($action, $parameters = [], $status = 302, $headers = [])
        {
            /** @var \Illuminate\Routing\Redirector $instance */
            return $instance->action($action, $parameters, $status, $headers);
        }

        /**
         * Get the URL generator instance.
         *
         * @return \Illuminate\Routing\UrlGenerator
         * @static
         */
        public static function getUrlGenerator()
        {
            /** @var \Illuminate\Routing\Redirector $instance */
            return $instance->getUrlGenerator();
        }

        /**
         * Set the active session store.
         *
         * @param \Illuminate\Session\Store $session
         * @return void
         * @static
         */
        public static function setSession($session)
        {
            /** @var \Illuminate\Routing\Redirector $instance */
            $instance->setSession($session);
        }

        /**
         * Get the "intended" URL from the session.
         *
         * @return string|null
         * @static
         */
        public static function getIntendedUrl()
        {
            /** @var \Illuminate\Routing\Redirector $instance */
            return $instance->getIntendedUrl();
        }

        /**
         * Set the "intended" URL in the session.
         *
         * @param string $url
         * @return \Illuminate\Routing\Redirector
         * @static
         */
        public static function setIntendedUrl($url)
        {
            /** @var \Illuminate\Routing\Redirector $instance */
            return $instance->setIntendedUrl($url);
        }

        /**
         * Register a custom macro.
         *
         * @param string $name
         * @param object|callable $macro
         * @param-closure-this static  $macro
         * @return void
         * @static
         */
        public static function macro($name, $macro)
        {
            \Illuminate\Routing\Redirector::macro($name, $macro);
        }

        /**
         * Mix another object into the class.
         *
         * @param object $mixin
         * @param bool $replace
         * @return void
         * @throws \ReflectionException
         * @static
         */
        public static function mixin($mixin, $replace = true)
        {
            \Illuminate\Routing\Redirector::mixin($mixin, $replace);
        }

        /**
         * Checks if macro is registered.
         *
         * @param string $name
         * @return bool
         * @static
         */
        public static function hasMacro($name)
        {
            return \Illuminate\Routing\Redirector::hasMacro($name);
        }

        /**
         * Flush the existing macros.
         *
         * @return void
         * @static
         */
        public static function flushMacros()
        {
            \Illuminate\Routing\Redirector::flushMacros();
        }

            }
    /**
     *
     *
     * @method static void createSubscription(array|string $channels, \Closure $callback, string $method = 'subscribe')
     * @method static \Illuminate\Redis\Limiters\ConcurrencyLimiterBuilder funnel(string $name)
     * @method static \Illuminate\Redis\Limiters\DurationLimiterBuilder throttle(string $name)
     * @method static mixed client()
     * @method static void subscribe(array|string $channels, \Closure $callback)
     * @method static void psubscribe(array|string $channels, \Closure $callback)
     * @method static mixed command(string $method, array $parameters = [])
     * @method static void listen(\Closure $callback)
     * @method static string|null getName()
     * @method static \Illuminate\Redis\Connections\Connection setName(string $name)
     * @method static \Illuminate\Contracts\Events\Dispatcher getEventDispatcher()
     * @method static void setEventDispatcher(\Illuminate\Contracts\Events\Dispatcher $events)
     * @method static void unsetEventDispatcher()
     * @method static void macro(string $name, object|callable $macro)
     * @method static void mixin(object $mixin, bool $replace = true)
     * @method static bool hasMacro(string $name)
     * @method static void flushMacros()
     * @method static mixed macroCall(string $method, array $parameters)
     * @see \Illuminate\Redis\RedisManager
     */
    class Redis {
        /**
         * Get a Redis connection by name.
         *
         * @param string|null $name
         * @return \Illuminate\Redis\Connections\Connection
         * @static
         */
        public static function connection($name = null)
        {
            /** @var \Illuminate\Redis\RedisManager $instance */
            return $instance->connection($name);
        }

        /**
         * Resolve the given connection by name.
         *
         * @param string|null $name
         * @return \Illuminate\Redis\Connections\Connection
         * @throws \InvalidArgumentException
         * @static
         */
        public static function resolve($name = null)
        {
            /** @var \Illuminate\Redis\RedisManager $instance */
            return $instance->resolve($name);
        }

        /**
         * Return all of the created connections.
         *
         * @return array
         * @static
         */
        public static function connections()
        {
            /** @var \Illuminate\Redis\RedisManager $instance */
            return $instance->connections();
        }

        /**
         * Enable the firing of Redis command events.
         *
         * @return void
         * @static
         */
        public static function enableEvents()
        {
            /** @var \Illuminate\Redis\RedisManager $instance */
            $instance->enableEvents();
        }

        /**
         * Disable the firing of Redis command events.
         *
         * @return void
         * @static
         */
        public static function disableEvents()
        {
            /** @var \Illuminate\Redis\RedisManager $instance */
            $instance->disableEvents();
        }

        /**
         * Set the default driver.
         *
         * @param string $driver
         * @return void
         * @static
         */
        public static function setDriver($driver)
        {
            /** @var \Illuminate\Redis\RedisManager $instance */
            $instance->setDriver($driver);
        }

        /**
         * Disconnect the given connection and remove from local cache.
         *
         * @param string|null $name
         * @return void
         * @static
         */
        public static function purge($name = null)
        {
            /** @var \Illuminate\Redis\RedisManager $instance */
            $instance->purge($name);
        }

        /**
         * Register a custom driver creator Closure.
         *
         * @param string $driver
         * @param \Closure $callback
         * @return \Illuminate\Redis\RedisManager
         * @static
         */
        public static function extend($driver, $callback)
        {
            /** @var \Illuminate\Redis\RedisManager $instance */
            return $instance->extend($driver, $callback);
        }

            }
    /**
     *
     *
     * @method static array validate(array $rules, ...$params)
     * @method static array validateWithBag(string $errorBag, array $rules, ...$params)
     * @method static bool hasValidSignature(bool $absolute = true)
     * @see \Illuminate\Http\Request
     */
    class Request {
        /**
         * Create a new Illuminate HTTP request from server variables.
         *
         * @return static
         * @static
         */
        public static function capture()
        {
            return \Illuminate\Http\Request::capture();
        }

        /**
         * Return the Request instance.
         *
         * @return \Illuminate\Http\Request
         * @static
         */
        public static function instance()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->instance();
        }

        /**
         * Get the request method.
         *
         * @return string
         * @static
         */
        public static function method()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->method();
        }

        /**
         * Get a URI instance for the request.
         *
         * @return \Illuminate\Support\Uri
         * @static
         */
        public static function uri()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->uri();
        }

        /**
         * Get the root URL for the application.
         *
         * @return string
         * @static
         */
        public static function root()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->root();
        }

        /**
         * Get the URL (no query string) for the request.
         *
         * @return string
         * @static
         */
        public static function url()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->url();
        }

        /**
         * Get the full URL for the request.
         *
         * @return string
         * @static
         */
        public static function fullUrl()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->fullUrl();
        }

        /**
         * Get the full URL for the request with the added query string parameters.
         *
         * @param array $query
         * @return string
         * @static
         */
        public static function fullUrlWithQuery($query)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->fullUrlWithQuery($query);
        }

        /**
         * Get the full URL for the request without the given query string parameters.
         *
         * @param array|string $keys
         * @return string
         * @static
         */
        public static function fullUrlWithoutQuery($keys)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->fullUrlWithoutQuery($keys);
        }

        /**
         * Get the current path info for the request.
         *
         * @return string
         * @static
         */
        public static function path()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->path();
        }

        /**
         * Get the current decoded path info for the request.
         *
         * @return string
         * @static
         */
        public static function decodedPath()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->decodedPath();
        }

        /**
         * Get a segment from the URI (1 based index).
         *
         * @param int $index
         * @param string|null $default
         * @return string|null
         * @static
         */
        public static function segment($index, $default = null)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->segment($index, $default);
        }

        /**
         * Get all of the segments for the request path.
         *
         * @return array
         * @static
         */
        public static function segments()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->segments();
        }

        /**
         * Determine if the current request URI matches a pattern.
         *
         * @param mixed $patterns
         * @return bool
         * @static
         */
        public static function is(...$patterns)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->is(...$patterns);
        }

        /**
         * Determine if the route name matches a given pattern.
         *
         * @param mixed $patterns
         * @return bool
         * @static
         */
        public static function routeIs(...$patterns)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->routeIs(...$patterns);
        }

        /**
         * Determine if the current request URL and query string match a pattern.
         *
         * @param mixed $patterns
         * @return bool
         * @static
         */
        public static function fullUrlIs(...$patterns)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->fullUrlIs(...$patterns);
        }

        /**
         * Get the host name.
         *
         * @return string
         * @static
         */
        public static function host()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->host();
        }

        /**
         * Get the HTTP host being requested.
         *
         * @return string
         * @static
         */
        public static function httpHost()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->httpHost();
        }

        /**
         * Get the scheme and HTTP host.
         *
         * @return string
         * @static
         */
        public static function schemeAndHttpHost()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->schemeAndHttpHost();
        }

        /**
         * Determine if the request is the result of an AJAX call.
         *
         * @return bool
         * @static
         */
        public static function ajax()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->ajax();
        }

        /**
         * Determine if the request is the result of a PJAX call.
         *
         * @return bool
         * @static
         */
        public static function pjax()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->pjax();
        }

        /**
         * Determine if the request is the result of a prefetch call.
         *
         * @return bool
         * @static
         */
        public static function prefetch()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->prefetch();
        }

        /**
         * Determine if the request is over HTTPS.
         *
         * @return bool
         * @static
         */
        public static function secure()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->secure();
        }

        /**
         * Get the client IP address.
         *
         * @return string|null
         * @static
         */
        public static function ip()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->ip();
        }

        /**
         * Get the client IP addresses.
         *
         * @return array
         * @static
         */
        public static function ips()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->ips();
        }

        /**
         * Get the client user agent.
         *
         * @return string|null
         * @static
         */
        public static function userAgent()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->userAgent();
        }

        /**
         * Merge new input into the current request's input array.
         *
         * @param array $input
         * @return \Illuminate\Http\Request
         * @static
         */
        public static function merge($input)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->merge($input);
        }

        /**
         * Merge new input into the request's input, but only when that key is missing from the request.
         *
         * @param array $input
         * @return \Illuminate\Http\Request
         * @static
         */
        public static function mergeIfMissing($input)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->mergeIfMissing($input);
        }

        /**
         * Replace the input values for the current request.
         *
         * @param array $input
         * @return \Illuminate\Http\Request
         * @static
         */
        public static function replace($input)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->replace($input);
        }

        /**
         * This method belongs to Symfony HttpFoundation and is not usually needed when using Laravel.
         *
         * Instead, you may use the "input" method.
         *
         * @param string $key
         * @param mixed $default
         * @return mixed
         * @static
         */
        public static function get($key, $default = null)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->get($key, $default);
        }

        /**
         * Get the JSON payload for the request.
         *
         * @param string|null $key
         * @param mixed $default
         * @return \Symfony\Component\HttpFoundation\InputBag|mixed
         * @static
         */
        public static function json($key = null, $default = null)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->json($key, $default);
        }

        /**
         * Create a new request instance from the given Laravel request.
         *
         * @param \Illuminate\Http\Request $from
         * @param \Illuminate\Http\Request|null $to
         * @return static
         * @static
         */
        public static function createFrom($from, $to = null)
        {
            return \Illuminate\Http\Request::createFrom($from, $to);
        }

        /**
         * Create an Illuminate request from a Symfony instance.
         *
         * @param \Symfony\Component\HttpFoundation\Request $request
         * @return static
         * @static
         */
        public static function createFromBase($request)
        {
            return \Illuminate\Http\Request::createFromBase($request);
        }

        /**
         * Clones a request and overrides some of its parameters.
         *
         * @return static
         * @param array|null $query The GET parameters
         * @param array|null $request The POST parameters
         * @param array|null $attributes The request attributes (parameters parsed from the PATH_INFO, ...)
         * @param array|null $cookies The COOKIE parameters
         * @param array|null $files The FILES parameters
         * @param array|null $server The SERVER parameters
         * @static
         */
        public static function duplicate($query = null, $request = null, $attributes = null, $cookies = null, $files = null, $server = null)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->duplicate($query, $request, $attributes, $cookies, $files, $server);
        }

        /**
         * Whether the request contains a Session object.
         *
         * This method does not give any information about the state of the session object,
         * like whether the session is started or not. It is just a way to check if this Request
         * is associated with a Session instance.
         *
         * @param bool $skipIfUninitialized When true, ignores factories injected by `setSessionFactory`
         * @static
         */
        public static function hasSession($skipIfUninitialized = false)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->hasSession($skipIfUninitialized);
        }

        /**
         * Gets the Session.
         *
         * @throws SessionNotFoundException When session is not set properly
         * @static
         */
        public static function getSession()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getSession();
        }

        /**
         * Get the session associated with the request.
         *
         * @return \Illuminate\Contracts\Session\Session
         * @throws \RuntimeException
         * @static
         */
        public static function session()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->session();
        }

        /**
         * Set the session instance on the request.
         *
         * @param \Illuminate\Contracts\Session\Session $session
         * @return void
         * @static
         */
        public static function setLaravelSession($session)
        {
            /** @var \Illuminate\Http\Request $instance */
            $instance->setLaravelSession($session);
        }

        /**
         * Set the locale for the request instance.
         *
         * @param string $locale
         * @return void
         * @static
         */
        public static function setRequestLocale($locale)
        {
            /** @var \Illuminate\Http\Request $instance */
            $instance->setRequestLocale($locale);
        }

        /**
         * Set the default locale for the request instance.
         *
         * @param string $locale
         * @return void
         * @static
         */
        public static function setDefaultRequestLocale($locale)
        {
            /** @var \Illuminate\Http\Request $instance */
            $instance->setDefaultRequestLocale($locale);
        }

        /**
         * Get the user making the request.
         *
         * @param string|null $guard
         * @return mixed
         * @static
         */
        public static function user($guard = null)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->user($guard);
        }

        /**
         * Get the route handling the request.
         *
         * @param string|null $param
         * @param mixed $default
         * @return \Illuminate\Routing\Route|object|string|null
         * @static
         */
        public static function route($param = null, $default = null)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->route($param, $default);
        }

        /**
         * Get a unique fingerprint for the request / route / IP address.
         *
         * @return string
         * @throws \RuntimeException
         * @static
         */
        public static function fingerprint()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->fingerprint();
        }

        /**
         * Set the JSON payload for the request.
         *
         * @param \Symfony\Component\HttpFoundation\InputBag $json
         * @return \Illuminate\Http\Request
         * @static
         */
        public static function setJson($json)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->setJson($json);
        }

        /**
         * Get the user resolver callback.
         *
         * @return \Closure
         * @static
         */
        public static function getUserResolver()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getUserResolver();
        }

        /**
         * Set the user resolver callback.
         *
         * @param \Closure $callback
         * @return \Illuminate\Http\Request
         * @static
         */
        public static function setUserResolver($callback)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->setUserResolver($callback);
        }

        /**
         * Get the route resolver callback.
         *
         * @return \Closure
         * @static
         */
        public static function getRouteResolver()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getRouteResolver();
        }

        /**
         * Set the route resolver callback.
         *
         * @param \Closure $callback
         * @return \Illuminate\Http\Request
         * @static
         */
        public static function setRouteResolver($callback)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->setRouteResolver($callback);
        }

        /**
         * Get all of the input and files for the request.
         *
         * @return array
         * @static
         */
        public static function toArray()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->toArray();
        }

        /**
         * Determine if the given offset exists.
         *
         * @param string $offset
         * @return bool
         * @static
         */
        public static function offsetExists($offset)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->offsetExists($offset);
        }

        /**
         * Get the value at the given offset.
         *
         * @param string $offset
         * @return mixed
         * @static
         */
        public static function offsetGet($offset)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->offsetGet($offset);
        }

        /**
         * Set the value at the given offset.
         *
         * @param string $offset
         * @param mixed $value
         * @return void
         * @static
         */
        public static function offsetSet($offset, $value)
        {
            /** @var \Illuminate\Http\Request $instance */
            $instance->offsetSet($offset, $value);
        }

        /**
         * Remove the value at the given offset.
         *
         * @param string $offset
         * @return void
         * @static
         */
        public static function offsetUnset($offset)
        {
            /** @var \Illuminate\Http\Request $instance */
            $instance->offsetUnset($offset);
        }

        /**
         * Sets the parameters for this request.
         *
         * This method also re-initializes all properties.
         *
         * @param array $query The GET parameters
         * @param array $request The POST parameters
         * @param array $attributes The request attributes (parameters parsed from the PATH_INFO, ...)
         * @param array $cookies The COOKIE parameters
         * @param array $files The FILES parameters
         * @param array $server The SERVER parameters
         * @param string|resource|null $content The raw body data
         * @static
         */
        public static function initialize($query = [], $request = [], $attributes = [], $cookies = [], $files = [], $server = [], $content = null)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->initialize($query, $request, $attributes, $cookies, $files, $server, $content);
        }

        /**
         * Creates a new request with values from PHP's super globals.
         *
         * @static
         */
        public static function createFromGlobals()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            return \Illuminate\Http\Request::createFromGlobals();
        }

        /**
         * Creates a Request based on a given URI and configuration.
         *
         * The information contained in the URI always take precedence
         * over the other information (server and parameters).
         *
         * @param string $uri The URI
         * @param string $method The HTTP method
         * @param array $parameters The query (GET) or request (POST) parameters
         * @param array $cookies The request cookies ($_COOKIE)
         * @param array $files The request files ($_FILES)
         * @param array $server The server parameters ($_SERVER)
         * @param string|resource|null $content The raw body data
         * @throws BadRequestException When the URI is invalid
         * @static
         */
        public static function create($uri, $method = 'GET', $parameters = [], $cookies = [], $files = [], $server = [], $content = null)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            return \Illuminate\Http\Request::create($uri, $method, $parameters, $cookies, $files, $server, $content);
        }

        /**
         * Sets a callable able to create a Request instance.
         *
         * This is mainly useful when you need to override the Request class
         * to keep BC with an existing system. It should not be used for any
         * other purpose.
         *
         * @static
         */
        public static function setFactory($callable)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            return \Illuminate\Http\Request::setFactory($callable);
        }

        /**
         * Overrides the PHP global variables according to this request instance.
         *
         * It overrides $_GET, $_POST, $_REQUEST, $_SERVER, $_COOKIE.
         * $_FILES is never overridden, see rfc1867
         *
         * @static
         */
        public static function overrideGlobals()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->overrideGlobals();
        }

        /**
         * Sets a list of trusted proxies.
         *
         * You should only list the reverse proxies that you manage directly.
         *
         * @param array $proxies A list of trusted proxies, the string 'REMOTE_ADDR' will be replaced with $_SERVER['REMOTE_ADDR'] and 'PRIVATE_SUBNETS' by IpUtils::PRIVATE_SUBNETS
         * @param int-mask-of<Request::HEADER_*> $trustedHeaderSet A bit field to set which headers to trust from your proxies
         * @static
         */
        public static function setTrustedProxies($proxies, $trustedHeaderSet)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            return \Illuminate\Http\Request::setTrustedProxies($proxies, $trustedHeaderSet);
        }

        /**
         * Gets the list of trusted proxies.
         *
         * @return string[]
         * @static
         */
        public static function getTrustedProxies()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            return \Illuminate\Http\Request::getTrustedProxies();
        }

        /**
         * Gets the set of trusted headers from trusted proxies.
         *
         * @return int A bit field of Request::HEADER_* that defines which headers are trusted from your proxies
         * @static
         */
        public static function getTrustedHeaderSet()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            return \Illuminate\Http\Request::getTrustedHeaderSet();
        }

        /**
         * Sets a list of trusted host patterns.
         *
         * You should only list the hosts you manage using regexs.
         *
         * @param array $hostPatterns A list of trusted host patterns
         * @static
         */
        public static function setTrustedHosts($hostPatterns)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            return \Illuminate\Http\Request::setTrustedHosts($hostPatterns);
        }

        /**
         * Gets the list of trusted host patterns.
         *
         * @return string[]
         * @static
         */
        public static function getTrustedHosts()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            return \Illuminate\Http\Request::getTrustedHosts();
        }

        /**
         * Normalizes a query string.
         *
         * It builds a normalized query string, where keys/value pairs are alphabetized,
         * have consistent escaping and unneeded delimiters are removed.
         *
         * @static
         */
        public static function normalizeQueryString($qs)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            return \Illuminate\Http\Request::normalizeQueryString($qs);
        }

        /**
         * Enables support for the _method request parameter to determine the intended HTTP method.
         *
         * Be warned that enabling this feature might lead to CSRF issues in your code.
         * Check that you are using CSRF tokens when required.
         * If the HTTP method parameter override is enabled, an html-form with method "POST" can be altered
         * and used to send a "PUT" or "DELETE" request via the _method request parameter.
         * If these methods are not protected against CSRF, this presents a possible vulnerability.
         *
         * The HTTP method can only be overridden when the real HTTP method is POST.
         *
         * @static
         */
        public static function enableHttpMethodParameterOverride()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            return \Illuminate\Http\Request::enableHttpMethodParameterOverride();
        }

        /**
         * Checks whether support for the _method request parameter is enabled.
         *
         * @static
         */
        public static function getHttpMethodParameterOverride()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            return \Illuminate\Http\Request::getHttpMethodParameterOverride();
        }

        /**
         * Whether the request contains a Session which was started in one of the
         * previous requests.
         *
         * @static
         */
        public static function hasPreviousSession()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->hasPreviousSession();
        }

        /**
         *
         *
         * @static
         */
        public static function setSession($session)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->setSession($session);
        }

        /**
         *
         *
         * @internal
         * @param \Symfony\Component\HttpFoundation\callable():  SessionInterface $factory
         * @static
         */
        public static function setSessionFactory($factory)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->setSessionFactory($factory);
        }

        /**
         * Returns the client IP addresses.
         *
         * In the returned array the most trusted IP address is first, and the
         * least trusted one last. The "real" client IP address is the last one,
         * but this is also the least trusted one. Trusted proxies are stripped.
         *
         * Use this method carefully; you should use getClientIp() instead.
         *
         * @see getClientIp()
         * @static
         */
        public static function getClientIps()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getClientIps();
        }

        /**
         * Returns the client IP address.
         *
         * This method can read the client IP address from the "X-Forwarded-For" header
         * when trusted proxies were set via "setTrustedProxies()". The "X-Forwarded-For"
         * header value is a comma+space separated list of IP addresses, the left-most
         * being the original client, and each successive proxy that passed the request
         * adding the IP address where it received the request from.
         *
         * If your reverse proxy uses a different header name than "X-Forwarded-For",
         * ("Client-Ip" for instance), configure it via the $trustedHeaderSet
         * argument of the Request::setTrustedProxies() method instead.
         *
         * @see getClientIps()
         * @see https://wikipedia.org/wiki/X-Forwarded-For
         * @static
         */
        public static function getClientIp()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getClientIp();
        }

        /**
         * Returns current script name.
         *
         * @static
         */
        public static function getScriptName()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getScriptName();
        }

        /**
         * Returns the path being requested relative to the executed script.
         *
         * The path info always starts with a /.
         *
         * Suppose this request is instantiated from /mysite on localhost:
         *
         *  * http://localhost/mysite              returns an empty string
         *  * http://localhost/mysite/about        returns '/about'
         *  * http://localhost/mysite/enco%20ded   returns '/enco%20ded'
         *  * http://localhost/mysite/about?var=1  returns '/about'
         *
         * @return string The raw path (i.e. not urldecoded)
         * @static
         */
        public static function getPathInfo()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getPathInfo();
        }

        /**
         * Returns the root path from which this request is executed.
         *
         * Suppose that an index.php file instantiates this request object:
         *
         *  * http://localhost/index.php         returns an empty string
         *  * http://localhost/index.php/page    returns an empty string
         *  * http://localhost/web/index.php     returns '/web'
         *  * http://localhost/we%20b/index.php  returns '/we%20b'
         *
         * @return string The raw path (i.e. not urldecoded)
         * @static
         */
        public static function getBasePath()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getBasePath();
        }

        /**
         * Returns the root URL from which this request is executed.
         *
         * The base URL never ends with a /.
         *
         * This is similar to getBasePath(), except that it also includes the
         * script filename (e.g. index.php) if one exists.
         *
         * @return string The raw URL (i.e. not urldecoded)
         * @static
         */
        public static function getBaseUrl()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getBaseUrl();
        }

        /**
         * Gets the request's scheme.
         *
         * @static
         */
        public static function getScheme()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getScheme();
        }

        /**
         * Returns the port on which the request is made.
         *
         * This method can read the client port from the "X-Forwarded-Port" header
         * when trusted proxies were set via "setTrustedProxies()".
         *
         * The "X-Forwarded-Port" header must contain the client port.
         *
         * @return int|string|null Can be a string if fetched from the server bag
         * @static
         */
        public static function getPort()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getPort();
        }

        /**
         * Returns the user.
         *
         * @static
         */
        public static function getUser()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getUser();
        }

        /**
         * Returns the password.
         *
         * @static
         */
        public static function getPassword()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getPassword();
        }

        /**
         * Gets the user info.
         *
         * @return string|null A user name if any and, optionally, scheme-specific information about how to gain authorization to access the server
         * @static
         */
        public static function getUserInfo()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getUserInfo();
        }

        /**
         * Returns the HTTP host being requested.
         *
         * The port name will be appended to the host if it's non-standard.
         *
         * @static
         */
        public static function getHttpHost()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getHttpHost();
        }

        /**
         * Returns the requested URI (path and query string).
         *
         * @return string The raw URI (i.e. not URI decoded)
         * @static
         */
        public static function getRequestUri()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getRequestUri();
        }

        /**
         * Gets the scheme and HTTP host.
         *
         * If the URL was called with basic authentication, the user
         * and the password are not added to the generated string.
         *
         * @static
         */
        public static function getSchemeAndHttpHost()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getSchemeAndHttpHost();
        }

        /**
         * Generates a normalized URI (URL) for the Request.
         *
         * @see getQueryString()
         * @static
         */
        public static function getUri()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getUri();
        }

        /**
         * Generates a normalized URI for the given path.
         *
         * @param string $path A path to use instead of the current one
         * @static
         */
        public static function getUriForPath($path)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getUriForPath($path);
        }

        /**
         * Returns the path as relative reference from the current Request path.
         *
         * Only the URIs path component (no schema, host etc.) is relevant and must be given.
         * Both paths must be absolute and not contain relative parts.
         * Relative URLs from one resource to another are useful when generating self-contained downloadable document archives.
         * Furthermore, they can be used to reduce the link size in documents.
         *
         * Example target paths, given a base path of "/a/b/c/d":
         * - "/a/b/c/d"     -> ""
         * - "/a/b/c/"      -> "./"
         * - "/a/b/"        -> "../"
         * - "/a/b/c/other" -> "other"
         * - "/a/x/y"       -> "../../x/y"
         *
         * @static
         */
        public static function getRelativeUriForPath($path)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getRelativeUriForPath($path);
        }

        /**
         * Generates the normalized query string for the Request.
         *
         * It builds a normalized query string, where keys/value pairs are alphabetized
         * and have consistent escaping.
         *
         * @static
         */
        public static function getQueryString()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getQueryString();
        }

        /**
         * Checks whether the request is secure or not.
         *
         * This method can read the client protocol from the "X-Forwarded-Proto" header
         * when trusted proxies were set via "setTrustedProxies()".
         *
         * The "X-Forwarded-Proto" header must contain the protocol: "https" or "http".
         *
         * @static
         */
        public static function isSecure()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->isSecure();
        }

        /**
         * Returns the host name.
         *
         * This method can read the client host name from the "X-Forwarded-Host" header
         * when trusted proxies were set via "setTrustedProxies()".
         *
         * The "X-Forwarded-Host" header must contain the client host name.
         *
         * @throws SuspiciousOperationException when the host name is invalid or not trusted
         * @static
         */
        public static function getHost()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getHost();
        }

        /**
         * Sets the request method.
         *
         * @static
         */
        public static function setMethod($method)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->setMethod($method);
        }

        /**
         * Gets the request "intended" method.
         *
         * If the X-HTTP-Method-Override header is set, and if the method is a POST,
         * then it is used to determine the "real" intended HTTP method.
         *
         * The _method request parameter can also be used to determine the HTTP method,
         * but only if enableHttpMethodParameterOverride() has been called.
         *
         * The method is always an uppercased string.
         *
         * @see getRealMethod()
         * @static
         */
        public static function getMethod()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getMethod();
        }

        /**
         * Gets the "real" request method.
         *
         * @see getMethod()
         * @static
         */
        public static function getRealMethod()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getRealMethod();
        }

        /**
         * Gets the mime type associated with the format.
         *
         * @static
         */
        public static function getMimeType($format)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getMimeType($format);
        }

        /**
         * Gets the mime types associated with the format.
         *
         * @return string[]
         * @static
         */
        public static function getMimeTypes($format)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            return \Illuminate\Http\Request::getMimeTypes($format);
        }

        /**
         * Gets the format associated with the mime type.
         *
         * @static
         */
        public static function getFormat($mimeType)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getFormat($mimeType);
        }

        /**
         * Associates a format with mime types.
         *
         * @param string|string[] $mimeTypes The associated mime types (the preferred one must be the first as it will be used as the content type)
         * @static
         */
        public static function setFormat($format, $mimeTypes)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->setFormat($format, $mimeTypes);
        }

        /**
         * Gets the request format.
         *
         * Here is the process to determine the format:
         *
         *  * format defined by the user (with setRequestFormat())
         *  * _format request attribute
         *  * $default
         *
         * @see getPreferredFormat
         * @static
         */
        public static function getRequestFormat($default = 'html')
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getRequestFormat($default);
        }

        /**
         * Sets the request format.
         *
         * @static
         */
        public static function setRequestFormat($format)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->setRequestFormat($format);
        }

        /**
         * Gets the usual name of the format associated with the request's media type (provided in the Content-Type header).
         *
         * @see Request::$formats
         * @static
         */
        public static function getContentTypeFormat()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getContentTypeFormat();
        }

        /**
         * Sets the default locale.
         *
         * @static
         */
        public static function setDefaultLocale($locale)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->setDefaultLocale($locale);
        }

        /**
         * Get the default locale.
         *
         * @static
         */
        public static function getDefaultLocale()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getDefaultLocale();
        }

        /**
         * Sets the locale.
         *
         * @static
         */
        public static function setLocale($locale)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->setLocale($locale);
        }

        /**
         * Get the locale.
         *
         * @static
         */
        public static function getLocale()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getLocale();
        }

        /**
         * Checks if the request method is of specified type.
         *
         * @param string $method Uppercase request method (GET, POST etc)
         * @static
         */
        public static function isMethod($method)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->isMethod($method);
        }

        /**
         * Checks whether or not the method is safe.
         *
         * @see https://tools.ietf.org/html/rfc7231#section-4.2.1
         * @static
         */
        public static function isMethodSafe()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->isMethodSafe();
        }

        /**
         * Checks whether or not the method is idempotent.
         *
         * @static
         */
        public static function isMethodIdempotent()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->isMethodIdempotent();
        }

        /**
         * Checks whether the method is cacheable or not.
         *
         * @see https://tools.ietf.org/html/rfc7231#section-4.2.3
         * @static
         */
        public static function isMethodCacheable()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->isMethodCacheable();
        }

        /**
         * Returns the protocol version.
         *
         * If the application is behind a proxy, the protocol version used in the
         * requests between the client and the proxy and between the proxy and the
         * server might be different. This returns the former (from the "Via" header)
         * if the proxy is trusted (see "setTrustedProxies()"), otherwise it returns
         * the latter (from the "SERVER_PROTOCOL" server parameter).
         *
         * @static
         */
        public static function getProtocolVersion()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getProtocolVersion();
        }

        /**
         * Returns the request body content.
         *
         * @param bool $asResource If true, a resource will be returned
         * @return string|resource
         * @psalm-return ($asResource is true ? resource : string)
         * @static
         */
        public static function getContent($asResource = false)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getContent($asResource);
        }

        /**
         * Gets the decoded form or json request body.
         *
         * @throws JsonException When the body cannot be decoded to an array
         * @static
         */
        public static function getPayload()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getPayload();
        }

        /**
         * Gets the Etags.
         *
         * @static
         */
        public static function getETags()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getETags();
        }

        /**
         *
         *
         * @static
         */
        public static function isNoCache()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->isNoCache();
        }

        /**
         * Gets the preferred format for the response by inspecting, in the following order:
         *   * the request format set using setRequestFormat;
         *   * the values of the Accept HTTP header.
         *
         * Note that if you use this method, you should send the "Vary: Accept" header
         * in the response to prevent any issues with intermediary HTTP caches.
         *
         * @static
         */
        public static function getPreferredFormat($default = 'html')
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getPreferredFormat($default);
        }

        /**
         * Returns the preferred language.
         *
         * @param string[] $locales An array of ordered available locales
         * @static
         */
        public static function getPreferredLanguage($locales = null)
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getPreferredLanguage($locales);
        }

        /**
         * Gets a list of languages acceptable by the client browser ordered in the user browser preferences.
         *
         * @return string[]
         * @static
         */
        public static function getLanguages()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getLanguages();
        }

        /**
         * Gets a list of charsets acceptable by the client browser in preferable order.
         *
         * @return string[]
         * @static
         */
        public static function getCharsets()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getCharsets();
        }

        /**
         * Gets a list of encodings acceptable by the client browser in preferable order.
         *
         * @return string[]
         * @static
         */
        public static function getEncodings()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getEncodings();
        }

        /**
         * Gets a list of content types acceptable by the client browser in preferable order.
         *
         * @return string[]
         * @static
         */
        public static function getAcceptableContentTypes()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->getAcceptableContentTypes();
        }

        /**
         * Returns true if the request is an XMLHttpRequest.
         *
         * It works if your JavaScript library sets an X-Requested-With HTTP header.
         * It is known to work with common JavaScript frameworks:
         *
         * @see https://wikipedia.org/wiki/List_of_Ajax_frameworks#JavaScript
         * @static
         */
        public static function isXmlHttpRequest()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->isXmlHttpRequest();
        }

        /**
         * Checks whether the client browser prefers safe content or not according to RFC8674.
         *
         * @see https://tools.ietf.org/html/rfc8674
         * @static
         */
        public static function preferSafeContent()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->preferSafeContent();
        }

        /**
         * Indicates whether this request originated from a trusted proxy.
         *
         * This can be useful to determine whether or not to trust the
         * contents of a proxy-specific header.
         *
         * @static
         */
        public static function isFromTrustedProxy()
        {
            //Method inherited from \Symfony\Component\HttpFoundation\Request
            /** @var \Illuminate\Http\Request $instance */
            return $instance->isFromTrustedProxy();
        }

        /**
         * Filter the given array of rules into an array of rules that are included in precognitive headers.
         *
         * @param array $rules
         * @return array
         * @static
         */
        public static function filterPrecognitiveRules($rules)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->filterPrecognitiveRules($rules);
        }

        /**
         * Determine if the request is attempting to be precognitive.
         *
         * @return bool
         * @static
         */
        public static function isAttemptingPrecognition()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->isAttemptingPrecognition();
        }

        /**
         * Determine if the request is precognitive.
         *
         * @return bool
         * @static
         */
        public static function isPrecognitive()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->isPrecognitive();
        }

        /**
         * Determine if the request is sending JSON.
         *
         * @return bool
         * @static
         */
        public static function isJson()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->isJson();
        }

        /**
         * Determine if the current request probably expects a JSON response.
         *
         * @return bool
         * @static
         */
        public static function expectsJson()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->expectsJson();
        }

        /**
         * Determine if the current request is asking for JSON.
         *
         * @return bool
         * @static
         */
        public static function wantsJson()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->wantsJson();
        }

        /**
         * Determines whether the current requests accepts a given content type.
         *
         * @param string|array $contentTypes
         * @return bool
         * @static
         */
        public static function accepts($contentTypes)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->accepts($contentTypes);
        }

        /**
         * Return the most suitable content type from the given array based on content negotiation.
         *
         * @param string|array $contentTypes
         * @return string|null
         * @static
         */
        public static function prefers($contentTypes)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->prefers($contentTypes);
        }

        /**
         * Determine if the current request accepts any content type.
         *
         * @return bool
         * @static
         */
        public static function acceptsAnyContentType()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->acceptsAnyContentType();
        }

        /**
         * Determines whether a request accepts JSON.
         *
         * @return bool
         * @static
         */
        public static function acceptsJson()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->acceptsJson();
        }

        /**
         * Determines whether a request accepts HTML.
         *
         * @return bool
         * @static
         */
        public static function acceptsHtml()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->acceptsHtml();
        }

        /**
         * Determine if the given content types match.
         *
         * @param string $actual
         * @param string $type
         * @return bool
         * @static
         */
        public static function matchesType($actual, $type)
        {
            return \Illuminate\Http\Request::matchesType($actual, $type);
        }

        /**
         * Get the data format expected in the response.
         *
         * @param string $default
         * @return string
         * @static
         */
        public static function format($default = 'html')
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->format($default);
        }

        /**
         * Retrieve an old input item.
         *
         * @param string|null $key
         * @param \Illuminate\Database\Eloquent\Model|string|array|null $default
         * @return string|array|null
         * @static
         */
        public static function old($key = null, $default = null)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->old($key, $default);
        }

        /**
         * Flash the input for the current request to the session.
         *
         * @return void
         * @static
         */
        public static function flash()
        {
            /** @var \Illuminate\Http\Request $instance */
            $instance->flash();
        }

        /**
         * Flash only some of the input to the session.
         *
         * @param array|mixed $keys
         * @return void
         * @static
         */
        public static function flashOnly($keys)
        {
            /** @var \Illuminate\Http\Request $instance */
            $instance->flashOnly($keys);
        }

        /**
         * Flash only some of the input to the session.
         *
         * @param array|mixed $keys
         * @return void
         * @static
         */
        public static function flashExcept($keys)
        {
            /** @var \Illuminate\Http\Request $instance */
            $instance->flashExcept($keys);
        }

        /**
         * Flush all of the old input from the session.
         *
         * @return void
         * @static
         */
        public static function flush()
        {
            /** @var \Illuminate\Http\Request $instance */
            $instance->flush();
        }

        /**
         * Retrieve a server variable from the request.
         *
         * @param string|null $key
         * @param string|array|null $default
         * @return string|array|null
         * @static
         */
        public static function server($key = null, $default = null)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->server($key, $default);
        }

        /**
         * Determine if a header is set on the request.
         *
         * @param string $key
         * @return bool
         * @static
         */
        public static function hasHeader($key)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->hasHeader($key);
        }

        /**
         * Retrieve a header from the request.
         *
         * @param string|null $key
         * @param string|array|null $default
         * @return string|array|null
         * @static
         */
        public static function header($key = null, $default = null)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->header($key, $default);
        }

        /**
         * Get the bearer token from the request headers.
         *
         * @return string|null
         * @static
         */
        public static function bearerToken()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->bearerToken();
        }

        /**
         * Get the keys for all of the input and files.
         *
         * @return array
         * @static
         */
        public static function keys()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->keys();
        }

        /**
         * Get all of the input and files for the request.
         *
         * @param array|mixed|null $keys
         * @return array
         * @static
         */
        public static function all($keys = null)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->all($keys);
        }

        /**
         * Retrieve an input item from the request.
         *
         * @param string|null $key
         * @param mixed $default
         * @return mixed
         * @static
         */
        public static function input($key = null, $default = null)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->input($key, $default);
        }

        /**
         * Retrieve input from the request as a Fluent object instance.
         *
         * @param array|string|null $key
         * @return \Illuminate\Support\Fluent
         * @static
         */
        public static function fluent($key = null)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->fluent($key);
        }

        /**
         * Retrieve a query string item from the request.
         *
         * @param string|null $key
         * @param string|array|null $default
         * @return string|array|null
         * @static
         */
        public static function query($key = null, $default = null)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->query($key, $default);
        }

        /**
         * Retrieve a request payload item from the request.
         *
         * @param string|null $key
         * @param string|array|null $default
         * @return string|array|null
         * @static
         */
        public static function post($key = null, $default = null)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->post($key, $default);
        }

        /**
         * Determine if a cookie is set on the request.
         *
         * @param string $key
         * @return bool
         * @static
         */
        public static function hasCookie($key)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->hasCookie($key);
        }

        /**
         * Retrieve a cookie from the request.
         *
         * @param string|null $key
         * @param string|array|null $default
         * @return string|array|null
         * @static
         */
        public static function cookie($key = null, $default = null)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->cookie($key, $default);
        }

        /**
         * Get an array of all of the files on the request.
         *
         * @return array
         * @static
         */
        public static function allFiles()
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->allFiles();
        }

        /**
         * Determine if the uploaded data contains a file.
         *
         * @param string $key
         * @return bool
         * @static
         */
        public static function hasFile($key)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->hasFile($key);
        }

        /**
         * Retrieve a file from the request.
         *
         * @param string|null $key
         * @param mixed $default
         * @return \Illuminate\Http\UploadedFile|\Illuminate\Http\UploadedFile[]|array|null
         * @static
         */
        public static function file($key = null, $default = null)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->file($key, $default);
        }

        /**
         * Dump the items.
         *
         * @param mixed $keys
         * @return \Illuminate\Http\Request
         * @static
         */
        public static function dump($keys = [])
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->dump($keys);
        }

        /**
         * Dump the given arguments and terminate execution.
         *
         * @param mixed $args
         * @return never
         * @static
         */
        public static function dd(...$args)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->dd(...$args);
        }

        /**
         * Determine if the data contains a given key.
         *
         * @param string|array $key
         * @return bool
         * @static
         */
        public static function exists($key)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->exists($key);
        }

        /**
         * Determine if the data contains a given key.
         *
         * @param string|array $key
         * @return bool
         * @static
         */
        public static function has($key)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->has($key);
        }

        /**
         * Determine if the instance contains any of the given keys.
         *
         * @param string|array $keys
         * @return bool
         * @static
         */
        public static function hasAny($keys)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->hasAny($keys);
        }

        /**
         * Apply the callback if the instance contains the given key.
         *
         * @param string $key
         * @param callable $callback
         * @param callable|null $default
         * @return $this|mixed
         * @static
         */
        public static function whenHas($key, $callback, $default = null)
        {
            /** @var \Illuminate\Http\Request $instance */
            return $instance->whenHas($key, $callback, $default);
        }

        /**
         * Determine if the instance contains a no