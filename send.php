<?php

use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
use Twilio\Rest\Client;

require __DIR__ . "/vendor/autoload.php";

$number = $_POST["number"];
$message = $_POST["message"];

// close curl resource to free up system resources
curl_close($ch);

if ($_POST["provider"] === "infobip") { // Infobib

    $base_url = "9lny4d.api.infobip.com";
    $api_key = "6d99d920a8afb19089348f1cfa2ca0b6-2ffbe15c-5744-4a65-8fa5-54b8a7d9d584";

    $configuration = new Configuration(host: $base_url, apiKey: $api_key);

    $api = new SmsApi(config: $configuration);

    $destination = new SmsDestination(to: $number);

    $message = new SmsTextualMessage(
        destinations: [$destination],
        text: $message,
        from: "test"
    );

    $request = new SmsAdvancedTextualRequest(messages: [$message]);

    $response = $api->sendSmsMessage($request);

}

echo "Message sent.";
