<?php

/**
* Gimpa : gnu image manipulate Apache
* Author: gnutec
* AuthorLink: http://gnutec.ir
*/

function gnt_png2jpg($input, $output) {
    $input_file = $input;
    $output_file = $output;

    $input = imagecreatefrompng($input_file);
    list($width, $height) = getimagesize($input_file);
    $output = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($output,  255, 255, 255);
    imagefilledrectangle($output, 0, 0, $width, $height, $white);
    imagecopy($output, $input, 0, 0, 0, 0, $width, $height);
    $result = imagejpeg($output, $output_file);
    if($result){
        echo "<span style=\"color: greenyellow;\">output OK</span><br>";
    }else{
        echo "<span class=\"color:red;\">output ERROR</span><br>";
    }
}

function gnt_jpg2png() {
    echo "<span class=\"color:red;\">input type is image/png</span><br>";
}

ini_set('memory_limit', '-1');
$i = 1;
$inputGallery_array = glob("inputGallery/*");
foreach ($inputGallery_array as $filename) {
    $sitename = str_replace("inputGallery/", "", $filename);
    $output = "outputGallery/{$sitename}";
    $sitename = str_replace(".jpg", "", $sitename);
    $sitename = str_replace(".png", "", $sitename);
    if (preg_match("/\.(png)$/", $filename)) {
        $output = "outputGallery/{$sitename}.jpg";
        gnt_png2jpg($filename,$output);
    } else {
        gnt_jpg2png();
    }
    $i++;
}