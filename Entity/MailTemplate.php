<?php

namespace KRS\MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailTemplate
 */
class MailTemplate
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $vars_mail;

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
    private $list_unsuscribe;
    

    /**
     * @var boolean
     */
    private $is_html;

    /**
     * @var boolean
     */
    private $is_active;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sentMail;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sentMail = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString()
    {
    	return $this->getName();
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
     * Set name
     *
     * @param string $name
     * @return MailTemplate
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return MailTemplate
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

     /**
     * Set vars_mail
     *
     * @param string $varsMail
     * @return MailTemplate
     */
    public function setVarsMail($varsMail)
    {
        $this->vars_mail = $varsMail;

        return $this;
    }

    /**
     * Get vars_mail
     *
     * @return string 
     */
    public function getVarsMail()
    {
        return $this->vars_mail;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return MailTemplate
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
     * @return MailTemplate
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
     * @return MailTemplate
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
     * @return MailTemplate
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
     * @return MailTemplate
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
     * @return MailTemplate
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
     * @return MailTemplate
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
     * @return MailTemplate
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
     * Set list_unsuscribe
     *
     * @param string $listUnsuscribe
     * @return MailTemplate
     */
    public function setListUnsuscribe($listUnsuscribe)
    {
        $this->list_unsuscribe = $listUnsuscribe;
    
        return $this;
    }

    /**
     * Get list_unsuscribe
     *
     * @return string 
     */
    public function getListUnsuscribe()
    {
        return $this->list_unsuscribe;
    }
    
    /**
     * Set is_html
     *
     * @param boolean $isHtml
     * @return MailTemplate
     */
    public function setIsHtml($isHtml)
    {
        $this->is_html = $isHtml;
    
        return $this;
    }

    /**
     * Get is_html
     *
     * @return boolean 
     */
    public function getIsHtml()
    {
        return $this->is_html;
    }

    /**
     * Set is_active
     *
     * @param boolean $isActive
     * @return MailTemplate
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;
    
        return $this;
    }

    /**
     * Get is_active
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return MailTemplate
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
     * @return MailTemplate
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
     * Add sentMail
     *
     * @param \KRS\MailBundle\Entity\SentMail $sentMail
     * @return MailTemplate
     */
    public function addSentMail(\KRS\MailBundle\Entity\SentMail $sentMail)
    {
        $this->sentMail[] = $sentMail;
    
        return $this;
    }

    /**
     * Remove sentMail
     *
     * @param \KRS\MailBundle\Entity\SentMail $sentMail
     */
    public function removeSentMail(\KRS\MailBundle\Entity\SentMail $sentMail)
    {
        $this->sentMail->removeElement($sentMail);
    }

    /**
     * Get sentMail
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSentMail()
    {
        return $this->sentMail;
    }
}