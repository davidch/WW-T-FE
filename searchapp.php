<!DOCTYPE html>
<html lang="en" data-ng-app="touro">
  <head>
    <meta charset="utf-8">
    <title>The Touro College and University System</title>
 <style>
.searcherror
{
  border:solid 1px #f00;
}
.main-search-field
{
border-radius: 8px 8px 8px 8px;
box-shadow: 1px 2px 3px rgba(0, 0, 0, 0.7) inset;
padding: 8px 12px;
}
</style>   
    <meta name="description" content="">
    <meta name="author" content="">

    <?php include('includes/head.php'); ?>
    
    	<!--[if lte IE 8]>
      <script>
      // The ieshiv takes care of our ui.directives, bootstrap module directives and
      // AngularJS's ng-view, ng-include, ng-pluralize and ng-switch directives.
      // However, IF you have custom directives (yours or someone else's) then
      // enumerate the list of tags in window.myCustomTags
       
      //window.myCustomTags = [ 'yourDirective', 'somebodyElsesDirective' ]; // optional
      </script>
      <script src="javascripts/angular-ui-custom/angular-ui-ieshiv.min.js"></script>
      <![endif]-->
    
  </head>

  <body class="homepage" style="padding:50px;">

<div data-ng-controller="SearchCtrl">
  <div data-touro-search data-replace-div="#targetdiv" data-search-size="10" data-search-element-uniqueid="mainsearch" data-place-holder-text="Search"></div>
  <div data-ng-show="searchedData">
    <div>TOTAL RESULT {{searchedData.data.hits.total}}</div>
    <pagination boundary-links="true" num-pages="noOfPages" current-page="currentPage"  max-size="maxSize"></pagination>
    <div class="clearfix"> </div>

    <div data-ng-repeat="(k,v) in searchedData.data.hits.hits">
      <div style="padding:10px;border-bottom:solid 1px #ccc;">
        
        <div style="font-weight:bold"><a href="{{v._source.url}}" target="_blank" ng-bind-html-unsafe="v._source.title | removenewlines"></a></div>
        <div style="font-size:10px;"><strong>{{v._source.content_type}}</strong></div>
        <div style="font-size:11px;" ng-bind-html-unsafe="v._source.intro_text_plain_text"></div>
        
      </div>
      
    </div>
      
  </div>
</div>


<div id="targetdiv">
  <h1>CONTENT TO HIDE OR SHOW</h1>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vulputate, quam eu ultrices viverra, dui ipsum mollis lorem, sed posuere lectus tortor non augue. Ut eget justo nec orci elementum molestie. Ut sed tristique enim. Phasellus id orci mi. Integer sollicitudin tortor sit amet nisi luctus tincidunt. Aenean orci mauris, gravida id faucibus ac, pellentesque sit amet magna. Duis dolor dolor, pretium id auctor et, scelerisque ac sapien. Suspendisse rutrum, neque sed egestas cursus, sapien nibh congue quam, eget lacinia ante est tempor quam. Aenean lorem leo, egestas accumsan posuere eget, scelerisque id eros. Cras imperdiet arcu quis dui venenatis dignissim. Praesent varius lacus id risus malesuada interdum. Cras libero risus, ornare pulvinar ornare at, auctor id odio. Etiam convallis risus vel ligula lobortis faucibus.</p>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vulputate, quam eu ultrices viverra, dui ipsum mollis lorem, sed posuere lectus tortor non augue. Ut eget justo nec orci elementum molestie. Ut sed tristique enim. Phasellus id orci mi. Integer sollicitudin tortor sit amet nisi luctus tincidunt. Aenean orci mauris, gravida id faucibus ac, pellentesque sit amet magna. Duis dolor dolor, pretium id auctor et, scelerisque ac sapien. Suspendisse rutrum, neque sed egestas cursus, sapien nibh congue quam, eget lacinia ante est tempor quam. Aenean lorem leo, egestas accumsan posuere eget, scelerisque id eros. Cras imperdiet arcu quis dui venenatis dignissim. Praesent varius lacus id risus malesuada interdum. Cras libero risus, ornare pulvinar ornare at, auctor id odio. Etiam convallis risus vel ligula lobortis faucibus.</p>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vulputate, quam eu ultrices viverra, dui ipsum mollis lorem, sed posuere lectus tortor non augue. Ut eget justo nec orci elementum molestie. Ut sed tristique enim. Phasellus id orci mi. Integer sollicitudin tortor sit amet nisi luctus tincidunt. Aenean orci mauris, gravida id faucibus ac, pellentesque sit amet magna. Duis dolor dolor, pretium id auctor et, scelerisque ac sapien. Suspendisse rutrum, neque sed egestas cursus, sapien nibh congue quam, eget lacinia ante est tempor quam. Aenean lorem leo, egestas accumsan posuere eget, scelerisque id eros. Cras imperdiet arcu quis dui venenatis dignissim. Praesent varius lacus id risus malesuada interdum. Cras libero risus, ornare pulvinar ornare at, auctor id odio. Etiam convallis risus vel ligula lobortis faucibus.</p>
</div>



	<link href="/javascripts/angular-ui-custom/angular-ui.min.css" rel="stylesheet">
	<script src="/javascripts/1.8.2.jquery.min.js" type="text/javascript"></script>
	<script src="/javascripts/angular.min.js" type="text/javascript"></script>
	<script src="/javascripts/angular-resource.min.js" type="text/javascript"></script>
	<script src="/javascripts/angular-ui-custom/angular-ui.min.js" type="text/javascript"></script>
	<script src="/javascripts/bootstrap-gh-pages/ui-bootstrap-tpls-0.2.0.min.js" type="text/javascript"></script>
	<script src="/javascripts/touro-ng.js" type="text/javascript"></script>
	

  </body>
</html>
