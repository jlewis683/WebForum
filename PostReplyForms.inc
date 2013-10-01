<h2 align=center>Reply to a Post</h2>
<form action=<?php echo $_SERVER['PHP_SELF'] ?> method="POST">
	<table border=1>
		<tr>
			<td>
				Name: <input type="text" name="author" value="" size=30 maxsize=30><br>
				Post:<br>
				<textarea name="body" value="" rows=5 cols=60></textarea>
				<input type="hidden" name="freplyto" value="<?php echo $_GET['ReplyTo'] ?>">
				<input type="hidden" name="fsubject" value="">
			</td>
		</tr>
		<tr>
			<td colsapn=2 style="text-align:center">
			<input type="submit" name="Button" value="Post Message">
		</tr>
	</table>
</form>
