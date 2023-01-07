<?php
function Connect(){

    $ip = '127.0.0.1';
    $user = 'root';
    $password = ''; //To be completed if you have set a password to root
    $database = 'bdd_ensim'; //To be completed to connect to a database. The database must exist.
    $port = NULL;

    $m = new mysqli($ip, $user, $password, $database, NULL);

    if ($m->connect_error) {
        die('Connect Error (' . $m->connect_errno . ') '
            . $m->connect_error);
        return NULL;
    }
    return $m;

}

function Disconnect($m){
    $m->close();
}

function Redirect($extra){

    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $parts = explode('/', $extra);
    $last = end($parts);
    header("Location: http://$host$uri/$last");
    exit;

}





?>