<?php

include '../lib/Curl.php';
include '../lib/Curl/Share.php';



/**
 * curl_share_init() example
 *
 * http://php.net/manual/en/function.curl-share-init.php#refsect1-function.curl-share-init-examples
 */

// Create cURL share handle and set it to share cookie data
$sh = new Curl\Share();
$sh->setopt(CURLSHOPT_SHARE, CURL_LOCK_DATA_COOKIE);

// Initialize the first cURL handle and assign the share handle to it
$ch1 = new Curl("http://example.com/");
$ch1->setopt(CURLOPT_SHARE, $sh);

// Execute the first cURL handle
$ch1->exec();

// Initialize the second cURL handle and assign the share handle to it
$ch2 = new Curl("http://php.net/");
$ch2->setopt(CURLOPT_SHARE, $sh);

// Execute the second cURL handle
//  all cookies from $ch1 handle are shared with $ch2 handle
$ch2->exec();

// Close the cURL share handle
$sh->close();

// Close the cURL handles
$ch1->close();
$ch2->close();
