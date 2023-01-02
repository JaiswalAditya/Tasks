<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helpers;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Description of PermissionHelper
 *
 */
class AppHelper
{


    static function resize($source_image, $destination, $tn_w, $tn_h, $quality = 100)
    {
        $info = getimagesize($source_image);
        $imgtype = image_type_to_mime_type($info[2]);

#assuming the mime type is correct
        switch ($imgtype) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($source_image);
                break;
            case 'image/gif':
                $source = imagecreatefromgif($source_image);
                break;
            case 'image/png':
                $source = imagecreatefrompng($source_image);
                break;
            default:
                die('Invalid image type.');
        }

#Figure out the dimensions of the image and the dimensions of the desired thumbnail
        $src_w = imagesx($source);
        $src_h = imagesy($source);

#Do some math to figure out which way we'll need to crop the image
#to get it proportional to the new size, then crop or adjust as needed

        $x_ratio = $tn_w / $src_w;
        $y_ratio = $tn_h / $src_h;


        $scale = ($x_ratio < $y_ratio) ? $x_ratio : $y_ratio;
        $new_w = $src_w * $scale;
        $new_h = $src_h * $scale;

        $newpic = imagecreatetruecolor(round($new_w), round($new_h));
        imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);

//$white = imagecolorallocate($newpic, 255, 255, 255);
//imagefill($newpic, 0, 0, $white);

        $final = imagecreatetruecolor($tn_w, $tn_h);
        $backgroundColor = imagecolorallocate($final, 255, 255, 255);
        imagefill($final, 0, 0, $backgroundColor);
// //imagecopyresampled($final, $newpic, 0, 0, ($x_mid - ($tn_w / 2)), ($y_mid - ($tn_h / 2)), $tn_w, $tn_h, $tn_w, $tn_h);
        imagecopy($final, $newpic, (($tn_w - $new_w) / 2), (($tn_h - $new_h) / 2), 0, 0, $new_w, $new_h);

        if (imagejpeg($final, $destination, $quality)) {
            return true;
        }
        return false;
    }
}