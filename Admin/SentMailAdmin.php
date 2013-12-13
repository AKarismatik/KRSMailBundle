<?php

namespace KRS\MailBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SentMailAdmin extends Admin
{
	
	
	/**
	 * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
	 *
	 * @return void
	 */
	protected function configureListFields(ListMapper $listMapper)
	{

		$listMapper
		->addIdentifier('subject',NULL,array('label'=>'Subject'))
		->add('body',NULL,array('label'=>'Description'))
		->add('from_email',NULL,array('label'=>'From e-mail'))
		->add('to_email',NULL,array('label'=>'Recipient\'s email'))
		->add('mailTemplate.name',NULL,array('label'=>'Template'))
		->add('created',NULL,array('label'=>'Created'));
	
		$listMapper->add('_action', 'actions',array('actions' => array('edit' => array(), 'delete' => array(),)));
	
	}
	

	/**
	 * {@inheritdoc}
	 */
	protected function configureShowFields(ShowMapper $showMapper)
	{
		$showMapper
		->add('subject')
		->add('body')
		->add('from_email')
		->add('to_email')
		->add('mailTemplate')
		->add('created')
		;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function configureFormFields(FormMapper $formMapper)
	{
	
		$formMapper
		->add('subject')
		->add('body')
		->add('from_email')
		->add('to_email')
		->add('mailTemplate')
		->add('created')
		;
	
	}
}