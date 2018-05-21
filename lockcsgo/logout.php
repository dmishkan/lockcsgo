<?php
session_start();
if (isset($_SESSION['steamid'])){
$con = mysqli_connect("127.0.0.1", "root", "dm3270*", "steam");

mysqli_query($con, "UPDATE users_steam SET activity = 'offline' WHERE steamid = {$_SESSION['steamid']}");
}
unset($_SESSION['steamid']);
?>
		<script type= "text/javascript">

			window.location = "http://localhost";
	
		</script>
	<?php

?>