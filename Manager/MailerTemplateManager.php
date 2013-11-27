<?php

namespace KRS\MailBundle\Manager;

use Doctrine\ORM\EntityManager;
use KRS\MailBundle\Entity\MailTemplate;
use KRS\MailBundle\Manager\BaseManager;

class MailerTemplateManager extends BaseManager
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function loadKarisMailTemplate($mailTemplateId) {
        return $this->getRepository()
                ->findOneBy(array('id' => $mailTemplateId));
    }

    public function createDefault($name)
    {
    	
    	$template = new MailTemplate();
    	$template->setName($name);
    	$template->setSubject('Default subject');
    	$template->setFromEmail('noreply@nomail.com');
    	$template->setIsActive(true);
    	$this->saveEntity($template);
    	return  $template;
    }
  
    public function updateTemplate($template,$values)
    {
    	$templateVars = array_keys($values);
    
    	natsort($templateVars);
    
    	if ($template->getVarsMail() != implode(', ', $templateVars))
    	{
    		$template->setVarsMail(implode(', ', $templateVars));
    	}
    
    	if (!$template->getBody())
    	{
    		$body = array();
    		foreach($values as $key =>  $value)
    		{
    			$body[] = $key.' : '.$this->wrap($key);
    		}
    		$template->setBody(implode("\n", $body));
    	}
    
  		  $this->saveEntity($template);
  		  
  		  return  $template;
    }
    
    public function wrap($key)
    {
    	return '%'.$key.'%';
    }
    
    public function getRepository()
    {
    	return $this->em->getRepository('KRSMailBundle:MailTemplate');
    }
}