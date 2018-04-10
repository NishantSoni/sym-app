<?php

namespace App\Service\Frontend;
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
     * Method to create or insert the record in the database table
     *
	 * @param array
     * @return bool
     */
	public function createRecord($data)
	{
		if(!empty($data))
		{
			$this->em->persist($data);
			$this->em->flush(); 

			return true;
		}else
		{
			return false;
		}		
	}

	/**
     * Method to update the record on the basis of id
     *
	 * @param array
	 * @param integer
     * @return bool
     */
	public function updateRecord($updatedData , $id)
	{
		if(empty($updatedData))
		{
			return false;
		}

		$post = $this->em->getRepository(Post::class)->find($id);

		if(!empty($post))
		{
			$post->setTitle($updatedData->getTitle());
			$post->setDescription($updatedData->getDescription());
			$post->setCategory($updatedData->getCategory());
			$this->em->flush(); 

			return true;
		}else
		{
			return false;
		}
	}

	/**
     * Method to delete the records
	 * 
	 * @param integer
     * @return bool
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