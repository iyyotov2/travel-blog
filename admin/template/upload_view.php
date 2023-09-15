<?php defined('SITE') || exit('Неразрешен директен достъп!'); ?>

        <!-- Upload -->
        <div class="container">
            <br>
            <?= ($data['errors'] !== '') ? $data['errors'] : ''; ?>
            <?= (isset($success)) ? '<div class="alert alert-success">'.$success.'</div>' : ''; ?>
            <h2>Качване на изображения</h2>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="fileToUpload">Избери изображение:</label>
                    <br>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Качване" class="btn btn-style">
                </div>
            </form>
            <hr>
            <div class="row">
                <?php foreach ($images AS $image) { ?>
                    <div class="col-sm-2">
                        <img src="<?= $image; ?>" alt="" style="max-width: 100%;">
                        <div style="font-size: 15px;"> <?= $image; ?></div>
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>
</body>
</html>