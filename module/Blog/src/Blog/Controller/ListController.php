<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Blog\Service\PostServiceInterface;

class ListController extends AbstractActionController {

    protected $postService;

    public function __construct(PostServiceInterface $postService) {
        $this->postService = $postService;
    }

    public function detailAction() {
        $id = $this->params()->fromRoute('id');

        try {
            $post = $this->postService->findPost($id);
        } catch (\InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('blog');
        }

        return new ViewModel(array(
            'post' => $post
        ));
    }

    public function listAction() {
        $data = $this->postService->findAllPosts();

        return new ViewModel(array(
            'data' => $data,
        ));
    }

}
