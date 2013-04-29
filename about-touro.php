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
			
			




<div class="search-wrapper" data-ng-controller="SecondarySearchCtrl" data-ng-cloak>

  <div data-touro-search data-replace-div="#main-content-col-wrapper" data-search-size="10" data-input-class="main-search-field" data-search-element-uniqueid="{{uniquesearchid}}" data-place-holder-text="Type to Search Press Releases" data-search-collection="Press-Release"></div>
  
    <div data-touro-search data-replace-div="#main-content-col-wrapper" data-search-size="10" data-input-class="main-search-field" data-search-element-uniqueid="{{uniquesearchid}}" data-place-holder-text="Type to Search Touro in the News" data-search-collection="Touro-in-the-News"></div>
  
  <div class="clearfix"> </div>

  <div class="search-result-wrapper" data-ng-show="searchedSubData">
   
    <div class="search-pagination"><pagination boundary-links="true" num-pages="noOfPages" current-page="currentPage"  max-size="maxSize"></pagination></div>
    <div class="clearfix"> </div>
    <div class="searched-details">Total Search Results for "{{searchedParams.q}}" : {{searchedSubData.data.hits.total}}</div>
      <div data-ng-repeat="(k,v) in searchedSubData.data.hits.hits">
        <div style="padding:10px;border-bottom:solid 1px #ccc;">
        
        <div style="font-weight:bold"><a href="{{v.url | swapurl:v.source_url }}" target="_blank" ng-bind-html-unsafe="v.title | removenewlines"></a></div>
        <div style="font-size:10px;"><strong>{{v.content_type}}</strong></div>
        <div style="font-size:11px;" ng-bind-html-unsafe="v.intro_text_plain_text"></div>
        
      </div>
    

    
    </div>
    <div class="clearfix"> </div>
    <div class="search-pagination"><pagination boundary-links="true" num-pages="noOfPages" current-page="currentPage"  max-size="maxSize"></pagination></div>
    
      
  </div>
</div>			
			
<div id="main-content-col-wrapper">			
			
			
				<h2 class="section_header">Touro por rom quisquam est, qui dolorem New York ipsum quia dolor sit amet, consectetur, adipisci velit, quia non eius.</h2>
				<div class="row">
					<div class="span6">	
						<p class="intro">Sed ut perspiciatis unde omnis iste natus error sit accusantium dolore mque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta, Touro College sunt explicabo.</p>
						<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur <a href="#">magni dolores</a> eos qui ratione voluptatem sequi nesciunt. Touro por rom quisquam est, qui dolorem New York ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius.</p>
						<p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
					</div>	
					<div class="span3 sidebar_feature">
						<img src="images/sidebar_feature_about.jpg" alt="Treating History" />							
						<div class="img_overlay">
						</div>	
						<div class="inner">
							<h3>Treating History</h3>
							<p>This might look like an ordinary day in the lab, but this TouroCOM student is part of a new approach to community healthcare that could provide a model for cities around the world.</p>
						</div>	
					</div>
					
				</div>					
					
					
					
					
					
					
				</div>	
			</div>
		</div><!-- end row -->	      
   </div> <!-- /container -->

	<footer class="clear">
		<?php include('includes/footer.php'); ?>
	</footer>

	<link href="/javascripts/angular-ui-custom/angular-ui.min.css" rel="stylesheet">
	<script src="/javascripts/angular.min.js" type="text/javascript"></script>
	<script src="/javascripts/angular-resource.min.js" type="text/javascript"></script>
	<script src="/javascripts/angular-ui-custom/angular-ui.min.js" type="text/javascript"></script>
	<script src="/javascripts/bootstrap-gh-pages/ui-bootstrap-tpls-0.2.0.min.js" type="text/javascript"></script>
	<script src="/javascripts/touro-ng.js" type="text/javascript"></script>

  </body>
</html>