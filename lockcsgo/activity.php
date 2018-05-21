<?php

$con = mysqli_connect("127.0.0.1", "root", "dm3270*", "steam");

$online = mysqli_num_rows(mysqli_query($con, "SELECT * FROM users_steam WHERE activity = 'online'"));

	echo "<h2>" . $online . "</h2>";
?>