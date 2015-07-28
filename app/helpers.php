<?php 

	/**
	* Helpers functions 
	*
	* Constain custom helper functions
	*/
	
	/**
	* function addMessage
	*
	* Add message to messages buffer, 
	* what will be showed with Smoke plugin
	*
	* @param array $data - data message
	* @return null
	*/
	function addMessage(Array $data) 
	{
		$notifications = Session::get('notifications');
        $notifications[] = $data;
        Session::set('notifications', $notifications);
	}

	/**
	* function getMessages
	*
	* Get messages for Smoke plugin
	*
	* @param boolean $forget default true
	* @return array - list all messages || empty array
	*/
	function getMessages ($forget = true)
	{
		$list = Session::get('notifications', []);
		if ($forget == true) {
			Session::forget('notifications');
		}
		return $list;
	}
