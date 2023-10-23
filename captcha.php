<?php
session_start();

// Generate a random CAPTCHA code
$captchaCode = generateRandomCode(6);
$_SESSION['captcha_code'] = $captchaCode;

// Create an image with the CAPTCHA code
$width = 150;
$height = 40;
$image = imagecreate($width, $height);
$bgColor = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, 0, 0, 0);

// Add random lines to make it harder to read
for ($i = 0; $i < 5; $i++) {
    imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $textColor);
}

// Write the CAPTCHA code on the image
imagestring($image, 5, 20, 10, $captchaCode, $textColor);

// Output the image
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);

function generateRandomCode($length)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code;
}
?>