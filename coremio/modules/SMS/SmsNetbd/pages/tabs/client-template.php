<?php

return [

    // Client hooks
    "ClientBlocked" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {name}",
        "message" => "Client {name} Blocked",
        "number" => "",
    ],

    "ClientActivated" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {name}",
        "message" => "Client {name} Activated",
        "number" => "",
    ],

    // Invoice hooks
    "InvoicePaid" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Invoice #{id} Paid",
        "number" => "",
    ],

    "InvoiceCancelled" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Invoice #{id} Cancelled",
        "number" => "",
    ],

    "InvoiceRefunded" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Invoice #{id} Refunded",
        "number" => "",
    ],

    "InvoiceCreated" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Invoice #{id} Created",
        "number" => "",
    ],

];
