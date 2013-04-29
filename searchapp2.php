<?php //phpinfo(); ?>


<!DOCTYPE html>
<html lang="en" data-ng-app="touro">
  <head>
    <meta charset="utf-8">
    <title>The Touro College and University System</title>
    
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

<?php 


function full_url()
{
    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
    $sp = strtolower($_SERVER["SERVER_PROTOCOL"]);
    $protocol = substr($sp, 0, strpos($sp, "/")) . $s;
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
    return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
}
function __autoload_elastica ($class) {
    $path = str_replace('\\', '/', substr($class, 0));

    if (file_exists('/srv/www/Elastica/lib/' . $path . '.php')) {
        require_once('/srv/www/Elastica/lib/' . $path . '.php');
    }
}

$elasticaClient = null;
$allowed_hosts = array( '50.116.41.30');
if (1) {

spl_autoload_register('__autoload_elastica');
   
//Or using anonymous function PHP 5.3.0>=
spl_autoload_register(function($class){
   
   if (file_exists('/srv/www/Elastica/lib/' . $class . '.php')) {
        require_once('/srv/www/Elastica/lib/' . $class . '.php');
    }

});

$elasticaClient = new Elastica\Client(array(
   'host' => 'search.touro.edu',
   'port' => '80'
));
$elasticaIndex = $elasticaClient->getIndex('www');
}
?>


<?

/*
$elasticaQueryString 	= new Elastica\Query\QueryString();

//'And' or 'Or' default : 'Or'
$elasticaQueryString->setDefaultOperator('AND');
$elasticaQueryString->setQuery('touro');

// Create the actual search object with some data.
$elasticaQuery 		= new Elastica\Query();
$elasticaQuery->setQuery($elasticaQueryString);

//Search on the index.
$elasticaResultSet 	= $elasticaIndex->search($elasticaQuery);*/
$documentdata = array(
  'cid' => 1571,
  'content_type' =>'General Content',
  'name' => 'Home',
  'title' => 'About Touro',
  'intro_text' => '&lt;p&gt;&lt;a href=&quot;/about/at-a-glance/#d.en.1875&quot;&gt;Touro students hail from all over the world&lt;/a&gt;, from all walks of life, in the pursuit of a common goal: To get the best possible education, to find a promising professional career, and to do so in an environment that respects and supports their backgrounds and beliefs.&lt;/p&gt;\n&lt;!--  edited --&gt;',
  'intro_text_plain_text' => 'Touro students hail from all over the world, from all walks of life, in the pursuit of a common goal: To get the best possible education, to find a promising professional career, and to do so in an environment that respects and supports their backgrounds and beliefs.\n',
  'main_body' => '&lt;p&gt;What sets Touro apart is not simply our top-notch programs, engaged faculty members, or experiential learning opportunities, it&rsquo;s our culture and curriculum that respect your commitments &ndash; to your community, your values, and your future.&lt;/p&gt;\n&lt;p&gt;&lt;a href=&quot;/about/our-history/#d.en.1879&quot;&gt;Established in 1970&lt;/a&gt; to focus on higher education for &lt;a href=&quot;/about/jewish-heritage/#d.en.1883&quot;&gt;the Jewish community&lt;/a&gt;, we&rsquo;ve grown to serve a widely diverse population of over &lt;a href=&quot;/locations/&quot;&gt;19,000 students across 32 schools in 5 countries&lt;/a&gt;. We are uniquely attuned to the importance of an education that accommodates students from all backgrounds and circumstances.&lt;/p&gt;\n&lt;p&gt;From liberal arts to law, health sciences to technology, business, Jewish studies, education&mdash;and everything in between&mdash;Touro provides &lt;a href=&quot;/fields/#d.en.1584&quot;&gt;educational opportunities and career paths&lt;/a&gt; to not only the most talented and motivated students but also those who have been overlooked and underserved, who have the drive and potential to succeed.&lt;/p&gt;\n&lt;p&gt;We have something for everyone. The only question is: To what do you aspire and what do you want to achieve?&lt;/p&gt;',
  'main_body_plain_text' => 'What sets Touro apart is not simply our top-notch programs, engaged faculty members, or experiential learning opportunities, it&rsquo;s our culture and curriculum that respect your commitments &ndash; to your community, your values, and your future.\nEstablished in 1970 to focus on higher education for the Jewish community, we&rsquo;ve grown to serve a widely diverse population of over 19,000 students across 32 schools in 5 countries. We are uniquely attuned to the importance of an education that accommodates students from all backgrounds and circumstances.\nFrom liberal arts to law, health sciences to technology, business, Jewish studies, education&mdash;and everything in between&mdash;Touro provides educational opportunities and career paths to not only the most talented and motivated students but also those who have been overlooked and underserved, who have the drive and potential to succeed.\nWe have something for everyone. The only question is: To what do you aspire and what do you want to achieve?',
  'url' => full_url(),
  'indexed_date' => convert(time(), "UTC"),
  'meta' => array(
    'last_modified'=> convert(strtotime('Tue, 11 Mar 2013 10:48:38 CDT'), 'UTC'),  
    'last_modified_by_username' => 'david.choi',  
    'last_modified_by_fullname' => 'david.choi',
    'publish_date' => '',
    'expiry_date' => '',
    'content_version' => '7.0',
    'modified_within_x_days' => ''
  )
);   
 
function convert($time, $timezone = '', $format = 'Y-m-d H:i:s')
{
  if (is_integer($time))
  {
  $time = date('r', $time);
  }
  
  $result = FALSE;
  
  if ($datetime = new DateTime($time))
  {
  // If timezone not speciofied then we get server timezone
  if (empty($timezone))
  {
  $timezone = date('e');
  }
  
  $datetime->setTimeZone(new DateTimeZone($timezone));
  
  $result = $datetime->format($format);
  }
  
  return $result;
} 

$type = $elasticaClient->getIndex('www')->getType('page');

try {
  $doc = $type->getDocument($documentdata['cid']); 
} catch (Exception $e) {
  $doc = false;
}

//$indexed_doc_lastmodified = $doc->indexed_date;

if(($doc->indexed_date < $documentdata['meta']['last_modified']) || !$doc)
{
  echo "reindex";
}



if(full_url() != 'http://www.touro.edu/' && $elasticaClient != null)
{
//  $elasticaType = $elasticaIndex->getType('page');
//  $page = new Elastica\Document($documentdata['cid'],$documentdata);
//  $elasticaType->addDocument($page);
}
?>

<div data-ng-controller="SearchCtrl">
  <div data-touro-search></div>
  
  <div data-ng-show="searchedData">TOTAL RESULT {{searchedData.data.hits.total}}</div>
  <div data-ng-repeat="(k,v) in searchedData.data.hits.hits">
    <div style="padding:10px;border-bottom:solid 1px #ccc;">
      <div style="font-weight:bold"><a href="{{v._source.url}}" target="_blank">{{v._source.title}}</a></div>
      <div style="font-size:11px;">{{v._source.intro_text_plain_text}}</div>
      <div style="font-size:10px;"><strong>{{v._source.content_type}}</strong></div>
    </div>
    
  </div>
  
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
