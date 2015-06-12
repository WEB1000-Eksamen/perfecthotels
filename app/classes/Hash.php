<?php
class Hash {
    public static function make ($email) {
        return substr(md5($email), 0, 6);
    }
}