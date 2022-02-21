<h1 class="text-center font-bold text-xl mt-3">Busqueda de <?= $title ?></h1>
<br><br>
<div class="articlecontainer">

    <?php foreach ($results as $content) { ?>
        <div class="">
            <?php include 'controllers/c_partial_article.php'; ?>
        </div>
    <?php } ?>
</div