<?php

namespace Elsass\SeeraiwerBarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/_seeraiwerBar/element")
 */
class ElementController extends Controller
{
    /**
     * @Route("/version/")
     * @Template()
     */
    public function toolbarVersionAction()
    {
        return array('');
    }

    /**
     * @Route("/user/")
     * @Template()
     */
    public function toolbarUserAction()
    {
        return array();
    }

    /**
     * @Route("/locale/")
     * @Template()
     */
    public function toolbarLocaleAction()
    {
        return array();
    }

}
