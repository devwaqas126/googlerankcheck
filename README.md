
<!-- GETTING STARTED -->
## Getting Started

This is simple keyword rank checker tool.

<!-- Installation -->
### Installation

    composer require devwaqas/googlerankcheck
    
    
    
## Usage

### csv

```
$client = new SearchEngine();

//Set Search Engine eg. google.com,google.ae,google.sa.....
$client->setEngine('https://www.google.ae');

//return array with keywords and position
$result = $client->search(['keyword 1','keyword 2']);

print_r($result);


```
