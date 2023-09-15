<?php defined('SITE') || exit('Неразрешен директен достъп!'); ?>

        <!-- New pass -->
        <div class="row mt-5">
            <div class="col-5 col-md-5 offset-3">
                <?= ($errors !== '') ? $errors : ''; ?>
                <h2>Смяна на паролата</h2>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="pwd">Стара парола:</label>
                        <input type="password" class="form-control" id="pwd" name="password">
                    </div>
                    <div class="form-group">
                        <label for="new-pwd">Нова парола:</label>
                        <input type="password" class="form-control" id="new-pwd" name="new-password">
                    </div>
                    <button type="submit" class="btn btn-style" name="new-pass" value="new-pass">Потвърди</button>
                </form>
            </div>
        </div>

    </div>
</body>
</html>