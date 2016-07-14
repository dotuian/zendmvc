<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WriteController extends AbstractActionController {

    protected $postService;
    protected $postForm;

    public function __construct($postService, $postForm) {
        $this->postService = $postService;
        $this->postForm = $postForm;
    }

    public function addAction() {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->postForm->setData($request->getPost());

            if ($this->postForm->isValid()) {
                try {
//                    \Zend\Debug\Debug::dump($this->postForm->getData()); die();
                    $this->postService->savePost($this->postForm->getData());

                    return $this->redirect()->toRoute('blog');
                } catch (\Exception $e) {
                    // 某些数据库错误发生了，记录并且让用户知道
                }
            }
        }

        return new ViewModel(array(
            'form' => $this->postForm
        ));
    }

     public function editAction()
     {
         $request = $this->getRequest();
         $post    = $this->postService->findPost($this->params('id'));

         $this->postForm->bind($post);

         if ($request->isPost()) {
             $this->postForm->setData($request->getPost());

             if ($this->postForm->isValid()) {
                 try {
                     $this->postService->savePost($post);

                     return $this->redirect()->toRoute('blog');
                 } catch (\Exception $e) {
                     die($e->getMessage());
                     // Some DB Error happened, log it and let the user know
                 }
             }
         }

         return new ViewModel(array(
             'form' => $this->postForm
         ));
     }
    
}
