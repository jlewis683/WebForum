<?php
	function DisplayThreadsHeader()
	{
		echo '
			<tr>
				<td class="ThreadHeader" height=25 nowrap="nowrap">Subject</td>
				<td class="ThreadHeader" height=25 nowrap="nowrap">Replies</td>
				<td class="ThreadHeader" height=25 nowrap="nowrap">Author</td>
				<td class="ThreadHeader" height=25 nowrap="nowrap">Last Post</td>
			</tr>
		';
	}
	function AddField($assoc, $column, $style)
	{
		echo '<td class="' . $style . '">' . $assoc[$column] . '</td>';
	}
?>