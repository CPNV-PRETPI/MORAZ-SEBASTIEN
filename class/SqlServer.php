<?php


class SqlServer{

    public function __construct()
    {
        $link = mysqli_connect('127.0.0.1', 'pretpi', 'bouteille01', 'pretpi');

        if (!$link) {
            echo "Error Connect MariaDB server";
        }else{
            echo "good";
        }

    }
}


