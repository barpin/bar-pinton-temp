<script>
    var olddata={};
    var originalcategories = document.getElementsByClassName("category");
    function newcode(event){
        event.preventDefault();
        var formData =new FormData(document.getElementById("fullform"));
        formData.set('perms', JSON.stringify(Array.prototype.map.call(Array.prototype.filter.call(originalcategories, x=>x.checked), x=>x.getAttribute('data-cat'))));

        fetch("/api/v1/codes", { method:"POST", body:formData, credentials: 'same-origin', mode: 'same-origin', cache: 'no-cache', })
        .then(CheckError)
        .then((jsonResponse) => {
            var newpostnumber = jsonResponse; 
            Swal.fire({ title: 'El codigo se ha creado correctamente', icon: 'success', })
            .then((jsonResponse) => {
                    window.location.reload(true);                
            });
        }).catch((error) => {
            console.log(error);
            Swal.fire({ title: 'El codigo no se ha creado', icon: 'error', text: error, showCancelButton: true, confirmButtonText: 'Reintentar',})
            .then((result) => {
                if (result.isConfirmed) {
                    newcode (formData);
                }   
            });
        });
    }

    function editrow(id){
        let row=document.querySelector(`#c${id}`);
        /*wrapperform=document.createElement("form");
        wrapperform.id=`f${id}`;
        wrapperform.onsubmit=`modcode(${id})`;
        row.parentNode.replaceChild(wrapperform,row);
        wrapperform.appendChild(row);*/

        olddata[id]=[row.querySelector('.name').innerHTML , row.querySelector('.perms').innerHTML];

        row.querySelector('.name').innerHTML=`<input type="text" class="form-control block w-full px-2 py-1 text-sm font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">`;
        row.querySelector('.name').childNodes[0].value=olddata[id][0];
        row.querySelector('.perms').innerHTML=`<input type="number" value="${olddata[id][1]}" class="form-control block w-full px-2 py-1 text-sm font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">`;
        row.querySelector('.perms').childNodes[0].value=olddata[id][1];
        row.querySelector('.edit').innerHTML=`<button onclick='modcode(${id})'>✔</button><button  onclick='cancelmod(${id})'>✖</button>`;
        
    }

    function cancelmod(id){
        let row=document.querySelector(`#c${id}`);
        row.querySelector('.name').innerHTML=olddata[id][0];
        row.querySelector('.perms').innerHTML=olddata[id][1];
        row.querySelector('.edit').innerHTML=`<button onclick=\"editrow(${id})\">✏️</button>`;
    }

    function modcode(id){
        var row=document.querySelector(`#c${id}`);
        var formData= new FormData();
        formData.set("id", row.querySelector(".id").innerHTML);
        var nameval=row.querySelector(".name").childNodes[0].value; //pq no se puede pasar como parametro al then?
        var permsval=row.querySelector(".perms").childNodes[0].value;
        formData.set("name", nameval);
        formData.set("perms", permsval);
        fetch("/api/v1/codes", { method:"POST", body:formData, credentials: 'same-origin', mode: 'same-origin', cache: 'no-cache', })
        .then(CheckError)
        .then((jsonResponse) => {
            var newpostnumber = jsonResponse; 
            Swal.fire({ title: 'El codigo se ha modificado correctamente', icon: 'success', })
            .then((jsonResponse) => {

                olddata[id]=[nameval , permsval];
                cancelmod(id);
            });
        }).catch((error) => {
            console.log(error);
            Swal.fire({ title: 'El codigo no se ha modificado', icon: 'error', text: error, showCancelButton: true, confirmButtonText: 'Reintentar',})
            .then((result) => {
                if (result.isConfirmed) {
                    newcode (formData);
                }   
            });
        });
    }

    function delrow(id){
        Swal.fire({ title: 'Estas segur@ de que queres borrar este codigo y su usuario correspondiente?', icon: 'warning',  showCancelButton: true, confirmButtonText: 'Si',})
            .then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData();
                    formData.set("delete", 1);
                    formData.set("id", id);
                    fetch("/api/v1/codes", { method:"POST", body:formData, credentials: 'same-origin', mode: 'same-origin', cache: 'no-cache', })
                    .then(CheckError)
                    .then((jsonResponse) => {
                        Swal.fire({ title: 'El codigo se ha eliminado correctamente', icon: 'success', });
                        document.querySelector(`#c${jsonResponse}`).remove();
                    }).catch((error) => {
                        console.log(error);
                        Swal.fire({ title: 'El codigo no se ha eliminado', icon: 'error', text: error, showCancelButton: true, confirmButtonText: 'Reintentar',})
                        .then((result) => {
                            if (result.isConfirmed) {
                                delrow(id);
                            }   
                        });
                    });
                }   
            });
    }

</script>
<h1>Admin codigos</h1>
<br>
<br>
<table border="1">
    <tr>
<?php foreach ($tablehead as $reg){
    echo "<th>${reg['Field']}</th>   ";
} ?>
    <th>Edit</th>
    <th>Delete</th>
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
<h1>Nuevo codigo</h1>
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
