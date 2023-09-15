<?php defined('SITE') || exit('Неразрешен директен достъп!'); ?>

        <!-- Menu -->
        <nav class="navbar navbar-color navbar-expand-lg navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?= ($data['menu']['active'] == 'Начало') ? 'active' : '' ?>">
                        <a class="nav-link <?= ($data['menu']['active'] == 'Начало') ? 'pb-0' : '' ?>" href="index.php" style="font-size: 26px;<?= ($data['menu']['active'] == 'Начало') ? 'border-bottom: 2px solid white;' : '' ?>">Начало</a>
                    </li>
                    <li class="nav-item <?= ($data['menu']['active'] == 'Новини') ? 'active' : '' ?>">
                        <a class="nav-link <?= ($data['menu']['active'] == 'Новини') ? 'pb-0' : '' ?>" href="news.php" style="font-size: 26px;<?= ($data['menu']['active'] == 'Новини') ? 'border-bottom: 2px solid white;' : '' ?>">Новини</a>
                    </li>
                    <li class="nav-item <?= ($data['menu']['active'] == 'Пътеписи') ? 'active' : '' ?>">
                        <a class="nav-link <?= ($data['menu']['active'] == 'Пътеписи') ? 'pb-0' : '' ?>" href="travelogues.php" style="font-size: 26px;<?= ($data['menu']['active'] == 'Пътеписи') ? 'border-bottom: 2px solid white;' : '' ?>">Пътеписи</a>
                    </li>
                    <li class="nav-item <?= ($data['menu']['active'] == 'Пиши ни') ? 'active' : '' ?>">
                        <a class="nav-link <?= ($data['menu']['active'] == 'Пиши ни') ? 'pb-0' : '' ?>" href="contact_us.php" style="font-size: 26px;<?= ($data['menu']['active'] == 'Пиши ни') ? 'border-bottom: 2px solid white;' : '' ?>">Пиши ни</a>
                    </li>
                </ul>
                <div class="form-inline my-2 my-lg-0">
                    <a href="https://www.facebook.com/"><span class="icon-facebook" style="color: rgb(255, 255, 255); font-size: 25px;"></span></a>
                    <a href="https://www.instagram.com/"><span class="icon-instagram" style="color: rgb(255, 255, 255); font-size: 25px;"></span></a>
                </div>
            </div>
        </nav>