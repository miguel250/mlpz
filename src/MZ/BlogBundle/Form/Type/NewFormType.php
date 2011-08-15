<?php

namespace MZ\BlogBundle\Form\Type;

use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\AbstractType;

class NewFormType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder->add('title','text',array('label'=>'Post Tile'));
		$builder->add('image','textarea',array('label'=>'Image','required'=>false));
		$builder->add('video','textarea',array('label'=>'Video','required'=>false));
		$builder->add('link','text',array('label'=>'link','required'=>false));
		$builder->add('body','textarea');
		$builder->add('type','choice',array('expanded'=> true,
		'choices' => array('post' => 'Post','image' => 'Images', 'video' => 'Video','link'=>'Link')));
		$builder->add('tagString','text',array('label'=> 'Post Tags'));
		$builder->add('userid','hidden');
		$builder->add('description','textarea',array('label'=>'Post Description'));
		$builder->add('keywords','textarea',array('label'=>'Post Keywords'));
	}

	public function getDefaultOptions(array $options)
	{
		return array('data_class' => 'MZ\BlogBundle\Document\Posts');
	}

	public function getName()
	{
		return 'new_post';
	}
}