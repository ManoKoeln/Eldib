<?PHP

function generatePassword ( $passwordlength = 8,
                            $numNonAlpha = 0,
                            $numNumberChars = 0,
                            $useCapitalLetter = false ) {
    
    $numberChars = '123456789';
    $specialChars = '!$%&=?*-:;.,+~@_';
    $secureChars = 'abcdefghjkmnpqrstuvwxyz';
    $stack = '';
        
    // Stack für Password-Erzeugung füllen
    $stack = $secureChars;
    
    if ( $useCapitalLetter == true )
        $stack .= strtoupper ( $secureChars );
        
    $count = $passwordlength - $numNonAlpha - $numNumberChars;
    $temp = str_shuffle ( $stack );
    $stack = substr ( $temp , 0 , $count );
    
    if ( $numNonAlpha > 0 ) {
        $temp = str_shuffle ( $specialChars );
        $stack .= substr ( $temp , 0 , $numNonAlpha );
    }
        
    if ( $numNumberChars > 0 ) {
        $temp = str_shuffle ( $numberChars );
        $stack .= substr ( $temp , 0 , $numNumberChars );
    }
            
        
    // Stack durchwürfeln
    $stack = str_shuffle ( $stack );
        
    // Rückgabe des erzeugten Passwort
    return $stack;
    
}

// $passwd = generatePassword ( 8, 2, 2, true );
// echo $passwd . '<br>';

// $passwd = generatePassword ( 8, 0, 0, true );
// echo $passwd . '<br>';

// $passwd = generatePassword ( 8 );
// echo $passwd;

?> 