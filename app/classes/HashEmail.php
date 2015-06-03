<?php
    function hashEmail ($email) {
        return substr(md5($email), 0, 10);
    }