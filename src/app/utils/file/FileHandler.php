<?php
abstract class FileHandler {
    
    abstract public function getRoute($id, $extension);
    abstract public function getFilePath($id, $extension);
    abstract public function getUrl($id, $extension);


    public function writeFile($id, $extension, $formDataName) {
        $filePath = $this->getFilePath($id, $extension);
        
        $directory = pathinfo($filePath, PATHINFO_DIRNAME);

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        // Move uploaded files to destination
        move_uploaded_file($_FILES[$formDataName]['tmp_name'], $filePath);

        return $this->getUrl($id, $extension);
    }
}