var fillme=document.getElementById('fillme');
var i_radios = document.forms['fullform'].elements['type'];
var i_title = document.forms['fullform'].elements['title'];
var categoryarr = JSON.parse(permsdata);
var categories = document.getElementById('categories'); 
var originalcategories= categories.querySelectorAll('[data-original]');
var othercategories= categories.querySelectorAll('input:not([data-original])');
var parentcats= document.getElementById('parentcats');
var editorcontainer= document.getElementById('form2');
var currenteditor = 1;
var richtexthtmldata= isnew ? "" : t_content;
var codehtmldata= isnew ? "" : t_content;
var cssdata= isnew ? "" : t_css;
var editasbtn= document.getElementById('editas');
var htmleditor, csseditor;

var savedhtml={
    static: "Una pagina Sin Fecha. Se recomienda usar el editor html/css",
    post: "Una actualizacion, como anunciando un evento, pidiendo ayuda, etc. No se recomienda usar CSS.",
    vote: `Un voto. Cada usuario puede votar anonimamente
        <br><br>
        <label for="end_date">Fecha final</label>
        <input type="datetime-local" id="end_date" name="end_date" required>

        <br><br>
        
        <span class="my-3" >Opciones:</span>
        <div class="my-3" id="options"></div>
        <button type='button' id="addoption" onclick="addvoteoption()"  class="my-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">+</button>

    `,
    alert: "Una alerta. Aparece arriba de la pagina hasta que se borre. No se recomienda usar CSS.",
};

var radiocategories={
    4: "static",
    8: "post",
    16: "vote",
    32: "alert",
};
var checkboxcategories={
    "static": 2,
    "post": 3,
    "vote": 4,
    "alert": 5,
};

var prev="";


CodeMirror.commands.autocomplete = function(cm) {
    CodeMirror.showHint(cm, CodeMirror.hint.html);
}

function addvoteoption(name="", disabled=""){
    var options=document.getElementById('options');
    options.insertAdjacentHTML("beforeend", `
        <div class="flex p-2 border items-center justify-around" >
            <span>${options.children.length}: </span> 
            <input type="text" value="${name}" class="form-control block w-1/2 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
            <button onclick="rmoption(this.parentElement)" ${disabled} class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">-</button>
        </div>`);
}

function rmoption(poption){
    poption.remove();
    let optionsarr = document.getElementById('options').children;
    for (x=0; x<optionsarr.length; x++){
        optionsarr[x].children[0].innerHTML=x+optionsarr[x].children[0].innerHTML.substr(1);
    }
    

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
    });
}

function sethtmleditor(){
    editor.then(x=>{return (x.getData())}).then(x=>{
        richtexthtmldata=x;
        editorcontainer.innerHTML=`<div id='htmlcont'>HTML<div id='htmledit' class="border cmeditor"></div></div><div id='csscont'>CSS<div id='cssedit' class="border cmeditor"></div></div>`
        currenteditor=0;
        htmleditor = CodeMirror(editorcontainer.children['htmlcont'].children['htmledit'], {
            value: codehtmldata,
            mode:  "text/html",
            lineNumbers: true,
            styleActiveLine: true,
            matchBrackets: true,

            extraKeys: {
                "Ctrl-Space": "autocomplete"
            },

        });
        csseditor = CodeMirror(editorcontainer.children['csscont'].children['cssedit'], {
            value: cssdata,
            mode:  "css",
            lineNumbers: true,
            styleActiveLine: true,
            matchBrackets: true,

            extraKeys: {
                "Ctrl-Space": "autocomplete"
            },

        });
        editasbtn.innerHTML="Editar como Texto"
    });
};

function setrichtexteditor(){
    codehtmldata=htmleditor.getValue();
    cssdata=csseditor.getValue();
    editorcontainer.innerHTML=`<div name="texto" id="editor"></div>`;
    editor=ClassicEditor.create(document.querySelector('#editor'));
    editor.then(editorobj =>{editorobj.setData(richtexthtmldata)});
    editasbtn.innerHTML="Editar como HTML";
    currenteditor=1;

};

function swapeditor(){
    if (currenteditor){
        swapwarn(sethtmleditor);
    } else {
        swapwarn(setrichtexteditor);
    }
};

function swapwarn(after){
    Swal.fire({
        title: 'Cambiar de editor?',
        text: "Los editores no son compatibles. tus cambios se perderan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Cambiar'
      }).then((result) => {
        if (result.isConfirmed) {
          after();
        }
      })
}


function saverecipe(event){
    event.preventDefault();
    var formData =new FormData(document.getElementById("fullform"));
    //codigo muy mantenible
    formData.set('categories', JSON.stringify(Array.prototype.map.call(Array.prototype.filter.call(originalcategories, x=>x.checked && !x.parentElement.hidden), x=>x.getAttribute('data-cat'))));
    if (formData.get('type')=="vote" && isnew){
        formData.set('options', JSON.stringify(Array.prototype.map.call(document.getElementById('options').querySelectorAll('input'), x=>x.value)))
    }
    if (currenteditor){
        editor.then(x=>{return (x.getData())}).then(x=>{
            formData.set("content", x);
            if (typeof t_css !== 'undefined') {
                formData.set("css", t_css);
            }
            postform(formData);
        });
    } else {
        formData.set("content", htmleditor.getValue());
        formData.set("css", csseditor.getValue());
        postform(formData);
    }
}

function postform (formData){
    //formtext=`<form id='submitform' action="" method="POST">`;
    //for(var pair of formData.entries()) {
    //    console.log(pair);
    //    formtext+=`<input type="hidden" name="${pair[0]}" value="${pair[1]}" >`;
    //    console.log(`<input type="hidden" name="${pair[0]}" value="${pair[1]}" >`);  
    // }
    // formtext+=`</form>`;
    //document.body.insertAdjacentHTML( "beforeend", formtext );
    //document.getElementById("submitform").submit()

    fetch("/api/v1/edit", {
        method:"POST",
        body:formData,
        credentials: 'same-origin', 
        mode: 'same-origin',
        cache: 'no-cache',
    })
    .then(CheckError)
    .then((jsonResponse) => {
        var newpostnumber = jsonResponse; 
        Swal.fire({
            title: 'El post se ha creado/editado correctamente',
            icon: 'success',
          }).then((jsonResponse) => {
              console.log(jsonResponse);
              if (isnew) {
                  window.location.href=window.location.origin+`/articulo/${newpostnumber}`
              } else {
                window.location.href=window.location.origin+`/articulo/${p_id}`

              }  
          });
    }).catch((error) => {
        console.log(error);
        Swal.fire({
            title: 'El post no se ha creado/editado',
            icon: 'error',
            text: error,
            showCancelButton: true,
            confirmButtonText: 'Reintentar',

        })
        .then((result) => {
            if (result.isConfirmed) {
                postform (formData);
            }   
        });
    });
  

    
}


for(var i = 0, max = i_radios.length; i < max; i++) {
    i_radios[i].onclick = function() {
        
        savedhtml[prev] = fillme.innerHTML;
        fillme.innerHTML = savedhtml[this.value];
        prev = this.value
        refreshcats();
    }
}

//setup

var editor=ClassicEditor.create(document.querySelector('#editor'))
    .catch(error =>{
    });
if (!isnew){
    i_title.value=p_title;
    i_title.disabled=true;
    editor.then(editorobj =>{editorobj.setData(t_content)});

    var selectedradio = radiocategories[Number(BigInt(p_category) & BigInt(60))];
    document.getElementById(selectedradio).checked = true;
    fillme.innerHTML = savedhtml[selectedradio];
    prev = selectedradio;
    i_radios.forEach(x=>x.disabled=true);
    if ((Number(BigInt(p_category) & BigInt(60)))==16){ //votes
        var options=document.getElementById('options');
        document.getElementById('addoption').disabled=true;
        var i_enddate=document.getElementById('end_date');
        i_enddate.disabled=true;
        i_enddate.value=p_end_date;
        JSON.parse(p_options).forEach(x=>addvoteoption(x, "disabled"));
    }
    if (t_css && t_css!="/*CSS:DEFAULT*/"){
        sethtmleditor();
    }
}
refreshcats();