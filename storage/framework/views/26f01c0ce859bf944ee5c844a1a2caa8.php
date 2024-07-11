<!DOCTYPE html>
<html lang="en">


<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Informasi Tugas Akhir</title>
    <link href="../../hh/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="../../hh/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="../../hh/vendor/jquery/jquery.min.js"></script>
    <script src="../../hh/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../hh/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .container {
            background-color: #fffff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* #content-wrapper {
            background-image: url('0313.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100%;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            box-sizing: border-box;
            padding: 20px;
        } */
        @media print {
            body {
                font-size: 22pt;
            }

            .card {
                border: none;
            }

            .btn {
                display: none;
            }

            #accordionSidebar {
                display: none;
            }

            @page {
                size: auto;
                margin: 25mm;
            }
        }
    </style>
</head>

<body>
    <?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container">
        <?php echo $__env->yieldContent('main'); ?>
        <?php if(session('Welcome')): ?>
            <div class="alert alert-success">
                <?php echo e(session('Welcome')); ?>

            </div>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
<?php /**PATH C:\Kuliah\Kuliah\PBL\pbl_sipenta\resources\views/layout/template.blade.php ENDPATH**/ ?>