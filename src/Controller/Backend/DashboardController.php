<?php

namespace App\Controller\Backend;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Service\Backend\DashboardService;

class DashboardController extends Controller
{
    /**
     * Dashboard Service oject
     * 
     * @var instance
     */
    private $dashboardService;

    /**
     * Creating object of class
     */
    public function __construct(DashboardService $DashboardServiceInstance)
	{
		$this->dashboardService = $DashboardServiceInstance; // Example of Symfony service container
    }

    /**
     * @Route("/admin/dashboard", name="admin_home_route")
     */
    public function index()
    {
        $result = $this->dashboardService->getAllRecordCounts(); 
        return $this->render('Backend/dashboard.html.twig' , ['recordCount' => $result]);
    }

}