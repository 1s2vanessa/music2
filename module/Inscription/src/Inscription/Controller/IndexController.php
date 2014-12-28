<?php
namespace Inscription\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
	public function indexAction()
	{
		$inscriptionService = $this->serviceLocator->get('inscription_service');
    	if (! $inscriptionService->hasIdentity()) {
    		// if not log in, redirect to login page
    		return $this->redirect()->toUrl('inscription');
    	}
    	
		return new ViewModel();
	}	
}
