<?php

include 'lib/clientData.php';

session_start();


if ((int)$_GET['state'] !== (int)$_SESSION['state']) {
    die ('Invalid State');
}


// Request Token
$ch = curl_init('https://github.com/login/oauth/access_token');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => [
        'Accept: application/json',
        'User-Agent: http://localhost:8888'
    ],
    CURLOPT_POSTFIELDS     => http_build_query([
        'client_id'     => $clientData['clientId'],
        'client_secret' => $clientData['clientSecret'],
        'code'          => $_GET['code'],
        'redirect_url'  => 'callback.php',
        'state'         => $_GET['state']
    ]),

]);
$tokenRequest = curl_exec($ch);
// Execute and Read
$tokenData = json_decode($tokenRequest);
// Store Token in Session
$_SESSION['access_token'] = $tokenData->access_token;

if (isset($tokenData->error)) {
    die ('Fatal Error');
}
?>
<!doctype html>
<html class="no-js" lang="">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>OAuth 2.0 Simplified</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="styles/styles.css">
    </head>

    <body>
        <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a
                href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <h1>OAuth 2.0 Simplified</h1>

        <h3>Token Request Successful!</h3>

        <a class="btn" href="app.php">Continue</a>
    </body>

</html>

