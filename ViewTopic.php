<html>
	<head>
		<title>
			<?php
				include("ForumVars.inc");
				$cxn = mysqli_connect($host, $user, $passwd) or die("Couldn't connect to database");
				$db = mysqli_select_db($cxn, $database) or die("Couldn't select database.");
				$query = "Select TopicName from topic where id = " . $_GET['topicID'];
				$result = mysqli_query($cxn, $query);
				$title = mysqli_fetch_assoc($result);
				echo $title['TopicName'];
			?>
		</title>
		<link rel="stylesheet" href="forums.css" type="text/css">
	</head>
	<body>
		<?php
			echo "<h1 align=center>" . $title['TopicName'] . "</h1>";
			include("ViewTopicFunctions.inc");
			$query = "SELECT thread.*, PostDate, author FROM thread, post WHERE ParentTopic = " 
			. $_GET['topicID'] 
			. " AND ParentThread = thread.id AND InReplyTo IS NULL";

			$result = mysqli_query($cxn, $query);

			if($result == 0)
			{
				echo "<b>Error: " . mysqli_error($cxn) . "</b>";
			}
			else
			{
				echo "<table width=100% class=\"ForumLine\" cellpadding=4 cellspacing=2 border=1 align=center>";
				DisplayThreadsHeader();
				for($i = 0; $i < mysqli_num_rows($result); $i++)
				{
					$thread = mysqli_fetch_assoc($result);
					echo "<tr>";
					echo "<td class=\"ThreadSubject\">";
					echo "<a href=\"ViewThread.php?threadID=" . $thread['id'] . "\">";
					echo $thread['ThreadSubject'];
					echo "</a></td>";
					echo "<td class=\"ThreadFiller\">" . $thread['replies'] . "</td>";
					echo "<td class=\"ThreadFiller\">" . $thread['author'] . "</td>";
					echo "<td class=\"ThreadFiller\">" . $thread['LastPost'] . "</td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "<b><a href=\"PostThread.php?topicID=" . $_GET['topicID'] . "\">Start a new thread</a></b>";
			}
		?>
		<br><a href="ViewForums.php">Back</a>
	</body>
</html>