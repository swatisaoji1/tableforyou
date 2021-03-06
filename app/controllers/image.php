<?php

/*
  Return a image. If id is no valid, return default image.
  Example:
  Return a image, which id is 24 in Restaurant_Images table.
  image/index/24
 */

class image extends Controller {

    public $db;

    public function __construct() {
        try {
            $this->db = new Database();
        } catch (Exception $ex) {
            echo "connection failed";
        }
    }

    public function index($image_id) {
        $result = mysqli_fetch_array($this->db->db_query("SELECT `Image` FROM `Restaurant_Images` where `idRestaurant_Images` = '$image_id'"));
        $uri = 'data://application/octet-stream;base64,' . base64_encode($result['Image']);
        $image_type = getimagesize($uri);

        if ($result !== NULL) {
            header('Content-Type: ', $image_type['mime']);
            $image = imagecreatefromstring($result['Image']);
            switch ($image_type['mime']) {
                case 'image/jpeg':
                    imagejpeg($image);
                    break;
                case 'image/bmp':
                    imagewbmp($image);
                    break;
                case 'image/gif':
                    imagegif($image);
                    break;
                case 'image/png':
                    imagepng($image);
                    break;
                default:
                    echo ("Unsupported picture type: " . $image_type);
                    return;
            }
            imagedestroy($image);
        } else {
            header('Content-Type: image/png');
            $fp = fopen(APP_ROOT . '/img/restaurant.png', 'r');
            fpassthru($fp);
        }
    }

}
