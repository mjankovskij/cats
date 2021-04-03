<?php

namespace Controller;

class Index{
    public function render($data)
    {
        return include_once DIR.'/pages/index.php';
    }
}