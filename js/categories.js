var olddata={};
var originalcategories = document.querySelectorAll(".parentcategory");
console.log(originalcategories);
var prev="";
var checkboxcategories = {
    secretaria:6,
    comision:7,
    club:8,
    otra:0,
};
var categoryarr = JSON.parse(permsdata);


function newcat(event){
    event.preventDefault();
    var formData =new FormData(document.getElementById("fullform"));
    formData.set('perms', JSON.stringify(Array.prototype.map.call(Array.prototype.filter.call(originalcategories, x=>x.checked), x=>x.getAttribute('data-cat'))));

    fetch("/api/v1/categories", { method:"POST", body:formData, credentials: 'same-origin', mode: 'same-origin', cache: 'no-cache', })
    .then(CheckError)
    .then((jsonResponse) => {
        var newpostnumber = jsonResponse; 
        Swal.fire({ title: 'La categoria se ha creado correctamente', icon: 'success', })
        .then((jsonResponse) => {
                window.location.reload(true);                
        });
    }).catch((error) => {
        console.log(error);
        Swal.fire({ title: 'El categoria no se ha creado', icon: 'error', text: error, showCancelButton: true, confirmButtonText: 'Reintentar',})
        .then((result) => {
            if (result.isConfirmed) {
                newcat (formData);
            }   
        });
    });
}

var editablefields=["name", "urlname", "parents"];

function editrow(id){
    let row=document.querySelector(`#c${id}`);

    olddata[id]={};


    editablefields.forEach(x=>{
        olddata[id][x]=row.querySelector('.'+x).innerHTML;
        row.querySelector('.'+x).innerHTML=`<input type="text" class="form-control block w-full px-2 py-1 text-sm font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">`;
        row.querySelector('.'+x).childNodes[0].value=olddata[id][x];

    });
    row.querySelector('.edit').innerHTML=`<button onclick='modcat(${id})'>✔</button><button  onclick='cancelmod(${id})'>✖</button>`;
    
}

function cancelmod(id){
    let row=document.querySelector(`#c${id}`);
    editablefields.forEach(x=>{
        row.querySelector('.'+x).innerHTML=olddata[id][x];
    });
    row.querySelector('.edit').innerHTML=`<button onclick=\"editrow(${id})\">✏️</button>`;
}

function modcat(id){
    var row=document.querySelector(`#c${id}`);
    var formData= new FormData();
    formData.set("id", row.querySelector(".id").innerHTML);
        
    editablefields.forEach(x=>{
        formData.set(x, row.querySelector("."+x).childNodes[0].value);
    }); 

    fetch("/api/v1/categories", { method:"POST", body:formData, credentials: 'same-origin', mode: 'same-origin', cache: 'no-cache', })
    .then(CheckError)
    .then((jsonResponse) => {
        var newpostnumber = jsonResponse; 
        Swal.fire({ title: 'La categoria se ha modificado correctamente', icon: 'success', })
        .then((jsonResponse) => {

            for (const [key, value] of formData) {
                olddata[id][key]=value;
            }
            cancelmod(id);
        });
    }).catch((error) => {
        console.log(error);
        Swal.fire({ title: 'El categoria no se ha modificado', icon: 'error', text: error, showCancelButton: true, confirmButtonText: 'Reintentar',})
        .then((result) => {
            if (result.isConfirmed) {
                modcat (id);
            }   
        });
    });
}

function delrow(id){
    Swal.fire({ title: 'Estas segur@ de que queres borrar/rehabilitar esta categoria?', text:"Seguira siendo accesible, pero no estara mas en la barra de navegacion", icon: 'warning',  showCancelButton: true, confirmButtonText: 'Si',})
        .then((result) => {
            if (result.isConfirmed) {
                var formData = new FormData();
                formData.set("delete", 1);
                formData.set("id", id);
                fetch("/api/v1/categories", { method:"POST", body:formData, credentials: 'same-origin', mode: 'same-origin', cache: 'no-cache', })
                .then(CheckError)
                .then((jsonResponse) => {
                    Swal.fire({ title: 'La categoria se ha eliminado/rehabilitado correctamente', icon: 'success', });
                    window.location.reload(true);       
                }).catch((error) => {
                    console.log(error);
                    Swal.fire({ title: 'La categoria no se ha eliminado/rehabilitado', icon: 'error', text: error, showCancelButton: true, confirmButtonText: 'Reintentar',})
                    .then((result) => {
                        if (result.isConfirmed) {
                            delrow(id);
                        }   
                    });
                });
            }   
        });
}



function refreshcats(){
    var reqcats= new Set();
    originalcategories.forEach(x=>{
        if (x.checked){
            binarydecompose(categoryarr[x.getAttribute('data-cat')]['parents']).forEach(y=>reqcats.add(Math.round(Math.log(y)/Math.log(2))));
        }
    });
    reqcats.add(0);
    if (prev){
        reqcats.add(checkboxcategories[prev]);
    }
    inputstr=""
    reqcats.forEach(z=>{
        inputstr+=`
            <div class="relative">
                <div class="top-0 flex items-center m-1 border justify-around">
                    <input type="checkbox" class="mx-1 checkbox" disabled checked data-cat='${z}'" > 
                    <span class="mx-1">${categoryarr[z]['name']}</span>
                </div> 
                <div class="background"></div> <!--TODO hocer que aparezca un color cuando esta seleccionado-->
            </div> 
        `;
    });
    parentcats.innerHTML=inputstr;
    originalcategories.forEach(w=>{
        w.parentElement.hidden = reqcats.has(parseInt(w.getAttribute(['data-cat'])));
        w.checked = reqcats.has(parseInt(w.getAttribute(['data-cat']))) ? false : w.checked ; 
    });
}

refreshcats();