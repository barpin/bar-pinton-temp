<div class="articlebody" id="art-<?= $content['p_id'] ?>"><h1><?= $content['p_title'] ?></h1>
    <style><?= $content['t_css'] =="default" ? $defaultcss : $content['t_css'] ?></style>
    <span> Fecha: <?= $content['p_created_at'] ?>  |  Modificado: <?= $content['t_created_at'] ?>
    <br>
    <div class="content">
    <?= $content['t_content'] ?>
    </div>
</div>
