<?php

namespace KRS\MailBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class MailTemplateAdmin extends Admin
{
		
	/**
	 * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
	 *
	 * @return void
	 */
	protected function configureListFields(ListMapper $listMapper)
	{

		$listMapper
		->addIdentifier('name',NULL,array('label'=>'Name'))
		->add('description',NULL,array('label'=>'Description'))
		->add('subject',NULL,array('label'=>'Subject'))
		->add('is_active',NULL,array('label'=>'Active'))
		->add('created',NULL,array('label'=>'Created'))
		->add('updated',NULL,array('label'=>'Updated'));
	
		$listMapper->add('_action', 'actions',array('actions' => array('edit' => array())));
	
	}
	
	
	/**
	 * {@inheritdoc}
	 */
	protected function configureShowFields(ShowMapper $showMapper)
	{
		$showMapper
		->add('description' ,null, array('label' => 'Titre'))
		->add('body')
		->add('subject')
		->add('vars_mail')
		->add('is_active')
		->add('from_email')
		->add('to_email')
		->add('cc_email')
		->add('bcc_email')
		->add('reply_to_email')
		->add('created')
		->add('updated')
		;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function configureFormFields(FormMapper $formMapper)
	{
		
		$formMapper
			->with('General')
				->add('description',null, array('label' => 'Titre'))
				->add('subject', null, array('required' => true))
				->add('vars_mail', null,  array('attr' => array('readonly' => true)))
				->add('body')
				->add('is_html')
				->add('is_active')
		   ->with('Info')
				->add('from_email', null, array('required' => true))
				->add('to_email')
				->add('cc_email')
				->add('bcc_email')
				->add('reply_to_email')
				->add('reply_to_email')
				->add('sender_email');

	}
}