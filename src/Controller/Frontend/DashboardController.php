<?php

namespace App\Controller\Frontend;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
	public function __construct()
	{

    }
    
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard()
    {
        return $this->render('Frontend/dashboard.html.twig');
    }
}