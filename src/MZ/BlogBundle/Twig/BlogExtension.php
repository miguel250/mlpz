<?php

namespace MZ\BlogBundle\Twig;

class BlogExtension extends \Twig_Extension
{
	public function getFilters()
	{
		return array('readmore' => new \Twig_Filter_Method($this, 'ReadMore', array('is_safe' => array('html'))));
	}

	public function ReadMore($string, $url)
	{
		$count = strpos($string, '<!-- more -->');

		if($count === false){
			return $string;
		}else{
			$text = substr($string, 0, $count);
			$string = $text.'<div class="readmore"><a href="'.$url.'">Read More</a></div>';
			return $string ;
		}
	}

	public function getName()
	{
		return 'readmore';
	}
}