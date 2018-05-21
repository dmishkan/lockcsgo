<?php

ob_start();

session_start();

ini_set('display_errors', 1);

	$button = "<a href='?login'><img src='http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_large_border.png'></a>";
	echo $button;
					
if (isset($_GET['login'])){
	require 'includes/lightopenid/openid.php';
	try {
		require 'steam_config.php';
		$openid = new LightOpenID($steamauth['domainname']);
		include_once('db.php');
		if(!$openid->mode) {
			$openid->identity = 'http://steamcommunity.com/openid';
			header('Location: ' . $openid->authUrl());
		} elseif ($openid->mode == 'cancel') {
			echo 'User has canceled authentication!';
		} else {
			if($openid->validate()) { 
				$id = $openid->identity;
				$ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
				preg_match($ptn, $id, $matches);
																					     
			$url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=" . $steamauth['apikey'] ."&steamids=$matches[1]";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL,$url);
			$result=curl_exec($ch);
			curl_close($ch);
			$content = json_decode($result, true);
			var_dump($content);
			$_SESSION['steamid'] = $matches[1];
			$_SESSION['personaname'] = $content['response']['players'][0]['personaname'];
			$_SESSION['avatar'] = $content['response']['players'][0]['avatarfull'];
			
			$sql_get_id = "SELECT * FROM users_steam WHERE steamid = {$_SESSION['steamid']}";
			$query_id = mysqli_query($db, $sql_get_id);
				
			if(mysqli_num_rows($query_id) == 0) {
				
				$sql_steam = "INSERT INTO users_steam(name, steamid, points, activity) VALUES ('{$_SESSION['personaname']}', '{$_SESSION['steamid']}', '100.00', 'online')";
				mysqli_query($db, $sql_steam);
			}
			else {
				mysqli_query($db, "UPDATE users_steam SET activity = 'online' WHERE steamid = {$_SESSION['steamid']}");
				
			}
							
				if (!headers_sent()) {
					header('Location: '.$steamauth['loginpage']);
					exit;
				} else {
					?>
					<script type="text/javascript">
						window.location.href="<?=$steamauth['loginpage']?>";			
					</script>
					<noscript>
						<meta http-equiv="refresh" content="0;url=<?=$steamauth['loginpage']?>" />
					</noscript>
					<?php
					exit;
				}
			} else {
				echo "User is not logged in.\n";
			}
		}
	} catch(ErrorException $e) {
		echo $e->getMessage();
	}
}

if (isset($_GET['update'])){
	unset($_SESSION['steam_uptodate']);
	require 'userInfo.php';
	header('Location: '.$_SERVER['PHP_SELF']);
	exit;
}
?>