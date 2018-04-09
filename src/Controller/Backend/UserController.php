<?php

namespace App\Controller\Backend;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/admin", name="admin_home_route")
     */
    public function index()
    {
        echo "welcome to the admin page"; exit();
    }

}