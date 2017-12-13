<?php

namespace App\Helpers;

class StringManipulator
{
    /**
     * Get the first letter for each word in a given string.
     *
     * @param $name
     * @return string
     */
    static public function firstLetters($name){
        $name = self::removeNonAlpha($name);
        
        $manipulatedString = explode(" ", ucwords($name));
        
        $initials = " ";
        
        for($i = 0; $i < count($manipulatedString); $i++){
            $initials .= $manipulatedString[$i][0];
        }
        
        return $initials;
    }
    
    /**
     * Remove all non alpha chars in a given string
     *
     * @param $input
     * @return string
     */
    static public function removeNonAlpha($input){
        $onlyAlpha = "a";
        $alphaIdx = 0;
        $isSpace = true;
        
        for ($i = 0; $i < strlen($input); $i++) {
            if (ctype_alpha($input[$i]) || ( (ctype_space($input[$i])) && !$isSpace ) ) {
                $onlyAlpha[$alphaIdx] = $input[$i];
                $alphaIdx++;
                if(ctype_space($input[$i]))
                    $isSpace = true;
                else
                    $isSpace = false;
            }
        }
        
        return $onlyAlpha;
    }
}
