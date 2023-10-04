<?php
abstract class FileHandler {

    public static function getFilePathFromUrl($publicUrl)
    {
        $pattern = '/' . preg_quote(BASE_URL, '/') . '/';
        return preg_replace($pattern, PUBLIC_PATH, $publicUrl, 1);
    }

    abstract protected function getMiddlePath();
    abstract public function getRoute($id, $extension);
    abstract public function getFilePath($id, $extension);
    abstract public function getUrl($id, $extension);

    public function getBasePath() {
        return PUBLIC_PATH . $this->getMiddlePath();
    }

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

    private function removeFileOrDirectory($path)
    {
        if (is_file($path)) {
            unlink($path);
        } 
        
        elseif (is_dir($path)) {
            rmdir($path);
        }
    }

    private function deleteFilesAndEmptyFolders($path, $basePath) {

        if (strpos($path, $basePath) !== 0) {
            // Make sure $path is within the $basePath to prevent deleting unintended files
            return;
        }

        $this->removeFileOrDirectory($path);
    
        // Check if the parent directory is empty
        $parentDir = dirname($path);
        if (count(scandir($parentDir)) == 2) {
            // After deleting files, check if the directory is empty (only contains "." and "..")
            rmdir($parentDir);
    
            // Recursively check the parent directory
            $this->deleteFilesAndEmptyFolders($parentDir, $basePath);
        }
    }

    public function deleteFile($publicUrl, $removeAdditionalFolders=true) {

        $path = self::getFilePathFromUrl($publicUrl);

        if ($removeAdditionalFolders)
        {
            $basePath = $this->getBasePath();

            $this->deleteFilesAndEmptyFolders($path, $basePath);
        }
        
        else
        {
            $this->removeFileOrDirectory($path);
        }
    }
}