<?php defined('SITE') || exit('Неразрешен директен достъп!'); ?>

        <!-- News -->
        <div class="news">
            <section class="inner-page">
                <div class="content-section">
                    <h2>Новини</h2>
                    <?php foreach ($news AS $new) { ?>
                    <a href="news.php?id=<?= $new['id']; ?>" style="text-decoration: none;">
                        <div class="new">
                            <div class="new-content">
                                <h3><?= $new['title'] ?></h3>
                                <p><?= $new['summary'] ?></p>
                                <p><?= $new['timestamp'] ?></p>
                            </div>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </section>
        </div>