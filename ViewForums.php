<?php 
	include("ViewForumsFunctions.inc"); 
?>
<html>
	<head>
		<title>Forums</title>
		<link rel="stylesheet" href="forums.css" type="text/css">
	</head>
	<body>
		<?php
			include("ForumVars.inc");
			$cxn = mysqli_connect($host, $user, $passwd) or die("Couldn't connect to database");
			$db = mysqli_select_db($cxn, $database) or die("Couldn't select database.");
			$result = mysqli_query($cxn, "SELECT * FROM forum");
			if($result == 0)
			{
				echo "<b>Error ";
				echo mysqli_errno($cxn);
				echo "</b>";
			}
			else
			{
				echo "<table width=100% class=\"ForumLine\" cellpadding=4 cellspacing=2 border=1 align=center>";
				DisplayForumHeader();
				for($i=0; $i<mysqli_num_rows($result); $i++)
				{
					$forum = mysqli_fetch_assoc($result);
					echo "<tr>";
					echo "<td class=\"ForumTitle\" colspan=5>" . $forum['ForumName'] . "</td>";
					echo "</tr>";
					DisplayTopics($forum['id'], $cxn, "ViewTopic.php");
				}
				echo "</table>";
			}
		?>
	</body>
</html>