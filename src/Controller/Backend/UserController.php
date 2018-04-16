<?php

namespace App\Controller\Backend;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
Use App\Service\Backend\UserService;

class UserController extends Controller
{
    /**
     * PostService instance
     *
     * @var instance 
     */
    private $userService;

    /**
     * Service container implementation
     *
     * @param Instance
     */
	public function __construct(UserService $userServiceInstance)
	{
		$this->userService = $userServiceInstance;
    }

    /**
     * @Route("/admin/users" , name="admin_users")
     * 
     * Method to show all the users list
     * 
     * @param Request
     * @return Html
     */
    public function showAllUsers()
    {
        $users = $this->userService->getAllUsers();
        
        return $this->render('Backend/usersList.html.twig' , ['users' => $users]);
    }

    /**
     * @Route("admin/user/{userId}" , name="view_user")
     * 
     * Method to view the user
     * 
     * @param Int
     * @return Html
     */
    public function viewUser($userId)
    {
        if($userId > 0)
        {
            $user = $this->userService->getUser($userId);
            if(!empty($user))
            {
                return $this->render('Backend/viewUser.html.twig' , ['user' => $user]);
            }else
            {
                $this->addFlash('error_flash', 'User is not found...!');
            }
        }else
        {
            $this->addFlash('error_flash', 'User is not found...!!');
        }

        return $this->redirectToRoute('admin_users');
    }

    /**
     * @Route("admin/user/delete/{userId}" , name="delete_user")
     * 
     * Method to delete the user
     * 
     * @param Int
     * @return Html
     */
    public function deleteUser($userId)
    {
        if($userId > 0)
        {
            $result = $this->userService->deleteUser($userId);
            if($result)
            {
                $this->addFlash('success_flash', 'User deleted successfully.!!');
            }else
            {
                $this->addFlash('error_flash', 'User is not found for the given ID...!!');
            }
        }else
        {
            $this->addFlash('error_flash', 'User is not found for the given ID...!!');
        }

        return $this->redirectToRoute('admin_users');
    }    
}