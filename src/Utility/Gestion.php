<?php
	
	namespace App\Utility;
	
	use App\Entity\Participation;
	use Doctrine\ORM\EntityManagerInterface;
	
	class Gestion
	{
		private EntityManagerInterface $entityManager;
		
		public function __construct(EntityManagerInterface $entityManager)
		{
			$this->entityManager = $entityManager;
		}
		
		public function participer($entity)
		{
			$dernier_participant = $this->entityManager->getRepository(Participation::class)->findOneBy([],['id'=>'DESC']);
			if ($dernier_participant) $id = $this->reference($dernier_participant->getId() + 1);
			else $id = $this->reference(1);
			
			$montant = (int) $entity->getNombrePlace() * 40000;
			$entity->setMontant($montant);
			$entity->setReference($id);
			
			return $entity;
		}
		
		public function reference($id): string
		{
			if ($id < 10) $num = '00'.$id;
			elseif ($id < 100) $num = '0'.$id;
			else $num = $id;
			
			return date('m').$num;
		}
	}
