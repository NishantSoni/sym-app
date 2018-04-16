<?php

namespace App\Service\Backend;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;
use App\Entity\User;

class DashboardService
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
     * Method to find the counts of records exists in the database
     * 
     * @return array
     */
    public function getAllRecordCounts()
    {
        $result['allUsers'] = $this->em->getRepository(User::class)->count(['enabled' => 1]);
        $result['allPosts'] = count($this->em->getRepository(Post::class)->findAll());

        return $result;
    }
}