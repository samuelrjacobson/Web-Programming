/*	20
	This is related to the resume project. Add the following feature to the resume. When the 
	resume is clicked anywhere, a box appears at the clicked location. The box contains a link to a
	company. When the resume is clicked again anywhere, the box disappears. When the resume is 
	clicked again anywhere, the box appears at the clicked location containing a link to another 
	company. This continues. In other words, the box alternately appears and disappears with clicks. 
	The company of a click is randomly chosen from ten companies you like to work. Use
	appropriate css style for box and link.
*/

// List of links to companies
const companies = [
    '<a target="_blank" href="https://www.apple.com/">Apple</a></li>',
	'<a target="_blank" href="https://www.microsoft.com/en-us/">Microsoft</a></li>',
	'<a target="_blank" href="https://www.nvidia.com/en-us/">Nvidia</a></li>',
	'<a target="_blank" href="https://www.broadcom.com/">Broadcom</a></li>',
	'<a target="_blank" href="https://www.oracle.com/">Oracle</a></li>',
	'<a target="_blank" href="https://www.adobe.com/">Adobe</a></li>',
	'<a target="_blank" href="https://www.salesforce.com/">Salesforce</a></li>',
	'<a target="_blank" href="https://www.cisco.com/">Cisco</a></li>',
	'<a target="_blank" href="https://www.amd.com/en.html">AMD</a></li>',
	'<a target="_blank" href="https://www.ti.com/">Texas Instruments</a></li>'
]

let count = 0

// Called when user clicks body of page, 
function linkCompany()
{
	count++
	let link = document.getElementById("linkBox")	// Span element for link to reside in

	// Every other time, select a link to make visible
	if(count % 2 == 1)
	{
		link.style.top = event.clientY + "px"	// Position link at location of click
		link.style.left = event.clientX + "px"

		link.innerHTML = companies[Math.floor(10*Math.random())]	// Choose random company
		link.style.visibility = "visible"
	}
	// Remove link
	else
	{
		link.innerHTML = ""
		link.style.visibility = "hidden"
	}
}