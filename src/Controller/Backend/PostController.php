<?php

namespace App\Controller\Backend;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use App\Service\Backend\PostService;

class PostController extends Controller
{
    /**
     * PostService instance
     *
     * @var instance 
     */
    private $postService;

    public function __construct(PostService $postServiceInstance)
    {
        $this->postService = $postServiceInstance; // Example of Symfony service container, rather then using "new" keyword to create instance of class. 
    }

    /**
     * @Route("admin/post/show" , name="admin_show_posts")
     * 
     * Method to show all the posts.
     * 
     * @param Request
     * @return Html
     */
    public function showAllPosts(Request $request)
    {
        $posts = $this->postService->getAllRecords();
        /** 
         * @var $paginator \Knp\component\pager\paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
                        $posts,
                        $request->query->getInt('page' , 1),
                        $request->query->getInt('limit', 10)
                    );
        return $this->render('Backend/showPost.html.twig' , ['posts' => $posts , 'active' => true]);
    }

    /**
     * @Route("admin/post/view/{postId}" , name="view_post")
     * 
     * Method to View the post by ID
     * 
     * @param Int
     * @return Html
     */
    public function viewPost($postId)
    {
        if($postId > 0)
        {
            $post = $this->postService->getRecord($postId);
            if(!empty($post))
            {
                return $this->render('Backend/viewPost.html.twig' , ['post' => $post]);
            }else
            {
                $this->addFlash('error_flash', 'Post is not found for the given ID...!!');
            }
        }else
        {
            $this->addFlash('error_flash', 'Post is not found for the given ID...!!');
        }
        
        return $this->redirectToRoute('admin_show_posts');        
    }

    /**
     * @Route("admin/post/delete/{postId}" , name="delete_post")
     * 
     * Method to View the post by ID
     * 
     * @param Int
     * @return Html
     */
    public function deletePost($postId)
    {
        if($postId > 0)
        {
            $result = $this->postService->deleteRecord($postId);
            if($result)
            {
                $this->addFlash('success_flash', 'Post deleted successfully.!!');
            }else
            {
                $this->addFlash('error_flash', 'Post is not found for the given ID...!!');
            }
        }else
        {
            $this->addFlash('error_flash', 'Post is not found for the given ID...!!');
        }
        
        return $this->redirectToRoute('admin_show_posts');
    }
}