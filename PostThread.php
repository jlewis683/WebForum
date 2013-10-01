<html>
	<head>
		<title>Post a New Thread</title>
		<link rel="stylesheet" href="forums.css" type="text/css">
	</head>
	<body>
		<?php
			switch(@$_POST['Button'])
			{
				case "Post Thread":
				{
					include("forumvars.inc");
					$cxn = mysqli_connect($host, $user, $passwd) or die("Could not connect to the MySQL server.");
					$db = mysqli_select_db($cxn, $database) or die("Could not open the database.");
					# create the new thread
					$sql = "INSERT INTO thread(ParentTopic, ThreadSubject, replies) "
						. "VALUES(" . $_POST['ftopicID'] . ", '" . addslashes(htmlentities($_POST['subject'])) . "', 1)";
					if(!mysqli_query($cxn, $sql))
					{
						echo "Error: " . mysqli_error($cxn);
					}
					$ParentThread = mysqli_insert_id($cxn);
					# sanitize the inputs
					$author = strip_tags($_POST['author']);
					$author = mysqli_real_escape_string($cxn, $author);
					$body = htmlentities($_POST['body']);
					$body = mysqli_real_escape_string($cxn, $body);
					# write to the post table
					$query = "INSERT INTO post (ParentThread, author, body)"
						. "VALUES(" . $ParentThread . ", '" . $author . "', '" . $body . "')";
					$result = mysqli_query($cxn, $query);
					if($result == 0)
					{
						echo "Error: " . mysqli_error($cxn);
					}
					else
					{
						echo "<meta http-equiv=\"Refresh\" content=\"3; url=ViewTopic.php?topicID=" . $_POST['ftopicID'] . "\"/>";
						echo "<b>Your message has been posted. In a moment, you will be automatically returned to the topic.</b>";
					}
					break;
				}
				default:
				{
					include("PostThreadForms.inc");
					break;
				}
			}
		?>
		<a href="ViewForums.php">Back</a>
	</body>
</html>