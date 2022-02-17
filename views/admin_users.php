<h1>Admin Usuarios</h1>
<br>
<br>
✏️=editar, ❌=eliminar, ↻=renovar, <?= $isroot ?  "🗑=eliminar permanentemente" : '' ?>
<table border="1">
    <tr>
<?php foreach ($tablehead as $reg){
    echo "<th>${reg}</th>   ";
} ?>
    <th colspan="<?= $isroot ? 4 : 3 ?>" >Actions</th>
    </tr>
<?php foreach ($userlist as $row){
        echo "<tr id='c${row['id']}'>";
        foreach ($row as $tdclass=>$reg){
            echo "<td class='${tdclass}'>${reg}</td>";
        }
        if ($row['id']){ //disable for root (id=0)
            ?>
                <td class='edit'>
                    <button onclick="editrow(<?= $row['id'] ?>)">✏️</button>
                </td>
                <td class='delete'>
                    <button onclick="delrow(<?= $row['id'] ?>)">❌</button>
                </td>
                <td class='refresh'>
                    <button onclick="refrow(<?= $row['id'] ?>)">↻</button>
                </td>
                <?php if ($isroot){ ?>
                <td class='purge'>
                    <button onclick="purgerow(<?= $row['id'] ?>)">🗑</button>
                </td>
                <?php } ?>
            </tr>
            <?php
        }
} ?>
</table>
<br><br>
