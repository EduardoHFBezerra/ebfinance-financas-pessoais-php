<?php
spl_autoload_register(
    function ($classe)
    {
        require_once "classes/class." . $classe . ".php";
    }
);