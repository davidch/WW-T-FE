<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>The Touro College and University System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">    
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/touro-custom.css" rel="stylesheet">
    <link href="css/touro-media.css" rel="stylesheet">


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <script src='http://api.tiles.mapbox.com/mapbox.js/v0.6.6/mapbox.js'></script>
    <link href='http://api.tiles.mapbox.com/mapbox.js/v0.6.6/mapbox.css' rel='stylesheet' />    
    
    <style>
    
		.map-holder {
		    background: #e6c963;
		    height: 366px;
		    left: 0;
		    position: relative;
		    top: 24px;
		    width: 960px;
		    z-index: 1;
		}  
    
		.map_actual {
		    bottom: 0;
		    height: 366px;
		    left: 30px;
		    position: absolute;
		    top: 0;
		    overflow: hidden;
		    width: 870px;
		}
		
		#map_ny {
			left: 60px;
		}
		
		#map_us {
			left: 90px;
		}
		
		
		.marker-title, .marker-popup {
			font-size: 14px;
			padding: 4px;
		}
		
		.left {
			float: left;
			margin: 0;
			padding: 0;
		}			
		
		.main .map_click {
		    background-color: #e9cc5a;
		    color: #FFFFFF;
		    height: 366px;
		    left: 0;
		    line-height: 30px;
		    margin: 0;
		    padding: 0;
		    position: absolute;
		    text-align: right;
		    text-decoration: none;
		    text-transform: uppercase;
		    top: 0;
		    width: 30px;
		    z-index: 2;
		}

		
		.main #ny_map {
			background-color: #436447;
			left: 900px;
		}
		
		.main #ny_map .no-transform {
			text-transform: none;
		}
		
		.main #us_map {
			background-color: #ba0029;
		    left: 930px;
		}	
		
.rotated > img {
    float: left;
    padding: 20px 8px 0;
}
			
		 
	</style>

  </head>

  <body class="body_locations inside_landing">

	  <?php include('includes/top-navigation.php'); ?>
	  
	  <div class="container">
	  	<?php include('includes/search-inside-pages.php'); ?>
	  
	  	<?php include('includes/main-navigation.php'); ?>
	  </div>	
	  
	  
	<!-- scroll area -->
	<div class="scroll_bar">
	  	<?php include('includes/scroll-inside-pages.php'); ?>
	</div>	  

    <div class="container" id="main_content">
	    <div class="row">
	        <div class="span12 main" style="position: relative; height: 700px;">
	        	<h2 class="section_header">Touro is everywhere: in New York, across the country, around the world.</h2>
	        	<a href="#world" class="left"><img src="images/map_sections/world-map.jpg" /></a>
	        	<a href="#nyc" class="left"><img src="images/map_sections/ny-map.jpg" /></a>
	        	<a href="#us" class="left"><img src="images/map_sections/us-map.jpg" /></a>
	        	
	        	<br class="clear" />

	        	<div class="map-holder">
	        		<div class="map_click loaded" id="world_map">
	        			<a href="#" class="rotated"><img src="images/map_sections/world-text.jpg" alt="Around the World" /></a>
	        		</div>
	        		<div class="map_click" id="ny_map">	
	        			<a href="#" class="rotated"><img src="images/map_sections/ny-text.jpg" alt="New York City Long Island" /></a>
	        		</div>
	        		<div class="map_click" id="us_map">
	        			<a href="#" class="rotated"><img src="images/map_sections/us-text.jpg" alt="United States" /></a>
	        		</div>	
	        		<div class="map_actual" id="map_world"></div>
	        		<div class="map_actual" id="map_ny"></div>
	        		<div class="map_actual" id="map_us"></div>
	        	</div>		

	        </div><!-- end main --> 
	   </div><!-- end row -->	      
   </div> <!-- /container -->

	<footer class="clear">
		<?php include('includes/footer.php'); ?>
	</footer>
	<script>
		$(document).ready(function(){
		
			mapbox.auto('map_world', 'whitewhale.map-7srryw0v');

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
							$('.map-holder').css('background', '#e9cc5a');
							
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
							
							$('.map-holder').css('background', '#436447');
							
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
							$('.map-holder').css('background', '#ba0029');
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
			
		});

	</script>	


  </body>
</html>