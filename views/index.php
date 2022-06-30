<header class="header">
    <div class="flex flex-column items-center justify-center w-full h-full">
        <div class="flex gap-5" style="transform: translateY(5%);">
            <picture class="h-32 w-32 lg:h-64 lg:w-64" style="transform:translatey(-17%)">
                <source srcset="/img/suizablanco.png" type="image/png"> 
                <img src="/img/suizablanco.png" alt="Logo">
            </picture>
        </div>
        <div style="transform:translateY(-20%);" class="navbartexts flex flex-column items-center justify-center">
            <span class="text-3xl lg:text-5xl text-white">CENTRO DE</span>
            <span class="text-3xl lg:text-5xl text-white">ESTUDIANTES</span>
            <span class="text-xl text-white">ESCUELA TECNICA N 26</span>
            <span class="text-xl text-white">"CONFEDERACION SUIZA"</span>
        </div>
    </div>
</header> 
<div style="height: 70vh;width:100vw;">

</div>
<div class="flex gap-2 flex-column w-full">
    <div class="flex justify-evenly flax-wrap flex-row postrow">
        <div class="mt-1 w-2/5 h-full min-w-min overflow-hidden indpost">
            <?php $nxtarticle($entries) ?>
        </div>
        <div class="mt-1 w-1/5 h-full min-w-min overflow-hidden  indpost">
            <?php $nxtarticle($entries, 200) ?>
        </div> 
        <div class="w-1/5 gap-1 h-full flex flex-column">
            <div class="mt-1 w-full h-full overflow-hidden  indpost">
                <?php $nxtarticle($entries, 70) ?>
            </div>
            <div class="mt-1 w-full h-full overflow-hidden  indpost">
                <?php $nxtarticle($entries, 70) ?>
            </div>
        </div>
    </div>
    <div class="flex justify-evenly flax-wrap flex-row postrow">
        <div class="w-1/5 gap-1 h-full flex flex-column">
            <div class="mt-1 w-full h-full overflow-hidden  indpost">
                <?php $nxtarticle($entries, 70) ?>
            </div>
            <div class="mt-1 w-full h-full overflow-hidden  indpost">
                <?php $nxtarticle($entries, 70) ?>
            </div>
        </div>    
    
        <div class="mt-1 w-1/5 h-full min-w-min overflow-hidden  indpost">
            <?php $nxtarticle($entries, 200) ?>
        </div> 
        
        <div class="mt-1 w-2/5 h-full min-w-min overflow-hidden indpost">
            <?php $nxtarticle($entries, ) ?>
        </div>
    </div>
    <br>
    <hr>
    <br>
    <div class="flex justify-evenly flax-wrap flex-row postrow">
        <div class="mt-1 w-1/5 h-full min-w-min overflow-hidden  indpost">
            <?php $nxtarticle($sccentries, 200) ?>
        </div>     
        <div class="mt-1 w-1/5 h-full min-w-min overflow-hidden  indpost">
            <?php $nxtarticle($sccentries, 200) ?>
        </div> 
        <div class="mt-1 w-1/5 h-full min-w-min overflow-hidden  indpost">
            <?php $nxtarticle($sccentries, 200) ?>
        </div> 
        
        <div class="mt-1 w-1/5 h-full min-w-min overflow-hidden  indpost">
            <?php $nxtarticle($sccentries, 200) ?>
        </div> 
    </div>

</div>
<style>

.header {
    top:0;
    z-index:-1;
  	height: 80vh;
    width:100vw;
  	background-image:url('/img/fdo-quinto-lores.jpg');
    background-size:100px 100px, 100px 100px, 25px 25px, 25px 25px, cover, cover;
    background-position:-2px -2px, -2px -2px, -1px -1px, -1px -1px, top, top;  	
  	position: absolute;
  	clip-path: polygon(0 0, 100vw 0, 100vw 100%, 0 65vh);
}
.navbar{
    background-color: transparent !important;
    position: sticky !important;
}

@media screen and (max-width: 600px) {
    .navbartexts{
        transform:translateY(-10%) !important;
    }
    .header{
        clip-path: polygon(0 0, 100vw 0, 100vw 100%, 0 70vh);
    }
    .postrow{
        flex-direction: column !important;
        margin-left: 5vw;
        width:90vw
    }
    .indpost{
        width:90vw

    }
    
}
    </style>

<?php /*
    <!-- Empieza el carrousel -->
     
    <!-- Termina el carrousel -->
    <!-- Empieza el infinite scroll -->
        <div id="divContent">
oh
        </div>
        <div id="listEnd">
            Cargando mas items...
        </div>
        <br/>
    </div>
    <!-- Termina el infinite scroll -->
    <!-- Empieza el footer -->
    <!-- Termina el footer -->
    <script>
        let divContent = document.getElementById('divContent');
        let listEnd = document.getElementById('listEnd');
        let itemCount = 0;
        let appending = false;

        window.addEventListener('DOMContentLoaded', load)
        function load() {
            addItems();
        }
        function addItems(){ // Con esta funcion hacemos que se vea en la pantalla determinados divs
            appending = true;
            for(let i = 0; i < 20; i++){ // El comentario de arriba, se concatena con esto ya que el numero maximo del i, es la cantidad de items que nos va a mostrar en pantalla. 
                let item = generateDataBlock(['Este es el item #', itemCount].join(''));
                divContent.appendChild(item);
                itemCount++;
            }
            appending = false;
        }
        function generateDataBlock(message){ // Con esta funcion generamos, traducido, "bloques de datos" que son los divs que vemos en la pagina.
            let item = document.createElement('div');
            item.setAttribute('class', 'item');
            item.textContent = message;
            return item; // Esto es lo que hace que siempre se vaya incrementando mas divs
        }
        let options = {
            root: null,
            rootMargin:'0px',
            threshold:1.0
        };
        let callback = (entries, observer)=>{ // Con esta funcion vamos a hacer que se muestre la fila de divs
            entries.forEach(entry => {
                if(entry.target.id === 'listEnd'){
                    if(entry.isIntersecting && !appending){
                        appending = true;
                        setTimeout(() =>{
                            addItems();
                        }, 1000); // Ese numero, nos va a decir el tiempo en el que va a "esperar" para mostrar los demas elementos
                    }
                }
            });
        };
        let observer = new IntersectionObserver(callback, options);
        observer.observe(listEnd);
    </script>

<!-- --------------------------Este es el verdadero comentario, con el estilo y todo----------------------------------- -->
<!--   <div class="container">
        <div class="noticias border border-gray-400 p-2">
            <div class="noticia bg-red-200 rounded-md p-2 border-2 border-gray-400">
                <div class="noticia-content bg-red-100 rounded-md">
                    <div class="separacion m-2 p-2">
                        <div class="info-usuarios flex flex-wrap items-center">
                            <img src="logo.jpg" alt="" class="w-20">
                            <p class="mx-2">Nombre Apellido y Horario en el que se subio</p>
                        </div>
                        <hr class="mt-2">
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum explicabo possimus eveniet molestias similique sed, vel facilis architecto praesentium dolorum, repellendus doloribus? Itaque debitis vero maxime quo nihil accusantium repellat! Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis neque ex id molestias veritatis quam praesentium reiciendis exercitationem placeat ipsa culpa, vel quaerat, veniam, recusandae quibusdam possimus voluptas asperiores mollitia.</p> 
                    </div>
                </div>
            </div>
            <div class="noticia bg-red-200 rounded-md p-2 mt-2 border-2 border-gray-400">
                <div class="noticia-content bg-red-100 rounded-md">
                    <div class="separacion m-2 p-2">
                        <div class="info-usuarios flex flex-wrap items-center">
                            <img src="logo.jpg" alt="" class="w-20">
                            <p class="mx-2">Nombre Apellido y Horario en el que se subio</p>
                        </div>
                        <hr class="mt-2">
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum explicabo possimus eveniet molestias similique sed, vel facilis architecto praesentium dolorum, repellendus doloribus? Itaque debitis vero maxime quo nihil accusantium repellat! Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis neque ex id molestias veritatis quam praesentium reiciendis exercitationem placeat ipsa culpa, vel quaerat, veniam, recusandae quibusdam possimus voluptas asperiores mollitia.</p> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->



*/?>