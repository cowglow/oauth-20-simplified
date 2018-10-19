<?php
/**
 * OAuth 2.0 Simplified
 *
 */


// Arbitrary string used to label this project
/** @var string $projectTitle */
$projectTitle = 'OAuth 2.0 Simplified';

/**
 * Isolate your Client Id and Secret from repository.
 *
 * This means you'll have you create your on file and follow the pattern layout in the client
 */
include 'lib/clientData.php';

// First thing first. Start the session!
session_start();

// Create state Id and give it to the session
$stateIdentifier   = random_int(10000, 99999);
$_SESSION['state'] = $stateIdentifier;

// For this example we're using GitHub
$loginLink = 'https://github.com/login/oauth/authorize?'.http_build_query([
        'client_id'    => $clientData['clientId'],
        'redirect_uri' => 'http://localhost:8888/callback.php',
        'scope'        => 'user read:user',
        'state'        => $stateIdentifier
    ]);
?>
<!doctype html>
<html class="no-js" lang="">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?= $projectTitle; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="styles/styles.css">
    </head>

    <body>
        <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a
                href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <h1><?= $projectTitle; ?></h1>

        <a class="btn" href="<?= $loginLink; ?>">OAuth Login</a>
    </body>

</html>