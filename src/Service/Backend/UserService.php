<?php

namespace App\Service\Backend;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class UserService
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
     * Method to fetch all the users list
     * 
     * @return Array
     */
    public function getAllUsers()
    {
        $data = $this->em->getRepository(User::class)->getAllUsersByRole('ROLE_ADMIN');
		if(!empty($data)) 
		{
            return $data;
		}else
		{
			return [];
		}
    }

    /**
     * Method to find the user by user id
     * 
     * @param In
     * @return Array
     */
    public function getUser($userId)
    {
        $data = $this->em->getRepository(User::class)->find($userId);
		if(!empty($data)) 
		{
			return $data;
		}else
		{
			return [];
		}
    }  
    
    /**
     * Method to delete the user
     * 
     * @param Int
     * @return Bool
     */
    public function deleteUser($userId)
    {
        $user = $this->em->getRepository(User::class)->find($userId);
		if(!empty($user))
		{
			$this->em->remove($user);
			$this->em->flush(); 

			return true;
		}

		return false;
    }
}