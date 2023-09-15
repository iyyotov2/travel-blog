<?php defined('SITE') || exit('Неразрешен директен достъп!'); ?>

        <!-- Contact us -->
        <div class="contact-form">
            <section class="inner-page">
                <div class="content-section">
                <?php
                if ($_SESSION['success'] != '') {
                    echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
                     $_SESSION['success'] = '';
                } ?>
                <?php
                if ($_SESSION['error'] != '') {
                    echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
                    $_SESSION['error'] = '';
                } ?>
                    <div class="contact-title">
                        <h2>Пиши ни</h2>
                        <p>
                            Тук можете да изпращате вашите питания, предложения, критика, както и интересни истории от пътувания 
                            <i>(плюс снимков материал)</i>, които да качим в секция "Пътеписи".
                        </p>
                    </div>
                    <form action="contact_us.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="from"><b>От:</b></label>
                            <input type="email" name="from" class="form-control" id="from" placeholder="Вашият e-mail..." required>
                        </div>
                        <div class="form-group">
                            <label for="subject"><b>Тема:</b></label>
                            <input type="text" name="subject" class="form-control" id="subject" placeholder="Тема на вашето съобщение..." required>
                        </div>
                        <div class="form-group">
                            <label for="msg"><b>Съобщение:</b></label>
                            <textarea name="msg" class="form-control" id="msg" style="height: 180px;" placeholder="Вашето съобщение..." required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="attachment"><b>Прикачи снимка:</b></label>
                            <br>
                            <input type="file" name="attachment">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-style" value="send_mail">Изпрати</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>