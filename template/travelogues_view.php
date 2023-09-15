<?php defined('SITE') || exit('Неразрешен директен достъп!'); ?>

        <!-- Travelogues -->
        <div class="news">
            <section class="inner-page">
                <div class="content-section">
                    <h2>Пътеписи</h2>
                    <?php foreach ($travelogues AS $travelogue) { ?>
                    <a href="travelogues.php?id=<?= $travelogue['id']; ?>" style="text-decoration: none;">
                        <div class="new">
                            <div class="new-content">
                                <h3><?= $travelogue['title'] ?></h3>
                                <p><?= $travelogue['summary'] ?></p>
                                <p><?= $travelogue['timestamp'] ?></p>
                            </div>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </section>
        </div>