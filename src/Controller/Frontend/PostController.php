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
    public function updatePost($postId)
    {
        
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
