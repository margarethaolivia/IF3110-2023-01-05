<?php
class FileHandler {
    
    public function writeFile($pattern) {
        // Remove '#^' at the beginning and '#$' at the end
        $pattern = substr($pattern, 2, -2);

        // Replace '([0-9a-fA-F-]+)' with '[param]' between two "/"
        $pattern = str_replace('/' . PatternHandler::URL_PARAM_PATTERN, '/[param]', $pattern);
    
        return $pattern;
    }
}