<?php

/**
 * @author D.D.M. van Zelst
 * @copyright 2012
 */

function scheduler($teams){
    if (count($teams)%2 != 0){
        array_push($teams,"bye");
    }
    $away = array_splice($teams,(count($teams)/2));
    $home = $teams;
    for ($i=0; $i < count($home)+count($away)-1; $i++){
        for ($j=0; $j<count($home); $j++){
            $round[$i][$j]["Home"]=$home[$j];
            $round[$i][$j]["Away"]=$away[$j];
        }
        if(count($home)+count($away)-1 > 2){
            array_unshift($away,array_shift(array_splice($home,1,1)));
            array_push($home,array_pop($away));
        }
    }
    return $round;
}
?>