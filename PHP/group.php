<?php //group.php

class Group
{
	private $name, $teams;
	
	function __construct(string $group_name, Group $parent_group=null)
	{
		$this->name=$group_name;
		
		if ($parent_group)
		{
			foreach($parent_group->teams as $item)
			{
				$this->teams[]=$item;
			}
		}
	}
	
	function addTeam(Team $team)
	{
		$this->teams[]=array($team->getName(),$team->getCountry());
		return $this;
	}
	
	function generateCalendar()
	{
		$text="";
		$teams_number=count($this->teams);
		$games_number=(($teams_number-1)*$teams_number)/2;
		$teams_at_round=$teams_number-($teams_number%2);
		$games_at_round=$teams_at_round/2;
		$rounds_number=$games_number/$games_at_round;
		$columns=$games_at_round;
		if($teams_number%2) $columns++;
		
		for($i=0;$i<$columns;$i++)
		{
			$table[0][$i]=$i;
			$table[1][$i]=2*$columns-1-$i;
		}
				
		for($j=1;$j<=$rounds_number;$j++)
		{
			$text=$text."$this->name. Round $j<br>";
			for($k=0;$k<$columns;$k++)
			{
				$a=$table[0][$k];
				$b=$table[1][$k];
				if(($a==$teams_number)||($b==$teams_number)) continue;
				$c=$this->teams[$a][0];
				$d=$this->teams[$a][1];
				$e=$this->teams[$b][0];
				$f=$this->teams[$b][1];
				$text=$text."$c ";
				if($d) $text=$text."($d) ";
				$text=$text."- $e";
				if($f) $text=$text." ($f)";
				$text=$text."<br>";
			}
			$text=$text."<br>";
			
			for($m=0;$m<2;$m++)
				for($n=0;$n<$columns;$n++)
				{
					if($table[$m][$n]==0) 
						continue;
					elseif($table[$m][$n]>1) 
						--$table[$m][$n];
					else
						$table[$m][$n]=2*$columns-1;
				}				
		}
		
		$text=$text."<br>";
		echo $text;
		
	}
}

?>