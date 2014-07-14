<?php if ($message) { ?>
	<p><?php echo $message ?></p>
<?php } ?>

<form
	action="/"
	method="post"
>
	<input
		id="poem_title"
		name="poem_title"
		type="text"
		value="<?php echo $poemTitle ?: '' ?>"
	>
	<textarea
		id="poem_text"
		name="poem_text"
	><?php echo $poemText ?: '' ?></textarea>
	<button
		type="submit"
	>Send</button>
</form>
