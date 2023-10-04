<?php 
include_once __DIR__ . '/FileHandler.php';

class ThumbnailFileHandler extends FileHandler {

    protected function getMiddlePath()
    {
        return "/images/thumbnails";
    }

    public function getRoute($id, $extension)
    {
        return $this->getMiddlePath() . "/$id/pic.$extension";
    }

    public function getFilePath($id, $extension)
    {
        return PUBLIC_PATH . $this->getRoute($id, $extension);
    }

    public function getUrl($id, $extension)
    {
        return BASE_URL . $this->getRoute($id, $extension);
    }
}