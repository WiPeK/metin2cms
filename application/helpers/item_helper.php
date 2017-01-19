<?php

function get_proffesion_img($job)
{
	switch($job)
	{
		case 0:
			$img = site_url() . 'assets/images/36.png';
			break;
		case 1:
			$img = site_url() . 'assets/images/183.png';
			break;
		case 2:
			$img = site_url() . 'assets/images/282.png';
			break;
		case 3:
			$img = site_url() . 'assets/images/231.png';
			break;
		case 4:
			$img = site_url() . 'assets/images/142.png';
			break;
		case 5:
			$img = site_url() . 'assets/images/430.png';
			break;
		case 6:
			$img = site_url() . 'assets/images/455.png';
			break;
		case 7:
			$img = site_url() . 'assets/images/27.png';
			break;
	}
	return $img;
}

function nazwa_profesji($job, $skill_group)
{
		if($skill_group==0)
		{
			return "Bez profesji";
		}
		elseif($job==0 and $skill_group==1)
		{
			return "Body";
		}
		elseif($job==0 and $skill_group==2)
		{
			return "Mental";
		}
		elseif($job==1 and $skill_group==1)
		{
			return "Dagger";
		}
		elseif($job==1 and $skill_group==2)
		{
			return "Archer";
		}
		elseif($job==2 and $skill_group==1)
		{
			return "Weapon";
		}
		elseif($job==2 and $skill_group==2)
		{
			return "BM";
		}
		elseif($job==3 and $skill_group==1)
		{
			return "Smok";
		}
		elseif($job==3 and $skill_group==2)
		{
			return "Healer";
		}
		elseif($job==4 and $skill_group==1)
		{
			return "Body";
		}
		elseif($job==4 and $skill_group==2)
		{
			return "Mental";
		}
		elseif($job==5 and $skill_group==1)
		{
			return "Dagger";
		}
		elseif($job==5 and $skill_group==2)
		{
			return "Archer";
		}
		elseif($job==6 and $skill_group==1)
		{
			return "Weapon";
		}
		elseif($job==6 and $skill_group==2)
		{
			return "BM";
		}
		elseif($job==7 and $skill_group==1)
		{
			return "Smok";
		}
		elseif($job==7 and $skill_group==2)
		{
			return "Healer";
		}
}

function krolestwo($id)
{
	if($id==1)
		return "Shinsoo";
	elseif($id==2)
		return "Chunjo";
	elseif($id==3)
		return "Jinno";
}

function bonus_name($bon)
{
	switch ($bon) {
		case 1:
			$name = 'Max PŻ';
			break;
		case 2:
			$name = 'Max PE';
			break;
		case 3:
			$name = 'Energia Życiowa';
			break;
		case 4:
			$name = 'Inteligencja';
			break;
		case 5:
			$name = 'Siła';
			break;
		case 6:
			$name = 'Zwinność';
			break;
		case 7:
			$name = 'Szybkość ataku';
			break;
		case 8:
			$name = 'Szybkość poruszania się';
			break;
		case 9:
			$name = 'Szybkość Zaklęcia';
			break;
		case 10:
			$name = 'Regeneracja PŻ';
			break;
		case 11:
			$name = 'Regeneracja PE';
			break;
		case 12:
			$name = 'Szansa na Otrucie';
			break;
		case 13:
			$name = 'Szansa na Omdlenie';
			break;
		case 14:
			$name = 'Szansa na Spowolnienie';
			break;
		case 15:
			$name = 'Szansa na krytyczne uderzenie';
			break;
		case 16:
			$name = 'Szansa na przeszywające uderzenie';
			break;
		case 17:
			$name = 'Silny przeciwko ludziom';
			break;
		case 18:
			$name = 'Silny przeciwko zwierzętom';
			break;
		case 19:
			$name = 'Silny przeciwko orkom';
			break;
		case 20:
			$name = 'Silny przeciwko mistykom';
			break;
		case 21:
			$name = 'Silny przeciwko nieumarłym';
			break;
		case 22:
			$name = 'Silny przeciwko diabłom';
			break;
		case 23:
			$name = 'Obrażenie absorbowane przez PŻ';
			break;
		case 24:
			$name = 'Obrażenie absorbowane przez PE';
			break;
		case 25:
			$name = 'Szansa na kradzież PE';
			break;
		case 26:
			$name = 'Szansa na kradzież PŻ';
			break;
		case 28:
			$name = 'Szansa na Uniknięcie strzały';
			break;
		case 29:
			$name = 'Odporność na miecze';
			break;
		case 30:
			$name = 'Odporność na 2-ręczne';
			break;
		case 31:
			$name = 'Odporność na sztylety';
			break;
		case 32:
			$name = 'Odporność na dzwony';
			break;
		case 33:
			$name = 'Odporność na wachlarze';
			break;
		case 34:
			$name = 'Odporność na strzały';
			break;
		case 35:
			$name = 'Odporność na ogień';
			break;
		case 36:
			$name = 'Odporność na błyskawice';
			break;
		case 37:
			$name = 'Odporność na magie';
			break;
		case 38:
			$name = 'Odporność na wiatr';
			break;
		case 39:
			$name = 'Blok ciosów';
			break;
		case 40:
			$name = 'Odbicie ciosów';
			break;
		case 41:
			$name = 'Odporność na trucizny';
			break;
		case 43:
			$name = 'Szansa na bonus doś.';
			break;
		case 44:
			$name = 'Szansa na podwójną ilość YANG';
			break;
		case 45:
			$name = 'Szansa na podwójną ilość Przedmiotów';
			break;
		case 48:
			$name = 'Niewrażliwy na omdlenia';
			break;
		case 49:
			$name = 'Niewrażliwy na spowolnienie';
			break;
		case 53:
			$name = 'Wartość ataku';
			break;
		case 59:
			$name = 'Silny przeciwko wojownikom';
			break;
		case 60:
			$name = 'Silny przeciwko ninja';
			break;
		case 61:
			$name = 'Silny przeciwko surom';
			break;
		case 62:
			$name = 'Silny przeciwko szamanom';
			break;	
		case 63:
			$name = 'silny przeciwko potworom';
			break;
		case 71:
			$name = 'Obrażenia Umiejętności';
			break;	
		case 72:
			$name = 'Średnie Obrażenia';
			break;
		case 78:
			$name = 'Odporność na wojownika';
			break;		
		case 79:
			$name = 'Odporność na ninje';
			break;	
		case 80:
			$name = 'Odporność na sure';
			break;	
		case 81:
			$name = 'Odporność na szamana';
			break;	
		case 69:
			$name = 'Max. Pż';
			break;		
		case 54:
			$name = 'Obrona';
			break;

		case 47:
			$name = 'Szansa na odzyskanie PŻ';
			break;		

		default:
			$name = 'Unknown';
			break;
	}

	return $name;
}
