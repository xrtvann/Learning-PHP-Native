<?php
    $x = 10;

    function TampilkanX() {
        global $x;
        echo $x;
    }

    TampilkanX();
?>