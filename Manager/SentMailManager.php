<?php

namespace KRS\MailBundle\Manager;

use Doctrine\ORM\EntityManager;
use KRS\MailBundle\Entity\SentMail;
use KRS\MailBundle\Manager\BaseManager;

class SentMailManager extends BaseManager
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function loadKarisSentMail($sentMailId) {
        return $this->getRepository()
                ->findOneBy(array('id' => $sentMailId));
    }

    public function createSentMail($mailTemplate)
    {	
    	$template = new SentMail($mailTemplate);
    	$template->setMailTemplate($mailTemplate);
    	$template->setSubject($mailTemplate->getSubject());
    	$template->setFromEmail($mailTemplate->getFromEmail());
    	$template->setToEmail($mailTemplate->getToEmail());
    	$this->saveEntity($template);
    }
  
    public function getRepository()
    {
    	return $this->em->getRepository('KRSMailBundle:SentMail');
    }
}