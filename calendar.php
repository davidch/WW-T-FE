<!DOCTYPE html>
<html lang="en" data-ng-app="touro">
  <head>
    <meta charset="utf-8">
    <title>The Touro College and University System</title>
    
    <meta name="description" content="">
    <meta name="author" content="">

    <?php include('includes/head.php'); ?>

  </head>

  <body class="body_about inside_landing">

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
	        <div class="span3 section_navigation">
	        	<h2>About Touro</h2>
    			<ul>
    				<li><a href="about-inside.php" target="_blank">At a Glance</a></li>
					<li><a href="about-inside.php" target="_blank">Research</a></li>
					<li><a href="about-inside.php" target="_blank">Our Mission</a></li>
					<li><a href="about-inside.php" target="_blank">Our History</a></li>
					<li><a href="about-inside.php" target="_blank">Jewish Heritage</a></li>
					<li><a href="about-inside.php" target="_blank">Leadership</a>
						<ul class="subnav">
							<li><a href="#">Office of the President</a></li>
							<li><a href="#">Central Administration</a></li>
							<li><a href="#">Board of Trustees</a></li>
							<li><a href="#">Legal</a></li>
						</ul>
					</li>
					<li><a href="about-inside.php" target="_blank">Accreditations</a></li>
					<li><a href="about-inside.php" target="_blank">Careers at Touro</a></li>
				</ul>
			</div>
			<div class="span9 main">
			
			




			
<div id="main-content-col-wrapper">			
			
			
				<h2 class="section_header">Events</h2>
				
				 
				
				<div class="row">
				  <div data-ng-controller="CalendarCtrl">
				    <div data-ui-calendar="{height: 450,editable: true}" class="span9 calendar" data-ng-model="eventSources"></div>
				  </div> 
										
				</div>					
					
					
					
					
					
					
				</div>	
			</div>
		</div><!-- end row -->	      
   </div> <!-- /container -->

	<footer class="clear">
		<?php include('includes/footer.php'); ?>
	</footer>
	
	
	
	<!-- CALENDAR SPECIFIC -->
	
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
	<script src="/javascripts/fullcalendar.js"></script> 
	<script src="/javascripts/gcal.js"></script>


	<link rel="stylesheet" href="/css/fullcalendar.css" >
	<link href="/javascripts/angular-ui-custom/angular-ui.min.css" rel="stylesheet">
	<script src="/javascripts/angular.min.js" type="text/javascript"></script>
	<script src="/javascripts/angular-resource.min.js" type="text/javascript"></script>
	<script src="/javascripts/angular-ui-custom/angular-ui.js" type="text/javascript"></script>
	<script src="/javascripts/bootstrap-gh-pages/ui-bootstrap-tpls-0.2.0.min.js" type="text/javascript"></script>
	<script src="/javascripts/touro-ng.js" type="text/javascript"></script>
	<script src="/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	 
	 
	
	

  </body>
</html>