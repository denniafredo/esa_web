<?php
function convertPhoneNumber($phoneNumber) {
    // Remove any non-digit characters from the phone number
    $cleanedPhoneNumber = preg_replace('/\D/', '', $phoneNumber);
    if (substr($cleanedPhoneNumber, 0, 1) === '0') {
        $cleanedPhoneNumber = substr($cleanedPhoneNumber, 1);
    }
    if (substr($cleanedPhoneNumber, 0, 2) === '62') {
        $cleanedPhoneNumber = substr($cleanedPhoneNumber, 2);
    }
    // Add +62 in front of the cleaned phone number
    $formattedPhoneNumber = '+62' . $cleanedPhoneNumber;

    return $formattedPhoneNumber;
}

