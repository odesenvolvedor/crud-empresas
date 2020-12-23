<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Empresas</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?=PUBLIC_PATH?>/assets/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?=PUBLIC_PATH?>/assets/css/custom.css" rel="stylesheet">
    <link href="<?=PUBLIC_PATH?>/assets/css/responsive.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/a2d644bf17.js"></script>
    <script src="<?=PUBLIC_PATH?>/assets/js/jquery.min.js"></script>
</head>

<body>
<div class="page-wrapper" id="app">
    <div id="loading">
        <span>  <i class="fas fa-spinner fa-spin"></i> Por favor, aguarde...</span>
    </div>
    <header class="main-header header-style-two fixed-header">
        <nav class="navbar navbar-expand-md navbar-light fixed-top">
            <button id="sidebarCollapse" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h3 class="text-center"><?= isset($pageTitle) ? $pageTitle : "Cadastro de Empresas" ?></h3>
        </nav>
    </header>
    <?php
        include_once('sidebar.php');
    ?>
    <div class="wrapper">
        <div class="container mt-30">
            <?php
            echo $content_for_layout;
            ?>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="<?=PUBLIC_PATH?>/assets/js/bootstrap-select.min.js"></script>
<script src="<?=PUBLIC_PATH?>/assets/js/custom.js"></script>
<script>var baseUrl = "<?=BASE_URL?>";</script>
</body>
</html>
