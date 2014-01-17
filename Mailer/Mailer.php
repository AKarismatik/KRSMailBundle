<?php

namespace KRS\MailBundle\Mailer;

/**
 * Mailer
 * 
 */
use FOS\UserBundle\Mailer\MailerInterface;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Routing\RouterInterface;
use KRS\MailBundle\Entity\MailTemplate;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Mailer implements MailerInterface
{

	
    protected  $template;
    protected  $portail;
    /**
     * 
     * @var array
     */
    protected  $values;
    protected  $router;
    protected  $message;
    protected  $mailerManager;
    protected  $sentMailer;
    protected  $isRendered;
    protected  $twig;
    protected  $container;
    protected  $em;
    
    /**
     * Constructor
     * 
     */
    public function __construct($mailer,$mailerManager,$sentMailer,$router, \Twig_Environment $twig,ContainerInterface $container,$em)
    {
        $this->mailer = $mailer;
        $this->mailerManager = $mailerManager;
        $this->sentMailer = $sentMailer;
        $this->router = $router;
        $this->twig = $twig;
        $this->container = $container;
        $this->em = $em;
        $this->initialize();
    }

    protected function initialize()
    {
    	$this->values     = array();
    	$this->isRendered = false;
    	$this->message    = \Swift_Message::newInstance();
    }
    
    /**
     * Set a template to the mail
     *
     * @return Mailer $this
     */
    public function setTemplate($templateName)
    {
    	if($templateName instanceof MailTemplate)
    	{
    		$this->template = $templateName;
    	}
    	elseif (!$this->template = $this->mailerManager->getRepository()->findOneBy(array('name' => $templateName)))
    	{
    		$this->template =  $this->mailerManager->createDefault($templateName);
    	}
    
    	return $this;
    }
    
    /**
     * Get the template used to build the mail
     *
     *  @return MailTemplate the template instance
     */
    public function getTemplate()
    {
    	return $this->template;
    }
    
    
    /**
     * Set a portail to the mail
     *
     * @return Mailer $this
     */
    public function setPortail($PortailName)
    {
    	$this->portail = $PortailName;
    	
    	return $this;
    }
    
    /**
     * Get the portail used to build the mail
     *
     * the template instance
     */
    public function getPortail()
    {
    	if($this->portail)
    	{
    		return $this->portail;
    	}
    	else 
    	{
    		return $this->container->getParameter('portail');
    	}
    }
    
    /**
     * Set a message manually to the mail
     *
     * @param Swift_Message $message the Swift message
     * @return Mailer $this
     */
    public function setMessage(\Swift_Message $message)
    {
    	$this->message = $message;
    
    	return $this;
    }
    
    /**
     * Get the Swift message that will be sent
     *
     * @return Swift_Message the message instance
     */
    public function getMessage()
    {
    	return $this->message;
    }
    
    /**
     * Set a mailer manually
     *
     * @param Swift_Mailer $mailer another mailer
     * @return Mailer $this
     */
    public function setMailer(\Swift_Mailer $mailer)
    {
    	$this->mailer = $mailer;
    
    	return $this;
    }

    
    /**
     * Get the mailer used
     *
     * @return Swift_Mailer the mailer instance
     */
    public function getMailer()
    {
    	return $this->mailer;
    }
    
    
    /**
     * Add values to the mail that will be available in the template
     *
     * @param   mixed   $data   array
     * @param   string  $prefix a prefix for this data
     * @return  Mailer  $this
     */
    public function addValues($values, $prefix = null)
    {    
    	if(!is_array($values))
    	{
    		throw new MailerException('KarisMailer->setValues arrays');
    	}
    	foreach($values as $key => $value)
    	{
    		if(is_array($value))
    		{
    			unset($values[$key]);
    		}
    		elseif(is_object($value))
    		{
    			try
    			{
    				$values[$key] = $value;
    			}
    			catch(\Exception $e)
    			{
    				unset($values[$key]);
    			}
    		}
    		elseif($prefix)
    		{
    			$values[$prefix.$key] = $value;
    			unset($values[$key]);
    		}
    	}
    
    	$this->values = array_merge($this->values, $values);
    
    	return $this;
    }
    
    /**
     * Return values that will be available in the template
     *
     * @return array $values
     */
    public function getValues()
    {
    	return $this->values;
    }
    
    public function isRendered()
    {
    	return $this->isRendered;
    }
    
    /**
     * Binds the mail with available data
     * Uses Swift to send it.
     *
     * @return Mailer $this
     */
    public function send()
    {
    	if(!$this->getTemplate()->getIsActive())
    	{
    		return $this;
    	}
    	
        if(!$this->isRendered())
	    {
	      $this->render();
	    }
	    
    	$eventParams = array(
    			'mailer'    => $this->getMailer(),
    			'message'   => $this->getMessage(),
    			'template'  => $this->getTemplate()
    	);

    	$this->getMailer()->send($this->getMessage());
    	$this->sentMailer->createSentMail($this->getTemplate());
    
    	return $this;
    }
    


  /**
   * Builds the Swift message inserting vars in templates
   *
   * @return Mailer $this
   */
  public function render()
  {
    if (!$this->getTemplate())
    {
      throw new MailerException('You must call setTemplate() to set a mail template');
    }
    
    $template = $this->getTemplate();
    
    $template =  $this->mailerManager->updateTemplate($template,$this->getValues());
    $replacements = $this->getReplacements();
    //load the template content
    $templateFile = 'KRSMailBundle:mailTemplate:karisMailTemplate.html.twig';
    $templateContent = $this->twig->loadTemplate($templateFile);
    
    $body = $templateContent->render(array('body' =>strtr($template->getBody(), $replacements)));
    
    $message = $this->getMessage();

    $from = array($template->getFromEmail() => "KRS");
    $message
    ->setSubject(strtr($template->getSubject(), $replacements))
    ->setBody(strtr($body, $replacements),'text/html')
    ->setContentType("text/html")
    ->setFrom($from)
    ->setTo($this->emailListToArray(strtr($template->getToEmail(), $replacements)));

    if($template->getCcEmail())
    {
    	$message->setCc($this->emailListToArray(strtr($template->getCcEmail(), $replacements)));
    }
    
    if($template->getBccEmail())
    {
    	$message->setBcc($this->emailListToArray(strtr($template->getBccEmail(), $replacements)));
    }
    
    if($template->getReplyToEmail())
    {
    	$message->setReplyTo($this->emailListToArray(strtr($template->getReplyToEmail(), $replacements)));
    }
    
    if($template->getSenderEmail())
    {
    	$message->setSender($this->emailListToArray(strtr($template->getSenderEmail(), $replacements)));
    }

    $this->isRendered = true;

    return $this;
  }

  protected function getReplacements()
  {
    $replacements = array();

    foreach($this->getValues() as $key => $value)
    {
      $replacements[$this->wrap($key)] = $value;
    }

    return $replacements;
  }

  protected function emailListToArray($emails)
  {
    $entries = array_unique(array_filter(array_map('trim', explode(',', str_replace("\n", ',', $emails)))));
    $emails = array();
    foreach($entries as $entry)
    {
      if(preg_match('/^.+\s<.+>$/', $entry))
      {
        $email  = preg_replace('/^.+\s<(.+)>$/', '$1', $entry);
        $name   = preg_replace('/^(.+)\s<.+$/', '$1', $entry);
        $emails[$email] = $name;
      }
      else
      {
        $emails[$entry] = null;
      }
    }

    return $emails;
  }
  
  protected function wrap($key)
  {
  	return '%'.$key.'%';
  }
  
  
  public function sendConfirmationEmailMessage(UserInterface $user)
  {
  	 $url = $this->router->generate('fos_user_registration_confirm', array('token' => $user->getConfirmationToken()), true);
	 $this->setTemplate('fos_user_registration_confirm')->addValues(array('url'=>$url),'registration.')->addValues($this->getEntityColumnValues($user,$this->em),'user.');
	 $this->sendEmailMessage();
  }
  
 
  public function sendResettingEmailMessage(UserInterface $user)
  {
	  	$url = $this->router->generate('fos_user_resetting_reset', array('token' => $user->getConfirmationToken()), true);
	  	$this->setTemplate('fos_user_resetting_reset')->addValues(array('url'=>$url),'reset.')->addValues($this->getEntityColumnValues($user,$this->em),'user.');
	  	$this->sendEmailMessage();
  }
  
 public function getValuesUser($user)
 {
 	return  $this->getEntityColumnValues($user,$this->em);
 } 
 
 public function getEntityColumnValues($entity,$em){
 		$classMetadata = $emEntity->getClassMetadata(get_class($em));
	  	$idFields   = $classMetadata->getFieldNames();
        $values = array();

        foreach ($idFields as $idField)
        {
            $values[$idField] = $classMetadata->getFieldValue($entity, $idField);
	  	}
	  	return $values;
  }
}
