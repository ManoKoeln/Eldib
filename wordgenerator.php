<?php

namespace WordGenerator;
require 'vendor/autoload.php';
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;


// use PhpOffice\PhpWord\IOFactory;

class WordGenerator
{
    private $phpWord;

    public function __construct()
    {

        $this->phpWord = new PhpWord();
    }
    public function createDocument()
    {
        return $this->phpWord->addSection();
    }

    public function addText($section, $text, $style = [])
    {
        $section->addText($text, $style);
    }

    public function saveDocument($filename)
    {
        $objWriter = IOFactory::createWriter($this->phpWord, 'Word2007');
        $objWriter->save($filename);
        return $filename;
    }
}