<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

</head>
<style>
	@import url("https://fonts.googleapis.com/css2?family=Righteous&display=swap");
.body2{
  position: relative;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  font-family: "Righteous", cursive;
  min-height: 96.6vh;
  background-color: #a9c9ff;
  background-image: linear-gradient(180deg, #a9c9ff 0%, #ffbbec 100%);
}
.body2 .container-slider {
	max-width: 100vw;
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
	grid-gap: 35px;
	margin: 0 auto;
	padding: 40px;
	flex: 1;
}
.body2 .container-slider .card {
  position: relative;
  width: 300px;
  height: 400px;
  margin: 0 auto;
  background: black;
  border-radius: 15px;
  box-shadow: 1px 15px 25px rgba(0, 0, 0, 0.5);
}
.body2 .container-slider .card .face {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.body2 .container-slider .card .face.face1 {
  box-sizing: border-box;
  padding: 20px;
}
.body2 .container-slider .card .face.face1 h2 {
  margin: 0;
  padding: 0;
}
.body2 .container-slider .card .face.face1 .java {
  background-color: #fffc00;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.body2 .container-slider .card .face.face1 .python {
  background-color: #00fffc;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.body2 .container-slider .card .face.face1 .cSharp {
  background-color: #fc00ff;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.body2 .container-slider .card .face.face2 {
  transition: 0.5s;
}
.body2 .container-slider .card .face.face2 h2 {
  margin: 0;
  padding: 0;
  font-size: 7em;
  color: #fff;
  transition: 0.5s;
  text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  z-index: 10;
}
.body2 .container-slider .card:hover .face.face2 {
  height: 60px;
}
.body2 .container-slider .card:hover .face.face2 h2 {
  font-size: 2em;
}
.body2 .container-slider .card:nth-child(1) .face.face2 {
  background-image: linear-gradient(40deg, #fffc00 0%, #fc00ff 45%, #00fffc 100%);
  border-radius: 15px;
}
.body2 .container-slider .card:nth-child(2) .face.face2 {
  background-image: linear-gradient(40deg, #fc00ff 0%, #00fffc 45%, #fffc00 100%);
  border-radius: 15px;
}
.body2 .container-slider .card:nth-child(3) .face.face2 {
  background-image: linear-gradient(40deg, #00fffc 0%, #fc00ff 45%, #fffc00 100%);
  border-radius: 15px;
}
.body2 .container-slider .card:nth-child(4) .face.face2 { /* Esto es lop que necesitamos solamente le cambiamos el numero de child por uno mas si queremos agregar mas cartitas*/
  background-image: linear-gradient(40deg, #00fffc 0%, #fc00ff 45%, #fffc00 100%);
  border-radius: 15px;
}
.body2 .container-slider .card:nth-child(5) .face.face2 { /* Esto es lop que necesitamos solamente le cambiamos el numero de child por uno mas si queremos agregar mas cartitas*/
  background-image: linear-gradient(40deg, #00fffc 0%, #fc00ff 45%, #fffc00 100%);
  border-radius: 15px;
}
.footer{
	flex: 0;
}
</style>
<body>
  <?php include_once 'partials/navbar.php' ?>
  <div class="body2">
	<div class="container-del-container bg-red-100 mt-56 rounded-lg p-1 shadow-2xl">
	<div class="container-slider bg-white p-5 rounded-lg">
			<div class="card">
		    <div class="face face1">
		      <div class="content">
		        <span class="stars"></span>
		        <h2 class="titulo-cards">Primera cosa no se</h2>
				<hr>
		        <p class="text-cards">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequuntur sunt excepturi repudiandae obcaecati deserunt provident fuga quasi aperiam ut ab adipisci quas cupiditate, totam consequatur tenetur distinctio dolores rerum dolorum!</p>
		      </div>
		    </div>
		    <div class="face face2">
		      <h2>FUN</h2>
		    </div>
		  </div>

		  <div class="card">
		    <div class="face face1">
		      <div class="content">
		        <span class="stars"></span>
		        <h2 class="titulo-cards">SEGUNDA COSA NO SE</h2>
		        <p class="text-cards">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vitae inventore quae iure minima cupiditate veniam veritatis quia velit deserunt obcaecati, maxime, voluptate earum rem. Omnis eius corporis totam ullam est!</p>
		      </div>
		    </div>
		    <div class="face face2">
		      <h2>CIO</h2>
		    </div>
		  </div>

		  <div class="card">
		    <div class="face face1">
		      <div class="content">
		        <span class="stars"></span>
		        <h2 class="titulo-cards">TERCERA COSA NO SE</h2>
		        <p class="text-cards">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Incidunt, necessitatibus cum. Optio labore laborum qui nam harum ab sunt impedit obcaecati, ipsum magni illo dolore animi, nihil facere repudiandae natus.</p>
		      </div>
		    </div>
		    <div class="face face2">
		      <h2>NA</h2>
		    </div>
		  </div>
		  

		  <div class="card">
		    <div class="face face1">
		      <div class="content">
		        <span class="stars"></span>
		        <h2 class="titulo-cards">CUARTA COSA NO SE</h2>
		        <p class="text-cards">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae quaerat sit esse, hic, cum cumque excepturi sunt minus possimus, ipsam dolor consectetur debitis explicabo harum a voluptatum. Doloribus, accusamus corporis.</p>
		      </div>
		    </div>
		    <div class="face face2">
		      <h2>MIEN</h2>
		    </div>
		  </div>

		  <div class="card">
		    <div class="face face1">
		      <div class="content">
		        <span class="stars"></span>
		        <h2 class="titulo-cards">QUINTA COSA NO SE</h2>
		        <p class="text-cards">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Beatae blanditiis et consectetur omnis nihil praesentium assumenda repellendus sunt facilis voluptatibus! Dignissimos consequatur officiis laboriosam quam rerum cum architecto porro molestiae!</p>
		      </div>
		    </div>
		    <div class="face face2">
		      <h2>TO</h2>
		    </div>
		  </div>
		</div>
		<?php include_once 'partials/footer.php' ?>
	</div>
	</div>
  </div>
</body>
</html>