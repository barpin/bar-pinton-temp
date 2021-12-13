<!doctype html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
    /* --- Aca inicia el carrousel --- */
    
    /* --- Aca esta todo lo de la Api, el css que despues lo tengo que hacer con tailwind --- */
    #divContent{
        width: 307px;
        display: block;
        margin: 0 auto;
        border: 2px solid black;
        text-align: center;
    }
    #listEnd{
        width: 400px;
        display: block;
        margin-left: auto;
        margin-top: auto;
        margin-top: 5px;
        margin-bottom: 5px;
        border: 2px solid black;
        text-align: center;
    }
    .item{
        width: 300px;
        height: 50px;
        margin-left: auto;
        margin-rigth: auto;
        margin-top: 5px;
        margin-bottom: 5px;
        border: 1px solid black;
        text-align: center;
        line-height: 50px;
    }
</style>
</head>
<body>
    <?php include_once 'partials/navbar.php' ?>
    <!-- Empieza el carrousel -->
    
    <!-- Termina el carrousel -->
    <!-- Empieza el infinite scroll -->
        <div id="divContent">

        </div>
        <div id="listEnd">
            Cargando mas items...
        </div>
        <br/>
    </div>
    <!-- Termina el infinite scroll -->
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
</body>
</html>
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
</body>
</html>