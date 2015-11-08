<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Acd;

/**
 * Description of FileSystem
 *
 * @author Acidvertigo
 */
class FileSystem {

    private $path;
    private $content;

    public function __construct($path = null)
    {
        $this->path = $path;
    }

    public function find()
    {
        return file_exists($this->path);

    }

    public function load()
    {
        if ($this->find())
        {
            return $this->content = include $this->path;
        }
		else {
            throw new \Exception('File not found: ' . $this->path);
        }
    }

}
