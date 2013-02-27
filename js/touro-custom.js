$(document).ready(function(){

	var wide = $('body').width(),
		mapW = '900px';
				
	$('.open_sec').live('click', function(){
		$('.section_navigation > ul').slideToggle();
		$('.side_nav').slideToggle();
	});			
		
		
	if(wide <= 768 && $('.section_navigation').length >= 1) {
		$('.section_navigation h2').append('<a href="#open_sec" class="open_sec">View Section Navigation &raquo;</a>');
		
		$('.section_navigation > ul').hide();		
	}	
	
	if(wide <= 768 && $('.inside_navigation').length >= 1 && $('body').hasClass('search_page') !== true) {
	
		if($('.inside_navigation h2').length >= 1) {
			$('.inside_navigation h2').append('<a href="#open_sec" class="open_sec">View Section Navigation &raquo;</a>');
		}
		else {
			$('.inside_navigation').prepend('<a href="#open_sec" class="open_sec">View Section Navigation &raquo;</a>');		
		}
		
		$('.side_nav').hide();		
	}	

	
	if(wide <= 768) {
		mapW = '600px';
	}
	
	if(wide <= 400) {
		mapW = '320px';
	}	
	
	$(window).resize(function () {
		
		function showNav() {
			if($('body').width() >= 769 && $('.open_sec').length >= 1) {
				
				$('.open_sec').remove();
				$('.section_navigation > ul').show();
			}
			
			if($('body').attr('class') !== 'homepage' && $('body').width() >= 481) {
			
				$("#makeMeScrollable").css('width', '100%').unwrap();
			
				$("#makeMeScrollable").smoothDivScroll({ 
					scrollToEasingFunction: "easeOutCubic",
					hotSpotScrollingStep: 5,
					hotSpotScrollingInterval: 2
				});	
											
			} else if($('body').width() <= 768) { 
			
				if($('.scrollMe').length === 0){

					var NewWidth = 0;
				
					$("#makeMeScrollable div.col").each(function(i){
						$(this).addClass('check');
						NewWidth += $(this).outerWidth(true);	
					});
							
					$("#makeMeScrollable").css('width', NewWidth + 'px').wrap('<div class="scrollMe" />');						
					
				}
				
				if($('.open_sec').length === 0) {
				
					$('.section_navigation h2').append('<a href="#open_sec" class="open_sec">View Section Navigation &raquo;</a>');
					
					$('.section_navigation > ul').hide();
				
				}							
				
			}
			
		}
		
		window.setTimeout(showNav, 500, true);  // won't pass "true" to the showNav in IE
												
	});	
		
		if($("#makeMeScrollable").length >= 1) {
				
			if($('body').attr('class') !== 'homepage' && wide >= 481) {
						
				$("#makeMeScrollable").smoothDivScroll({ 
					scrollToEasingFunction: "easeOutCubic",
					hotSpotScrollingStep: 5,
					hotSpotScrollingInterval: 2
				});			
				
				
			} else if($('body').attr('class') === 'homepage' && wide >= 481) { 		
				
				// Switch panels on nav clicks
				
				$('#main_navigation > li > a').click(function(e){
					e.preventDefault();
					
						var offset = parseInt($(this).offset().top)-50;
							
							$("html, body").animate({ scrollTop: offset});
							
					  var open = $(this).parent('li').attr('class');
					  $('#main_navigation > li > a').removeClass('active');
					  
					  $('#site_sections div.slider').fadeOut();
					  
					  if($('#site_sections div.' + open).is(":visible") === true) {
						  $('#site_sections div.' + open).fadeOut();
					  }else {
						  $('#site_sections div.' + open).fadeIn(1000);  
						  $(this).addClass('active');
					  }
					  			  
				  });
				
				// Horizontal scrolling with smoothDivScroll plugin			
				$("#makeMeScrollable").smoothDivScroll({ 
					scrollToEasingFunction: "easeOutCubic",
					hotSpotScrollingStep: 5,
					hotSpotScrollingInterval: 2,
					startAtElementId: "mosaic-right"
				});
				
			} else if(wide <= 480) { 
			
				$(window).load(function(){
					
					var NewWidth = 0;
				
					$("#makeMeScrollable div.col").each(function(i){
						$(this).addClass('check');
						NewWidth += $(this).outerWidth(true);	
					});
							
					$("#makeMeScrollable").css('width', NewWidth + 'px').wrap('<div class="scrollMe" />');			
					
				});			
				
			}			
			
		}
			
			
		// section_switcher functionality
		if($('.switcher').length >= 1) {			
		
			$('.switch-controls li').click(function(){
				
				var newIndex = $(this).index();
				
				$('.switch-controls li').removeClass('active');
				$(this).addClass('active');
				
				$('.switcher').slideUp(500);
				
				$('.switcher').eq(newIndex).slideDown(1000);
				
			});
			
		
		}

		// if there's a map-holder div and it's not the homepage - then go ahead and load the map
		if($('.map-holder').length >= 1 && $('body').attr('class') !== 'homepage' && wide >= 481) {
		
			mapbox.auto('map_ny', 'whitewhale.map-rqcwlcce');
			$('#ny_map').css('z-index','8').animate({left: '30px', width: mapW}, 500, function(){
				$('#map_ny').show().css('z-index', '9');
			});
			
			
		} else if($('.map-holder').length >= 1 && $('body').attr('class') !== 'homepage' && wide <= 480) {
		
			mapbox.auto('map_world', 'whitewhale.map-7srryw0v', function(map, tiledata) {
				map.zoom(3);
		    });
		    
			mapbox.auto('map_ny', 'whitewhale.map-rqcwlcce', function(map, tiledata) {
				map.zoom(8);
		    });		    
		    
		    mapbox.auto('map_us', 'whitewhale.map-s1s65k18', function(map, tiledata) {
				map.zoom(3);
		    });		    
		    
		    $('.loc_list a').addClass('loaded');
		    
			$('#map_world').css('z-index', '9');			
			
		} else if($('.map-holder').length >= 1 && $('body').attr('class') === 'homepage') {
		
		// if there's a map-holder div and it IS the homepage - then load the map when 'locations' is clicked
		
			$('.locations').click(function(){
				mapbox.auto('map_world', 'whitewhale.map-7srryw0v');
			});
			
		}
		
		
		// map functionality
		if($('.map-holder').length >= 1) {	

			$('.map_click a, .loc_list a').click(function(e){
			
				e.preventDefault();
							
				var newID = $(this).attr('href');
				
				if($(this).parents('div.loc_list, .map_click').hasClass('open') !== true) {
					
					$('.map_click, .loc_list').removeClass('open');
					$(this).parents('div.loc_list, .map_click').addClass('open');
					
					$('.map_actual').css('z-index', '1');
								
					switch(newID){
					
						case '#world_map':
							if($(this).hasClass('loaded') !== true) {
								mapbox.auto('map_world', 'whitewhale.map-7srryw0v');
								$(this).addClass('loaded');
							}						
							
							$('#ny_map').css({left: 'auto'}).animate({width: '30px', right: '30px'}, 500);
							$('#us_map').css({left: 'auto'}).animate({width: '30px', right: '0'}, 500);
							$('#world_map').animate({width: mapW, left: '0'}, 500, function(){
								$('#map_world').css('z-index', '9');
							});							
							
							break;
						  
						case '#ny_map':
							if($(this).hasClass('loaded') !== true) {
								mapbox.auto('map_ny', 'whitewhale.map-rqcwlcce');
								$(this).addClass('loaded')
							}
							
							$('#us_map').css({left: 'auto'}).animate({width: '30px', right: '0'}, 500);
							$('#ny_map').css('z-index','8').animate({left: '30px', width: mapW}, 500, function(){
								$('#map_ny').show().css('z-index', '9');
							});														
	
						  break;
						  
						case '#us_map':
							if($(this).hasClass('loaded') !== true) {
								mapbox.auto('map_us', 'whitewhale.map-s1s65k18');
								$(this).addClass('loaded');
							}						

							$('#ny_map').animate({width: '30px', left: '30px'}, 500);	
							$('#us_map').css('z-index','8').animate({left: '60px', width: mapW}, 500, function(){
								$('#map_us').css('z-index', '9');
							});							
							

										  
						  break;					  
						  
						default:
						  mapbox.auto('map_ny', 'whitewhale.map-rqcwlcce');	
					}				
				}		
				
			});			
			
		}

		
		// dept list drop down
		if($('.dept_list').length >= 1) {	
		
			$('.dept_list > span').click(function(e){
				
				e.preventDefault();
												
				$('.dept_list ul').slideToggle();
				
			});
		
		
		}
		
		if($('.gal_imgs').length >= 1) {
		
			$('.gal_imgs .span3 ul li').click(function(e){
				
				e.preventDefault();
				
				var newIndex = parseInt($(this).attr('id').split('-')[1])-1;
				
				$('.hidden_images img').eq(newIndex).modal();
				
			});		
		}
		
		
		// school tabs
		if($('.events_box').length >= 1) {	
		
			$('.event_tab').click(function(e){
				
				e.preventDefault();
				$('.schools_events').removeClass('active_tab').find('.box_inner').hide();							
				$(this).parents('.schools_events').addClass('active_tab').find('.box_inner').show();
				
			});
		
		
		}		
		
		
	});
