<?php

namespace KRS\MailBundle\Manager;

abstract class BaseManager
{
	
	/**
	 * Save  entity
	 *
	 * @param  $entity
	 */
	public function saveEntity($entity)
	{
		$this->persistAndFlush($entity);
	}
	
	protected function persistAndFlush($entity)
	{
		$this->em->persist($entity);
		$this->em->flush();
	}
}