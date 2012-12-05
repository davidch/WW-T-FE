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
	        <div class="span12 main">
	        	<h2 class="section_header">Touro is everywhere: in New York, across the country, around the world.</h2>
	        	<div class="row">
		        	<div class="world_list loc_list span3">	
		        		<h3><a href="#world_map">Around the World</a></h3>
			        	<ul>
			        		<li><a href="#world_map">Berlin</a></li>
			        		<li><a href="#world_map">Paris</a></li>
			        		<li><a href="#world_map">Israel</a></li>
			        		<li><a href="#world_map">Moscow</a></li>
			        	</ul>
			        </div>		
		        	<div class="ny_list loc_list span6">	
		        		<h3><a href="#ny_map">NEW YORK CITY and LONG ISLAND</a></h3>
			        	<ul>
			        		<li><a href="#ny_map">Schools</a></li>
			        		<li><a href="#ny_map">Undergraduate Programs</a></li>
			        		<li><a href="#ny_map">Graduate Programs</a></li>
			        		<li><a href="#ny_map">Judaic Studies</a></li>
			        	</ul>
			        </div>	
		        	<div class="us_list loc_list span3">	
		        		<h3><a href="#us_map">UNITED STATES</a></h3>
			        	<ul>
			        		<li><a href="#us_map">Northern California</a></li>
			        		<li><a href="#us_map">Southern California</a></li>
			        		<li><a href="#us_map">Florida</a></li>
			        		<li><a href="#us_map">Nevada</a></li>
			        	</ul>
			        </div>
			        <br class="clear" />			        
	        	</div>

	        	<div class="map-holder">
	        		<div class="map_click" id="world_map">
	        			<a href="#world_map" class="rotated"><img src="images/map_sections/world-text.png" alt="Around the World" /></a>
	        		</div>
	        		<div class="map_click" id="ny_map">	
	        			<a href="#ny_map" class="rotated"><img src="images/map_sections/ny-text.png" alt="New York City Long Island" /></a>
	        		</div>
	        		<div class="map_click" id="us_map">
	        			<a href="#us_map" class="rotated"><img src="images/map_sections/us-text.png" alt="United States" /></a>
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