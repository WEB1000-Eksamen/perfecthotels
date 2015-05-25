<?php
    require_once 'app/bootstrap.php';

    echo 'Hashing e-mail: cam-bridge@hotmail.com<br>';

    echo hashEmail('cam-bridge@hotmail.com') . '<br>';

    var_dump(hashEmail('cam-bridge@hotmail.com') == '37d579b6e3');