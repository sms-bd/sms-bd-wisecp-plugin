<?php

defined('CORE_FOLDER') or exit('You can not get in here!');


// function log_message($message)
// {
//     // Path to the log file
//     $logFile = __DIR__ . '/hook_log.txt';

//     // Write to the log file
//     if (is_writable($logFile) || !file_exists($logFile)) {
//         file_put_contents($logFile, $message . "\n", FILE_APPEND);
//     } else {
//         error_log("Unable to write to log file: " . $logFile);
//     }
// }

Hook::add("ClientCreated", 1, function ($params = []) {
    // Include the SmsNetbd class
    include_once(__DIR__ . "/../modules/SMS/SmsNetbd/SmsNetbd.php");

    // Initialize SmsNetbd
    $SmsNetbd = new SmsNetbd();

    // Get configuration
    $config = $SmsNetbd->getConfig();

    $check = $config['ClientCreatedCheck']; // Enable or disable SMS
    $number = $config['ClientCreatedNumber']; // Recipient number
    $messageTemplate = $config['ClientCreatedMessage']; // Message template

    // Replace {name} placeholder with client's full name in the message
    $message = str_replace('{name}', $params['full_name'], $messageTemplate);

    // Variable to store SMS response
    $sendMessage = null;

    if ($check) {
        // Send the SMS
        $sendMessage = $SmsNetbd->send($message, $number);

        // Prepare log message
        $logMessage = "ClientCreated event triggered for: " . $params['full_name'] .
            ", Number: " . $number .
            ", Message: " . $message .
            ", Response: " . json_encode($sendMessage);

       
    }

});

Hook::add("OrderDeleted", 1, function ($params = []) {

    // Include the SmsNetbd class
    include_once(__DIR__ . "/../modules/SMS/SmsNetbd/SmsNetbd.php");

    // Initialize SmsNetbd
    $SmsNetbd = new SmsNetbd();

    // Get configuration
    $config = $SmsNetbd->config;

    $check = $config['OrderDeletedCheck']; // Enable or disable SMS
    $number = $config['OrderDeletedNumber']; // Recipient number
    $messageTemplate = $config['OrderDeletedMessage']; // Message template

    // Replace {name} placeholder with client's full name in the message
    $message = str_replace('{id}', $params['id'], $messageTemplate);

    // Variable to store SMS response
    $sendMessage = null;

    if ($check) {
        // Send the SMS
        $sendMessage = $SmsNetbd->send($message, $number);

        // Prepare log message
        $logMessage = "OrderDeleted event triggered for: " . $params['id'] .
            ", Number: " . $number .
            ", Message: " . $message .
            ", Response: " . json_encode($sendMessage);


    }
});


Hook::add("OrderApproved", 1, function ($params = []) {

    // Include the SmsNetbd class
    include_once(__DIR__ . "/../modules/SMS/SmsNetbd/SmsNetbd.php");

    // Initialize SmsNetbd
    $SmsNetbd = new SmsNetbd();

    // Get configuration
    $config = $SmsNetbd->config;

    $check = $config['OrderApprovedCheck']; // Enable or disable SMS
    $number = $config['OrderApprovedNumber']; // Recipient number
    $messageTemplate = $config['OrderApprovedMessage']; // Message template

    // Replace {name} placeholder with client's full name in the message
    $message = str_replace('{id}', $params['id'], $messageTemplate);

    // Variable to store SMS response
    $sendMessage = null;

    if ($check) {
        // Send the SMS
        $sendMessage = $SmsNetbd->send($message, $number);

        // Prepare log message
        $logMessage = "OrderApproved event triggered for: " . $params['id'] .
            ", Number: " . $number .
            ", Message: " . $message .
            ", Response: " . json_encode($sendMessage);

    
    }
});


Hook::add("OrderSuspended", 1, function ($params = []) {

    // Include the SmsNetbd class
    include_once(__DIR__ . "/../modules/SMS/SmsNetbd/SmsNetbd.php");

    // Initialize SmsNetbd
    $SmsNetbd = new SmsNetbd();

    // Get configuration
    $config = $SmsNetbd->config;

    $check = $config['OrderSuspendedCheck']; // Enable or disable SMS
    $number = $config['OrderSuspendedNumber']; // Recipient number
    $messageTemplate = $config['OrderSuspendedMessage']; // Message template

    // Replace {name} placeholder with client's full name in the message
    $message = str_replace('{id}', $params['id'], $messageTemplate);

    // Variable to store SMS response
    $sendMessage = null;

    if ($check) {
        // Send the SMS
        $sendMessage = $SmsNetbd->send($message, $number);

        // Prepare log message
        $logMessage = "OrderSuspended event triggered for: " . $params['id'] .
            ", Number: " . $number .
            ", Message: " . $message .
            ", Response: " . json_encode($sendMessage);

    
    }
});


Hook::add("OrderCancelled", 1, function ($params = []) {

    // Include the SmsNetbd class
    include_once(__DIR__ . "/../modules/SMS/SmsNetbd/SmsNetbd.php");

    // Initialize SmsNetbd
    $SmsNetbd = new SmsNetbd();

    // Get configuration
    $config = $SmsNetbd->config;

    $check = $config['OrderCancelledCheck']; // Enable or disable SMS
    $number = $config['OrderCancelledNumber']; // Recipient number
    $messageTemplate = $config['OrderCancelledMessage']; // Message template

    // Replace {name} placeholder with client's full name in the message
    $message = str_replace('{id}', $params['id'], $messageTemplate);

    // Variable to store SMS response
    $sendMessage = null;

    if ($check) {
        // Send the SMS
        $sendMessage = $SmsNetbd->send($message, $number);

        // Prepare log message
        $logMessage = "OrderCancelled event triggered for: " . $params['id'] .
            ", Number: " . $number .
            ", Message: " . $message .
            ", Response: " . json_encode($sendMessage);

       
    }
});


Hook::add("TicketAdminCreated", 1, function ($params = []) {

    // Include the SmsNetbd class
    include_once(__DIR__ . "/../modules/SMS/SmsNetbd/SmsNetbd.php");

    // Initialize SmsNetbd
    $SmsNetbd = new SmsNetbd();

    // Get configuration
    $config = $SmsNetbd->config;

    $check = $config['TicketAdminCreatedCheck']; // Enable or disable SMS
    $number = $config['TicketAdminCreatedNumber']; // Recipient number
    $messageTemplate = $config['TicketAdminCreatedMessage']; // Message template

    // Replace {name} placeholder with client's full name in the message
    $message = str_replace('{id}', $params['request']['id'], $messageTemplate);

    // Variable to store SMS response
    $sendMessage = null;

    if ($check) {
        // Send the SMS
        $sendMessage = $SmsNetbd->send($message, $number);

        // Prepare log message
        $logMessage = "TicketAdminCreated event triggered for: " . $$params['request']['id'] .
            ", Number: " . $number .
            ", Message: " . $message .
            ", Response: " . json_encode($sendMessage);

    }
});

Hook::add("TicketAdminReplied", 1, function ($params = []) {

    // Include the SmsNetbd class
    include_once(__DIR__ . "/../modules/SMS/SmsNetbd/SmsNetbd.php");

    // Initialize SmsNetbd
    $SmsNetbd = new SmsNetbd();

    // Get configuration
    $config = $SmsNetbd->config;

    $check = $config['TicketAdminRepliedCheck']; // Enable or disable SMS
    $number = $config['TicketAdminRepliedNumber']; // Recipient number
    $messageTemplate = $config['TicketAdminRepliedMessage']; // Message template

    // Replace {name} placeholder with client's full name in the message
    $message = str_replace('{id}', $params['request']['id'], $messageTemplate);

    // Variable to store SMS response
    $sendMessage = null;

    if ($check) {
        // Send the SMS
        $sendMessage = $SmsNetbd->send($message, $number);

        // Prepare log message
        $logMessage = "TicketAdminReplied event triggered for: " . $params['request']['id'] .
            ", Number: " . $number .
            ", Message: " . $message .
            ", Response: " . json_encode($sendMessage);

    }
});

Hook::add("TicketAdminUpdated", 1, function ($params = []) {

    // Include the SmsNetbd class
    include_once(__DIR__ . "/../modules/SMS/SmsNetbd/SmsNetbd.php");

    // Initialize SmsNetbd
    $SmsNetbd = new SmsNetbd();

    // Get configuration
    $config = $SmsNetbd->config;

    $check = $config['TicketAdminUpdatedCheck']; // Enable or disable SMS
    $number = $config['TicketAdminUpdatedNumber']; // Recipient number
    $messageTemplate = $config['TicketAdminUpdatedMessage']; // Message template

    // Replace {name} placeholder with client's full name in the message
    $message = str_replace('{id}', $params['request']['id'], $messageTemplate);

    // Variable to store SMS response
    $sendMessage = null;

    if ($check) {
        // Send the SMS
        $sendMessage = $SmsNetbd->send($message, $number);

        // Prepare log message
        $logMessage = "TicketAdminUpdated event triggered for: " . $params['request']['id'] .
            ", Number: " . $number .
            ", Message: " . $message .
            ", Response: " . json_encode($sendMessage);

    
    }
});

Hook::add("TicketClientCreated", 1, function ($params = []) {

    // Include the SmsNetbd class
    include_once(__DIR__ . "/../modules/SMS/SmsNetbd/SmsNetbd.php");

    // Initialize SmsNetbd
    $SmsNetbd = new SmsNetbd();

    // Get configuration
    $config = $SmsNetbd->config;

    $check = $config['TicketClientCreatedCheck']; // Enable or disable SMS
    $number = $config['TicketClientCreatedNumber']; // Recipient number
    $messageTemplate = $config['TicketClientCreatedMessage']; // Message template

    // Replace {name} placeholder with client's full name in the message
    $message = str_replace('{id}', $params['request']['id'], $messageTemplate);

    // Variable to store SMS response
    $sendMessage = null;

    if ($check) {
        // Send the SMS
        $sendMessage = $SmsNetbd->send($message, $number);

        // Prepare log message
        $logMessage = "TicketClientCreated event triggered for: " . $params['request']['id'] .
            ", Number: " . $number .
            ", Message: " . $message .
            ", Response: " . json_encode($sendMessage);

 
    }
});

Hook::add("TicketClientReplied", 1, function ($params = []) {

    // Include the SmsNetbd class
    include_once(__DIR__ . "/../modules/SMS/SmsNetbd/SmsNetbd.php");

    // Initialize SmsNetbd
    $SmsNetbd = new SmsNetbd();

    // Get configuration
    $config = $SmsNetbd->config;

    $check = $config['TicketClientRepliedCheck']; // Enable or disable SMS
    $number = $config['TicketClientRepliedNumber']; // Recipient number
    $messageTemplate = $config['TicketClientRepliedMessage']; // Message template

    // Replace {name} placeholder with client's full name in the message
    $message = str_replace('{id}', $params['request']['id'], $messageTemplate);

    // Variable to store SMS response
    $sendMessage = null;

    if ($check) {
        // Send the SMS
        $sendMessage = $SmsNetbd->send($message, $number);

        // Prepare log message
        $logMessage = "TicketClientReplied event triggered for: " . $params['request']['id'] .
            ", Number: " . $number .
            ", Message: " . $message .
            ", Response: " . json_encode($sendMessage);


    }
});


// Client hooks

Hook::add("ClientBlocked", 1, function ($params = []) {
    // Include the SmsNetbd class
    include_once(__DIR__ . "/../modules/SMS/SmsNetbd/SmsNetbd.php");

    // Initialize SmsNetbd
    $SmsNetbd = new SmsNetbd();

    // Get configuration
    $config = $SmsNetbd->config;

    $check = $config['ClientBlockedCheck']; // Enable or disable SMS
    $number = $config['ClientBlockedNumber']; // Recipient number
    $messageTemplate = $config['ClientBlockedMessage']; // Message template

    // Replace {name} placeholder with client's full name in the message
    $message = str_replace('{name}', $params['full_name'], $messageTemplate);

    // Variable to store SMS response
    $sendMessage = null;

    if ($check) {

        // Send the SMS
        $sendMessage = $SmsNetbd->send($message, $number);

        // Prepare log message
        $logMessage = "ClientBlocked event triggered for: " . $params['full_name'] .
            ", Number: " . $number .
            ", Message: " . $message .
            ", Response: " . json_encode($sendMessage);

    }
});

Hook::add("ClientActivated", 1, function ($params = []) {
    // Include the SmsNetbd class
    include_once(__DIR__ . "/../modules/SMS/SmsNetbd/SmsNetbd.php");

    // Initialize SmsNetbd
    $SmsNetbd = new SmsNetbd();

    // Get configuration
    $config = $SmsNetbd->config;

    $check = $config['ClientActivatedCheck']; // Enable or disable SMS
    $number = $config['ClientActivatedNumber']; // Recipient number
    $messageTemplate = $config['ClientActivatedMessage']; // Message template

    // Replace {name} placeholder with client's full name in the message
    $message = str_replace('{name}', $params['full_name'], $messageTemplate);

    // Variable to store SMS response
    $sendMessage = null;

    if ($check) {
        // Send the SMS
        $sendMessage = $SmsNetbd->send($message, $number);

        // Prepare log message
        $logMessage = "ClientActivated event triggered for: " . $params['full_name'] .
            ", Number: " . $number .
            ", Message: " . $message .
            ", Response: " . json_encode($sendMessage);

     
    }
});

Hook::add("InvoicePaid", 1, function ($params = []) {

    // Include the SmsNetbd class
    include_once(__DIR__ . "/../modules/SMS/SmsNetbd/SmsNetbd.php");

    // Initialize SmsNetbd
    $SmsNetbd = new SmsNetbd();

    // Get configuration
    $config = $SmsNetbd->config;

    $check = $config['InvoicePaidCheck']; // Enable or disable SMS
    $number = $config['InvoicePaidNumber']; // Recipient number
    $messageTemplate = $config['InvoicePaidMessage']; // Message template

    // Replace {name} placeholder with client's full name in the message
    $message = str_replace('{id}', $params['id'], $messageTemplate);

    // Variable to store SMS response
    $sendMessage = null;

    if ($check) {
        // Send the SMS
        $sendMessage = $SmsNetbd->send($message, $number);

        // Prepare log message
        $logMessage = "InvoicePaid event triggered for: " . $params['id'] .
            ", Number: " . $number .
            ", Message: " . $message .
            ", Response: " . json_encode($sendMessage);

    
    }
});


Hook::add("InvoiceCancelled", 1, function ($params = []) {

    // Include the SmsNetbd class
    include_once(__DIR__ . "/../modules/SMS/SmsNetbd/SmsNetbd.php");

    // Initialize SmsNetbd
    $SmsNetbd = new SmsNetbd();

    // Get configuration
    $config = $SmsNetbd->config;

    $check = $config['InvoiceCancelledCheck']; // Enable or disable SMS
    $number = $config['InvoiceCancelledNumber']; // Recipient number
    $messageTemplate = $config['InvoiceCancelledMessage']; // Message template

    // Replace {name} placeholder with client's full name in the message
    $message = str_replace('{id}', $params['id'], $messageTemplate);

    // Variable to store SMS response
    $sendMessage = null;

    if ($check) {
        // Send the SMS
        $sendMessage = $SmsNetbd->send($message, $number);

        // Prepare log message
        $logMessage = "InvoiceCancelled event triggered for: " . $params['id'] .
            ", Number: " . $number .
            ", Message: " . $message .
            ", Response: " . json_encode($sendMessage);

   
    }
});


Hook::add("InvoiceRefunded", 1, function ($params = []) {

    // Include the SmsNetbd class
    include_once(__DIR__ . "/../modules/SMS/SmsNetbd/SmsNetbd.php");

    // Initialize SmsNetbd
    $SmsNetbd = new SmsNetbd();

    // Get configuration
    $config = $SmsNetbd->config;

    $check = $config['InvoiceRefundedCheck']; // Enable or disable SMS
    $number = $config['InvoiceRefundedNumber']; // Recipient number
    $messageTemplate = $config['InvoiceRefundedMessage']; // Message template

    // Replace {name} placeholder with client's full name in the message
    $message = str_replace('{id}', $params['id'], $messageTemplate);

    // Variable to store SMS response
    $sendMessage = null;

    if ($check) {
        // Send the SMS
        $sendMessage = $SmsNetbd->send($message, $number);

        // Prepare log message
        $logMessage = "InvoiceRefunded event triggered for: " . $params['id'] .
            ", Number: " . $number .
            ", Message: " . $message .
            ", Response: " . json_encode($sendMessage);


    }
});

Hook::add("InvoiceCreated", 1, function ($params = []) {

    // Include the SmsNetbd class
    include_once(__DIR__ . "/../modules/SMS/SmsNetbd/SmsNetbd.php");

    // Initialize SmsNetbd
    $SmsNetbd = new SmsNetbd();

    // Get configuration
    $config = $SmsNetbd->config;

    $check = $config['InvoiceCreatedCheck']; // Enable or disable SMS
    $number = $config['InvoiceCreatedNumber']; // Recipient number
    $messageTemplate = $config['InvoiceCreatedMessage']; // Message template

    // Replace {name} placeholder with client's full name in the message
    $message = str_replace('{id}', $params['id'], $messageTemplate);

    // Variable to store SMS response
    $sendMessage = null;

    if ($check) {
        // Send the SMS
        $sendMessage = $SmsNetbd->send($message, $number);

        // Prepare log message
        $logMessage = "InvoiceCreated event triggered for: " . $params['id'] .
            ", Number: " . $number .
            ", Message: " . $message .
            ", Response: " . json_encode($sendMessage);


    }
});




