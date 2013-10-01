<html>
	<head>
		<title>
			<?php
				include("ForumVars.inc");
				$cxn = mysqli_connect($host, $user, $passwd) or die("Couldn't connect to database");
				$db = mysqli_select_db($cxn, $database) or die("Couldn't select database.");
				$query = "Select ThreadSubject from thread where id = " . $_GET['threadID'];
				$result = mysqli_query($cxn, $query);
				$title = mysqli_fetch_assoc($result);
				echo $title['ThreadSubject'];
			?>
		</title>
		<link rel="stylesheet" href="forums.css" type="text/css">
	</head>
	<body>
		<?php
			include("ForumVars.inc");
			echo "<h2 align=center>" . $title['ThreadSubject'] . "</h2>";
			$cxn = mysqli_connect($host, $user, $passwd) or die("Could not connect to host.");
			$db = mysqli_select_db($cxn, "forum") or die("Could not load database.");
			$query = "SELECT id, author, PostDate, body FROM post WHERE ParentThread = " . $_GET['threadID'];
			$result = mysqli_query($cxn, $query);
			if($result == 0)
			{
				echo "Error: " . mysqli_error($cxn);
			}
			else
			{
				echo "<table width=100% class=\"ForumLine\" cellpadding=4 border=1>";
				echo "<tr><td class=\"PostHeader\" nowrap=\"nowrap\">Author</td><td class=\"PostHeader\" nowrap=\"nowrap\">Message</td></tr>";
				for($i = 0; $i < mysqli_num_rows($result); $i++)
				{
					$post = mysqli_fetch_assoc($result);
					echo "<tr>";
					echo "<td class=\"PostFiller\">";
					echo "<span class=\"PostAuthor\">" . $post['author'] . "</span><br>";
					echo "<span class=\"PostDate\">" . $post['PostDate'] . "</span><br>";
					echo "<span class=\"PostReply\"><a href=\"PostReply.php?ReplyTo=" . $post['id'] . "\">Reply</a></span>";
					echo "</td>";
					echo "<td class=\"PostText\">" . $post['body'] . "</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
		?>
		<a href="ViewForums.php">Back</a>
	</body>
</html>