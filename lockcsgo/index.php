<!DOCTYPE html>
<html>

<head>
	<link type = "text/css" rel="stylesheet" href="jquery-ui-style.css">
	<link type = "text/css" rel = "stylesheet" href = "stylesheet.css">
	<script type = "text/javascript" src="jquery.js"></script>
	<script type = "text/javascript" src="hash-change.js"></script>
	<script type = "text/javascript" src="jquery-ui.js"></script>
	<script type = "text/javascript" src = "script.js"></script>
	<script>
	

				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById('activity').innerHTML = xmlhttp.responseText;
					}
				}				
				setInterval(function() {
					xmlhttp.open('GET' , 'activity.php', true);
					xmlhttp.send();
				}, 1000);
			
			<?php session_start(); ?>
				var steamid = <?php echo json_encode($_SESSION['steamid']); ?>;
				var name = <?php echo json_encode($_SESSION['personaname']); ?>;
				var avatar = <?php echo json_encode($_SESSION['avatar']); ?>;
				var msg = form1.msg.value;
				
	function checkChat() {
		msg = form1.msg.value;
		if (steamid == null) {
			document.getElementById("message-box").focus();
			tell("Login to use chat");
		}
		else if (msg == '') {
			document.getElementById("message-box").focus();
			tell("Nothing was written");
		}
		else {
		submitChat();
		}
	}
							
	function submitChat() {
				msg = form1.msg.value;
				var xmlhttp = new XMLHttpRequest();
				
				setInterval(function() {
					xmlhttp.open('GET' , 'getmessages.php', true);
					xmlhttp.send();
				}, 500);

				var pre_update = 0;
				var go = 0;

				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						if (xmlhttp.responseText.length > pre_update) {
							$('#chat_box').animate({scrollTop: $(document).height() + 1000 + "px"}, 500);
							pre_update = xmlhttp.responseText.length;	
						}
						document.getElementById('chat_data').innerHTML = xmlhttp.responseText;
						
					}
				}
				
				if (msg == '' || steamid == null) {
					return;
				}
				
				xmlhttp.open('GET' , 'chat.php?name=' + name + '&avatar=' + avatar + '&msg=' + msg, true);
				xmlhttp.send();
				
				document.getElementById('message-box').value = '';
				document.getElementById("mytext").focus();
			}
	</script>
	
	<title>Beta 1.2</title>
</head>
<body id = "body">
	<div id = "backgroundScreen"></div>
	<img id = "waitingScreen" src = "images/lockcsgo.png"/>
	
	<div id = "main"></div>

	<div class = "loader"></div>
	
	<div id = "orange"></div>

	<div id = "navbar">
		<h1 class = "menu">MENU</h1>
		<h1 class = "account">ACCOUNT</h1>
		<h1 class = "miscellaneous">MISC.</h1>

			<button class="rouletteButton" >ROULETTE</button>
			<button class="jackpotButton" >JACKPOT</button>
			<button class="spinButton" >SPIN</button>
			<div class = "steamButton"><?php include 'login_steam.php'; ?></div>
			<button class="faqButton" >FAQ</button>
			<button class="provablyfairButton" >PROVABLY FAIR</button>
			<button class="termsofserviceButton" >TERMS OF SERVICE</button>
			<img class = "users-online" src = "images/users-online.png"/>
			<div id = "activity"></div>
			
			<div id = "slider"></div>
			<div id = "all-images">
					<img class = "roulette-hover" src = "images/roulette-hover.png">
					<img class = "roulette" src = "images/roulette.png">
					<img class = "jackpot-hover" src = "images/jackpot-hover.png">
					<img class = "jackpot" src = "images/jackpot.png">
					<img class = "spin-hover" src = "images/spin-hover.png">
					<img class = "spin" src = "images/spin.png">
					<img class = "steam-hover" src = "images/steam-hover.png">
					<a href='?login'><img class = "steam" src = "images/steam.png"></a>
					<img class = "faq-hover" src = "images/faq-hover.png">
					<img class = "faq" src = "images/faq.png">
					<img class = "provablyfair-hover" src = "images/provablyfair-hover.png">
					<img class = "provablyfair" src = "images/provablyfair.png">
					<img class = "termsofservice-hover" src = "images/termsofservice-hover.png">
					<img class = "termsofservice" src = "images/termsofservice.png">
					<?php include 'state.php'; ?>
			</div>
			
			<img id = "chat-hover" src = "images/chat-hover.png"/>
			<img id = "chat" src = "images/chat.png"/>
	</div>

	<div id = "pull">
		<button class = "lines" style = "TOP: 0px; LEFT: 0px; width: 50px; height: 30px">&#9776</button>
		<button class = "exit" style = "TOP: 0px; LEFT: 0px; width: 50px; height: 30px">&#10060</button>
	</div>
	
	<div id = "note">Login to use chat</div>
	
	<div id = "container">
		<button class = "exit_chat">&#10060</button>
		<div id = "chat_box">
			<div id = "chat_data"></div>
		</div>
		
		<form name = "form1">
			<input id = "message-box" type = "text" name = "msg" placeholder = " Enter Message" autocomplete = "off"/>
			<button class = "sending" type = "button" onclick = "checkChat();">Send</button>
		</form>
		
	</div>

</body>


</html>



