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
	        <div class="span3 inside_navigation">
	        	<div>
		        	<?php include('includes/side-nav.html'); ?>
        		</div>
			</div>
			<div class="span9 main form outline">
				<div class="row">
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
					<div class="span3">
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