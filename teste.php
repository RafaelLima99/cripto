<?php
$url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest?symbol=1';
$parameters = [
 
];

$headers = [
  'Accepts: application/json',
  'X-CMC_PRO_API_KEY: fd9883bb-c82c-48da-8984-2ad15ff614aa'
];
$qs = http_build_query($parameters); // query string encode the parameters
$request = "{$url}?{$qs}"; // create the request URL


$curl = curl_init(); // Get cURL resource
// Set cURL options
curl_setopt_array($curl, array(
  CURLOPT_URL => $request,            // set the request URL
  CURLOPT_HTTPHEADER => $headers,     // set the headers 
  CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
));

$response = curl_exec($curl); // Send the request, save the response
echo "<pre>";
print_r(json_decode($response)); // print json decoded response
curl_close($curl); // Close request
?>