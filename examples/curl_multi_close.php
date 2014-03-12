<?php

include '../lib/Curl.php';
include '../lib/CurlMulti.php';
include '../lib/CurlShare.php';



/**
 * curl_multi_close() example
 *
 * http://php.net/manual/en/function.curl-multi-close.php#refsect1-function.curl-multi-close-examples
 */

// create both cURL resources
$ch1 = new Curl();
$ch2 = new Curl();

// set URL and other appropriate options
$ch1->setopt(CURLOPT_URL, "http://www.example.com/");
$ch1->setopt(CURLOPT_HEADER, 0);
$ch2->setopt(CURLOPT_URL, "http://www.php.net/");
$ch2->setopt(CURLOPT_HEADER, 0);

//create the multiple cURL handle
$mh = new CurlMulti();

//add the two handles
$mh->add_handle($ch1);
$mh->add_handle($ch2);

$running=null;
//execute the handles
do {
	$mh->exec($running);
} while ($running > 0);

//close the handles
$mh->remove_handle($ch1);
$mh->remove_handle($ch2);
$mh->close();
