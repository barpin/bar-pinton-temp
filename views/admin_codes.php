<h1>Admin codigos</h1>
<br>
<br>
✏️=edit, ❌=delete
<table border="1">
    <tr>
<?php foreach ($tablehead as $reg){
    echo "<th>${reg}</th>   ";
} ?>
    <th colspan="2" >Actions</th>
    </tr>
<?php foreach ($codeslist as $row){
        echo "<tr id='c${row['id']}'>";
        foreach ($row as $tdclass=>$reg){
            echo "<td class='${tdclass}'>${reg}</td>";
        }

        echo "<td class='edit'><button onclick=\"editrow(${row['id']})\">✏️</button></td><td class='delete'><button onclick=\"delrow(${row['id']})\">❌</button></td></tr>";
} ?>
</table>
<br><br>

<form id="fullform" onsubmit="return newcode(event)" class="border-2 border-gray rounded m-1">
<h3>Nuevo codigo</h3>
<br>
<label for="name">Nombre Completo / Iniciales y Apellido</label>
    <input name="name" type="text" maxlength="64" class="form-control block w-1/2 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
   <br>
   <span>Permisos de Usuario</span>
    <div id="parentcats" class="border-2 border-gray rounded m-1">
    <?php foreach ($permsdata as $category){ ?>
        <div class="relative inline-flex">
            <div class="top-0 inline-flex items-center m-1 border justify-around">
                <input type="checkbox" class="mx-1 checkbox category" <?= "data-cat='${category['id']}'" ?>> 
                <span class="mx-1"><?= $category['name'] ?></span>
            </div> 
            <div class="background"></div> 
        </div> 
    <?php } ?>
    </div>
    <input type="submit">
</form>
