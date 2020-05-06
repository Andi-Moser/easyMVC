<?php

// change for linus
define('DS', "\\");

function loadDir($dir) {
    foreach (scandir($dir) as $fileName) {
        if ($fileName == "." || $fileName == "..") {
            continue;
        }

        include_once $dir . DS . $fileName;
    }
}

loadDir(__DIR__ . DS . "lib");
loadDir(__DIR__ . DS . "model");
loadDir(__DIR__ . DS . "controller");
