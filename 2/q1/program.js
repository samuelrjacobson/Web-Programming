// q1~q14

// 1. 
/* Write a function named middle that finds the middle value of three numbers. The function takes three numbers as parameters
 and returns the middle value. The middle value means the value that is greater than the smallest value and less than the 
 largest value.
 */

 function getMid(num1, num2, num3){ 

    if((num1 >= num2 && num1 <=num3) || (num1 <= num2 && num1 >= num3) ) {
        return num1;
    } else if ((num2 >= num1 && num2 <= num3)||(num2 <= num1 && num2 >= num3)) {
        return num2;
    } else {
        return num3;
    }
   
 }


 // 2.
/*
 Write a function named factors that finds the factors of a number. The function takes a
 number as a parameter and returns a string. The string contains the factors separated by commas
 and spaces. The factors include 1 and the number. The number is a positive integer.
 */

function factors(n){
    var stringOfFactors = "1"  // 1 is the first factor.
    for (var i = 2; i <= n / 2; i++) // check each number 2 to (n / 2)
    {
        if (n % i == 0) // if it's a factor of n, add it to string
        {
            stringOfFactors += ", " + i
        }
    }
    stringOfFactors += ", " + n    // add number itself to string
     
    return stringOfFactors
}


// 3.
/* Write a function named tax that computes the tax according to the following tax rules. The tax depends
 on the income and the marital status. If single and income is less than 30000 then tax rate is 20%. If 
 single and income is greater or equal to 30000 then tax rate is 25%. If married and income is less than 
 50000 then tax rate is 10%. If married and income is greater or equal to 50000 then tax rate is 15%. The 
 function takes the income and the marital status as parameters and returns the tax amount. The income is 
 a positive number. The status is a string single or married in lower or upper case.*/

function tax(income,status){
    if(status.toLowerCase() == "single"){
        if(income < 30000) {
            taxNum = 0.2 * income;
        } else {
            taxNum = 0.25 * income;
        }
    } 

    if(status.toLowerCase() == "married") {
        if(income < 50000) {
            taxNum = 0.1 * income;
        } else {
            taxNum = 0.15 * income;
        }  
    }
    return taxNum;
}


// #4
/* Write a function named stdDev that computes the standard deviation of a set of numbers. 
 The function takes the numbers as a variable number of parameters and returns the standard 
 deviation. The standard deviation of n numbers x1, x2 . . . xn is the square root of 
 [((x1-m)2 + (x2-m)2 + . . . + (xn-m)2)/n] where m is the average of the 
 numbers. If there are less than two numbers the standard deviation is 0.
 */

function stdDev()
{
    // calculate average of numbers
    let sum = 0
    for (var i = 0; i < arguments.length; i++)
    {
        sum += arguments[i]
    }
    const average = sum / arguments.length
    
    // calculate standard deviation
    let stdDeviation = 0
    for (var i = 0; i < arguments.length; i++)
    {
        stdDeviation += Math.pow(arguments[i] - average, 2)
    }
    stdDeviation /= arguments.length
    stdDeviation = Math.sqrt(stdDeviation)
     
    return stdDeviation
}
 

/* 5
Write a function named compoundInterest that computes the compound interest. If p amount is invested for 
n years with interest rate r and the money is compounded annually then the final amount will be 
p(1 + r/100)n . The function takes initial amount p, interest rate r which is between 0 and 100, and the 
number of years n as parameters and returns the final amount. The parameter values are all positive.
*/

function compoundInterest(p, r, n){
    var amount = (1 + r/100);
    amount =p *  Math.pow(amount, n);
    return amount;
}


//#6
/* Write a function that takes a character as a parameter and returns its type. The possible types 
 are upper, lower, digit, and other. Upper means an upper case letter. Lower means a 
 lower case letter. Digit means a numerical digit. Other means all other characters. The return 
 value is a string in lower case. Regular expressions cannot be used.
 */

function checkType(ch)
{
    if("0" <= ch && ch <= "9") return "digit"	// digit
    else if("a" <= ch && ch <= "z") return "lower"	// lowercase
    else if("A" <= ch && ch <= "Z") return "upper"	// uppercase
    else return "other"				// special character
}

/* 7.
Write a function named createIdPassword that takes a last name and a first name as parameters and returns 
an object containing an id and a password. The id is the first letter of the first name followed by the 
last name. The password is the first letter of the first name followed by the last letter of the first 
name followed by the first three letters of the last name followed by the length of the first name 
followed by the length of the last name. Both id and password are all upper case. For example if the 
first name is John and the last name is Maxwell then the id is JMAXWELL and the password is JNMAX47. The 
returned object has two properties namely id and password, and their values are set to the id and 
password that are created.
 */

function createIdPassword(lname, fname) {
    var firstLOfFName = fname.slice(0,1);
    var id = firstLOfFName + lname;
    var lenFname = fname.length;
    var lastLOfFName = fname.slice(lenFname-1, lenFname);
    var fist3LOfLname = lname.slice(0,3);
    var lenLname = lname.length;
    var passWord = firstLOfFName + lastLOfFName + fist3LOfLname + lenFname + lenLname;
    id = id.toUpperCase();
    passWord = passWord.toUpperCase();

    return {id, passWord};

}


// #8
/* Write a function named removeDuplicates that takes an array of strings as parameter and 
 returns a duplicate free array. The calling/parameter array does not change. The unique strings of
 the calling array are placed in a newly created array and it is returned. For example if the calling 
 array is [tree, cat, box, cat, dog, tree, tree] then the returned array is 
 [tree, cat, box, dog].
 */

function removeDuplicates(inArray)
{
    // declare outArray to return later
    let outArray = []
    
    // for every value in inArray, add it to outArray if not in outArray yet
    for(let inVal of inArray)
    {
        let isDuplicate = false

        for (let outVal of outArray)
        {
            // determine whether value in inArray is already in outArray
            if(inVal == outVal)
            {
                isDuplicate = true
                break
            }
        }
        // push value from inArray to outArray if it is unique
        if(!isDuplicate)
        {
            outArray.push(inVal)
        }
    }
     
    return outArray
}

/* 9.
Write a function named mySort that takes three arrays and sort/rearrange them in parallel. The three 
arrays contain information about students. The first array contains last names. The second array contains 
gpa's. The third array contains zip codes. The sorting is performed in the ascending order of last names. 
The function changes the calling/parameter arrays. Built in sorting methods cannot be used. Write custom 
code using selection sort algorithm.
*/

function mySort(lnames, gpas, zips){

    for(var i = 0; i < lnames.length-1; i++) {
        var min_index = i;
        for(var j=i+1; j < lnames.length; j++){
            if (lnames[j]< lnames[min_index]){
                min_index = j;
            }
        }

        var tempLname = lnames[i];
                lnames[i] = lnames[min_index];
                lnames[min_index] = tempLname;

                var tempgpa = gpas[i];
                gpas[i] = gpas[min_index];
                gpas[min_index] = tempgpa;

                var tempzip = zips[i];
                zips[i] = zips[min_index];
                zips[min_index] = tempzip;  

    }

    return lnames, gpas, zips;

}

// #10
/* Write a function named myReverse that takes a line of words as a paramter, reverses the 
order of words, reverses the order of characters in every other word, and returns the result. The 
input and the output are strings. The words are separated by single spaces in the input and the 
output. For example if the line of words is tree is big green then the result is neerg 
big si tree
*/

function myReverse(line)
{
	// convert to array
	line = line.split(" ")

	// reverse order of words
	for(let i = 0; i < Math.floor(line.length / 2); i++)
	{
		let temp = line[i]
		line[i] = line[line.length - 1 - i]
		line[line.length - 1 - i] = temp
	}

	// reverse order of characters in every other word
	for(let i = 0; i < line.length; i++)
	{
		if(i % 2 == 0) // only every other word
		{
			let temp = ""
			for(let j = line[i].length - 1; j >= 0; j--)
			{
				temp += line[i].charAt(j)
			}
			line[i] = temp
		}
	}

	// convert back to string
	let outLine = ""
	for(let i = 0; i < line.length; i++)
	{
		outLine += line[i] + " "
	}
	outLine = outLine.trim()
	return outLine
}



/* 11. 
Write a function named ApplyFunctionToArray that takes a function f and an array p as parameters. The f is 
a function that takes a number as a parameter and returns a number as output. The p is an array of numbers.
The function calls f on each element of p and replaces the element with the output of f. For example if f 
is a square function then all the values in p will be squared. The function changes the calling/parameter 
array.
 */

function ApplyFunctionToArray(f, p) {
    for (var i = 0; i < p.length; i++) {
        p[i] = f(p[i])
    }

    return p;
}

function f(n){
    return n * n;
}


// #12
/* Write a class called Student. The class has two properties called name and gpa. The class 
has a constructor that takes a name and a gpa and set them to the properties of the class. The 
class getName, getGpa, setName, and setGpa methods that get and set name and gpa. The 
class has isHonors method which returns true/false depending on whether gpa is above 
or below 3. The class has toString method that returns a string containing name and gpa
*/

class Student
{
	// constructor
	constructor(name, gpa)
	{
		this.name = name 
		this.age = age
	}
	
	// getters
	getName()
	{
		return this.name
	}	
	getGpa()
	{
		return this.gpa
	}
	
	// setters
	setName(name)
	{
		this.name = name
	}
	setGpa(gpa)
	{
		this.gpa = gpa
	}
	
	// says whether student is honors or no
	isHonors()
	{
		return gpa > 3
	}

	// toString, print 
	toString()
	{
		return "Name: " + name + "\tGPA: " + gpa + "\t"
	}
}

/* 13.
Write a function named university that takes a string as a parameter and decides whether it is a valid 
university id. The university id format is E-0xxy-9yyx. Write a method named phone that takes a string as a 
parameter and decides whether it is a valid phone number with area code 313 or 248 or 734. The phone number 
format is xxx-xxx-xxxx. Here x is a digit and y is a lower case letter. These functions return true/false. The 
code must be based on regular expressions.
*/

function university(id) {
    
    let reg = /^E-0\d{2}[a-z]-9[a-z]{2}\d$/;
   
    return id.search(reg)==0;
}

function phone(number) {

    let reg = /^(313|248|734)-\d{3}-\d{4}$/;
   
    return number.search == 0;
}


// #14
/* Write a function named fullName that takes a string as a parameter and decides whether it 
 is a full name of a person. The full name format is Prefix First M. Last. Prefix is Mr, 
 Mrs, or Ms. First is the first name that begins in upper case letter followed by one or more lower 
 case letters with a total length of at least two. M is the middle initial which is a single upper case 
 letter. Last is the last name which has the same format as the first name. There is a dot after the 
 middle initial. There is one space between prefix, first name, middle initial, and last name. The
 function returns true/false. The code must be based on regular expressions
 */

function fullName(name)
{
    return name.search(/^Mr?s? [A-Z][a-z]+ [A-Z]\. [A-Z][a-z]+$/) == 0 // returns true if name matches that format, false otherwise
}
