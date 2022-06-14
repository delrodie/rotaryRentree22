<?php
	
	namespace App\Utility;
	
	use App\Entity\Participation;
	use App\Repository\UserRepository;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Component\Security\Core\Security;
	
	class Gestion
	{
		private EntityManagerInterface $entityManager;
		private Security $security;
		private UserRepository $userRepository;
		
		public function __construct(EntityManagerInterface $entityManager, Security $security, UserRepository $userRepository)
		{
			$this->entityManager = $entityManager;
			$this->security = $security;
			$this->userRepository = $userRepository;
		}
		
		public function participer($entity, $edit=null)
		{
			$dernier_participant = $this->entityManager->getRepository(Participation::class)->findOneBy([],['id'=>'DESC']);
			if ($dernier_participant) $id = $this->reference($dernier_participant->getId() + 1);
			else $id = $this->reference(1);
			
			
			$montant = (int) $entity->getNombrePlace() * 40000;
			$entity->setMontant($montant);
			if ($edit) $this->reference($entity->getReference());
			else $entity->setReference($id);
			
			return $entity;
		}
		
		public function reference($id): string
		{
			if ($id < 10) $num = '00'.$id;
			elseif ($id < 100) $num = '0'.$id;
			else $num = $id;
			
			return date('m').$num;
		}
		
		public function connexion(): bool
		{
			$user = $this->userRepository->findOneBy(['email'=>$this->security->getUser()->getUserIdentifier()]);
			$nombre_connexion = $user->getConnexion();
			$user->setConnexion($nombre_connexion + 1);
			$user->setLastConnectedAt(new \DateTime());
			
			$this->entityManager->flush();
			
			return true;
		}
	}
