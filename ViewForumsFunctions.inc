<?php

function DisplayForumHeader()
{
	echo '
		<tr>
		<td colspan=5 class="ForumHeader" height=25 nowrap="nowrap">Forums</td>
	</tr>';
}

function DisplayTopics($forumID, $cxn, $LinkTarget)
{
	$sql = "SELECT * FROM topic WHERE parentforum = " . $forumID;
	$result = mysqli_query($cxn, $sql);
	for($k = 0; $k < mysqli_num_rows($result); $k++)
	{

		echo '<tr>';
		$topic = mysqli_fetch_assoc($result);
		echo '<td class="TopicFiller" colspan=2><img src="green.png"></td>';
		echo '<td class="TopicLink">';
		echo '<a href="' . $LinkTarget . '?topicID=' . $topic['id'] . '">' . $topic['TopicName'] . '</a>';
		echo '</td>';
		echo '<td class="TopicDesc">' . $topic['description'] . '</td>';
		echo '</tr>';

	}
}

?>