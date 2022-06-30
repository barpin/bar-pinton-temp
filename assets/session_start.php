<?php
if (!isset($_SESSION)){
	session_start();
}
$loggedin=isset($_SESSION["user"]) ? 1 : 0; 
if (isset($_SESSION["msg"])){
	?>
	
    <script>
		function showErrMsg(){
			setTimeout(function() {
				Swal.fire({
					icon: "<?php echo $_SESSION["icon"]; ?>",
					title: "<?php echo $_SESSION["msg"]; ?>",
					confirmButtonColor: "#34a34e",
					timerProgressBar: true,
					backdrop: true,
					//timer: 5000
				});
			}, 0.01);
		}
		window.onload=showErrMsg;
	</script>
    <?php
	$sessionmessage=$_SESSION["msg"];
	$_SESSION["msg"]=null;
}
?>
