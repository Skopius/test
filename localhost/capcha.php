<?php

define('USE_SESSION', true);


$chars = "ABCDIFGHIJKLMNOPQRSTUVWXYZabcdifghijklmnopqrstuvwxyz1234567890";
$length = 5;
$code = substr(str_shuffle($chars), 0, $length);

$cryptedCode = crypt($code, '$1$itchief$7');

$image = imagecreatefrompng(__DIR__.'/assets/img/capcha_bg.png');
$size = 20;
$color = imagecolorallocate($image, 66, 182, 66);
$font = __DIR__.'/assets/font/timesi.ttf';
$angle = rand(-5, 5);
$x = 40;
$y = 25;

imagefttext($image, $size, $angle, $x, $y, $color, $font, $code);

header('Cache-Control: no-store, must-revalidate');
header('Expires: 0');
// Enable output buffering
ob_start();
imagepng($image);
// Capture the output and clear the output buffer
$imagedata = ob_get_clean();

imagedestroy($image);

echo json_encode([
  'image' => base64_encode($imagedata),
  'code' => $cryptedCode
]);


?>