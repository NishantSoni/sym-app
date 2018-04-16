<?php

namespace App\Service\Backend;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;

class PostService
{
    /**
     * Entity manager instance
     *
     * @var instance 
     */
	private $em; 

	/**
     * At the time initialization of this class
     *
     * @param Instance
     */
	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->em = $entityManager;
    }

    /**
     * Method to get all the records from the table. 
     *
     * @return array
     */
	public function getAllRecords()
	{
		$data = $this->em->getRepository(Post::class)->findAll();
		if(!empty($data)) 
		{
			return $data;
		}else
		{
			return [];
		}
    }
    
    /**
     * Method to get only one record at a time
     *
	 * @param integer
     * @return array
     */
	public function getRecord($id)
	{
		$data = $this->em->getRepository(Post::class)->find($id);
		if(!empty($data)) 
		{
			return $data;
		}else
		{
			return [];
		}
    }
    
    /**
     * Method to delete the records
	 * 
	 * @param Int
     * @return Bool
     */
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