<?php if ($message) { ?>
	<p><?php echo $message ?></p>
<?php } ?>

<form
	action="/"
	method="post"
	class="columns small-12 small-centered medium-7 medium-centered large-5 large-centered"
>
	<input
		id="poem_title"
		name="poem_title"
		type="text"
		value="<?php echo $poemTitle ?: '' ?>"
		placeholder="Her skal diktets tittel"
	>
	<textarea
		id="poem_text"
		name="poem_text"
		rows="7"
		placeholder="Og her dets kapittel"
	><?php echo $poemText ?: '' ?></textarea>
	<button
		type="submit"
	>Send</button>
</form>
