<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>The Touro College and University System</title>
    
    <meta name="description" content="">
    <meta name="author" content="">

	<link type="text/css" href="../css/inside-pages.css" rel="stylesheet"/>
    <?php include('../includes/head.php'); ?>

  </head>

  <body class="inside_page">

	  <?php include('../includes/top-navigation.php'); ?>
	  
	  <div class="container">
	  	<?php include('../includes/search-inside-pages.php'); ?>
	  
	  	<?php include('../includes/main-navigation.php'); ?>
	  </div>	
	  
    <div class="container" id="main_content">
	    <div class="row">
	    	<div class="inner_padding">
		        <div class="span6 form_info">
		        	<h1>Open House</h1>
		        	<ul>
		        		<li><span><span class="info_label">Date:</span> <span>Wednesday, August 18, 2012</span></span></li>
		        		<li><span><span class="info_label">Time:</span> <span>6:00-8:30pm</span></span></li>
		        		<li><span><span class="info_label">Location:</span> <span>230 West 125th Street<br />New York, NY 10027<br />Room 323</span></span></li>
		        	</ul>	
		        	<img src="../images/inside_pages/open-house1.jpg" alt="open house" />
		        	<img src="../images/inside_pages/open-house2.jpg" alt="open house" />
				</div>			
				<div class="span6">
					<div class="form_holder">
						<form>
							<h2 class="form_header">RSVP</h2>
							<fieldset>
								<div class="form_set">
									<label>Your Name</label>
									<input type="text" />
								</div>
								<div class="form_set">
									<label>Email</label>
									<input type="text" />
								</div>
								<div class="form_set">
									<label>Phone</label>
									<input type="text" />
								</div>
								<div class="form_set">
									<label>Address</label>
									<input type="text" />
									<input type="text" />
								</div>	
								<?php include('includes/state-list.html'); ?>
								<?php include('includes/country-list.html'); ?>
							</fieldset>
							<fieldset>
								<p>What would you like to do today?</p>
								<div class="form_set">
									<input type="radio" /><label>Request a Program Information packet</label>
								</div>
								<div class="form_set">
									<input type="radio" /><label>Schedule One-to-One Information Session</label>
									<div class="form_indent">
										<span>Date:</span> <input type="text" class="short_text" /><br />
										<span>Time:</span> <input type="text" class="short_text" />		
									</div>	
								</div>
								<div class="form_set">
									<input type="radio" /><label>RSVP: Open House - Wednesday, August 8</label>
								</div>
							</fieldset>	
							<fieldset>
								<input type="submit" value="Submit">
							</fieldset>	
						</form> 
					</div>
				</div>
			</div>	
		</div><!-- end row -->	      
   </div> <!-- /container -->

	<footer class="clear">
		<?php include('../includes/footer.php'); ?>
	</footer>



  </body>
</html>