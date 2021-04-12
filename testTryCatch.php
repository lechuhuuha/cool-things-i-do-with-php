<?php
$a = 1;
function a()
{
    echo 'invoce try';
}
function b()
{
    echo 'invoce catch';
}
try {

    if ($a == 0) {
        echo 'a = 0';
    }
    a();
} catch (Exception $e) {
    b();
}
