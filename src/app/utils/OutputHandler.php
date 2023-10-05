<?php
    class OutputHandler {
        public function outputComponentAsString($functionName, $functionPath, $namedArgs)
        {
            include_once ($functionPath);
            ob_start();
            $functionName(...$namedArgs);
            $output = ob_get_clean();
            return $output; 
        }
    }
?>