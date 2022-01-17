<?php
    require 'vendor/autoload.php'; // If you're using Composer (recommended)
    // Comment out the above line if not using Composer
    // require("<PATH TO>/sendgrid-php.php");
    // If not using Composer, uncomment the above line and
    // download sendgrid-php.zip from the latest release here,
    // replacing <PATH TO> with the path to the sendgrid-php.php file,
    // which is included in the download:
    // https://github.com/sendgrid/sendgrid-php/releases

    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom("ritchie.morfe@gmail.com", "Ritchie Morfe");
    $email->setSubject("my First Mail from SendGrid");
    $email->addTo("ritchie.morfe@gmail.com", "RitzH");
    $email->addContent("text/plain", "Congratulations! This is a sample message");
    $email->addContent(
        "text/html", "<strong>Congratulations! This is a sample message</strong>"
    );

    $key = getenv('SENDGRID_API_KEY', true) ?: $_SERVER['SENDGRID_API_KEY'];
    $sendgrid = new \SendGrid($key);
    // $sendgrid = new \SendGrid($key);
    // $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));

    echo "TESTING...\n";
    // getenv('REMOTE_ADDR') ?: print_r($_SERVER['SENDGRID_API_KEY']);
    // echo "\n";

    try {
        $response = $sendgrid->send($email);
        //$response = $sendgrid->client->_("suppression/bounces")->get();
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }

?>