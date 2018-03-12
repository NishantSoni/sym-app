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
}