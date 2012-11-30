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
		    background: #bdaf6a;
		    height: 366px;
		    left: 0;
		    position: relative;
		    top: 24px;
		    width: 960px;
		    z-index: 1;
		}  
    
		#map {
		    bottom: 0;
		    height: 366px;
		    left: 30px;
		    position: absolute;
		    top: 0;
		    overflow: hidden;
		    width: 870px;
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
		    background: none repeat scroll 0 0 #A58F3A;
		    color: #FFFFFF;
		    height: 30px;
		    left: -168px;
		    line-height: 30px;
		    margin: 0;
		    padding: 0 20px 0 0;
		    position: absolute;
		    text-align: right;
		    text-decoration: none;
		    text-transform: uppercase;
		    top: 450px;
		    transform: rotate(-90deg);
		    width: 346px;
		    z-index: 2;
    
			/* Safari */
			-webkit-transform: rotate(-90deg);
			
			/* Firefox */
			-moz-transform: rotate(-90deg);
			
			/* IE */
			-ms-transform: rotate(-90deg);
			
			/* Opera */
			-o-transform: rotate(-90deg);
			
			/* Internet Explorer */
			filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
		}
		
		.main #ny_map {
			background-color: #436447;
			left: 732px;
		}
		
		.main #ny_map .no-transform {
			text-transform: none;
		}
		
		.main #us_map {
			background-color: #a92137;
		    left: 762px;
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
	        	<a href="#" class="map_click" id="world_map">Around the World</a>
	        	<a href="#" class="map_click" id="ny_map">New York City <span class="no-transform">and</span> Long Island</a>
	        	<a href="#" class="map_click" id="us_map">United States</a>
	        	<div class="map-holder">
	        		<div id='map'></div>
	        	</div>		

	        </div><!-- end main --> 
	   </div><!-- end row -->	      
   </div> <!-- /container -->

	<footer class="clear">
		<?php include('includes/footer.php'); ?>
	</footer>
	<script>
		$(document).ready(function(){
		
			mapbox.auto('map', 'whitewhale.map-7srryw0v');

			$('.map_click').click(function(e){
			
				e.preventDefault();
			
				var newID = $(this).attr('id');
				
				switch(newID){
				
					case 'world_map':
					  	$('.map-holder').css('background', '#bdaf6a');
						$('#map').html('').animate({width: '0', left : '30px'}, 1000);
						$('#us_map').animate({left: '762px'}, 1000);
						$('#ny_map').animate({left: '732px'}, 1000);	
						$('#map').animate({width: '870px'}, 1000, function(){
							mapbox.auto('map', 'whitewhale.map-7srryw0v');
						});
					  break;
					  
					case 'ny_map':
						$('.map-holder').css('background', '#18935d');
						$('#map').html('').animate({width: '0', left : '60px'}, 1000);
						$('#us_map').animate({left: '762px'}, 1000);
						$(this).animate({left: '-138px'}, 1000, function () {
							$('#map').animate({width: '870px'}, 1000, function(){
								mapbox.auto('map', 'whitewhale.map-rqcwlcce');
							});
						});						

					  break;
					  
					case 'us_map':
						$('.map-holder').css('background', '#c8596c');
						$('#map').html('').animate({width: '0', left : '90px'}, 1000);
						$('#ny_map').animate({left: '-138px'}, 1000);	
						$(this).animate({left: '-108px'}, 1000, function () {
							$('#map').animate({width: '870px'}, 1000, function(){
								mapbox.auto('map', 'whitewhale.map-s1s65k18');
							});
						});						
					  
					  break;					  
					  
					default:
					  mapbox.auto('map', 'whitewhale.map-7srryw0v');	
				}				
						
				
			});
			
		});

	</script>	


  </body>
</html>