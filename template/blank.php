<?php defined('SITE') || exit('Неразрешен директен достъп!'); ?>
        
        <!-- Blank -->
        <div class="blank">
            <section class="inner-page">
                <div class="content-section">
                    <?= ($category == 1) ? '<div style="margin-bottom: 20px;"><a href="news.php" style="color: rgb(73, 155, 84);">< Всички новини</a></div>' : '' ?>
                    <?= ($category == 2) ? '<div style="margin-bottom: 20px;"><a href="travelogues.php" style="color: rgb(73, 155, 84);">< Всички пътеписи</a></div>' : '' ?>
                    <h2><?= $title; ?></h2>
                    <h4><?= $summary; ?></h4>
                    <br>
                    <p><?= $content; ?></p>
                    <br>
                </div>
            </section>
        </div>