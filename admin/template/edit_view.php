<?php defined('SITE') || exit('Неразрешен директен достъп!'); ?>

        <!-- Edit -->
        <div class="container">
            <br>
            <div style="margin-bottom: 20px;"><a href="index.php" style="color: rgb(73, 155, 84);">< Всички страници</a></div>
            <?= ($data['errors'] !== '') ? $data['errors'] : ''; ?>
            <h2>Редактиране</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <div class="form-group">
                    <label for="title">Заглавие:</label>
                    <input type="text" class="form-control" id="title" placeholder="Въведете заглавие" name="title" value="<?= $title; ?>">
                </div>
                <div class="form-group">
                    <label for="summary">Въвеждащ текст:</label>
                    <input type="text" class="form-control" id="summary" placeholder="Въведете кратък текст" name="summary" value="<?= $summary; ?>">
                </div>
                <?php if ($data['category'] != '0') { ?>
                    <div class="form-group">
                    <label for="category">Категория:</label>
                    <select class="form-control" id="category" name="category">
                    <?php 
                    foreach ($categories AS $cat) { ?>
                        <option value="<?= $cat['id']; ?>" <?= ($cat['id'] == $category) ? "selected" : ''; ?>><?= $cat['name']; ?></option>
                    <?php } ?>
                    </select>
                </div>
                <?php } ?>
                <div class="form-group">
                    <label for="content">Съдържание:</label>
                    <textarea class="form-control" rows="5" id="content" name="content"><?= $content; ?></textarea>
                </div>
                <button type="submit" name="edit" value="save" class="btn btn-style">Запис</button>
                <script src="ckeditor/ckeditor.js"></script>
                <script>
                    CKEDITOR.replace('content', {
                        extraPlugins: 'filetools',
                        extraPlugins: 'popup',
			            filebrowserBrowseUrl: 'browse.php?type=Images&dir=' + encodeURIComponent('../images/'),
			            filebrowserUploadUrl: 'ck_upload.php',
			            filebrowserUploadMethod: 'form'
		            });
                </script>
            </form>
        </div>

    </div>
</body>
</html>