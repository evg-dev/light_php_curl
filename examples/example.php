<?php require __DIR__ . '/../vendor/autoload.php';

use evg_dev\LightCurl\LightCurl;

/** @var \evg_dev\LightCurl\Request $response */

try {
    $response = LightCurl::get('www.example.com');
} catch (Exception $e) {
    print_r($e->getMessage());
}

print_r($response->headers);
print_r($response->body);

