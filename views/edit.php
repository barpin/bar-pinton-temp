
<div class="formbox border">
	<form onsubmit="return saverecipe(event)" id="fullform" >
		<input name="title" type="text" maxlength="128" placeholder="Titulo" required class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
		<br><br>
		<div id="categories" class="border p-6 flex flex-wrap">
			<div id="parentcats" class="flex"></div>
			<?php foreach ($permsdata as $category){ ?>
				<div class="relative">
					<div class="top-0 flex items-center m-1 border justify-around">
						<input type="checkbox" class="mx-1 checkbox" <?= ( $new   ? "data-original onclick='refreshcats()'" : "disabled checked")." data-cat='${category['id']}'" ?>> 
						<span class="mx-1"><?= $category['name'] ?></span>
					</div> <!--CUALQUIER CAMBIO A ESTAS CLASES SE DEBE HACER TAMBIEN EN EL JAVASCRIPT CORRESPONDIENTE-->
					<div class="background"></div> <!--TODO hocer que aparezca un color cuando esta seleccionado-->
				</div> 
			<?php } ?>
		</div>
		<br><br>
		<div class="flex flex-wrap justify-around	w-100%">
		<span class="text-xl block">Contenido</span> 
		<button type='button' id="editas" onclick="swapeditor()" class="block mr-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar como HTML</button>
		</div>
		<div id="form2" class="form2 flex flex-wrap justify-around">
			<div name="texto" id="editor"></div>
		</div>
		<br><br>
		
		<textarea id="text-area" style="display:none;"></textarea>
		<?php if (!$new){ ?>
			<input id='id' name='id' type='hidden' value='<?php echo $article; ?>'>
		<?php }  ?>
	
		<div class="border">
			<div class="m-6">
			<div class="flex justify-around">
				<input type="radio" id="static" name="type" value="static" <?=  $staticdisabled ? "disabled" : "" ?> required>
				<label for="static">Estatico</label><br>
				<input type="radio" id="post" name="type" value="post">
				<label for="post">Post</label><br>
				<input type="radio" id="vote" name="type" value="vote">
				<label for="vote">Voto</label><br>
				<input type="radio" id="alert" name="type" value="alert" class="type">
				<label for="alert">Alerta</label>  <br>  
			</div>
			<div class="m-6">
			<div id="fillme"></div>
			</div>
			</div>
		</div>
		
		<br><br>
		<input type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
	</form>
</div>

