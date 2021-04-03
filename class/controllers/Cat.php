<?php

namespace Controller;

use File;

class Cat
{
    private string $fileName = 'cats.txt';
    private int $limitRecords = 3;
    private file $file;
    private array $cats = [];

    public function __construct()
    {
        $this->file = new File($this->fileName);
    }

    public function render($data)
    {
        return include_once DIR . '/pages/cat.php';
    }

    public function getCats($from = 0)
    {
        foreach (range($from, $from + $this->limitRecords) as $item) {
            if (!isset(explode("\n", $this->file->read())[$item])) {
                return $this->getCats(0, $this->cats);
            }
            if (count($this->cats) >= $this->limitRecords) {
                break;
            }
            $this->cats[] = explode("\n", $this->file->read())[$item];
        }
        return $this->cats;
    }

    public function getCatKey($name)
    {
        foreach (explode('\n', $this->file->read()) as $key => $item) {
            if ($item === $name) {
                return $key;
            }
        }
    }
}
