<?php if ($message) { ?>
	<p class="feedback"><?php echo $message ?></p>
<?php } ?>

<form
	action="/"
	method="post"
	class="columns small-12 small-centered medium-7 medium-centered large-5 large-centered"
>
	<input
		autocomplete="off"
		id="poem_title"
		name="poem_title"
		placeholder="Her skal diktets tittel"
		type="text"
		value="<?php echo $poemTitle ?: '' ?>"
	>
	<textarea
		id="poem_text"
		name="poem_text"
		placeholder="Og her dets kapittel"
	><?php echo $poemText ?: '' ?></textarea>
	<button
		type="submit"
	>Send</button>
</form>
