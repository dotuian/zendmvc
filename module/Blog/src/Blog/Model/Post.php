<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Blog\Model;

class Post implements \Blog\Model\PostInterface {

    protected $id;
    protected $title;
    protected $text;

    public function getId() {
        return $this->id;
    }

    public function getText() {
        return $this->text;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

}
