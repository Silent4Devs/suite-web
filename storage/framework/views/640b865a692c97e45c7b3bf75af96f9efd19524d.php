<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(trans('panel.site_title')); ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@coreui/coreui@3.2/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/responsive.css')); ?>">
    <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('img/Silent4Business-Logo-Color.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('img/favicon_tabantaj_v2.png')); ?>">
    <?php echo $__env->yieldContent('styles'); ?>
    <?php echo \Livewire\Livewire::styles(); ?>

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="<?php echo e(asset('/img/logo_policromatico.png')); ?>">
    <link rel="manifest" href="<?php echo e(asset('/manifest.json')); ?>">
    <style>
        html {
            height: 100%;
        }

        body {
            min-height: 100%;
        }
    </style>
</head>



<body id="layout-app-body">
    <div class="flex-row align-items-center" style="height: 100vh">
        <div class="container-fluid" style="height: 100vh">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
    <?php echo $__env->yieldContent('scripts'); ?>
    <?php echo \Livewire\Livewire::scripts(); ?>

    <script src="<?php echo e(asset('/sw.js')); ?>"></script>
    <script>
        if (!navigator.serviceWorker?.controller) {
            navigator.serviceWorker?.register("/sw.js").then(function(reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>

</body>

</html>
<?php /**PATH /var/www/html/resources/views/layouts/app.blade.php ENDPATH**/ ?>