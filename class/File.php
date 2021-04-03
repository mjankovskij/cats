<?php

class File
{
    private $fileName = '';

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function read()
    {
        $myfile = fopen(DIR . '/files/' . $this->fileName, "r") or die("Unable to open file!");
        $data = json_decode('');
        if (filesize(DIR . '/files/' . $this->fileName) > 0) {
            $data = fread($myfile, filesize(DIR . '/files/' . $this->fileName));
            fclose($myfile);
        }
        return $data;
    }

    public function push($data)
    {
        $file = fopen(DIR . '/files/' . $this->fileName, 'w');
        fwrite($file, $data);
    }
}
