<?php


namespace class;
class SqlServer
{

    public function __construct()
    {
        $link = mysqli_connect('127.0.0.1', 'pretpi', 'Pa$$w0rd', 'pretpi');

        if (!$link) {
            echo "Error Connect MariaDB server";
        } else {
            echo "good";
        }

    }
}


?>