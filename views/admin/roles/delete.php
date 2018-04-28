<?php
include_once VIEWS.'/shared/admin/header.php';
?>
        <main>
            <h1><?= $title;?></h1>
        </main>

<article class='large'>

        <h1>Удалить роль #<?php echo $data['role_id']; ?></h1>
        <p>Вы действительно хотите удалить эту роль?</p>

        <form method="post">
            <input type="submit" name="submit" value="Удалить" />
        </form>

</article>

<?php

include_once VIEWS.'/shared/admin/footer.php';


