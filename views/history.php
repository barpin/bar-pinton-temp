<h1 class="text-center font-bold text-xl mt-3">Historia de <?= $title ?></h1>
<?php foreach ($posts as $content) { ?>
    <div class="">
        <?php include 'controllers/c_partial_article.php'; ?>
    </div>
<?php } ?>