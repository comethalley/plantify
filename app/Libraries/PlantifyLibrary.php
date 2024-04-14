<?php

namespace App\Libraries;

class PlantifyLibrary
{
    public function generatehash($data)
    {
        $md5 = md5($data);
        $prefix = substr($md5, 5, 5);
        $posfix = substr($md5, 15, 8);
        $hash = $prefix . $md5 . $posfix . $data;
        return $hash;
    }

    public function verifydatafromhashid($hash)
    {
        $continue = 1;
        $data = substr($hash, 45);

        $md5 = md5($data);
        $prefix = substr($md5, 5, 5);
        $posfix = substr($md5, 15, 8);

        $md5comp = substr($hash, 5, 32);
        $prefixcomp = substr($hash, 0, 5);
        $posfixcomp = substr($hash, 37, 8);

        if ($md5 != $md5comp) {
            $continue = 0;
            //print "error md5.".$data;
        }
        if ($prefix != $prefixcomp) {
            $continue = 0;
            //print "error prefix.";
        }
        if ($posfix != $posfixcomp) {
            $continue = 0;
            //print "error posfix.";
        }
        //exit;
        if ($continue == 0) {
            header("HTTP/1.0 404 Not Found");
            exit;
        } else {
            $id = substr($hash, 45);
            return $id;
        }
    }
}
