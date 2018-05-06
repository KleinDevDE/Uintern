<?php
class Logger
{
    static function log($msg)
    {
        $file = file_get_contents(getRoot() . "/log.txt");
        file_put_contents(getRoot() . "/log.txt", $file . "\n[" . date('d\.m\.Y \| H\:i') . "] " . $msg);
    }
}