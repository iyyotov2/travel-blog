<?php defined('SITE') || exit('Неразрешен директен достъп!'); ?>

        <!-- Admin menu -->
        <nav class="navbar navbar-expand-lg navbar-color navbar-dark">
	        <div class="container">
	            <ul class="navbar-nav">
		            <li class="nav-item <?= ($menu['active'] == 'Страници') ? 'active' : '' ?>">
		                <a class="nav-link <?= ($menu['active'] == 'Страници') ? 'pb-0' : '' ?>" href="index.php" <?= ($menu['active'] == 'Страници') ? 'style="border-bottom: 1px solid white;"' : '' ?>>Страници</a>
		            </li>
		            <li class="nav-item <?= ($menu['active'] == 'Нова страница') ? 'active' : '' ?>">
		                <a class="nav-link <?= ($menu['active'] == 'Нова страница') ? 'pb-0' : '' ?>" href="add_new.php" <?= ($menu['active'] == 'Нова страница') ? 'style="border-bottom: 1px solid white;"' : '' ?>>Нова страница</a>
		            </li>
		            <li class="nav-item <?= ($menu['active'] == 'Файлове') ? 'active' : '' ?>">
		                <a class="nav-link <?= ($menu['active'] == 'Файлове') ? 'pb-0' : '' ?>" href="upload.php" <?= ($menu['active'] == 'Файлове') ? 'style="border-bottom: 1px solid white;"' : '' ?>>Файлове</a>
		            </li>
					<li class="nav-item <?= ($menu['active'] == 'Смяна на паролата') ? 'active' : '' ?>">
		                <a class="nav-link <?= ($menu['active'] == 'Смяна на паролата') ? 'pb-0' : '' ?>" href="new_pass.php" <?= ($menu['active'] == 'Смяна на паролата') ? 'style="border-bottom: 1px solid white;"' : '' ?>>Смяна на паролата</a>
		            </li>
	            </ul>
				<form class="form-inline my-2 my-lg-0">
					<a class="nav-link" href="logout.php?logout" style="color: rgb(244, 255, 242);">Изход</a>
    			</form>
	        </div>
	    </nav>