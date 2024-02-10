
    /*1. Write a function named factors that finds the factors of a number. 
    The function takes a number as a parameter and returns a string. 
    The string contains the factors separated by commas and spaces. 
    The factors include 1 and the number. The number is a positive integer. */

    function factors($n) {
        $factors = ""; // initialize a string variable to hold answer 
        for($i = 1; $i < $n; $i++) { // for loop finding factors
            if ($n % $i == 0) {
                $factors = $factors.$i.", "; // add the factor to the string 
            }
        }

        $factors = $factors.$n; // add the number itself to the string

        return $factors; // return string 

    }

    /* 2. Write a function named tax that computes the tax according to the following tax rules. The 
    tax depends on the income and the marital status. If single and income is less than 30000 then tax
    rate is 20%. If single and income is greater or equal to 30000 then tax rate is 25%. If married and 
    income is less than 50000 then tax rate is 10%. If married and income is greater or equal to
    50000 then tax rate is 15%. The function takes the income and the marital status as parameters 
    and returns the tax amount. The income is a positive number. The status is a string single or 
    married in lower or upper case */

    function tax(%income, $maritalStatus)
    {
        $maritalStatus = strtoupper($maritalStatus)

        if ($maritalStatus == "single")
        {
            if ($income < 30000) $tax = 0.2
            else $tax = 0.25
        }
        else if ($maritalStatus == "married")
        {
            if ($income < 50000) $tax = 0.1
            else $tax = 0.15
        }

        return $tax
    }

    /* 3. Write a function named stdDev that computes the standard deviation of a 
    set of numbers. The function takes the numbers in an array parameter and returns 
    the standard deviation. The standard deviation of n numbers x1, x2 . . . xn is 
    the square root of [((x1-m)2 + (x2-m)2 + . . . + (xn-m)2)/n] where m is the average 
    of the numbers. If there are less than two numbers the standard deviation is 0. */

    function stdDev($x) {
        $n = count($x); // Count the number of elements in the array
    
        $sum = 0; // Initialize sum of elements
        $result = 0; // Initialize variable for the sum of squared differences
    
        // Calculate the sum of all elements in the array
        foreach ($x as $element) {
            $sum = $sum + $element;
        }
        
        $m = $sum / $n; // Calculate the mean (average) of the elements
    
        // Calculate the sum of the squared differences from the mean
        foreach ($x as $element) {
            $result = $result + ($element - $m) * ($element - $m);
        }
    
        $result = $result / $n; // Divide by the number of elements to get the variance
        $result = sqrt($result); // Take the square root of the variance to get the standard deviation
    
        return $result; // Return the calculated standard deviation
    }

    /* 4. Write a function named compoundInterest that computes the compound interest. If p
    amount is invested for n years with interest rate r and the money is compounded annually then 
    the final amount will be p(1 + r/100)^n . The function takes initial amount p, interest rate r
    which is between 0 and 100, and the number of years n as parameters and returns the final 
    amount. The parameter values are all positive. */
    function compoundInterest($p, $r, $n)
    {
        return $p * pow((1 + $r/100), $n);
    }

    /* 5. Write a function named createIdPassword that takes a last name and a first name as parameters and returns 
    an associative array containing an id and a password. The id is the first letter of the first name followed by 
    the last name. The password is the first letter of the first name followed by the last letter of the first name 
    followed by the first three letters of the last name followed by the length of the first name followed by the 
    length of the last name. Both id and password are all upper case. For example if the first name is John and the 
    last name is Maxwell then the id is JMAXWELL and the password is JNMAX47. The returned associative array has two 
    keys namely id and password, and their values are set to the id and password that are created. */

    function createIdPassword($lname, $fname) {
        // Combine the first letter of the first name with the last name for the ID
        $id = $fname[0].$lname;
        // Convert the ID to uppercase
        $id = strtoupper($id);

        // Construct the password using the following pattern:
        // First letter of the first name, last letter of the first name,
        // first three letters of the last name, length of the first name,
        // and length of the last name
        $password = $fname[0].$fname[-1].substr($lname, 0, 3).strlen($fname).strlen($lname);
        // Convert the password to uppercase
        $password = strtoupper($password);

        // Create an associative array with keys 'id' and 'password'
        $result = array("id" => $id, "password" => $password);
        // Return the associative array
        return $result;
    }

    /* 6. Write a function named removeDuplicates that takes an array of strings as parameter and 
    returns a duplicate free array. The calling/parameter array does not change. The unique strings of
    the calling array are placed in a newly created array and it is returned. For example if the calling 
    array is [tree, cat, box, cat, dog, tree, tree] then the returned array is 
    [tree, cat, box, dog]. */
    function removeDuplicates($inArray)
    {
        // declare outArray to return later
        let $outArray = array();
        
        // for every value in inArray, add it to outArray if not in outArray yet
        foreach($inArray as $inVal)    {
            $isDuplicate = false;
    
            foreach($outArray as $outVal)
            {
                // determine whether value in inArray is already in outArray
                if($inVal == $outVal)
                {
                    $isDuplicate = true;
                    break;
                }
            }
            // push value from inArray to outArray if it is unique
            if(!$isDuplicate)
            {
                array_push($outArray, $inVal);
            }
        }
        
        return $outArray;
    }

    /* 7. Write a class called Student. The class has two private data members called name and gpa. The class has a 
    constructor that takes a name and a gpa and set them to the data members of the class. The class getName, getGpa, 
    setName, and setGpa methods that get and set name and gpa. The class has isHonors method which returns true/false 
    depending on whether gpa is above or below 3. */

    class Student {
        // Declare private data members for the class: name and gpa
        private $name;
        private $gpa;

        // Constructor method that takes name and gpa as parameters
        // and sets them to the data members of the class
        public function __construct($name, $gpa) {
            $this->name = $name; // Set the name data member
            $this->gpa = $gpa;   // Set the gpa data member
        }

        // Setter method for name
        public function setName($name) {
            $this->name = $name; // Update the name data member
        }

        // Setter method for gpa
        public function setGpa($gpa) {
            $this->gpa = $gpa; // Update the gpa data member
        }

        // Getter method for name
        public function getName() {
            return $this->name; // Return the name data member
        }

        // Getter method for gpa
        public function getGpa() {
            return $this->gpa; // Return the gpa data member
        }

        // Method to determine if the student is on honors
        public function isHonors() {
            // Check if the gpa is 3.0 or above
            if ($this->getGpa() < 3.0) {
                return false; // Return false if gpa is below 3.0
            } else {
                return true;  // Return true if gpa is 3.0 or above
            }
        }
    }

    /* 8. Write a function named university that takes a string as a parameter and decides whether
    it is a valid university id. The university id format is E-0xxy-9yyx. Write a method named 
    phone that takes a string as a parameter and decides whether it is a valid phone number with 
    area code 313 or 248 or 734. The phone number format is xxx-xxx-xxxx. Here x is a digit
    and y is a lower case letter. These functions return true/false. The code must be based on 
    regular expression */
    function university($id) {
        // Regular expression pattern for university ID: E-0xxy-9yyx
        $pattern = '/^E-0\d[a-z]{2}-9[a-z]{2}\d$/';
        
        // Check if the ID matches the pattern
        return preg_match($pattern, $id) === 1;
    }
        
    function phone($number) {
        // Regular expression pattern for phone number: xxx-xxx-xxxx with area code 313, 248, or 734
        $pattern = '/^(313|248|734)-\d{3}-\d{4}$/';
        
        // Check if the phone number matches the pattern
        return preg_match($pattern, $number) === 1;
    }