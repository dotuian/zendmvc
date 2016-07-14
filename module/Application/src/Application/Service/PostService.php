<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Doctrine\Common\Persistence\ObjectManager;

class PostService {

    protected $objectManager;

    public function __construct(ObjectManager $objectManager) {
        $this->objectManager = $objectManager;
    }

    public function deletePost($id) {
        $post = $this->objectManager->find('Post', $id);
        $this->objectManager->remove($post);
        $this->objectManager->flush();
    }

}
