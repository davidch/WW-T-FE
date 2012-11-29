<div class="container skyline">
</div>
<div class="bg-color">
	<div class="container">
		<div class="row">
			<br />
			<p class="span5"><strong>Touro</strong> College and University System<br />
			27-33 West 23 Street<br />
			New York, NY 10010<br />
			(212) 463-0400</p>
		</div>
	</div>
</div>	

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/1.8.2.jquery.min.js"></script>

<!-- <script src="bootstrap/js/bootstrap.js"></script>		 -->

<script src="js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.mousewheel.min.js" type="text/javascript"></script>
<script src="js/jquery.smoothdivscroll-1.2-min.js" type="text/javascript"></script>

<!--
<script src="js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.mousewheel.min.js" type="text/javascript"></script>
<script src="js/jquery.smoothdivscroll-1.2-min.js" type="text/javascript"></script>
-->


<script type="text/javascript">
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
		
		
						
	});
</script>	