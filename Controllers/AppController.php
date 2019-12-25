<?php

class AppController {
    private $request;

    public function __construct(){
        if(session_status() !== PHP_SESSION_ACTIVE)session_start();
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet():bool {
        return $this->request === "GET";
    }
    protected function isPost():bool {
        return $this->request === "POST";
    }
    protected function render(string $template=null, array $variables =[]) {
        $templatepath = $template ? dirname(__DIR__)."\View\\".get_class($this)."\\".$template.".php" : "";
        $output = "File not found";

        if(file_exists($templatepath)) {
            extract($variables);

            ob_start();
            include $templatepath;
            $output = ob_get_clean();
        }
        print $output;
    }
}