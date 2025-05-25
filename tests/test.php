<?php
require_once "../models/Ticket.php";
require_once "../models/User.php";

function testSubmitTicket()
{
    $ticket = new Ticket();
    $result = $ticket->submit("Test Ticket", "This is a test description", 1, 1);
    echo $result ? "Test Passed!" : "Test Failed!";
}

function testUserRegistration()
{
    $user = new User();
    $result = $user->register("Test User", "test@example.com", "password123", "admin");
    echo $result ? "Test Passed!" : "Test Failed!";
}

testSubmitTicket();
testUserRegistration();