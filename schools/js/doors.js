$(document).ready(function(){
	
	if($('body').width() <= 480) {
		
			$("#MenScroll, #WomenScroll").hide();
		
	} else {
				
		// Horizontal scrolling with smoothDivScroll plugin			
		$("#MenScroll").smoothDivScroll({ 
			scrollToEasingFunction: "easeOutCubic",
			hotSpotScrollingStep: 5,
			hotSpotScrollingInterval: 2,
			startAtElementId: "startMen"
		});	
		
		// Horizontal scrolling with smoothDivScroll plugin			
		$("#WomenScroll").smoothDivScroll({ 
			scrollToEasingFunction: "easeOutCubic",
			hotSpotScrollingStep: 5,
			hotSpotScrollingInterval: 2
		});						
		
	}					
	
});