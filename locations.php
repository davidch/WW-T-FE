<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>The Touro College and University System</title>
    
    <meta name="description" content="">
    <meta name="author" content="">

    <?php include('includes/head.php'); ?>

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
  </body>
</html>