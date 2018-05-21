<?php

$con = mysqli_connect("127.0.0.1", "root", "dm3270*", "steam");

$rows = mysqli_query($con, "SELECT * FROM users_chat");

if (mysqli_num_rows($rows) > 30) {
	mysqli_query($con, "DELETE FROM users_chat ORDER BY id ASC LIMIT 1");
}

$result1 = mysqli_query($con, "SELECT * FROM users_chat ORDER BY id ASC");

while ($extract = mysqli_fetch_array($result1)) {
	echo  "<img id = 'chat-avatar' src = ' ". $extract['avatar'] . "'/>";
	echo "<span>" . $extract['name'] . "</span><br/>";
	echo "<span id = 'message'>" . $extract['msg'] . "</span><br/><br/>";
	
}

?>