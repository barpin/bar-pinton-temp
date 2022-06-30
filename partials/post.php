<div class="articlebody 
                    <?= $hsnippet ? "gap-3" : "" ?>" 
            id="art-<?= $content['p_id'] ?>-<?= $content['t_id'] ?>" 
             style="<?= $margins ? "width:max(70vw, min(90%,350px)); margin: 10px auto;" : "" ?>
                    <?= $displayas=="snippet" ? "background-color: rgb(220,220,245);padding:0.5rem;border-radius:2px;height:100%;" : "" ?>
                    <?= $redback ? "background-color:rgba(245, 0, 0, 0.5);" : "" ?>
                    <?= $articleborder ? "padding: 3vw;border-radius: 3vw;border: 1px solid #333;" : "" ?>
                    <?= $shadowcontain ? "background-color: rgb(247,247,247);" : "" ?>
                   ">
<?php if (!$hidedots){ ?>
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
                
                <?php if ($content['p_deleted_at']) { ?> <span>Borrado: <?= $content['p_deleted_at'] ?></span> <?php } ?>
                <?php if ($content['p_end_date']) { ?> <span>Termina/o el: <?= $content['p_end_date'] ?></span> <?php } ?>
                <?php if ($showversion) { ?> <span>Version: <?= $content['t_id'] ?></span> <?php } ?>
                <?php if ($showauthor) { ?> <span>Editado por: <?= $content['u_name'] ?></span> <?php } ?>
                <?php if ($content['t_replaced_at']) { ?> 
                    <span>Reemplazado: <?= $content['t_replaced_at'] ?></span> 
                    <?= $restore ?  "<button class='dotdropdownlink text-left' onclick='restore({id: ${content['t_id']} })' >Restaurar Version</button>" : "" ?>
                <?php } ?>
                <?= $viewhist ?  "<a class='dotdropdownlink' href='/articulo/${content['p_id']}/historia'>Ver Historia</a>" : "" ?>
                <?php if ($viewdetails) { ?> <a class='dotdropdownlink' href='/articulo/<?= $content['p_id'].($content['t_replaced_at'] ? "/historia/" . $content['t_id']  : "") ?>'>Detalles</a> <?php } ?>
                <?php if ($canedit){ ?>
                <a class="dotdropdownlink" href="/editar/<?= $content['p_id'] ?>">Editar</a>
                <button class="dotdropdownlink text-left" onclick="toggledelete({id:<?= $content['p_id'] ?>})"><?=!$isdeleted ? "Eliminar" : "Reestablecer (deseliminar)" ?> </button>
                <?php } ?>
            </div>
            <div class="lowercut"></div>

        </div>
    </div> <?php } ?>
    <?php if ($shadowcontain){ ?>
        <template>
            <link href="/cdn/tailwind.min.css" rel="stylesheet">
            <link href="/css/main.css" rel="stylesheet">
            <?php $displaysnippet(); ?>
        </template>
        <div class="snippetpreview" style="transform:scale(0.3);transform-origin: left top;width:90vw;height:90vh;overflow:hidden;position:absolute;"></div>
        <div class="pr-3 float-left" style="min-width:calc(90vw * 0.3);min-height:calc(90vh * 0.3);max-height:calc(90vh * 0.3)"><div class="snippetcover border pr-1 pb-1 " style="min-width:calc(90vw * 0.3);min-height:calc(90vh * 0.3);max-height:calc(90vh * 0.3)"></div></div> 

        <script>
            carticle=document.querySelector("#art-<?= $content['p_id'] ?>-<?= $content['t_id'] ?>");
            shadowroot=carticle.querySelector(".snippetpreview").attachShadow({mode: 'open'});
            shadowroot.appendChild(carticle.querySelector("template").content);
        </script>
    <?php } ?>
    <div style=" <?= $shadowcontain ? "min-height:calc(90vh * 0.3);" : "" ?> ">
        <h5 class="text-center hover:underline "><a href='/articulo/<?= $content['p_id'].($content['t_replaced_at'] ? "/historia/" . $content['t_id']  : "") ?>' class="hover:text-gray-900"><?= $title ? $content['p_title'] : "" ?></a></h1>
        <?php if (!($shadowcontain || $displayas=="snippet") ){ ?>  <style><?= $content['t_css'] ?></style> <?php } ?>
        <?php if ($dates){ ?>
            <span class="text-center text-neutral-500 leading-3	" style="font-size:0.6em;"> 
                Fecha: <?= $content['p_created_at'] ?>    
<?php if ($dates>0){ ?>|                
                Modificado: <?= $content['t_created_at'] ?>
                <?= $content['t_replaced_at'] ? "| Reemplazado:  ${content['t_replaced_at']}" : "" ?>
                <?= $content['p_deleted_at'] ? "| Borrado:  ${content['p_deleted_at']}" : "" ?>
                <?= $content['p_end_date'] ? "| Termina/o el:  ${content['p_end_date']}" : "" ?>
                <?= $showauthor ? "| Editado por:  ${content['u_name']}" : "" ?>
<?php } ?>                
            </span>
            <br>
        <?php } ?>
        
        <?php if ($showcategories){ ?>
            <div class="flex flex-wrap p-1/2 gap-2">
            <?php foreach ($showncategoryarr as $fcatid=>$fcat){ ?>

                <a href="/listado/<?= $fcat['urlname'] ?? $fcatid ?>" class="text-blue-800 font-medium text-xs leading-tight uppercase rounded transition duration-150 ease-in-out">
                    <?= $fcat['name'] ?>
                </a>

                <?= end($showncategoryarr)!=$fcat ? "<span class='text-gray-300 font-medium text-xs'> | </span>" : "" ?>

            <?php } ?>

            </div>
        <?php } ?>

        <?php if ($votephase){ ?>
            <div class="pr-3 pb-3 float-left">
            <div  class="inline-flex flex-wrap m-1 p-1 containerborder rounded justify-center">
            <?php foreach ($voteoptions as $vnum=>$vvote) { ?>
                <div class="inline-flex flex-col containerborder rounded m-1 p-1 ">
                    <button <?= $votephase==2 ? "disabled" : 'onclick="submitvote({id:'.$content['p_id'].',vote:'. $vnum.'})"' ?> class="containerborder rounded m-1 p-1 <?= $votephase==2 ? "bg-gray-200" : "bg-blue-300 hover:bg-blue-600 transition duration-150 ease-in-out" ?> ">
                        <?= $vvote ?>
                    </button>
                    <span class="text-center text-sm text-gray-400"><?= $votephase==2 ? ($votesresults[$vnum]['OccurenceValue']-1)." votos" : "" ?></span>

                </div>
            <?php } ?>
            </div>
            </div>
        <?php } ?>
        <div class="content <?=$votephase ? "pt-3":""?>" <?=$votephase ? "style='min-height:100px;'":""?>>
        <?= $content['t_content'] ?>
        </div>
    </div>
</div>
