<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- jQuery -->
    <script src="./assets/jquery.js"></script>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom style -->
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">

        <!-- Admin menu -->
        <nav class="navbar navbar-expand-lg navbar-color navbar-dark">
	        <div class="container">
	            <ul class="navbar-nav">
		            <li class="nav-item active <?= ($menu['active'] == 'Страници') ? 'active' : '' ?>">
		                <a class="nav-link" href="index.php">Страници</a>
		            </li>
		            <li class="nav-item <?= ($menu['active'] == 'Нова страница') ? 'active' : '' ?>">
		                <a class="nav-link" href="add_new.php">Нова страница</a>
		            </li>
		            <li class="nav-item <?= ($menu['active'] == 'Файлове') ? 'active' : '' ?>">
		                <a class="nav-link" href="upload.php">Файлове</a>
		            </li>
	            </ul>
	        </div>
	    </nav>

        <!-- New pass -->
        <div class="row mt-5">
            <div class="col-5 col-md-5 offset-3">
                <h2>Смяна на паролата</h2>
                <form action="" method="post">
                    <input type="hidden" name="protect" value="<?= $protect; ?>">
                    <div class="form-group">
                        <label for="new-pwd">Нова парола:</label>
                        <input type="password" class="form-control" id="new-pwd" name="new-password">
                    </div>
                    <button type="submit" class="btn btn-style" name="new-pass" value="new-pass">Потвърди</button>
                    <a href="index.php" class="btn btn-style" style="background-color: grey;">Назад</a>
                </form>
            </div>
        </div>

    </div>
</body>
</html>