<?php if ($message) { ?>
	<p class="feedback"><?php echo $message ?></p>
<?php } ?>

{{
	Form::open([
		'class' => 'columns small-12 small-centered medium-7 medium-centered large-5 large-centered',
		'route' => 'poemFormSubmit',
	])
}}
	{{
		Form::text(
			'poem_title',
			null,
			[
				'autocomplete' => 'off',
				'placeholder' => 'Her skal diktets tittel',
			]
		)
	}}
	{{
		Form::textarea(
			'poem_text',
			null,
			[
				'placeholder' => 'Og her dets kapittel',
			]
		)
	}}
	{{ Form::button('Send', ['type' => 'submit']) }}
{{ Form::close() }}
