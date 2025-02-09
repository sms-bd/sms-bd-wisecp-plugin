<?php

return $hooks_array = [

    // Client hooks
    "ClientCreated" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {name}",
        "message" => "Client {name} created",
        "number" => "Admin Number",
    ],


    // Order hooks
    "OrderDeleted" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Order #{id} Deleted",
        "number" => "Admin Number",
    ],

    "OrderApproved" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Order #{id} Approved",
        "number" => "Admin Number",
    ],

    "OrderSuspended" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Order #{id} Suspended",
        "number" => "Admin Number",
    ],

    "OrderCancelled" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Order #{id} Cancelled",
        "number" => "Admin Number",
    ],


    // Ticket hooks
    "TicketAdminCreated" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Ticket #{id} Created",
        "number" => "Admin Number",
    ],

    "TicketAdminReplied" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Ticket #{id} Replied",
        "number" => "Admin Number",
    ],

    "TicketAdminUpdated" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Ticket #{id} Updated",
        "number" => "Admin Number",
    ],

    "TicketClientCreated" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Ticket #{id} Created",
        "number" => "Admin Number",
    ],

    "TicketClientReplied" => [
        "check" => "Check",
        "perameter" => "Supported Perameter {id}",
        "message" => "Ticket #{id} Replied",
        "number" => "Admin Number",
    ],


];
