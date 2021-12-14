<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<style>
    @rhino: #323b40;
    @rhinoMid: #4f585e;
    @teal: #0096a1;
    @tealMid: #0ebac7;
    @red: #fc625c;
    @amber: #fdbc40;
    @green: #34c748;
    @offWhite: #e9eaea;
    header {
	    background: url('http://www.autodatz.com/wp-content/uploads/2017/05/Old-Car-Wallpapers-Hd-36-with-Old-Car-Wallpapers-Hd.jpg');
	    text-align: center;
	    width: 100%;
	    height: auto;
	    background-size: cover;
	    background-attachment: fixed;
	    position: relative;
	    overflow: hidden;
	    border-radius: 0 0 85% 85% / 30%;
    }
    header .overlay{
    	width: 100%;
    	height: 100%;
    	padding: 50px;
    	color: #FFF;
    	text-shadow: 1px 1px 1px #333;
        background-image: linear-gradient( 135deg, #9f05ff69 10%, #fd5e086b 100%);
    }

    h1 {
    	font-family: 'Dancing Script', cursive;
    	font-size: 80px;
    	margin-bottom: 30px;
    }

    h3 p{
    	font-family: 'Open Sans', sans-serif;
    	margin-bottom: 30px;
    }

    button {
    	border: none;
    	outline: none;
    	padding: 10px 20px;
    	border-radius: 50px;
    	color: #333;
    	background: #fff;
    	margin-bottom: 50px;
    	box-shadow: 0 3px 20px 0 #0000003b;
    }
    button:hover{
	    cursor: pointer;
    }
    /* Aca termina el header */
    ion-icon{
        font-size: 30px
    }
    footer {
      background-image: linear-gradient( 135deg, #9f05ff69 10%, #fd5e086b 100%);
      bottom: 0;
      left: 0;
      position: absolute;
      right: 0;
    }
    .social-media-links {
        background: @rhino;
        overflow: hidden;
        padding-bottom: 10px;
        text-align: center;
    }
    ul {
    	margin: 0;
    	padding: 0;
    }
    li {
    	display: inline;
    	margin: 0;
    	padding: 0;
    }
    a {
    	border-bottom: 0px solid rgba(0,0,0,0.95);
    	border-radius: 5px;
    	box-shadow: inset 0 -2px 0 0 rgba(0,0,0,0), 0 6px 8px rgba(0,0,0,0), 0 24px 24px rgba(0,0,0,0), 0 36px 36px rgba(0,0,0,0), 0 64px 64px rgba(0,0,0,0), 0 64px 128px rgba(0,0,0,0), 0 120px 0 rgba(0,0,0,0), 0 86px 8px 6px rgba(0,0,0,0),;
    	display: inline-block;
        height: 20px;
    	padding: 15px;
    	position: relative;
    	transition: .1s ease-in;
        width: 25px;
    }
    a:hover {
    	transform: translateY(-10px);
    	box-shadow: inset 0 -3px 0 0 rgba(0,0,0,0.1), 0 6px 8px rgba(0,0,0,0.05), 0 24px 24px rgba(0,0,0,0.05), 0 36px 36px rgba(0,0,0,0.05), 0 64px 64px rgba(0,0,0,0.15), 0 64px 128px rgba(0,0,0,0.15), 0 86px 8px 6px fadeout(@tealMid, 75), 0 83px 4px 0px fadeout(@tealMid, 5);
    }
</style>
<body>
    <header>
    	<div class="overlay">
    <h1>Simply The Best</h1>
    <h3>Reasons for Choosing US</h3>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vero nostrum quis, odio veniam itaque ullam debitis qui magnam consequatur ab. Vero nostrum quis, odio veniam itaque ullam debitis qui magnam consequatur ab.</p>
    	<br>
    	<button>READ MORE</button>
    		</div>
    </header>
    <footer>
      <div class="social-media-links">
        <ul>
          <li>
            <!-- twitter -->
            <a href="#">
            <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>
          <li>
            <!-- facebook -->
            <a href="#">
            <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>
          <li>
            <!-- discord -->
            <a href="#">
            <ion-icon name="logo-discord"></ion-icon>
            </a>
          </li>
          <li>
            <!-- youtube -->
            <a href="#">
                <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </li>            
          <li>
            <!-- instagram -->
            <a href="#">
                <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>
        </ul>
      </div>
    </footer>
</div>
  
</body>
</html>