<html>
	<head>
		<title>Post a Reply</title>
		<link rel="stylesheet" href="forums.css" type="text/css">
	</head>
	<body>
		<?php
			switch(@$_POST['Button'])
			{
				case "Post Message":
				{
					include("ForumVars.inc");
					$cxn = mysqli_connect($host, $user, $passwd) or die("Could not connect to the MySQL server.");
					$db = mysqli_select_db($cxn, $database) or die("Could not open the database.");
					$query = "SELECT ParentThread FROM post WHERE id = " . $_POST['freplyto'];
					$result = mysqli_query($cxn, $query);
					$thread = mysqli_fetch_assoc($result);
					#sanitize inputs
					$author = strip_tags($_POST['author']);
					$author = mysqli_real_escape_string($cxn, $author);
					$body = htmlentities($_POST['body']);
					$body = mysqli_real_escape_string($cxn, $body);
					#Write to the post table
					$query = "INSERT INTO post (ParentThread, InReplyTo, author, body)"
						. "VALUES(" . $thread['ParentThread'] . "," . $_POST['freplyto'] . ", '" . $author . "', '" . $body . "')";
					$result = mysqli_query($cxn, $query);
					if($result == 0)
					{
						echo "Error: " . mysqli_error($cxn);
					}
					else
					{
						$query = "SELECT replies FROM thread WHERE id = $thread[ParentThread]";
						$result = mysqli_query($cxn, $query);
						$reps = mysqli_fetch_assoc($result);
						$query = "UPDATE thread SET LastPost = now(), replies = {$reps['replies']}+1 WHERE id = $thread[ParentThread]";
						$result = mysqli_query($cxn, $query);
						if($result == 0)
						{
							echo "Error: " . mysqli_error($cxn);
						}
						else
						{
							echo "<meta http-equiv=\"Refresh\" content=\"3; url=ViewThread.php?threadID=" . $thread['ParentThread'] . "\"/>";
							echo "<b>Your message has been posted. In a moment, you will be automatically returned to the thread.</b>";
						}
					}
					break;
				}
				default:
				{
					include("PostReplyForms.inc");
					break;
				}
			}
		?>
		<a href="ViewForums.php">Back</a>
	</body>
</html>