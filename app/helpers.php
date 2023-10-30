<?php
use Illuminate\Support\Facades\File;

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


function remove62PhoneNumber($phoneNumber) {
    if (substr($phoneNumber, 0, 3) === '+62') {
        $phoneNumber = substr($phoneNumber, 2);
    }
    return $phoneNumber;
}


function saveImage($directory, $imageFile)
{
    $path = public_path('images/' . $directory);

    if (!File::exists($path)) {
        File::makeDirectory($path, 0777, true, true);
    }

    $imageName = null;
    if ($imageFile) {
        $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
        $imageFile->move($path, $imageName);
    }

    return $imageName;
}


function dateIndo($dateString){
    $timestamp = strtotime($dateString);
    return date("j F Y", $timestamp);
}
