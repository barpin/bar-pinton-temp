var olddata={};
var originalcategories = document.getElementsByClassName("category");
var editablefields=["name", "nickname", "perms", "email"];

function editrow(id){
    let row=document.querySelector(`#c${id}`);

    olddata[id]={};


    editablefields.forEach(x=>{
        olddata[id][x]=row.querySelector('.'+x).innerHTML;
        row.querySelector('.'+x).innerHTML=`<input type="text" class="form-control block w-full px-2 py-1 text-sm font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">`;
        row.querySelector('.'+x).childNodes[0].value=olddata[id][x];

    });
    row.querySelector('.edit').innerHTML=`<buttoSn onclick='moduser(${id})'>✔</button><button  onclick='cancelmod(${id})'>✖</button>`;
    
}

function cancelmod(id){
    let row=document.querySelector(`#c${id}`);
    editablefields.forEach(x=>{
        row.querySelector('.'+x).innerHTML=olddata[id][x];
    });
    row.querySelector('.edit').innerHTML=`<button onclick=\"editrow(${id})\">✏️</button>`;
}

function moduser(id){
    var row=document.querySelector(`#c${id}`);
    var formData= new FormData();
    formData.set("id", row.querySelector(".id").innerHTML);
        
    editablefields.forEach(x=>{
        formData.set(x, row.querySelector("."+x).childNodes[0].value);
    }); 

    fetch("/api/v1/users", { method:"POST", body:formData, credentials: 'same-origin', mode: 'same-origin', cache: 'no-cache', })
    .then(CheckError)
    .then((jsonResponse) => {
        var newpostnumber = jsonResponse; 
        Swal.fire({ title: 'El Usuario se ha modificado correctamente', icon: 'success', })
        .then((jsonResponse) => {

            for (const [key, value] of formData) {
                olddata[id][key]=value;
            }
            cancelmod(id);
        });
    }).catch((error) => {
        console.log(error);
        Swal.fire({ title: 'El ususario no se ha modificado', icon: 'error', text: error, showCancelButton: true, confirmButtonText: 'Reintentar',})
        .then((result) => {
            if (result.isConfirmed) {
                moduser (id);
            }   
        });
    });
}

function delrow(id){
    
    var formData = new FormData();
    formData.set("delete", 1);
    formData.set("id", id);
    fetch("/api/v1/users", { method:"POST", body:formData, credentials: 'same-origin', mode: 'same-origin', cache: 'no-cache', })
    .then(CheckError)
    .then((jsonResponse) => {
        Swal.fire({ title: 'El ususario se ha eliminado/restaurado correctamente', icon: 'success', });
        window.location.reload(true);  
    }).catch((error) => {
        console.log(error);
        Swal.fire({ title: 'El ususario no se ha eliminado/restaurado', icon: 'error', text: error, showCancelButton: true, confirmButtonText: 'Reintentar',})
        .then((result) => {
            if (result.isConfirmed) {
                delrow(id);
            }   
        });
    });
}


function refrow(id){
    
    var formData = new FormData();
    formData.set("refresh", 1);
    formData.set("id", id);
    fetch("/api/v1/users", { method:"POST", body:formData, credentials: 'same-origin', mode: 'same-origin', cache: 'no-cache', })
    .then(CheckError)
    .then((jsonResponse) => {
        Swal.fire({ title: 'El ususario se ha renovado correctamente', icon: 'success', });
        window.location.reload(true);  
    }).catch((error) => {
        console.log(error);
        Swal.fire({ title: 'El ususario no se ha renovado', icon: 'error', text: error, showCancelButton: true, confirmButtonText: 'Reintentar',})
        .then((result) => {
            if (result.isConfirmed) {
                refrow(id);
            }   
        });
    });
}

function purgerow(id){
    Swal.fire({ title: 'ESTAS SEGUR@ DE QUE QUERES BORRAR ESTE USUARIO? ', text:'ESTO NO SE PUEDE DESHACER, CONSIDERA BORRAR AL USUARIO POR EL METODO NORMAL', icon: 'warning',  showCancelButton: true, confirmButtonText: 'Si',})
        .then((result) => {
            if (result.isConfirmed) {
                var formData = new FormData();
                formData.set("purge", 1);
                formData.set("id", id);
                fetch("/api/v1/users", { method:"POST", body:formData, credentials: 'same-origin', mode: 'same-origin', cache: 'no-cache', })
                .then(CheckError)
                .then((jsonResponse) => {
                    Swal.fire({ title: 'El ususario se ha eliminado correctamente', icon: 'success', });
                    document.querySelector(`#c${jsonResponse}`).remove();
                }).catch((error) => {
                    console.log(error);
                    Swal.fire({ title: 'El usuario no se ha eliminado', icon: 'error', text: error, showCancelButton: true, confirmButtonText: 'Reintentar',})
                    .then((result) => {
                        if (result.isConfirmed) {
                            purgerow(id);
                        }   
                    });
                });
            }   
        });
}