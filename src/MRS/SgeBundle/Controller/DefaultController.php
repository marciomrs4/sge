<?php

namespace MRS\SgeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MRSSgeBundle:Default:index.html.twig');
    }

    public function homeAction()
    {
        if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){

            return $this->redirectToRoute('user_login');
        }

        return $this->render(':template:base.html.twig');
    }

}
