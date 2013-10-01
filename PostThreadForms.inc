
<h2 align=center>Start a new thread</h2>
<form action=<?php echo $_SERVER['PHP_SELF'] ?> method="POST">
	<table border=1>
		<tr>
			<td>
				Name: <input type="text" name="author" value="" size=30 maxsize=30><br>
				Subject: <input type="text" name="subject" value="" size=30 maxsize=30><br>
				Post:<br>
				<textarea name="body" value="" rows=5 cols=60></textarea>
				<input type="hidden" name="ftopicID" value="<?php echo $_GET['topicID'] ?>">
			</td>
		</tr>
		<tr>
			<td colsapn=2 style="text-align:center">
			<input type="submit" name="Button" value="Post Thread">
		</tr>
	</table>
</form>
