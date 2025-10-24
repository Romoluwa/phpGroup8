<?php

function validate_input($field_name, $data, $required = true)
{
    if ($required && empty($data)) {
        report($field_name . " is required.");
        exit();
    }
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function report($message)
{
    header('Location: student.php?message=' . urlencode($message));
}
