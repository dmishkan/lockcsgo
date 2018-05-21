<?php

$name = $_REQUEST['name'];
$avatar = $_REQUEST['avatar'];
$msg = $_REQUEST['msg'];


$con = mysqli_connect("127.0.0.1", "root", "dm3270*", "steam");

mysqli_query($con, "INSERT INTO users_chat (name, avatar, msg) VALUES ('$name', '$avatar', '$msg')");

$result1 = mysqli_query($con, "SELECT * FROM users_chat ORDER BY id ASC");

while ($extract = mysqli_fetch_array($result1)) {
	echo  "<img id = 'chat-avatar' src = ' ". $extract['avatar'] . "'/><br/>";
	echo "<span>" . $extract['name'] . "</span><br/>";
	echo "<span id = 'message'>" . $extract['msg'] . "</span><br/><br/>";
}

?>