<?php namespace Application\Core;

class View
{
	//public $template_view;
	
	function generate($contentView, $templateView, $title = 'Title', $data = null)
	{
		/*
		if(is_array($data)) {
			extract($data);
		}
		*/
		
		include 'Application/Views/' . $templateView;
	}
}