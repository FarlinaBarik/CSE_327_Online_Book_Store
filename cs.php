

<?php 

/**
 * This file contains two funtions to identify odd prime and largest integer.
 *
 * 
 * 
 * 
 * @author     Farlina Barik Easha <farlinabarik.easha@northsouth.edu>
 */





  /**
 * Checks a given number if it is odd prime or not
 *
 * At first checks the even odd condition 
 * 
 * Then loop works till the suare root of the number.
 * Returns boolean value 
 * 
 * @param int  $number the integer to check odd prime
 * @return bool
 * @throws Exception If element is not an integer
 */

 
    function primeCheck ($number){ 
    if ($number <= 2) {
    return False; 
    }
    for ($i = 2; $i <= sqrt($number); $i++){ 
        if ($number % $i == 0) {
            return False; 
    }return True; 
    }

/**
 * Finds the largest integer among  given integer  
 *
 * Checks for each integer if it is larger than the other two
 * 
 * Then loop works till the suare root of the number.
 * Returns the largest integer 
 * 
 * param int  $number1,$number2,$number3 three integers to find the largest one
 * @return int
 * @throws Exception If element is not integer
 */
 
    function findMax ($number1,$number2,$number3){
 
 
	if ($number1 >= $number2 && $number1 >= 
    $number3)
	{
	return $number1;
	}else if ($number2 >= $number1 && $number2 >= 
    $number3){
	return $number2;
	}else {
	      return $number3;
     }


	echo "Insert number to check prime";
	fscanf(STDIN, "%d\n", $number);
	echo("\n"); 
	echo "Insert three numbers to to get the max";
	fscanf(STDIN, "%d %d %d \n", $number1,$number2,$number3);
	echo("\n");  
	 
	$flag = primeCheck($number); 
	if ($flag == True) 
	    echo "Prime"; 
	else
	    echo "Not Prime";
	 
	echo("\n");    
	echo(findMax($number1,$number2,$number3)); 
	echo("\n"); 
?> 

 

