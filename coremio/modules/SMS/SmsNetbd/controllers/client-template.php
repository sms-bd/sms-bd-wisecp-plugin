<?php

if (!defined("CORE_FOLDER")) die();

$lang = $module->lang;
$config = $module->config;

$SmsNetbd = new SmsNetbd();

// Hook settings
$eventSettings = [

    // Client hooks
    "ClientBlocked" => [
        "check" => (string) Filter::init("POST/ClientBlockedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/ClientBlockedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/ClientBlockedNumber", "hclear") ?? "",
    ],

    "ClientActivated" => [
        "check" => (string) Filter::init("POST/ClientActivatedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/ClientActivatedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/ClientActivatedNumber", "hclear") ?? "",
    ],

    "InvoicePaid" => [
        "check" => (string) Filter::init("POST/InvoicePaidCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/InvoicePaidMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/InvoicePaidNumber", "hclear") ?? "",
    ],

    "InvoiceCancelled" => [
        "check" => (string) Filter::init("POST/InvoiceCancelledCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/InvoiceCancelledMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/InvoiceCancelledNumber", "hclear") ?? "",
    ],

    "InvoiceRefunded" => [
        "check" => (string) Filter::init("POST/InvoiceRefundedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/InvoiceRefundedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/InvoiceRefundedNumber", "hclear") ?? "",
    ],

    "InvoiceCreated" => [
        "check" => (string) Filter::init("POST/InvoiceCreatedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/InvoiceCreatedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/InvoiceCreatedNumber", "hclear") ?? "",
    ],

];
$sets = [];

// Handle event settings dynamically
foreach ($eventSettings as $event => $data) {

    $checkKey = "{$event}Check";
    $messageKey = "{$event}Message";
    $numberKey = "{$event}Number";

    // Ensure proper settings for each event
    $sets[$checkKey] = (!empty($data['check'])) ? 1 : 0;
    $sets[$messageKey] = $data['message'] ?: "";
    $sets[$numberKey] = (!empty($data['number']) && $SmsNetbd->validatePhoneNumber($data['number'])) ? $data['number'] : "";
}

// Update configuration if changes exist
if (!empty($sets)) {
    // Merge the updated settings with the existing configuration
    $config_result = array_replace_recursive($config, $sets);
    $array_export = Utility::array_export($config_result, ['pwith' => true]);
    $file = dirname(__DIR__) . DS . "config.php";

    // Write updated settings to file
    $write = FileManager::file_write($file, $array_export);

    if ($write !== false) {
        // Log the change in system
        $adata = UserManager::LoginData("admin");
        User::addAction($adata["id"], "alteration", "changed-sms-module-settings", [
            'module' => $config["meta"]["name"],
            'name' => $lang["name"],
        ]);

        echo Utility::jencode([
            'error' => "0",
            'msg' => $lang["client-template-success"], // Define success message in language file
        ]);
    } else {
        echo Utility::jencode([
            'error' => "1",
            'msg' => $lang["client-template-error"], // Define error message in language file
        ]);
    }
} else {
    echo Utility::jencode([
        'error' => "0",
        'msg' => $lang["no-changes"], // Define no changes message in language file
    ]);
}
