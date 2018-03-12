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
	private $postService;
	private $postEntity;

	public function __construct(PostService $postServiceInstance)
	{
		$this->postEntity = new Post();
		$this->postService = $postServiceInstance;
	}

    /**
     * @Route("/post/show", name="post_show")
     */
    public function showAllPost()
    {
    	$posts = $this->postService->getAllRecords();
    	return $this->render('Frontend/showPost.html.twig' , ['posts' => $posts]);
    }

    /**
     * @Route("/post/view/{postId}", name="post_view")
     */
    public function viewPost($postId)
    {
    	$post = $this->postService->getRecord($postId);
        return $this->render('Frontend/viewPost.html.twig' , ['post' => $post]);
    }

    /**
     * @Route("/post/update/{postId}", name="post_update")
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
				$this->postService->updateRecord($form->getData() , $postId);
				$this->addFlash('success_flash', 'Post updated successfully.!!');

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
     */
    public function deletePost($postId)
    {
        
    }

    /**
     * @Route("/post/create", name="post_create")
     */
    public function createPost(Request $request)
    {
        $form = $this->createForm(PostCreateType::class, $this->postEntity); 

        $form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid())
		{
			$this->postService->createRecord($form->getData());
			$this->addFlash('success_flash', 'Post created successfully.!!');

			return $this->redirectToRoute('post_show');
		}
         
        return $this->render('Frontend/createPost.html.twig' , ['CreatePostform' => $form->createView()]);
    }


}
