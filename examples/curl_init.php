<?php

include '../lib/Curl.php';
include '../lib/CurlMulti.php';
include '../lib/CurlShare.php';



/**
 * curl_init() example
 *
 * http://php.net/manual/en/function.curl-init.php#refsect1-function.curl-init-examples
 */

// create a new cURL resource
$ch = new Curl();

// set URL and other appropriate options
$ch->setopt(CURLOPT_URL, "http://www.example.com/");
$ch->setopt(CURLOPT_HEADER, 0);

// grab URL and pass it to the browser
$ch->exec();

// close cURL resource, and free up system resources
$ch->close();
