<?php

namespace ElsassSeeraiwer\ESBarBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/_seeraiwerBar")
 */
class ToolbarController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function toolbarAction()
    {
        return array();
    }
}
