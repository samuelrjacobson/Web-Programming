/* 22
    This is related to the personalized web portal project. Add the following features to the 
    portal. When the page starts/loads, the quote near the left margin is randomly chosen. The quote
    is not fixed. The quote is randomly chosen from ten favorite quotes of yours. The current time is 
    shown near upper right corner. The time shows hours, minutes, and seconds separated by colons. 
    The time is updated every ten seconds using an animation loop. Use appropriate css style for
    quote and time.
*/
const quotes = [
    "The only thing necessary for the triumph of evil is for good men to do nothing.",
    "Cherish every moment.",
    "Animals are my friends, and I don't eat my friends.",
    "Ask not what your country can do for you...ask what you can do for your country",
    "Then they came for me...and there was no one left to speak for me.",
    "When governments fear the people, there is liberty. When the people fear the government, there is tyranny.",
    "Bigotry is the disease of ignorance, of morbid minds; enthusiasm of the free and buoyant. education & free discussion are the antidotes of both",
    "Never attribute to malice that which is adequately explained by stupidity.",
    "History is a set of lies agreed upon.",
    "Those who do not remember the past are condemned to repeat it.",
]

function init()
{
    function clock()
    {
        // Get date
        let date = new Date()
        let d = date.toString().split(" ")
        
        // Put time in upper right corner
        let time = document.getElementById("timeBox")
        time.innerHTML = d[4]
    }
    // Start clock
    clock()
    let animId = setInterval(clock, 10000);

    // Select quote
    document.getElementById("quoteBox").innerHTML = "\"" + quotes[Math.floor(10 * Math.random())] + "\""
}
