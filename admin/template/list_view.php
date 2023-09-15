<?php defined('SITE') || exit('Неразрешен директен достъп!'); ?>

        <!-- Pages list -->
        <div class="container" style="min-height: 697px">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ИД</th>
                        <th>Заглавие</th>
                        <th>Категория</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($list AS $item) {
                    if ($item['active'] == 1) { ?>
                        <tr>
                            <td><?= $item['id']; ?></td>
                            <td><?= $item['title']; ?></td>
                            <?php
                            if ($item['category'] == 0) {
                                echo '<td></td>';
                            } else if ($item['category'] == 1) {
                                echo '<td>Новини</td>';
                            } else if ($item['category'] == 2) {
                                echo '<td>Пътеписи</td>';
                            }
                            ?>
                            <td> <a href="edit.php?id=<?= $item['id']; ?>" style="color: rgb(73, 155, 84);">Редактиране</a> | <?= ($item['category'] == 0) ? 'Страницата не може да бъде изтрита' : '<a href="delete.php?id='.$item['id'].'" style="color: rgb(230, 11, 11);">Изтриване</a>'?> </td>
                        </tr>
                    <?php }
                } ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>