
var headerSpace = 0;
var buttonSpace = 0;
var imageSpace = 85;
var count = 0;
var pixel;
var flag = 0;
var imageClasses = ["roulette", "jackpot", "spin", "steam", "faq", "provablyfair", "termsofservice"];
var hoverImages = ["roulette-hover", "jackpot-hover", "spin-hover", "steam-hover", "faq-hover", "provablyfair-hover", "termsofservice-hover"];
var buttons = ["rouletteButton", "jackpotButton", "spinButton", "steamButton",  "faqButton", "provablyfairButton", "termsofserviceButton"];
var list = ["menu", "rouletteButton", "jackpotButton", "spinButton", "account", "steamButton", "miscellaneous", 
"faqButton", "provablyfairButton", "termsofserviceButton"];

$(window).ready(function() {
	$("#orange").show();
	$('#backgroundScreen').delay(500).animate({top: "-=1000px"}, 500).fadeOut();
    $('#waitingScreen').delay(500).animate({top: "-=1000px"}, 500).fadeOut();
});


$(document).ready(function() {
	placeEverything();
	submitChat();
	$("#container").draggable({ containment: "#containment-wrapper", scroll: false });
	$("#container").resizable({handles: 'n, s', minHeight: 90});
	$("#chat_box").on("touchstart mousedown", function(e) {e.stopPropagation();})
	$( "#message-box" ).keypress(function( event ) {
		msg = form1.msg.value;
		if ( event.which == 13 ) {
			event.preventDefault();
			
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
	});
});


$(document).ready(function(){
	
    $("#pull").click(function(){
		if (count % 2 === 0)  {
			
			$("#navbar #all-images img").animate({left: "+=295"}, 200);
			$("#navbar").animate({left: "-=220px"},200);
			$("#pull").animate({left: "-=225px"},200);
			$("#main").animate({left: "-=220px", width: "+=220px"},200);
			$(".loader").animate({left: "-=110px"}, 200);
			$(".lines").css("visibility", "visible");
			$(".exit").css("visibility", "hidden");
			$("#navbar button").fadeOut(200);
			$(".steamButton").fadeOut("slow");
			
		}
		else {
			$("#navbar #all-images img").animate({left: "-=295"}, 200);
			$("#navbar").animate({left: "+=220px"},200);
			$("#pull").animate({left: "+=225px"}, 200);
			$("#main").animate({left: "+=220px", width: "-=220px"},200);
			$(".loader").animate({left: "+=110px"}, 200);
			$(".exit").css("visibility", "visible");
			$(".lines").css("visibility", "hidden");
			$("#navbar button").fadeIn(200);
			$(".steamButton").fadeIn("slow");
			
		}
			count++;
    });
});

$(document).ready(function() {
	$("#navbar button").click(function() {
		var buttonName = $(this).attr("class");
		if(!$(this).hasClass("buttonActive")) {
		$(".loader").show();
		$("#main").hide();
		removeActiveButtons(buttonName);
		removeActiveImages(buttonName.substring(0, buttonName.indexOf("B")));
		$(this).addClass("buttonActive");
		$("." + buttonName.substring(0, buttonName.indexOf("B"))).addClass("active");
		pixel = parseInt($(this).css("top")) + 10;
		animateSlider(pixel);
		$.get(buttonName.substring(0, buttonName.indexOf("B")) + ".php #main", function(data) {
			$("#main").replaceWith(data);
			$(".loader").hide();
			$("#main").show();
			});
		}
		
	});
});
	
$(document).ready(function(){
	$("#navbar #all-images img").click(function() {
		if ($(this).attr('id') != "avatar") {
		var className = $(this).attr("class");
		if(!$(this).hasClass("active")) {
		$(".loader").show();
		$("#main").hide()
		removeActiveImages(className);
		removeActiveButtons(className + "Button");
		$("." + className + "Button").addClass("buttonActive");
		$(this).addClass("active");
		pixel = parseInt($(this).css("top")) - 5;
		animateSlider(pixel);
		$.get(className + ".php #main", function(data) {
			$("#main").replaceWith(data);
			$("#main").css("left", "90px");
			$("#main").css("width", "+=220px");
			$(".loader").hide();
			$("#main").show();
		});
			
		}
		}
	});
});

$(document).ready(function() {
	$("#chat").click(function() {
		$("#container").show();
		$(this).addClass("chatActive");
		
		$('#chat_box').animate({scrollTop: $(document).height() + 1000 + "px"}, 200);
		$('#container').animate({height: "600px"}, 200);
		document.getElementById("message-box").focus();
	});
	$(".exit_chat").click(function() {
		$('#container').animate({height: "90px"}, 200, function() {
			$("#container").hide();
		});
		$("#chat").removeClass("chatActive");
	});
});

var placeEverything = function() {
headerSpace = 0;
buttonSpace = 0;
$(".loader").hide();
$("#container").hide();
$("#note").hide();
	$(".rouletteButton").addClass("buttonActive");
	$(".roulette").addClass("active");
	$.get("roulette.php #main", function(data) {
			$("#main").replaceWith(data);
		});
	
	$(".loader").css("left",  (parseInt($("#main").css("width")) / 2) + "px");
	$("button").css("left", "-10px");
	$("#navbar #all-images img").css("left", "-65px");
	for (var i = 0; i < list.length; i++) {
		if (list[i].indexOf("Button") === -1) {
			$("." + list[i]).css("top", headerSpace + "px");
			buttonSpace += 65;
		}
		else {
			$("." + list[i]).css("top", buttonSpace + "px");
			buttonSpace += 65;
			headerSpace = buttonSpace;
		}
	}
	for (var i = 0; i < list.length; i++) {
		if (list[i].indexOf("Button") <= -1) {
			if (imageSpace != 85)
				imageSpace+=65;
		}
		else  {
		$("." + imageClasses[flag]).css("top", imageSpace + "px");
		$("." + hoverImages[flag]).css("top", imageSpace + "px");
		imageSpace += 65;
		flag++;
		}
	}
		$(".steam-hover").css("left",  "-77px");
		$(".steam").css("left",  "-77px");

	
}

var tell = function(note) {
	document.getElementById('note').innerHTML = note;
	$("#note").fadeIn({queue: false, duration: 'slow'});
	$("#note").animate({ left: "80%" }, 'slow');
	$("#note").delay(3000).fadeOut();
}

var animateSlider = function(slider) {
	$("#slider").animate({top: slider + "px"},100);	
}

var removeActiveImages = function(className) {
	for (var i = 0; i < imageClasses.length; i++) {
		$("." + imageClasses[i]).removeClass("active");
	}
}

var removeActiveButtons = function(buttonClass) {
	for (var i = 0; i < buttons.length; i++) {
		$("." + buttons[i]).removeClass("buttonActive");
	}
}


