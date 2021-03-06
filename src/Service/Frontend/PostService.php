<?php

namespace App\Service\Frontend;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;

class PostService
{
	private $em; 

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->em = $entityManager;
	}

	public function getAllRecords()
	{
		return $this->em->getRepository(Post::class)->findAll();
	}

	public function getRecord($id)
	{
		return $this->em->getRepository(Post::class)->find($id);
	}

	public function createRecord($data)
	{
		$this->em->persist($data);
        $this->em->flush(); 
        return true;
	}

	public function updateRecord($updatedData , $id)
	{
		$post = $this->em->getRepository(Post::class)->find($id);
		$post->setTitle($updatedData->getTitle());
		$post->setDescription($updatedData->getDescription());
		$post->setCategory($updatedData->getCategory());
		$this->em->flush(); 
		return;
	}

	public function deleteRecord($id)
	{
		$post = $this->em->getRepository(Post::class)->find($id);
		if(!empty($post))
		{
			$this->em->remove($post);
			$this->em->flush(); 
			return true;
		}
		return false;
	}
}