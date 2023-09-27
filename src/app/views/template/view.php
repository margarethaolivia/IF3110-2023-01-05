<?php

class View
{
    private $data;
    private $folder_path;

    public function __construct($folder_path, $data)
    {
        $this->data = $data;  
        $this->folder_path = $folder_path;
    }

    public function render()
    {
        require_once __DIR__ . '/../../views' . $this->folder_path . '/index.php';
    }
}
