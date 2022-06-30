<a href="<?= $returnlink ?>" class="z-30 right-0 absolute inline-block mx-6 my-1 text-gray-800 font-medium text-xs leading-tight uppercase rounded bg-white hover:bg-white  focus:outline-none focus:ring-0 transition duration-150 ease-in-out">Ver articulos <?= $archive ? "sin borrar" : "borrados" ?></a>
<?php 
$displayas="fullpage";
if ($content) {include 'controllers/c_partial_article.php';} else { echo "<br><h1 class='text-center'>${title}</h1><br>"; } 
$displayas="infeed";
?>
<hr>
<br>
<div class="articlecontainer ">

    <?php foreach ($alerts as $content) { ?>
    <div class="">
        <?php include 'controllers/c_partial_article.php'; ?>
    </div>
    <?php } ?>
    <?php foreach ($votes as $content) { ?>
    <div class="">
        <?php include 'controllers/c_partial_article.php'; ?>
    </div>
    <?php } ?>
    <?php foreach ($posts as $content) { ?>
    <div class="">
        <?php include 'controllers/c_partial_article.php'; ?>
    </div>
    <?php } ?>
</div>
<?= debug ? $staticcategory : "" //numero de la categoria ?>