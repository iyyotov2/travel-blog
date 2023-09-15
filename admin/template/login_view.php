<?php defined('SITE') || exit('Неразрешен директен достъп!'); ?>

        <!-- Login -->
        <div class="row mt-5">
            <div class="col-5 col-md-5 offset-3">
                <h2>Вход</h2>
                <p>Само за администратори!!!</p>
                <?= ($errors !== '') ? $errors : ''; ?>
                <form action="" method="post">
                    <input type="hidden" name="protect" value="<?= $protect; ?>">
                    <div class="form-group">
                        <label for="usr">Потребителско име:</label>
                        <input type="text" class="form-control" id="usr" name="username">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Парола:</label>
                        <input type="password" class="form-control" id="pwd" name="password">
                    </div>
                    <button type="submit" class="btn btn-style float-right" id="sub" name="submit" value="login">Вход</button>
                </form>
            </div>
        </div>

    </div>
</body>
</html>