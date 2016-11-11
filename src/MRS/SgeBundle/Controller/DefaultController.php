<?php

namespace MRS\SgeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MRSSgeBundle:Default:index.html.twig');
    }
}
