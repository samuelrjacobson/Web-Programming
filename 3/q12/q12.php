<!-- Creates an HTML webpage for my resume, with sections for education, computer skills, courses, projects, work experience, and other. 
-->
<html lang="en">
	<head>
		<title>Resume</title>
		
		<meta name="keywords" content="resume, computer science">
		<meta name="author" content="Sam Jacobson">

		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<?php
			// Accepted passwords
			$passwords = array("12345", "123456", "password", "54321", "winniethepooh");

			// Get user input
			$userInput = $_POST["password"];

			// Check whether the password the user gave is correct
			$isCorrect = false;
			foreach($passwords as $pw)
			{
				if($pw == $userInput)
				{
					$isCorrect = true;
					break;
				}
			}
			// If incorrect, give error
			if(!$isCorrect)
			{
				print "<p>Incorrect password</p>";
			}
			// If correct password, display resume
			else
			{
				print '<!--header-->
				<header style="text-align:center">
					<h1>Samuel Jacobson</h1>
					<p>sjacob25@emich.edu | 734.787.8794 | 1371 Warner Creek Dr. Saline, MI</p>
				</header>
				
				<main>
					<!-- education -->
					<section id="education">
						<h2>Education</h2>
						<p><span class="bigger">Saline High School</span>—Graduated in June 2021 with 3.9875 GPA</p>
						<p><span class="bigger">Eastern Michigan University</span>—Attending full-time since September 2021, cumulative GPA 3.97. Pursuing Bachelor in Computer Science - Applied, expected April 2025.</p>
					</section>

					<!-- computer skills -->
					<section id="computerSkills">
						<h2>Computer skills</h2>
						<ul>
							<li>Programming languages: Java, C, C++, C#, Python, Lisp, HTML/CSS, Javascript, Swift, Processing, R, machine language</li>
							<li>AutoCAD and Inventor</li>
							<li>Adobe and GIMP</li>
							<li>PGP and SSH</li>
						</ul>
					</section>
					
					<!-- courses -->
					<section id="courses">
						<h2>Courses</h2>
						<ul>
							<li>Intro to Programming</li>
							<li>Programming Data Structures</li>
							<li>Statistical Methods</li>
							<li>Computer Organization I</li>
							<li>Internet-based Computing</li>
							<li>Algorithms & Data Structures</li>
							<li>Computational Discrete Structures</li>
							<li>Programming Languages</li>
							<li>Software Engineering Solutions</li>
							<li>Web Programming</li>
							<li>Computer Graphics</li>
						</ul>
					</section>
					
					<!-- projects -->
					<section id="projects">
						<h2>Projects</h2>
						<ul>
							<li>Matrix properties computer</a></li>
							<li>Shortest path between airports (Dijkstra\'s algorithm)</a></li>
							<li>Student record database projects</a></li>
						</ul>
					</section>
					
					<!-- work experience -->
					<section id="workExperience">
						<h2>Work experience</h2>
						<ul>
							<li>Library shelver</li>
							<li>Cashier</li>
							<li>Lawn mower</li>
						</ul>
					</section>
					
					<!-- other -->
					<section id="other">
						<h2>Other</h2>
						<ul>
							<li>Saline Fiddlers Philharmonic</li>
							<li>Dungeons & Dreadnoughts club at Eastern Michigan University</li>
						</ul>
					</section>
				</main>';
			}
		?>

	</body>
</html>