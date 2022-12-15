<?php

class ImageProcessor {
  
    public static function upload($image, $directory = './images/uploads/')
    {
        // Generate a unique filename for the uploaded image
    
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
    
        $uniqueString = uniqid();

        $filename =  $uniqueString . '.' . $ext;

       // Create the full path to the destination directory
        $destination = dirname(__FILE__, 2) . $directory . '/' . $filename;

       // Move the uploaded image to the destination directory
        move_uploaded_file($image['tmp_name'], $destination);

       // Return the new, unique path of the uploaded image
        return $directory . $filename;
    }
}

?>