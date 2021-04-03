<?php

namespace Controller;

class Error{
    public function render()
    {
        return include_once DIR.'/pages/error.php';
    }
}