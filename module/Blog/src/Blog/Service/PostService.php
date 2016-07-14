<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Blog\Service;

use Blog\Service\PostServiceInterface;
use Blog\Model\Post;
use Blog\Model\PostInterface;

use Blog\Mapper\PostMapperInterface;

class PostService implements PostServiceInterface {

    protected $postMapper;

    public function __construct(PostMapperInterface $postMapper) {
        $this->postMapper = $postMapper;
    }

//    protected $data = array(
//        array(
//            'id' => 1,
//            'title' => 'Hello World #1',
//            'text' => 'This is our first blog post!'
//        ),
//        array(
//            'id' => 2,
//            'title' => 'Hello World #2',
//            'text' => 'This is our second blog post!'
//        ),
//        array(
//            'id' => 3,
//            'title' => 'Hello World #3',
//            'text' => 'This is our third blog post!'
//        ),
//        array(
//            'id' => 4,
//            'title' => 'Hello World #4',
//            'text' => 'This is our fourth blog post!'
//        ),
//        array(
//            'id' => 5,
//            'title' => 'Hello World #5',
//            'text' => 'This is our fifth blog post!'
//        )
//    );

    public function findAllPosts() {
//        $allPosts = array();
//
//        foreach ($this->data as $index => $post) {
//            $allPosts[] = $this->findPost($index);
//        }
//
//        return $allPosts;
        
        return $this->postMapper->findAll();
    }

    public function findPost($id) {
//        $postData = $this->data[$id];
//
//        $model = new Post();
//        $model->setId($postData['id']);
//        $model->setTitle($postData['title']);
//        $model->setText($postData['text']);
//
//        return $model;
        
        return $this->postMapper->find($id);
    }

     /**
      * {@inheritDoc}
      */
     public function savePost(PostInterface $post)
     {
         return $this->postMapper->save($post);
     }
 
     /**
      * {@inheritDoc}
      */
     public function deletePost(PostInterface $post)
     {
         return $this->postMapper->delete($post);
     }
     
}
