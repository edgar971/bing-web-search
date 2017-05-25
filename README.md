# Bing Web Search Client

## How to use this library



## Setup

### Laravel

### Simple PHP Site/Script
1. [Download](https://gitlab.envano.com/Envano/bing-web-search/builds/artifacts/master/download?job=release) the latest release.
1. Include the `autoload.php` file

        require_once __DIR__ . '/bing-web-search/vendor/autoload.php';
        
1. Use the class

        use EPino\BingSearch\Client;
        
1. Create the client by passing the API to the constructor.
        
        $client = new Client("343434dfdfdfdfdfdfdfdf");
