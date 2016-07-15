<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SuccessController extends AbstractActionController {

    public function indexAction() {
        if (!$this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->hasIdentity()) {
            return $this->redirect()->toRoute('auth');
        }

        return new ViewModel();
    }

}
