<h1>Admin Categorias</h1>
<br>
<br>
✏️=editar, ❌=desactivar
<table border="1">
    <tr>
<?php foreach ($tablehead as $reg){
    echo "<th>${reg}</th>   ";
} ?>
    <th colspan="2" >Actions</th>
    </tr>
<?php foreach ($categorylist as $row){
        echo "<tr id='c${row['id']}'>";
        foreach ($row as $tdclass=>$reg){
            echo "<td class='${tdclass}'>${reg}</td>";
        }
        if ($row['id']>=20){ 
            ?>
                <td class='edit'>
                    <button onclick="editrow(<?= $row['id'] ?>)">✏️</button>
                </td>
                <td class='delete'>
                    <button onclick="delrow(<?= $row['id'] ?>)">❌</button>
                </td>
            </tr>
            <?php
        }
} ?>
</table>
<br><br>
<br><br>

<form id="fullform" onsubmit="return newcat(event)" class="border-2 border-gray rounded m-1">
    <h3>Nueva categoria</h3>
    <b>Cuidado! Las categorias creadas no se pueden eliminar permanentemente, solo desactivadas, y hay un limite de 64 categorias</b>
    <br>
    <label for="id">Id</label>
    <input name="id" type="number" min="0" max="63" required class="form-control block w-1/2 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
    <br>
    <label for="name">Nombre</label>
    <input name="name" type="text" maxlength="64" required class="form-control block w-1/2 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
    <br>
    <label for="urlname">URL</label>
    <input name="urlname" type="text" maxlength="32" class="form-control block w-1/2 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
    <div class="border">
        <div class="m-6">
        <div class="flex justify-around">
            <input type="radio" id="secretaria" name="type" value="secretaria" onclick="prev = this.value;refreshcats();" required>
            <label for="secretaria">Secretaria</label><br>
            <input type="radio" id="comision" name="type" value="comision" onclick="prev = this.value;refreshcats();">
            <label for="comision">Comision</label><br>
            <input type="radio" id="club" name="type" value="club" class="type" onclick="prev = this.value;refreshcats();">
            <label for="club">Club</label>  <br>  
            <input type="radio" id="otra" name="type" value="otra" class="type" onclick="prev = this.value;refreshcats();">
            <label for="otra">Otra</label>  <br>  
        </div>
        <div class="m-6">
        <div id="fillme"></div>
        </div>
        </div>
    </div>
    <br>
    <span>Categorias Padre</span>
    <div class="allcats border-2 border-gray rounded m-1 flex flex-wrap">
    <div id="parentcats" class="flex"></div>
    <?php foreach ($permsdata as $category){ ?>
        <div class="relative inline-flex">
            <div class="top-0 inline-flex items-center m-1 border justify-around">
                <input type="checkbox" class="mx-1 checkbox parentcategory" <?= "data-cat='${category['id']}'" ?> onclick="refreshcats()"> 
                <span class="mx-1"><?= $category['name'] ?></span>
            </div> 
            <div class="background"></div> 
        </div> 
    <?php } ?>
    </div>
    <input type="submit">
</form>
