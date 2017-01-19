<?php
function btn_edit($uri)
{
	return anchor($uri, '<i class="glyphicon glyphicon-edit"></i>');
}

function btn_delete($uri)
{
	return anchor($uri, '<i class="glyphicon glyphicon-remove"></i>', array(
		'onclick' => "return confirm('Czy napewno chcesz usunąć element. Nie będzie można tego cofnąć. Jesteś pewien?');"
	));
}

function e($string){
    return htmlentities($string);
}

function slash_tags($item)
{
    $items = explode(',',$item);
    return $items;
}

function ranking_time($czas)
{
    $m = date('t');
    $minut = sprintf("%02d",floor($czas /60)%60);
    $sekund = sprintf("%02d",floor($czas)%60);
    $godzin = sprintf("%02d",floor($czas/(60*60)%24));
    $tygodni = sprintf("%2d",floor($czas/(604800)%4));
    $dni = sprintf("%2d",floor($czas/(60*60*24)%$m));
    $miesiecy = sprintf("%2d",floor($czas/(60*60*24*$m)%12));

    return $miesiecy . ' miesięcy ' . $tygodni . ' tygodni ' . $dni . ' dni ' . $godzin . ' godzin ' . $minut . ' minut ' . $sekund . ' sekund';
}


/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable 
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        
        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';
        
        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}
 
 
if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}

function dateV($format,$timestamp=null){
    $to_convert = array(
        'l'=>array('dat'=>'N','str'=>array('Poniedziałek','Wtorek','Środa','Czwartek','Piątek','Sobota','Niedziela')),
        'F'=>array('dat'=>'n','str'=>array('styczeń','luty','marzec','kwiecień','maj','czerwiec','lipiec','sierpień','wrzesień','październik','listopad','grudzień')),
        'f'=>array('dat'=>'n','str'=>array('stycznia','lutego','marca','kwietnia','maja','czerwca','lipca','sierpnia','września','października','listopada','grudnia'))
    );
    if ($pieces = preg_split('#[:/.\-, ]#', $format)){  
        if ($timestamp === null) { $timestamp = time(); }
        foreach ($pieces as $datepart){
            if (array_key_exists($datepart,$to_convert)){
                $replace[] = $to_convert[$datepart]['str'][(date($to_convert[$datepart]['dat'],$timestamp)-1)];
            }else{
                $replace[] = date($datepart,$timestamp);
            }
        }
        $result = strtr($format,array_combine($pieces,$replace));
        return $result;
    }
}