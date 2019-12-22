<?php
class Date{

	var $days=array('Lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche');
	var $months=array('janvier','fevrier','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre');

	function getAll($year){
		$r=array();
		/*
		$date=strtotime($year.'-01-01');
		while(date('Y',$date)<=$year){
			//ce que je veux obtenir-> &r[ANNEE][MOIS][JOUR]=jour de la semaine
			$y=date('Y',$date);
			$m=date('n',$date);
			$d=date('j',$date);
			$w=str_replace('0','7',date('w',$date));
			$r[$y][$m][$d]=$w;
			$date= strtotime(date('Y-m-d',$date).'+1 DAY');
	}
	*/
	$date=new DateTime($year.'-01-01');

	while($date->format('Y') <= $year){
			//ce que je veux obtenir-> &r[ANNEE][MOIS][JOUR]=jour de la semaine
			$y=$date->format('Y');
			$m=$date->format('n');
			$d=$date->format('j');
			$w=str_replace('0','7',$date->format('w'));
			$r[$y][$m][$d]=$w;
			$date->add(new DateInterval('P1D'));
		}

		return $r;
	}



}