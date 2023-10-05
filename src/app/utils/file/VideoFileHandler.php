<?php 

include_once __DIR__ . '/FileHandler.php';

class VideoFileHandler extends FileHandler {

    protected function getMiddlePath()
    {
        return "/videoFiles";
    }
    
    public function getRoute($id, $extension, $dateTimeString)
    {
        $extension = ltrim($extension, '.');
        return $this->getMiddlePath() . "/$id/vid$dateTimeString.$extension"; 
    }

    public function getFilePath($id, $extension, $dateTimeString)
    {
        return PUBLIC_PATH .  $this->getRoute($id, $extension, $dateTimeString);
    }

    public function getUrl($id, $extension, $dateTimeString)
    {
        return BASE_URL . $this->getRoute($id, $extension, $dateTimeString);
    }
}