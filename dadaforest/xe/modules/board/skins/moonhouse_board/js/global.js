
// Tooltip
jQuery(document).ready(function($) {

$("a").tooltip({
    track: true, 
    delay: 0, 
    showURL: false, 
    showBody: " - ", 
    fade: 250
   });
});

// Mouseover Fade Effects
jQuery(document).ready(function($){
    $(".thumbListStudio li .thumb a .subWrapper").fadeTo("slow", 0.0); // This sets the opacity of the thumbs to fade down to 60% when the page loads
    $(".thumbListStudio li .thumb a .subWrapper").hover(function(){
    $(this).fadeTo(500, 1.0); // This should set the opacity to 100% on hover
	
},function(){   		
    $(this).fadeTo(500, 0); // This should set the opacity back to 60% on mouseout
    });
});