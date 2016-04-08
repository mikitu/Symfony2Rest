<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @View()
     */
    public function indexAction()
    {
        return array('success' => true);
    }

    /**
     * @Route("/login")
     * @View()
     */
    public function loginAction(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        return array('success' => true);
    }

    /**
     * @Route("/logout")
     * @View()
     */
    public function logoutAction(Request $request)
    {
        return array('success' => true);
    }
}
