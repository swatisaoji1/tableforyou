<?php

class staticImage extends Controller {

    public function index($image_name) {
        $file_path = APP_ROOT . "/img/" . "$image_name";
        $file_info = pathinfo($file_path);
        switch ($file_info["extension"]) {
            case 'bmp':
                header('Content-Type: image/bmp');
                break;
            case 'gif':
                header('Content-Type: image/gif');
                break;
            case 'jpg':
                header('Content-Type: image/jpeg');
                break;
            case 'jpeg':
                header('Content-Type: image/jpeg');
                break;
            case 'png':
                header('Content-Type: image/png');
                break;
            default:
                error_handler("Create_thumb: Unsupported picture type: " . $src . "--" . $type);
                return;
        }
        $fp = fopen($file_path, 'r');
        fpassthru($fp);
    }

}
