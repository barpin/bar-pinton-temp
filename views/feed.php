<?php if ($content) {include 'views/article.php';} else { echo "<h1>${title}</h1>"; } ?>

<div class="articlecontainer">

    <?php foreach ($alerts as $content) { ?>
    <div class="alert post">
        <?php include 'views/article.php'; ?>
    </div>
    <?php } ?>
    <?php foreach ($votes as $content) { ?>
    <div class="post">
        <?php include 'views/article.php'; ?>
    </div>
    <?php } ?>
    <?php foreach ($posts as $content) { ?>
    <div class="post">
        <?php include 'views/article.php'; ?>
    </div>
    <?php } ?>
</div>
<?= $staticcategory ?>