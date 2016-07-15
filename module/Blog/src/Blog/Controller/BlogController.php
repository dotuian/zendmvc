<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BlogController extends AbstractActionController {

    protected $postService;
    protected $postForm;

    public function __construct($postService, $postForm) {
        $this->postService = $postService;
        $this->postForm = $postForm;
    }

//    public function detailAction() {
//        $id = $this->params()->fromRoute('id');
//
//        try {
//            $post = $this->postService->findPost($id);
//        } catch (\InvalidArgumentException $ex) {
//            return $this->redirect()->toRoute('blog');
//        }
//
//        return new ViewModel(array(
//            'post' => $post
//        ));
//    }

    public function indexAction() {
        return $this->redirect()->toRoute('blog', array('action' => 'list'));
    }

    public function listAction() {

        $data = $this->postService->findAllPosts();

        return new ViewModel(array(
            'data' => $data,
        ));
    }

    public function addAction() {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->postForm->setData($request->getPost());

            if ($this->postForm->isValid()) {
                try {
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

    public function editAction() {
        $request = $this->getRequest();
        $post = $this->postService->findPost($this->params('id'));

        $this->postForm->bind($post);

        if ($request->isPost()) {
            $this->postForm->setData($request->getPost());

            if ($this->postForm->isValid()) {
                try {
                    $this->postService->savePost($post);

                    return $this->redirect()->toRoute('blog', array('action' => 'list'));
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

    public function deleteAction() {
        try {
            $post = $this->postService->findPost($this->params('id'));
        } catch (\InvalidArgumentException $e) {
            return $this->redirect()->toRoute('blog');
        }

        $request = $this->getRequest();

        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');

            if ($del === 'yes') {
                $this->postService->deletePost($post);
            }

            return $this->redirect()->toRoute('blog');
        }

        return new ViewModel(array(
            'post' => $post
        ));
    }

}
