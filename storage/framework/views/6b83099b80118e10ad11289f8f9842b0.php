<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <title>Welcome</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/sass/app.scss'); ?>
</head>

<body>
    <div class="container m-5">
        
        <img class="img-thumbnail" src="<?php echo e(Vite::asset('resources/images/main.svg')); ?>" alt="image">
    </div>
    <div class="col-md-2 offset-md-5 mt-4">
        <div class="d-grid gap-2">
            <a class="btn btn-dark" href="<?php echo e(route('home')); ?>" >Home</a>

        </div>
    </div>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>
</body>

</html>
<?php /**PATH C:\Users\rezaf\uts\resources\views/welcome.blade.php ENDPATH**/ ?>