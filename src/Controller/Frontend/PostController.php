<?php

namespace App\Controller\Frontend;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Service\Frontend\PostService;
use App\Form\Frontend\PostCreateType;
use App\Entity\Post;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    /**
     * PostService instance
     *
     * @var instance 
     */
    private $postService;
    
    /**
     * PostEntity form object
     *
     * @var instance
     */
	private $postEntity;

    /**
     * Service container implementation
     *
     * @param Instance
     */
	public function __construct(PostService $postServiceInstance)
	{
		$this->postEntity = new Post(); // Created the instance of the class then use it, normal process
		$this->postService = $postServiceInstance; // Example of Symfony service container
    }
    
    /**
     * @Route("/", name="route_test")
     * 
     * Method to check user is logged in or not and to redirect
     * 
     * @return route 
     */
    public function index()
    {

        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY') && $securityContext->isGranted('ROLE_ADMIN'))
        {
            return $this->redirect('admin');
        }else if($securityContext->isGranted('IS_AUTHENTICATED_FULLY') && !$securityContext->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('post_show');
        }else{
            return $this->redirect('login');
        }
    }

    /**
     * @Route("/post/show", name="post_show")
     * 
     * Method to show all the posts
     * 
     * @param request
     * @return HTML
     */
    public function showAllPost(Request $request)
    {
        $posts = $this->postService->getAllRecords();
        
        /** 
         * @var $paginator \Knp\component\pager\paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
                        $posts,
                        $request->query->getInt('page' , 1),
                        $request->query->getInt('limit', 5)
                    );
        return $this->render('Frontend/showPost.html.twig' , ['posts' => $posts , 'active' => true]);
    }

    /**
     * @Route("/post/view/{postId}", name="post_view")
     * 
     * Method to view the single post
     * 
     * @param Integer
     * @return Html
     */
    public function viewPost($postId)
    {
    	$post = $this->postService->getRecord($postId);
        return $this->render('Frontend/viewPost.html.twig' , ['post' => $post]);
    }

    /**
     * @Route("/post/update/{postId}", name="post_update")
     * 
     * Method to update the post
     * 
     * @param Request
     * @param Integer
     * @return Html
     */
    public function updatePost(Request $request, $postId)
    {
        $post = $this->postService->getRecord($postId);
        if(!empty($post))
        {
        	$post->setTitle($post->getTitle());
        	$post->setDescription($post->getDescription());
        	$post->setCategory($post->getCategory());

        	$form = $this->createForm(PostCreateType::class, $post);

        	$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid())
			{
                $result = $this->postService->updateRecord($form->getData() , $postId);
                if($result)
                {
                    $this->addFlash('success_flash', 'Post updated successfully.!!');
                }else
                {
                    $this->addFlash('error_flash', 'Post not updated, something is wrong...!!');
                }
                
                return $this->redirectToRoute('post_show');
			}

			return $this->render('Frontend/updatePost.html.twig' , ['post' => $post , 'UpdatePostform' => $form->createView()]);
        }else{
        	$this->addFlash('error_flash', 'Post is not found for the given ID...!!');

        	return $this->render('Frontend/updatePost.html.twig' , ['post' => $post]);
        }
    }

    /**
     * @Route("/post/delete/{postId}", name="post_delete")
     * 
     * Method to delete the posts
     * 
     * @param integer
     * @return Html
     */
    public function deletePost($postId)
    {
        if($postId >= 0)
        {
            $result = $this->postService->deleteRecord($postId);
            if($result)
            {
                $this->addFlash('success_flash', 'Post deleted successfully.!!');
            }else
            {
                $this->addFlash('error_flash', 'Post is not found for the given ID...!!');
            }
            return $this->redirectToRoute('post_show');
        }
        else
        {
            $this->addFlash('error_flash', 'Post is not found for the given ID...!!');

            return $this->redirectToRoute('post_show');
        }
    }

    /**
     * @Route("/post/create", name="post_create")
     * 
     * Method to create the posts
     * 
     * @param request
     * @return html
     */
    public function createPost(Request $request)
    {
        $form = $this->createForm(PostCreateType::class, $this->postEntity); 

        $form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid())
		{
            $result = $this->postService->createRecord($form->getData());
            if($result)
            {
                $this->addFlash('success_flash', 'Post created successfully.!!');
            }else
            {
                $this->addFlash('error_flash', 'Post is not created...!!');
            }
            
            return $this->redirectToRoute('post_show');
		}
         
        return $this->render('Frontend/createPost.html.twig' , ['CreatePostform' => $form->createView()]);
    }
}
