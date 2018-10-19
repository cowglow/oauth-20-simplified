<?php

session_start();

$ch = curl_init('https://api.github.com/user/repos?');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => [
        'Accept: application/json',
        'User-Agent: http://localhost:8888',
        'Authorization: Bearer '.$_SESSION['access_token']
    ]
]);
$repos = json_decode(curl_exec($ch), true);;
?>
<!doctype html>
<html class="no-js" lang="">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>OAuth 2.0 Simplified - Your Repositories</title>
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

        <h2>GitHub Repositories</h2>

        <ol>
            <?php foreach ($repos as $repo) { ?>
                <li>
                    <h3>
                        <a href="<?= $repo['html_url']; ?>"><?= $repo['name']; ?></a>
                    </h3>
                    <span><?= $repo['language']; ?></span> |
                    <span><?= $repo['description']; ?></span>
                </li>
            <?php } ?>
        </ol>
    </body>

</html>
