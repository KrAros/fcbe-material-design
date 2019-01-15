<?php
$img = imagecreate(147, 99);
$col = imagecolorallocate($img, 255, 255, 255);
$col = imagecolorallocate($img,   0,   0,   0);
imagerectangle($img, 0, 0, 146, 98, $col);
$x = 0;
$y = 0;
for ($r = 0; $r < 6; $r++) for ($g = 0; $g < 6; $g++) for ($b = 0; $b < 6; $b++){
  $col = imagecolorallocate($img, $r*32+48, $g*32+48, $b*32+48);
  imagefilledrectangle($img, $x*8+2, $y*8+2, $x*8+8, $y*8+8, $col);
  if ($x == 17) $y++;
  if ($x != 17) $x++; else $x = 0;
}
imagepng    ($img, 'colors.png');
imagedestroy($img);
?>