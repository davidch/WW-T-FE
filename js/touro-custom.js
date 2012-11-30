$(document).ready(function(){
		
	if($('body').attr('class') !== 'homepage') {
		
			$("#makeMeScrollable").smoothDivScroll({ 
				mousewheelScrolling: true,
				visibleHotSpotBackgrounds: "never",
				scrollToEasingFunction: "easeOutCubic",
				hotSpotScrollingStep: 5,
				hotSpotScrollingInterval: 2
			});			
			
			
		} else if($('body').attr('class') === 'homepage') { 		
			
			// Switch panels on nav clicks
			
			$('#main_navigation > li > a').click(function(e){
				e.preventDefault();
						
				  var open = $(this).parent('li').attr('class');
				  $('#main_navigation > li > a').removeClass('active');
				  
				  $('#site_sections div.slider').slideUp();
				  
				  if($('#site_sections div.' + open).is(":visible") === true) {
					  $('#site_sections div.' + open).slideUp();
				  }else {
					  $('#site_sections div.' + open).slideDown(1000);  
					  $(this).addClass('active');
				  }
				  			  
			  });
			
			// Horizontal scrolling with smoothDivScroll plugin			
			$("#makeMeScrollable").smoothDivScroll({ 
				mousewheelScrolling: true,
				visibleHotSpotBackgrounds: "never",
				scrollToEasingFunction: "easeOutCubic",
				hotSpotScrollingStep: 5,
				hotSpotScrollingInterval: 2,
				startAtElementId: "mosaic-right"
			});
		
		}

		// if there's a map-holder div and it's not the homepage - then go ahead and load the map
		if($('.map-holder').length >= 1 && $('body').attr('class') !== 'homepage') {
		
			mapbox.auto('map_world', 'whitewhale.map-7srryw0v');
			
		} else if($('.map-holder').length >= 1 && $('body').attr('class') === 'homepage') {
		
		// if there's a map-holder div and it IS the homepage - then load the map when 'locations' is clicked
		
			$('.locations').click(function(){
				mapbox.auto('map_world', 'whitewhale.map-7srryw0v');
			});
			
		}
		
		
		// map functionality
		if($('.map-holder').length >= 1) {	

			$('.map_click').click(function(e){
			
				e.preventDefault();
							
				var newID = $(this).attr('id');
				
				if($(this).hasClass('open') !== true) {
					
					$('.map_click').removeClass('open');
					$(this).addClass('open');
					
					$('.map_actual').css('z-index', '1');
								
					switch(newID){
					
						case 'world_map':
							if($(this).hasClass('loaded') !== true) {
								mapbox.auto('map_world', 'whitewhale.map-7srryw0v');
								$(this).addClass('loaded');
							}						
							
							$('#ny_map').animate({width: '30px', left: '900px'}, 500);
							$('#us_map').animate({width: '30px', left: '930px'}, 500);
							$('#world_map').animate({width: '900px', left: '0'}, 500, function(){
								$('#map_world').css('z-index', '9');
							});							
							
							break;
						  
						case 'ny_map':
							if($(this).hasClass('loaded') !== true) {
								mapbox.auto('map_ny', 'whitewhale.map-rqcwlcce');
								$(this).addClass('loaded')
							}
							
							$('#us_map').animate({width: '30px', left: '930px'}, 500);
							$(this).css('z-index','8').animate({left: '30px', width: '900px'}, 500, function(){
								$('#map_ny').show().css('z-index', '9');
							});														
	
						  break;
						  
						case 'us_map':
							if($(this).hasClass('loaded') !== true) {
								mapbox.auto('map_us', 'whitewhale.map-s1s65k18');
								$(this).addClass('loaded');
							}						

							$('#ny_map').animate({width: '30px', left: '30px'}, 500);	
							$('#us_map').css('z-index','8').animate({left: '60px', width: '900px'}, 500, function(){
								$('#map_us').css('z-index', '9');
							});							
							

										  
						  break;					  
						  
						default:
						  mapbox.auto('map_world', 'whitewhale.map-7srryw0v');	
					}				
				}		
				
			});			
			
		}
		
	});
