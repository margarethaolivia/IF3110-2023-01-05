<?php

require_once __DIR__ . '/../Controller.php';

abstract class APIController extends Controller
{  
    public function __construct($folder_path)
    {
        parent::__construct($folder_path);
    }

    public function NotAllowedResponse() {
        
    }

    abstract public function GET();
    abstract public function POST();
    abstract public function PUT();
    abstract public function PATCH();
    abstract public function DELETE();

    public function index()
    {
    } 
}
