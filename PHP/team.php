<?php //team.php

class Team
{
	private $name, $country;
	
	function __construct($team_name)
	{
		$this->name=$team_name;
	}
	
	function setCountry($team_country)
	{
		$this->country=$team_country;
		return $this;
	}
	
	function getName()
	{
		return $this->name;
	}
	
	function getCountry()
	{
		return $this->country;
	}
}

?>