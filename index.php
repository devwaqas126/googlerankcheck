<?php 

include './SearchEngine.php';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$client = new SearchEngine();
$client->setEngine('https://www.google.ae');
$result = $client->search(['hello','car services']);
echo "<pre>";
print_r($result);

