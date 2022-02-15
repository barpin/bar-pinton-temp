<div class="articlebody" id="art-<?= $content['p_id'] ?>" style="<?= $margins ? "width:65%; margin: 10px auto;" : "" ?><?= $redback ? "background-color:rgba(245, 0, 0, 0.5);" : "" ?><?= $articleborder ? "padding: 3vw;border-radius: 3vw;border: 1px solid #333;" : "" ?>"  >
<div class="dotsdropdown" tabindex="0" role="button" onmousedown="var tthis = this;if (tthis.matches(':focus')){setTimeout(()=>{tthis.blur()}, 1)};"> 
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
            <?php if ($content['t_replaced_at']) { ?> 
                <span>Reemplazado: <?= $content['t_replaced_at'] ?></span> 
                <?= $restore ?  "<button class='dotdropdownlink text-left' onclick='restore( ${content['t_id']} )' >Restaurar Version</button>" : "" ?>
            <?php } ?>
            <?php if ($content['p_deleted_at']) { ?> <span>Borrado: <?= $content['p_deleted_at'] ?></span> <?php } ?>
            <?= $viewhist ?  "<a class='dotdropdownlink' href='/articulo/${content['p_id']}/historia'>Ver Historia</a>" : "" ?>
            <a class='dotdropdownlink' href='/articulo/<?= $content['p_id'].($content['t_replaced_at'] ? "/historia/" . $content['t_id']  : "") ?>'>Detalles</a>
            <?php if ($canedit){ ?>
            <a class="dotdropdownlink" href="/editar/<?= $content['p_id'] ?>">Editar</a>
            <button class="dotdropdownlink text-left" onclick="toggledelete(<?= $content['p_id'] ?>)"><?=!$isdeleted ? "Eliminar" : "Reestablecer (deseliminar)" ?> </button>
            <?php } ?>
        </div>
        <div class="lowercut"></div>

    </div>
</div>
    <h1 class="text-center"><?= $title ? $content['p_title'] : "" ?></h1>
    <style><?= $content['t_css'] ?></style>
    <?php if ($dates){ ?>
        <span class="text-center text-neutral-500 leading-3	" style="font-size:0.6em;"> 
            Fecha: <?= $content['p_created_at'] ?>  |  
            Modificado: <?= $content['t_created_at'] ?>
            <?= $content['t_replaced_at'] ? "| Reemplazado:  ${content['t_replaced_at']}" : "" ?>
            <?= $content['p_deleted_at'] ? "| Borrado:  ${content['p_deleted_at']}" : "" ?>
            <?= $showauthor ? "| Editado por:  ${content['u_name']}" : "" ?>

        </span>
        <br>
    <?php } ?>
    <!--TODO: Aca irian las opcones de voto-->
    
    <div class="content">
    <?= $content['t_content'] ?>
    </div>
</div>
