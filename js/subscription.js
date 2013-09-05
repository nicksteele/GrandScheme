jQuery( document ).ready( function( $ ) {
	$(".subscribe-button").click(function(){
		if ($(".ui-shwoop").is(":hidden")) {
			$(".ui-shwoop").slideDown("slow");
		} else {
			$(".ui-shwoop").slideUp();
		}
		$("sml_submit").click(function() {
			$(".subscribe_msg").text("Thanks for subscribing!");
		} );
	} );
} );
