<?php
include_once (APP_PATH . '/components/template/pageTemplate.php');
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
        pageTemplate($this->data, APP_PATH . '/views' . $this->folder_path . '/body.php');
    }
}
