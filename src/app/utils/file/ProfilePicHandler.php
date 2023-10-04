<?php 
include_once __DIR__ . '/FileHandler.php';

class ProfilePicHandler extends FileHandler {
    public function getRoute($id, $extension)
    {
        return "/images/profile/$id/pic" . $extension;
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