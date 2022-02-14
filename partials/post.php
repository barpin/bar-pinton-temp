<div class="articlebody" id="art-<?= $content['p_id'] ?>" style="<?= $margins ? "width:65%; margin: 10px auto;" : "" ?><?= $redback ? "background-color:rgba(245, 0, 0, 0.5);" : "" ?><?= $articleborder ? "padding: 3vw;border-radius: 3vw;border: 1px solid #333;" : "" ?>"  >
<div class="dotsdropdown" onclick="this.classList.toggle('dotsactive');"> 
    <div class="dots">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
    <div class="dotsdropcontent">
        <div class="uppercut"></div> <!--por si se quiere agregar una flechita para arriba. TODO-->
        <div class="dotsdropitems">
            <span>Creado: <?= $content['p_created_at'] ?></span>
            <span>Modificado: <?= $content['t_created_at'] ?></span>
            <?php if ($content['t_replaced_at']) { ?> <span>Reemplazado: <?= $content['t_replaced_at'] ?></span> <?php } ?>
            <?php if ($content['p_deleted_at']) { ?> <span>Borrado: <?= $content['p_deleted_at'] ?></span> <?php } ?>
            <a class="dotdropdownlink" href="">Ver Historia</a>
            <?php if ($canedit){ ?>
            <a class="dotdropdownlink" href="/editar/<?= $content['p_id'] ?>">Editar</a>
            <?= !$isdeleted ? '<a class="dotdropdownlink" href="">Eliminar</a>' : '<a class="dotdropdownlink" href="">Reestablecer</a>' ?>
            <?php } ?>
        </div>
        <div class="lowercut"></div>

    </div>
</div>
    <h1 class="text-center"><?= $title ? $content['p_title'] : "" ?></h1>
    <style><?= $content['t_css'] ?></style>
    <?php if ($dates){ ?>
        <span class="text-center text-neutral-500" style="font-size:0.6em;"> Fecha: <?= $content['p_created_at'] ?>  |  Modificado: <?= $content['t_created_at'] ?><br>
    <?php } ?>
    <!--TODO: Aca irian las opcones de voto-->
    
    <div class="content">
    <?= $content['t_content'] ?>
    </div>
</div>
