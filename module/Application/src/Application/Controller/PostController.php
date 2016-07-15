<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use ZfcRbac\Service\AuthorizationService;

class PostController extends AbstractActionController {

    protected $postService;
    
//    protected $autorizationService;
//
//    public function __construct(AuthorizationService $autorizationService) {
//        $this->autorizationService = $autorizationService;
//    }
    
    public function indexAction(){
        
//        if (!$this->isGranted('deletePost')) {
//            throw new UnauthorizedException('You are not allowed !');
//        }
        
        echo date('Y-m-d');
    }
    
    
    // addAction(), editAction(), etc...

    public function deleteAction() {
        $id = $this->params()->fromQuery('id');

        $this->postService->deletePost($id);

        return $this->redirect()->toRoute('posts');
    }

}
