<?php
include_once (__DIR__ . '/../../components/template/pageTemplate.php');
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
        pageTemplate($this->data, __DIR__ . '/../../views' . $this->folder_path . '/body.php');
    }
}
