<?php return array (
  'app' => 
  array (
    'name' => 'tann',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost',
    'asset_url' => NULL,
    'timezone' => 'America/Mexico_City',
    'locale' => 'es',
    'fallback_locale' => 'es',
    'faker_locale' => 'es_ES',
    'key' => 'base64:Eg38bYXpwuIFO9Zze3gmRIqJdW1ihnwT7O4UpPx0VUc=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      23 => 'Jenssegers\\Date\\DateServiceProvider',
      24 => 'App\\Providers\\AppServiceProvider',
      25 => 'App\\Providers\\AuthServiceProvider',
      26 => 'App\\Providers\\BroadcastServiceProvider',
      27 => 'App\\Providers\\EventServiceProvider',
      28 => 'App\\Providers\\RouteServiceProvider',
      29 => 'Emotality\\TawkTo\\TawkToServiceProvider',
      30 => 'Alexusmai\\LaravelFileManager\\FileManagerServiceProvider',
      31 => 'Barryvdh\\DomPDF\\ServiceProvider',
      32 => 'Intervention\\Image\\ImageServiceProvider',
      33 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      34 => 'Spatie\\Geocoder\\GeocoderServiceProvider',
      35 => 'Ladumor\\LaravelPwa\\PWAServiceProvider',
      36 => 'SimpleSoftwareIO\\QrCode\\QrCodeServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Http' => 'Illuminate\\Support\\Facades\\Http',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'TawkTo' => 'Emotality\\TawkTo\\TawkTo',
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
      'Geocoder' => 'Spatie\\Geocoder\\Facades\\Geocoder',
      'Form' => 'Collective\\Html\\FormFacade',
      'Html' => 'Collective\\Html\\HtmlFacade',
      'Flash' => 'Laracasts\\Flash\\Flash',
      'Date' => 'Jenssegers\\Date\\Date',
      'LaravelPwa' => 'Ladumor\\LaravelPwa\\LaravelPwa',
      'QrCode' => 'SimpleSoftwareIO\\QrCode\\Facades\\QrCode',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'passport',
        'provider' => 'users',
        'hash' => false,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'breadcrumbs' => 
  array (
    'view' => 'breadcrumbs::bootstrap4',
    'files' => '/var/www/html/routes/breadcrumbs.php',
    'unnamed-route-exception' => true,
    'missing-route-bound-breadcrumb-exception' => true,
    'invalid-named-breadcrumb-exception' => true,
    'manager-class' => 'DaveJamesMiller\\Breadcrumbs\\BreadcrumbsManager',
    'generator-class' => 'DaveJamesMiller\\Breadcrumbs\\BreadcrumbsGenerator',
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'useTLS' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/var/www/html/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
    ),
    'prefix' => 'tann_cache',
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => 'api/*',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => true,
  ),
  'database' => 
  array (
    'default' => 'pgsql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'homestead',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'postgres',
        'port' => '5432',
        'database' => 'homestead',
        'username' => 'homestead',
        'password' => 'secret',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => 'postgres',
        'port' => '5432',
        'database' => 'homestead',
        'username' => 'homestead',
        'password' => 'secret',
        'charset' => 'utf8',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => 'postgres',
        'port' => '5432',
        'database' => 'homestead',
        'username' => 'homestead',
        'password' => 'secret',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'tann_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'datatables' => 
  array (
    'search' => 
    array (
      'smart' => true,
      'multi_term' => true,
      'case_insensitive' => true,
      'use_wildcards' => false,
      'starts_with' => false,
    ),
    'index_column' => 'DT_RowIndex',
    'engines' => 
    array (
      'eloquent' => 'Yajra\\DataTables\\EloquentDataTable',
      'query' => 'Yajra\\DataTables\\QueryDataTable',
      'collection' => 'Yajra\\DataTables\\CollectionDataTable',
      'resource' => 'Yajra\\DataTables\\ApiResourceDataTable',
    ),
    'builders' => 
    array (
    ),
    'nulls_last_sql' => ':column :direction NULLS LAST',
    'error' => 'throw',
    'columns' => 
    array (
      'excess' => 
      array (
        0 => 'rn',
        1 => 'row_num',
      ),
      'escape' => '*',
      'raw' => 
      array (
        0 => 'action',
      ),
      'blacklist' => 
      array (
        0 => 'password',
        1 => 'remember_token',
      ),
      'whitelist' => '*',
    ),
    'json' => 
    array (
      'header' => 
      array (
      ),
      'options' => 0,
    ),
  ),
  'datatables-buttons' => 
  array (
    'namespace' => 
    array (
      'base' => 'DataTables',
      'model' => '',
    ),
    'pdf_generator' => 'snappy',
    'snappy' => 
    array (
      'options' => 
      array (
        'no-outline' => true,
        'margin-left' => '0',
        'margin-right' => '0',
        'margin-top' => '10mm',
        'margin-bottom' => '10mm',
      ),
      'orientation' => 'landscape',
    ),
    'parameters' => 
    array (
      'dom' => 'Bfrtip',
      'order' => 
      array (
        0 => 
        array (
          0 => 0,
          1 => 'desc',
        ),
      ),
      'buttons' => 
      array (
        0 => 'create',
        1 => 'export',
        2 => 'print',
        3 => 'reset',
        4 => 'reload',
      ),
    ),
    'generator' => 
    array (
      'columns' => 'id,add your columns,created_at,updated_at',
      'buttons' => 'create,export,print,reset,reload',
      'dom' => 'Bfrtip',
    ),
  ),
  'datatables-fractal' => 
  array (
    'includes' => 'include',
    'serializer' => 'League\\Fractal\\Serializer\\DataArraySerializer',
  ),
  'datatables-html' => 
  array (
    'namespace' => 'LaravelDataTables',
    'table' => 
    array (
      'class' => 'table',
      'id' => 'dataTableBuilder',
    ),
    'callback' => 
    array (
      0 => '$',
      1 => '$.',
      2 => 'function',
    ),
    'script' => 'datatables::script',
    'editor' => 'datatables::editor',
  ),
  'debugbar' => 
  array (
    'enabled' => NULL,
    'except' => 
    array (
      0 => 'telescope*',
      1 => 'horizon*',
    ),
    'storage' => 
    array (
      'enabled' => true,
      'driver' => 'file',
      'path' => '/var/www/html/storage/debugbar',
      'connection' => NULL,
      'provider' => '',
      'hostname' => '127.0.0.1',
      'port' => 2304,
    ),
    'include_vendors' => true,
    'capture_ajax' => true,
    'add_ajax_timing' => false,
    'error_handler' => false,
    'clockwork' => false,
    'collectors' => 
    array (
      'phpinfo' => true,
      'messages' => true,
      'time' => true,
      'memory' => true,
      'exceptions' => true,
      'log' => true,
      'db' => true,
      'views' => true,
      'route' => true,
      'auth' => false,
      'gate' => true,
      'session' => true,
      'symfony_request' => true,
      'mail' => true,
      'laravel' => false,
      'events' => true,
      'default_request' => false,
      'logs' => false,
      'files' => false,
      'config' => false,
      'cache' => true,
      'models' => true,
      'livewire' => true,
    ),
    'options' => 
    array (
      'auth' => 
      array (
        'show_name' => true,
      ),
      'db' => 
      array (
        'with_params' => true,
        'backtrace' => true,
        'backtrace_exclude_paths' => 
        array (
        ),
        'timeline' => false,
        'duration_background' => true,
        'explain' => 
        array (
          'enabled' => false,
          'types' => 
          array (
            0 => 'SELECT',
          ),
        ),
        'hints' => false,
        'show_copy' => false,
      ),
      'mail' => 
      array (
        'full_log' => false,
      ),
      'views' => 
      array (
        'timeline' => false,
        'data' => false,
      ),
      'route' => 
      array (
        'label' => true,
      ),
      'logs' => 
      array (
        'file' => NULL,
      ),
      'cache' => 
      array (
        'values' => true,
      ),
    ),
    'inject' => true,
    'route_prefix' => '_debugbar',
    'route_domain' => NULL,
    'theme' => 'auto',
    'debug_backtrace_limit' => 50,
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'convert_entities' => true,
    'defines' => 
    array (
      'font_dir' => '/var/www/html/storage/fonts/',
      'font_cache' => '/var/www/html/storage/fonts/',
      'temp_dir' => '/tmp',
      'chroot' => '/var/www/html',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => true,
      'strict_null_comparison' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'ignore_empty' => false,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'UTF-8',
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 100000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
    ),
    'transactions' => 
    array (
      'handler' => 'db',
    ),
    'temporary_files' => 
    array (
      'local_path' => '/var/www/html/storage/framework/laravel-excel',
      'remote_disk' => NULL,
      'remote_prefix' => NULL,
      'force_resync_remote' => NULL,
    ),
  ),
  'file-manager' => 
  array (
    'configRepository' => 'App\\Http\\FileManagerRepository',
    'aclRepository' => 'App\\Http\\UsersACLRepository',
    'routePrefix' => 'file-manager',
    'diskList' => 
    array (
      0 => 'public',
    ),
    'leftDisk' => NULL,
    'rightDisk' => NULL,
    'leftPath' => NULL,
    'rightPath' => NULL,
    'cache' => NULL,
    'windowsConfig' => 2,
    'maxUploadFileSize' => NULL,
    'allowFileTypes' => 
    array (
    ),
    'hiddenFiles' => false,
    'middleware' => 
    array (
      0 => 'web',
    ),
    'acl' => true,
    'aclHideFromFM' => true,
    'aclStrategy' => 'whitelist',
    'aclRulesCache' => NULL,
    'aclRules' => 
    array (
      '' => 
      array (
      ),
      1 => 
      array (
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/storage/app',
      ),
      'images' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/storage/app/public/images',
        'url' => 'http://localhost/storage',
        'visibility' => 'public',
      ),
      'Documentacion' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/storage/app/public',
        'url' => 'http://localhost/storage',
        'visibility' => 'private',
      ),
      'Documentos publicados' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/storage/app/public/Documentos publicados',
        'url' => 'http://localhost/storage',
        'visibility' => 'private',
      ),
      'Documentos en aprobacion' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/storage/app/public/Documentos en aprobacion',
        'url' => 'http://localhost/storage',
        'visibility' => 'private',
      ),
      'Documentos obsoletos' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/storage/app/public/Documentos obsoletos',
        'url' => 'http://localhost/storage',
        'visibility' => 'private',
      ),
      'Documentos versiones anteriores' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/storage/app/public/Documento versiones anteriores',
        'url' => 'http://localhost/storage',
        'visibility' => 'private',
      ),
      'Iso27001' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/storage/app/public/Normas/ISO27001',
        'url' => 'http://localhost/storage',
        'visibility' => 'private',
      ),
      'Normas' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/storage/app/public/Normas/',
        'url' => 'http://localhost/storage',
        'visibility' => 'private',
      ),
      'Administrador' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/storage/app/public',
        'url' => 'http://localhost/storage',
        'visibility' => 'private',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/storage/app/public',
        'url' => 'http://localhost/storage',
        'visibility' => 'public',
      ),
      'capacitaciones' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/storage/app/public/capacitaciones',
        'url' => 'http://localhost/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
        'endpoint' => NULL,
      ),
    ),
    'links' => 
    array (
      '/var/www/html/public/storage' => '/var/www/html/storage/app/public',
    ),
  ),
  'flare' => 
  array (
    'key' => NULL,
    'reporting' => 
    array (
      'anonymize_ips' => true,
      'collect_git_information' => false,
      'report_queries' => true,
      'maximum_number_of_collected_queries' => 200,
      'report_query_bindings' => true,
      'report_view_data' => true,
      'grouping_type' => NULL,
      'report_logs' => true,
      'maximum_number_of_collected_logs' => 200,
      'censor_request_body_fields' => 
      array (
        0 => 'password',
      ),
    ),
    'send_logs_as_events' => true,
    'censor_request_body_fields' => 
    array (
      0 => 'password',
    ),
  ),
  'geocoder' => 
  array (
    'key' => 'AIzaSyCMtPStAiDXhsaYws3HhCAqwHa2UbsPIPE',
    'language' => '',
    'region' => '',
    'bounds' => '',
    'country' => '',
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'health' => 
  array (
    'result_stores' => 
    array (
      'Spatie\\Health\\ResultStores\\EloquentHealthResultStore' => 
      array (
        'model' => 'Spatie\\Health\\Models\\HealthCheckResultHistoryItem',
        'keep_history_for_days' => 7,
      ),
    ),
    'notifications' => 
    array (
      'enabled' => true,
      'notifications' => 
      array (
        'Spatie\\Health\\Notifications\\CheckFailedNotification' => 
        array (
          0 => 'mail',
        ),
      ),
      'notifiable' => 'Spatie\\Health\\Notifications\\Notifiable',
      'throttle_notifications_for_minutes' => 120,
      'mail' => 
      array (
        'to' => 'luis.vargas@silent4business.com',
        'from' => 
        array (
          'address' => 'hello@example.com',
          'name' => 'tann',
        ),
      ),
      'slack' => 
      array (
        'webhook_url' => '',
        'channel' => NULL,
        'username' => NULL,
        'icon' => NULL,
      ),
    ),
    'oh_dear_endpoint' => 
    array (
      'enabled' => false,
      'always_send_fresh_results' => true,
      'secret' => NULL,
      'url' => '/oh-dear-health-check-results',
    ),
    'theme' => 'dark',
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'light',
    'enable_share_button' => true,
    'register_commands' => false,
    'ignored_solution_providers' => 
    array (
      0 => 'Facade\\Ignition\\SolutionProviders\\MissingPackageSolutionProvider',
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'imagecache' => 
  array (
    'route' => NULL,
    'paths' => 
    array (
      0 => '/var/www/html/public/upload',
      1 => '/var/www/html/public/images',
    ),
    'templates' => 
    array (
      'small' => 'Intervention\\Image\\Templates\\Small',
      'medium' => 'Intervention\\Image\\Templates\\Medium',
      'large' => 'Intervention\\Image\\Templates\\Large',
    ),
    'lifetime' => 43200,
  ),
  'infyom' => 
  array (
    'laravel_generator' => 
    array (
      'path' => 
      array (
        'migration' => '/var/www/html/database/migrations/',
        'model' => '/var/www/html/app/Models/',
        'datatables' => '/var/www/html/app/DataTables/',
        'repository' => '/var/www/html/app/Repositories/',
        'routes' => '/var/www/html/routes/web.php',
        'api_routes' => '/var/www/html/routes/api.php',
        'request' => '/var/www/html/app/Http/Requests/',
        'api_request' => '/var/www/html/app/Http/Requests/API/',
        'controller' => '/var/www/html/app/Http/Controllers/Admin/',
        'api_controller' => '/var/www/html/app/Http/Controllers/API/',
        'api_resource' => '/var/www/html/app/Http/Resources/',
        'repository_test' => '/var/www/html/tests/Repositories/',
        'api_test' => '/var/www/html/tests/APIs/',
        'tests' => '/var/www/html/tests/',
        'views' => '/var/www/html/resources/views/admin/',
        'schema_files' => '/var/www/html/resources/model_schemas/',
        'templates_dir' => '/var/www/html/resources/infyom/infyom-generator-templates/',
        'seeder' => '/var/www/html/database/seeders/',
        'database_seeder' => '/var/www/html/database/seeders/DatabaseSeeder.php',
        'factory' => '/var/www/html/database/factories/',
        'view_provider' => '/var/www/html/app/Providers/ViewServiceProvider.php',
      ),
      'namespace' => 
      array (
        'model' => 'App\\Models',
        'datatables' => 'App\\DataTables',
        'repository' => 'App\\Repositories',
        'controller' => 'App\\Http\\Controllers',
        'api_controller' => 'App\\Http\\Controllers\\API',
        'api_resource' => 'App\\Http\\Resources',
        'request' => 'App\\Http\\Requests',
        'api_request' => 'App\\Http\\Requests\\API',
        'seeder' => 'Database\\Seeders',
        'factory' => 'Database\\Factories',
        'repository_test' => 'Tests\\Repositories',
        'api_test' => 'Tests\\APIs',
        'tests' => 'Tests',
      ),
      'templates' => 'coreui-templates',
      'model_extend_class' => 'Eloquent',
      'api_prefix' => 'api',
      'api_version' => 'v1',
      'options' => 
      array (
        'softDelete' => true,
        'save_schema_file' => false,
        'localized' => false,
        'tables_searchable_default' => false,
        'repository_pattern' => true,
        'resources' => false,
        'excluded_fields' => 
        array (
          0 => 'id',
        ),
      ),
      'prefixes' => 
      array (
        'route' => '',
        'path' => '',
        'view' => '',
        'public' => '',
      ),
      'add_on' => 
      array (
        'swagger' => false,
        'tests' => false,
        'datatables' => false,
        'menu' => 
        array (
          'enabled' => false,
          'menu_file' => 'layouts/menu.blade.php',
        ),
      ),
      'timestamps' => 
      array (
        'enabled' => true,
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
        'deleted_at' => 'deleted_at',
      ),
      'ignore_model_prefix' => false,
      'from_table' => 
      array (
        'doctrine_mappings' => 
        array (
        ),
      ),
    ),
  ),
  'insights' => 
  array (
    'preset' => 'laravel',
    'ide' => NULL,
    'exclude' => 
    array (
    ),
    'add' => 
    array (
      'NunoMaduro\\PhpInsights\\Domain\\Metrics\\Architecture\\Classes' => 
      array (
        0 => 'NunoMaduro\\PhpInsights\\Domain\\Insights\\ForbiddenFinalClasses',
      ),
    ),
    'remove' => 
    array (
      0 => 'SlevomatCodingStandard\\Sniffs\\Namespaces\\AlphabeticallySortedUsesSniff',
      1 => 'SlevomatCodingStandard\\Sniffs\\TypeHints\\DeclareStrictTypesSniff',
      2 => 'SlevomatCodingStandard\\Sniffs\\TypeHints\\DisallowMixedTypeHintSniff',
      3 => 'NunoMaduro\\PhpInsights\\Domain\\Insights\\ForbiddenDefineFunctions',
      4 => 'NunoMaduro\\PhpInsights\\Domain\\Insights\\ForbiddenNormalClasses',
      5 => 'NunoMaduro\\PhpInsights\\Domain\\Insights\\ForbiddenTraits',
      6 => 'SlevomatCodingStandard\\Sniffs\\TypeHints\\ParameterTypeHintSniff',
      7 => 'SlevomatCodingStandard\\Sniffs\\TypeHints\\PropertyTypeHintSniff',
      8 => 'SlevomatCodingStandard\\Sniffs\\TypeHints\\ReturnTypeHintSniff',
      9 => 'SlevomatCodingStandard\\Sniffs\\Commenting\\UselessFunctionDocCommentSniff',
    ),
    'config' => 
    array (
      'NunoMaduro\\PhpInsights\\Domain\\Insights\\ForbiddenPrivateMethods' => 
      array (
        'title' => 'The usage of private methods is not idiomatic in Laravel.',
      ),
    ),
    'requirements' => 
    array (
    ),
    'threads' => NULL,
  ),
  'laravel-page-speed' => 
  array (
    'enable' => true,
    'skip' => 
    array (
      0 => '*.xml',
      1 => '*.less',
      2 => '*.pdf',
      3 => '*.doc',
      4 => '*.txt',
      5 => '*.ico',
      6 => '*.rss',
      7 => '*.zip',
      8 => '*.mp3',
      9 => '*.rar',
      10 => '*.exe',
      11 => '*.wmv',
      12 => '*.doc',
      13 => '*.avi',
      14 => '*.ppt',
      15 => '*.mpg',
      16 => '*.mpeg',
      17 => '*.tif',
      18 => '*.wav',
      19 => '*.mov',
      20 => '*.psd',
      21 => '*.ai',
      22 => '*.xls',
      23 => '*.mp4',
      24 => '*.m4a',
      25 => '*.swf',
      26 => '*.dat',
      27 => '*.dmg',
      28 => '*.iso',
      29 => '*.flv',
      30 => '*.m4v',
      31 => '*.torrent',
    ),
    'php' => 
    array (
      'enable' => true,
      'skip' => 
      array (
        0 => '*.xml',
        1 => '*.less',
        2 => '*.pdf',
        3 => '*.doc',
        4 => '*.txt',
        5 => '*.ico',
        6 => '*.rss',
        7 => '*.zip',
        8 => '*.mp3',
        9 => '*.rar',
        10 => '*.exe',
        11 => '*.wmv',
        12 => '*.doc',
        13 => '*.avi',
        14 => '*.ppt',
        15 => '*.mpg',
        16 => '*.mpeg',
        17 => '*.tif',
        18 => '*.wav',
        19 => '*.mov',
        20 => '*.psd',
        21 => '*.ai',
        22 => '*.xls',
        23 => '*.mp4',
        24 => '*.m4a',
        25 => '*.swf',
        26 => '*.dat',
        27 => '*.dmg',
        28 => '*.iso',
        29 => '*.flv',
        30 => '*.m4v',
        31 => '*.torrent',
      ),
    ),
  ),
  'livewire' => 
  array (
    'class_namespace' => 'App\\Http\\Livewire',
    'view_path' => '/var/www/html/resources/views/livewire',
    'layout' => 'layouts.app',
    'asset_url' => NULL,
    'app_url' => NULL,
    'middleware_group' => 'web',
    'temporary_file_upload' => 
    array (
      'disk' => NULL,
      'rules' => NULL,
      'directory' => NULL,
      'middleware' => NULL,
      'preview_mimes' => 
      array (
        0 => 'png',
        1 => 'gif',
        2 => 'bmp',
        3 => 'svg',
        4 => 'wav',
        5 => 'mp4',
        6 => 'mov',
        7 => 'avi',
        8 => 'wmv',
        9 => 'mp3',
        10 => 'm4a',
        11 => 'jpeg',
        12 => 'mpga',
        13 => 'webp',
        14 => 'wma',
      ),
    ),
    'manifest_path' => NULL,
    'back_button_cache' => false,
    'render_on_redirect' => false,
  ),
  'livewire-alert' => 
  array (
    'alert' => 
    array (
      'position' => 'top-end',
      'timer' => 3000,
      'toast' => true,
      'text' => NULL,
      'showCancelButton' => false,
      'showConfirmButton' => false,
    ),
    'confirm' => 
    array (
      'icon' => 'warning',
      'position' => 'center',
      'toast' => false,
      'timer' => NULL,
      'showConfirmButton' => true,
      'showCancelButton' => true,
      'cancelButtonText' => 'No',
      'confirmButtonColor' => '#3085d6',
      'cancelButtonColor' => '#d33',
    ),
  ),
  'livewire-tables' => 
  array (
    'theme' => 'bootstrap-5',
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/var/www/html/storage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/var/www/html/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => '/var/www/html/storage/logs/laravel.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'smtp',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'host' => 'mailhog',
        'port' => '1025',
        'encryption' => NULL,
        'username' => NULL,
        'password' => NULL,
        'timeout' => NULL,
        'auth_mode' => NULL,
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'mailgun' => 
      array (
        'transport' => 'mailgun',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -bs',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
    ),
    'from' => 
    array (
      'address' => 'hello@example.com',
      'name' => 'tann',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/var/www/html/resources/views/vendor/mail',
      ),
    ),
  ),
  'media-library' => 
  array (
    'disk_name' => 'public',
    'max_file_size' => 10485760,
    'queue_name' => '',
    'queue_conversions_by_default' => true,
    'media_model' => 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media',
    'remote' => 
    array (
      'extra_headers' => 
      array (
        'CacheControl' => 'max-age=604800',
      ),
    ),
    'responsive_images' => 
    array (
      'width_calculator' => 'Spatie\\MediaLibrary\\ResponsiveImages\\WidthCalculator\\FileSizeOptimizedWidthCalculator',
      'use_tiny_placeholders' => true,
      'tiny_placeholder_generator' => 'Spatie\\MediaLibrary\\ResponsiveImages\\TinyPlaceholderGenerator\\Blurred',
    ),
    'default_loading_attribute_value' => NULL,
    'conversion_file_namer' => 'Spatie\\MediaLibrary\\Conversions\\DefaultConversionFileNamer',
    'path_generator' => 'Spatie\\MediaLibrary\\Support\\PathGenerator\\DefaultPathGenerator',
    'url_generator' => 'Spatie\\MediaLibrary\\Support\\UrlGenerator\\DefaultUrlGenerator',
    'version_urls' => false,
    'image_optimizers' => 
    array (
      'Spatie\\ImageOptimizer\\Optimizers\\Jpegoptim' => 
      array (
        0 => '--strip-all',
        1 => '--all-progressive',
      ),
      'Spatie\\ImageOptimizer\\Optimizers\\Pngquant' => 
      array (
        0 => '--force',
      ),
      'Spatie\\ImageOptimizer\\Optimizers\\Optipng' => 
      array (
        0 => '-i0',
        1 => '-o2',
        2 => '-quiet',
      ),
      'Spatie\\ImageOptimizer\\Optimizers\\Svgo' => 
      array (
        0 => '--disable=cleanupIDs',
      ),
      'Spatie\\ImageOptimizer\\Optimizers\\Gifsicle' => 
      array (
        0 => '-b',
        1 => '-O3',
      ),
    ),
    'image_generators' => 
    array (
      0 => 'Spatie\\MediaLibrary\\Conversions\\ImageGenerators\\Image',
      1 => 'Spatie\\MediaLibrary\\Conversions\\ImageGenerators\\Webp',
      2 => 'Spatie\\MediaLibrary\\Conversions\\ImageGenerators\\Pdf',
      3 => 'Spatie\\MediaLibrary\\Conversions\\ImageGenerators\\Svg',
      4 => 'Spatie\\MediaLibrary\\Conversions\\ImageGenerators\\Video',
    ),
    'image_driver' => 'gd',
    'ffmpeg_path' => '/usr/bin/ffmpeg',
    'ffprobe_path' => '/usr/bin/ffprobe',
    'temporary_directory_path' => NULL,
    'jobs' => 
    array (
      'perform_conversions' => 'Spatie\\MediaLibrary\\Conversions\\Jobs\\PerformConversionsJob',
      'generate_responsive_images' => 'Spatie\\MediaLibrary\\ResponsiveImages\\Jobs\\GenerateResponsiveImagesJob',
    ),
    'media_downloader' => 'Spatie\\MediaLibrary\\Downloaders\\DefaultDownloader',
  ),
  'models' => 
  array (
    '*' => 
    array (
      'path' => '/var/www/html/app/Models',
      'namespace' => 'App\\Models',
      'parent' => 'Illuminate\\Database\\Eloquent\\Model',
      'use' => 
      array (
      ),
      'connection' => false,
      'timestamps' => true,
      'soft_deletes' => true,
      'date_format' => 'Y-m-d H:i:s',
      'per_page' => 15,
      'base_files' => false,
      'snake_attributes' => true,
      'indent_with_space' => 0,
      'qualified_tables' => false,
      'hidden' => 
      array (
        0 => '*secret*',
        1 => '*password',
        2 => '*token',
      ),
      'guarded' => 
      array (
      ),
      'casts' => 
      array (
        '*_json' => 'json',
      ),
      'except' => 
      array (
        0 => 'migrations',
      ),
      'only' => 
      array (
      ),
      'table_prefix' => '',
      'lower_table_name_first' => false,
      'model_names' => 
      array (
      ),
      'relation_name_strategy' => 'related',
      'with_property_constants' => false,
      'pluralize' => true,
      'override_pluralize_for' => 
      array (
      ),
      'fillable_in_base_files' => false,
    ),
  ),
  'panel' => 
  array (
    'date_format' => 'd-m-Y',
    'time_format' => 'H:i:s',
    'primary_language' => 'es',
    'available_languages' => 
    array (
      'es' => 'Spanish',
    ),
    'registration_default_role' => '2',
  ),
  'passport' => 
  array (
    'private_key' => NULL,
    'public_key' => NULL,
    'client_uuids' => false,
    'personal_access_client' => 
    array (
      'id' => NULL,
      'secret' => NULL,
    ),
    'storage' => 
    array (
      'database' => 
      array (
        'connection' => 'pgsql',
      ),
    ),
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'suffix' => NULL,
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'driver' => 'database-uuids',
      'database' => 'pgsql',
      'table' => 'failed_jobs',
    ),
  ),
  'scout' => 
  array (
    'driver' => 'algolia',
    'prefix' => '',
    'queue' => false,
    'after_commit' => false,
    'chunk' => 
    array (
      'searchable' => 500,
      'unsearchable' => 500,
    ),
    'soft_delete' => false,
    'identify' => false,
    'algolia' => 
    array (
      'id' => '',
      'secret' => '',
    ),
    'meilisearch' => 
    array (
      'host' => 'http://localhost:7700',
      'key' => NULL,
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
  ),
  'session' => 
  array (
    'driver' => 'database',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/var/www/html/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'tann_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => 'lax',
  ),
  'tawkto' => 
  array (
    'api_key' => NULL,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 94,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/var/www/html/resources/views',
    ),
    'compiled' => '/var/www/html/storage/framework/views',
  ),
);
