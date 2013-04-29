<?php 
ini_set('display_errors', 1);
 ini_set('log_errors', 1);
 ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
 error_reporting(E_ALL);

function indent($json) {

    $result      = '';
    $pos         = 0;
    $strLen      = strlen($json);
    $indentStr   = '  ';
    $newLine     = "\n";
    $prevChar    = '';
    $outOfQuotes = true;

    for ($i=0; $i<=$strLen; $i++) {

        // Grab the next character in the string.
        $char = substr($json, $i, 1);

        // Are we inside a quoted string?
        if ($char == '"' && $prevChar != '\\') {
            $outOfQuotes = !$outOfQuotes;

        // If this character is the end of an element,
        // output a new line and indent the next line.
        } else if(($char == '}' || $char == ']') && $outOfQuotes) {
            $result .= $newLine;
            $pos --;
            for ($j=0; $j<$pos; $j++) {
                $result .= $indentStr;
            }
        }

        // Add the character to the result string.
        $result .= $char;

        // If the last character was the beginning of an element,
        // output a new line and indent the next line.
        if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
            $result .= $newLine;
            if ($char == '{' || $char == '[') {
                $pos ++;
            }

            for ($j = 0; $j < $pos; $j++) {
                $result .= $indentStr;
            }
        }

        $prevChar = $char;
    }

    return $result;
}




function __autoload_elastica ($class) {
    $path = str_replace('\\', '/', substr($class, 0));

    if (file_exists('/srv/www/Elastica/lib/' . $path . '.php')) {
        require_once('/srv/www/Elastica/lib/' . $path . '.php');
    }
}

$elasticaClient = null;
//$allowed_hosts = array( 'www.touro.edu');
//if (isset($_SERVER['HTTP_HOST']) && in_array($_SERVER['HTTP_HOST'], $allowed_hosts)) {

function object_to_array($data)
{
    if (is_array($data) || is_object($data))
    {
        $result = array();
        foreach ($data as $key => $value)
        {
            $result[$key] = object_to_array($value);
        }
        return $result;
    }
    return $data;
}
function sanitize($data)
{
  // remove whitespaces (not a must though)
  $data = trim($data); 
  
  // apply stripslashes if magic_quotes_gpc is enabled
  if(get_magic_quotes_gpc()) 
  {
  $data = stripslashes($data); 
  }
  
  // a mySQL connection is required before using this function
  $data = mysql_real_escape_string($data);
  
  return $data;
}

if(1) {
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
$elasticaIndex = $elasticaClient->getIndex('lcm');

// Query string
$queryString = new Elastica\Query\QueryString($_GET['q']);
$queryString->setDefaultOperator($_GET['default_operator']);



if(isset($_GET['collection'])  && $_GET['collection'] != 'all') {  
$collection = str_replace('-', ' ', $_GET['collection']);
$queryMatch = new Elastica\Query\Match();
$queryMatch->setFieldQuery('content_type', $collection);

$elasticaTypeFilter	= new Elastica\Filter\Query();
$elasticaTypeFilter->setQuery($queryMatch);
$elasticaFilterAnd 	= new Elastica\Filter\BoolAnd();
$elasticaFilterAnd->addFilter($elasticaTypeFilter);

//print_r($elasticaTypeFilter);
$filteredQuery = new Elastica\Query\Filtered(
    $queryString,
    $elasticaTypeFilter
);
 
// Create the main query object
$query = new Elastica\Query($filteredQuery);
//$query->setFilter($elasticaFilterAnd);
}
else
{
$query = new Elastica\Query($queryString);
}

$query->setFrom($_GET['from'])->setLimit($_GET['size']);
 
// Create the search object and inject the client
$search = new Elastica\Search($elasticaClient);
 
// Configure and execute the search
$resultSet = $search->addIndex('www')->search($query);





/*

*/

/*
$query
  ->query()
    ->filteredQuery()
      ->query()
        ->queryString()
          ->field('query', ])
          ->defaultOperator($_GET['default_operator'])
        ->queryStringClose()
      ->queryClose()
    ->filteredQueryClose()
  ->queryClose()
  ->from($_GET['from'])
  ->size($_GET['size'])->setFilter($elasticaFilterAnd);;
 

// Create a raw query since the query above can't be passed directly to the search method used below
$query = new Elastica\Query($query->toArray());


// Create the search object and inject the client
$search = new Elastica\Search($elasticaClient);
*/



 header('Content-Type: application/json');
// Configure and execute the search
//$resultSet = $search->addIndex('www')->addType('page')->search($query);

$data = array();
foreach($resultSet as $result){
    $data[] = $result->getData();
}
$response = array();
$response['hits']['hits'] = $data;

$response['hits']['total'] = $resultSet->getTotalHits();


echo indent(json_encode($response));

}
?>