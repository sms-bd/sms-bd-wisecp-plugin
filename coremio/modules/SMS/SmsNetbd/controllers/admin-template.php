<?php

if (!defined("CORE_FOLDER")) die();

$lang = $module->lang;
$config = $module->config;

$SmsNetbd = new SmsNetbd();

// Hook settings
$eventSettings = [

    // Client hooks
    "ClientCreated" => [
        "check" => (string) Filter::init("POST/ClientCreatedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/ClientCreatedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/ClientCreatedNumber", "hclear") ?? "",
    ],
    
    "OrderDeleted" => [
        "check" => (string) Filter::init("POST/OrderDeletedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/OrderDeletedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/OrderDeletedNumber", "hclear") ?? "",
    ],

    "OrderApproved" => [
        "check" => (string) Filter::init("POST/OrderApprovedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/OrderApprovedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/OrderApprovedNumber", "hclear") ?? "",
    ],

    "OrderSuspended" => [
        "check" => (string) Filter::init("POST/OrderSuspendedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/OrderSuspendedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/OrderSuspendedNumber", "hclear") ?? "",
    ],

    "OrderCancelled" => [
        "check" => (string) Filter::init("POST/OrderCancelledCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/OrderCancelledMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/OrderCancelledNumber", "hclear") ?? "",
    ],

    "TicketAdminCreated" => [
        "check" => (string) Filter::init("POST/TicketAdminCreatedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/TicketAdminCreatedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/TicketAdminCreatedNumber", "hclear") ?? "",
    ],


    "TicketAdminReplied" => [
        "check" => (string) Filter::init("POST/TicketAdminRepliedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/TicketAdminRepliedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/TicketAdminRepliedNumber", "hclear") ?? "",
    ],

    "TicketAdminUpdated" => [
        "check" => (string) Filter::init("POST/TicketAdminUpdatedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/TicketAdminUpdatedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/TicketAdminUpdatedNumber", "hclear") ?? "",
    ],

    "TicketClientCreated" => [
        "check" => (string) Filter::init("POST/TicketClientCreatedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/TicketClientCreatedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/TicketClientCreatedNumber", "hclear") ?? "",
    ],

    "TicketClientReplied" => [
        "check" => (string) Filter::init("POST/TicketClientRepliedCheck", "hclear") ? 1 : 0,
        "message" => (string) Filter::init("POST/TicketClientRepliedMessage", "hclear") ?? "",
        "number" => (string) Filter::init("POST/TicketClientRepliedNumber", "hclear") ?? "",
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
            'msg' => $lang["admin-template-success"], // Define success message in language file
        ]);
    } else {
        echo Utility::jencode([
            'error' => "1",
            'msg' => $lang["admin-template-error"], // Define error message in language file
        ]);
    }
} else {
    echo Utility::jencode([
        'error' => "0",
        'msg' => $lang["no-changes"], // Define no changes message in language file
    ]);
}
