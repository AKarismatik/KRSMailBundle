<?php

namespace KRS\MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SentMail
 */
class SentMail
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $body;

    /**
     * @var string
     */
    private $from_email;

    /**
     * @var string
     */
    private $to_email;

    /**
     * @var string
     */
    private $cc_email;

    /**
     * @var string
     */
    private $bcc_email;

    /**
     * @var string
     */
    private $reply_to_email;

    /**
     * @var string
     */
    private $sender_email;

    /**
     * @var string
     */
    private $strategy;

    /**
     * @var string
     */
    private $transport;

    /**
     * @var string
     */
    private $culture;

    /**
     * @var string
     */
    private $debug_string;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * @var \KRS\MailBundle\Entity\MailTemplate
     */
    private $mailTemplate;


    public function __toString()
    {
    	return $this->getSubject();
    }
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return SentMail
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    
        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return SentMail
     */
    public function setBody($body)
    {
        $this->body = $body;
    
        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set from_email
     *
     * @param string $fromEmail
     * @return SentMail
     */
    public function setFromEmail($fromEmail)
    {
        $this->from_email = $fromEmail;
    
        return $this;
    }

    /**
     * Get from_email
     *
     * @return string 
     */
    public function getFromEmail()
    {
        return $this->from_email;
    }

    /**
     * Set to_email
     *
     * @param string $toEmail
     * @return SentMail
     */
    public function setToEmail($toEmail)
    {
        $this->to_email = $toEmail;
    
        return $this;
    }

    /**
     * Get to_email
     *
     * @return string 
     */
    public function getToEmail()
    {
        return $this->to_email;
    }

    /**
     * Set cc_email
     *
     * @param string $ccEmail
     * @return SentMail
     */
    public function setCcEmail($ccEmail)
    {
        $this->cc_email = $ccEmail;
    
        return $this;
    }

    /**
     * Get cc_email
     *
     * @return string 
     */
    public function getCcEmail()
    {
        return $this->cc_email;
    }

    /**
     * Set bcc_email
     *
     * @param string $bccEmail
     * @return SentMail
     */
    public function setBccEmail($bccEmail)
    {
        $this->bcc_email = $bccEmail;
    
        return $this;
    }

    /**
     * Get bcc_email
     *
     * @return string 
     */
    public function getBccEmail()
    {
        return $this->bcc_email;
    }

    /**
     * Set reply_to_email
     *
     * @param string $replyToEmail
     * @return SentMail
     */
    public function setReplyToEmail($replyToEmail)
    {
        $this->reply_to_email = $replyToEmail;
    
        return $this;
    }

    /**
     * Get reply_to_email
     *
     * @return string 
     */
    public function getReplyToEmail()
    {
        return $this->reply_to_email;
    }

    /**
     * Set sender_email
     *
     * @param string $senderEmail
     * @return SentMail
     */
    public function setSenderEmail($senderEmail)
    {
        $this->sender_email = $senderEmail;
    
        return $this;
    }

    /**
     * Get sender_email
     *
     * @return string 
     */
    public function getSenderEmail()
    {
        return $this->sender_email;
    }

    /**
     * Set strategy
     *
     * @param string $strategy
     * @return SentMail
     */
    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;
    
        return $this;
    }

    /**
     * Get strategy
     *
     * @return string 
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * Set transport
     *
     * @param string $transport
     * @return SentMail
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
    
        return $this;
    }

    /**
     * Get transport
     *
     * @return string 
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Set culture
     *
     * @param string $culture
     * @return SentMail
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;
    
        return $this;
    }

    /**
     * Get culture
     *
     * @return string 
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * Set debug_string
     *
     * @param string $debugString
     * @return SentMail
     */
    public function setDebugString($debugString)
    {
        $this->debug_string = $debugString;
    
        return $this;
    }

    /**
     * Get debug_string
     *
     * @return string 
     */
    public function getDebugString()
    {
        return $this->debug_string;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return SentMail
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return SentMail
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set mailTemplate
     *
     * @param \KRS\MailBundle\Entity\MailTemplate $mailTemplate
     * @return SentMail
     */
    public function setMailTemplate(\KRS\MailBundle\Entity\MailTemplate $mailTemplate = null)
    {
        $this->mailTemplate = $mailTemplate;
    
        return $this;
    }

    /**
     * Get mailTemplate
     *
     * @return \KRS\MailBundle\Entity\MailTemplate 
     */
    public function getMailTemplate()
    {
        return $this->mailTemplate;
    }
}
