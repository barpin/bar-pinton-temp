<?php 
$displayas="fullpage";
if ($content) {include 'controllers/c_partial_article.php';} else { echo "<h1 class='text-center'>${title}</h1>"; } 
$displayas="infeed";
?>
<hr>
<div class="articlecontainer">

    <?php foreach ($alerts as $content) { ?>
    <div class="alert post">
        <?php include 'controllers/c_partial_article.php'; ?>
    </div>
    <?php } ?>
    <?php foreach ($votes as $content) { ?>
    <div class="post">
        <?php include 'controllers/c_partial_article.php'; ?>
    </div>
    <?php } ?>
    <?php foreach ($posts as $content) { ?>
    <div class="post">
        <?php include 'controllers/c_partial_article.php'; ?>
    </div>
    <?php } ?>
</div>
<?= debug ? $staticcategory : "" //numero de la categoria ?>