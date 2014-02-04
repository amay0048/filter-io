<?php
 
class Question_Model_Question extends Core_Model_Item_Abstract
{
	public function getRichContent(){
	
		/** (amay0048) TODO: This is the place where the wall content for questions gets rendered **/
		if( isset($this->snapshot) && strlen($this->snapshot))
		{
		  $subject = $this->snapshot;
		  $pattern = '/(<img.*?>)/i';
		  preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE);
		  return $matches[1][0];
		}
		return ' ';
	}
	
	public function comments()
	{
	  return new Engine_ProxyObject($this, Engine_Api::_()->getDbtable('comments', 'core'));
	}
	
	public function likes()
	{
	  return new Engine_ProxyObject($this, Engine_Api::_()->getDbtable('likes', 'core'));
	}
	
	public function tags()
	{
	  return new Engine_ProxyObject($this, Engine_Api::_()->getDbtable('tags', 'core'));
	}

}
