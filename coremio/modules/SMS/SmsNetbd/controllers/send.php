<?php

// Fetch and sanitize input data with fallback to empty string if the variable is not set
$recipientNumber = (string) Filter::init("POST/recipientNumber", "hclear") ?? "";
$message = (string) Filter::init("POST/message", "hclear") ?? "";

// Function to send JSON response and exit
function sendResponse($error, $msg, $data = [])
{
    echo json_encode([
        'error' => $error,
        'msg' => $msg,
        'data' => $data
    ]);
    exit;
}

// Check if recipientNumber or message is empty
if (empty($recipientNumber) || empty($message)) {
    sendResponse('1', 'Message and recipient number are required.');
}

// Initialize the SmsNetbd object
$SmsNetbd = new SmsNetbd();

// Validate the phone number format
if (!$SmsNetbd->validatePhoneNumber($recipientNumber)) {
    sendResponse('1', 'Invalid phone number format.');
}

// Send the SMS and get the response
$response = $SmsNetbd->send($message, $recipientNumber);

// Output the response from the SMS service
echo $response;
