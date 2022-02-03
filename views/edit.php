

<form action="" method="POST" id="fullform" style="width:70vw;margin:3vw;padding:3vw;border:1px solid #333">
    <input name="title" type="text" maxlength="128" placeholder="Titulo" required class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
    <br><br>
    <div id="categories" style="border:1px solid #333;padding:3vw;display:flex;flex-wrap:wrap;">
		<?php foreach ($permsdata as $category){ ?>
			<div style="display:flex;align-items:center;margin:0.5vw;border:1px solid #333;border-radius:3px;gap:0.5vw;justify-content:space-around;">
				<input type="checkbox" style="margin-left:0.5vw" <?= ( $new && $category['id']!=0 )  ? "" : "disabled checked" ?>> <?= $category['name'] ?> <div class="background"></div>
			</div> 
		<?php } ?>
    </div>
	<br><br>
	<span class="text-xl">Contenido</span> <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar como HTML</button>
	<div class="form2">
		<div name="texto" id="editor"></div>
	</div>
	<br><br>
	
	<textarea name="content" id="text-area" style="display:none;"></textarea>
	<?php if (isset($article)){ ?>
		<input id='id' name='id' type='hidden' value='<?php echo $article; ?>'>
	<?php }  ?>
   
    <div style="border:1px solid #333; ">
		<div style="margin:3vw">
		<div style="display:flex;justify-content:space-around;">
			<input type="radio" id="static" name="type" value="static" disabled>
			<label for="static">Estatico</label><br>
			<input type="radio" id="post" name="type" value="post">
			<label for="post">Post</label><br>
			<input type="radio" id="vote" name="type" value="vote">
			<label for="vote">Voto</label><br>
			<input type="radio" id="alert" name="type" value="alert" class="type">
			<label for="alert">Alerta</label>  <br>  
		</div>
		<div style="margin:3vw">
		<div id="fillme"></div>
		</div>
		</div>
    </div>
    
	<br><br>
	<input type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
</form>


<script>
    var fillme=document.getElementById('fillme');
	var i_radios = document.forms['fullform'].elements['type'];
	var i_title = document.forms['fullform'].elements['title'];

	
	var savedhtml={
		static: "Una pagina Sin Fecha",
		post: "Una actualizacion, como anunciando un evento, pidiendo ayuda, etc. No se recomienda usar CSS.",
		vote: `Un voto. Cada usuario puede votar anonimamente
			<br><br>
			<label for="end_date">Fecha final</label>
			<input type="datetime-local" id="end_date" name="end_date">

			<br><br>
			
			<span style="margin: 1.5vw 0;">Opciones:</span>
			<div style="margin: 1.5vw 0;" id="options"></div>
			<button id="addoption" onclick="addoption()" style="margin: 1.5vw 0;" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">+</button>

		`,
		alert: "Una alerta. Aparece arriba de la pagina hasta que se borre. No se recomienda usar CSS.",
	};

	var radiocategories={
		4: "static",
		8: "post",
		16: "vote",
		32: "alert",
	};
	
	var prev="none";

	

	function addoption(name="", disabled=""){
		var options=document.getElementById('options');
		options.innerHTML+=`
			<div style="display:flex;padding:1vw;border:1px solid #333;align-items:center;justify-content:space-around;">
				<span>${options.children.length}: </span> 
				<input type="text" value=${name}>
				<button onclick="rmoption(this.parent)" ${disabled} class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">-</button>
			</div>`;
	}

	for(var i = 0, max = i_radios.length; i < max; i++) {
		i_radios[i].onclick = function() {
			
			savedhtml[prev] = fillme.innerHTML;
			fillme.innerHTML = savedhtml[this.value];
			prev = this.value

			console.log(this);
		}
	}

//setup

	var editor=ClassicEditor.create(document.querySelector('#editor'))
		.catch(error =>{
			//console.log('Error');
		});
	if (!isnew){
		i_title.value=p_title;
		i_title.disabled=true;
		editor.then(editorobj =>{editorobj.setData(t_content)});

		var selectedradio = radiocategories[p_category & 60];
		document.getElementById(selectedradio).checked = true;
		fillme.innerHTML = savedhtml[selectedradio];
		prev = selectedradio;
		i_radios.forEach(x=>x.disabled=true);
		if (p_category & 60==16){ //votes
			var options=document.getElementById('options');
			document.getElementById('addoption').disabled=true;
			document.getElementById('end_date').disabled=true;
			JSON.parse(t_options).forEach(x=>addoption(x, "disabled"));
		}
	}

</script>