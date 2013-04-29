<div id="search_bar">
<<<<<<< HEAD
	<a href="index.php"><img src="images/WeAreTouro.png" alt="We Are Touro" /></a>
	
	
	
		<div class="search-wrapper" data-ng-controller="SearchCtrl">
		
        <div class="pull-right" data-touro-search data-replace-div="#makeMeScrollable,#main_content,#main_navigation" data-search-size="10" data-input-class="main-search-field inside-main-search" data-search-element-uniqueid="{{uniquesearchid}}" data-place-holder-text="Type to Search"></div>
        <div class="clearfix"> </div>

        <div class="search-result-wrapper" data-ng-show="searchedData">
         
          <div class="search-pagination"><pagination boundary-links="true" num-pages="noOfPages" current-page="currentPage"  max-size="maxSize"></pagination></div>
          <div class="clearfix"> </div>
          <div class="searched-details">Total Search Results for "{{searchedParams.q}}" : {{searchedData.data.hits.total}}</div>
             <div data-ng-repeat="(k,v) in searchedData.data.hits.hits">
              <div style="padding:10px;border-bottom:solid 1px #ccc;">
              
              <div style="font-weight:bold"><a href="{{v.url}}" target="_blank" ng-bind-html-unsafe="v.title | removenewlines"></a></div>
              <div style="font-size:10px;"><strong>{{v.content_type}}</strong></div>
              <div style="font-size:11px;" ng-bind-html-unsafe="v.intro_text_plain_text"></div>
              
            </div>
          

          
          </div>
          <div class="clearfix"> </div>
          <div class="search-pagination"><pagination boundary-links="true" num-pages="noOfPages" current-page="currentPage"  max-size="maxSize"></pagination></div>
          
            
        </div>
      </div>



</div>	