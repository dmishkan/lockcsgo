<?php
if (isset($_SESSION['steamid'])){
	include_once('db.php');
	?>
		<script type= "text/javascript">
			buttons.splice(3, 1, "logoutButton");
			list.splice(5, 1, "logoutButton");
			buttons.splice(3, 0, "settingsButton");
			list.splice(5, 0, "settingsButton");
			buttons.splice(4, 0, "depositButton");
			list.splice(6, 0, "depositButton");
			buttons.splice(5, 0, "withdrawButton");
			list.splice(7, 0, "withdrawButton");
			
			imageClasses.splice(3, 1, "settings");
			imageClasses.splice(4, 0, "deposit");
			imageClasses.splice(5, 0, "withdraw");
			imageClasses.splice(6, 0, "logout");
			
			hoverImages.splice(3, 1, "settings-hover");
			hoverImages.splice(4, 0, "deposit-hover");
			hoverImages.splice(5, 0, "withdraw-hover");
			hoverImages.splice(6, 0, "logout-hover");

			$(".steamButton").css("visibility", "hidden");
			$(".steam").css("visibility", "hidden");
			$(".steam-hover").css("visibility", "hidden");
		
			idleTime = 0;

    var idleInterval = setInterval("timerIncrement()", 60000); // 1 minute //60000
    $(this).mousemove(function(e) {
        idleTime = 0;
    });
    $(this).keypress(function(e) {
        idleTime = 0;
    });


function timerIncrement() {

    idleTime = idleTime + 1;

    if (idleTime >= 5) {
		
        $(".logoutButton").click();
    }
}
	
		</script>
	<?php
	echo '<img class = "settings-hover" src = "images/settings-hover.png"/>';
	echo '<img class = "settings" src = "images/settings.png"/>';
	echo '<img class = "deposit-hover" src = "images/deposit-hover.png"/>';
	echo '<img class = "deposit" src = "images/deposit.png"/>';
	echo '<img class = "withdraw-hover" src = "images/withdraw-hover.png"/>';
	echo '<img class = "withdraw" src = "images/withdraw.png"/>';
	echo '<img class = "logout-hover" src = "images/logout-hover.png"/>';
	echo '<img class = "logout" src = "images/logout.png"/>';
	
	echo '<button class ="settingsButton">SETTINGS</button>';
	echo '<button class ="depositButton">DEPOSIT</button>';
	echo '<button class ="withdrawButton">WITHDRAW</button>';
	echo '<button class ="logoutButton">LOGOUT</button>';
	echo  "<img id = 'avatar' src = \"{$_SESSION['avatar']}\"/>";
			$query="SELECT * FROM users_steam";
			$results = mysqli_query($db, $query);

			while ($row = mysqli_fetch_array($results)) {
				echo "<h3>$" . $row['points'] . "</h3>";
			}			
	}
?>