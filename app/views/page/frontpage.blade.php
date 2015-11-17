<?php if ($message) { ?>
	<div class="columns small-12 small-centered medium-7 medium-centered large-5 large-centered">
		<p class="feedback"><?php echo $message ?></p>
	</div>
<?php } ?>

{{
	Form::open([
		'class' => 'columns small-12 small-centered medium-7 medium-centered large-7 large-centered',
		'route' => 'poemFormSubmit',
	])
}}

	{{ Form::honeypot('user_name', 'user_time') }}
	@if ($errors->poem->has('user_time'))
		<p>
			<span class="help-block">
				<i class="fa fa-exclamation-circle"></i>
				{{ $errors->poem->first('user_time') }}
			</span>
		</p>
	@else
		<div class="row">
			<p class="form-action columns small-4">
				<a href="{{ URL::route('randomPoem') }}" class="button">Les</a>
			</p>
			<p class="form-action columns small-4">
				{{ Form::button('Send', ['type' => 'submit', 'class' => 'button']) }}
			</p>
			<p class="form-action columns small-4">
				<a href="{{ URL::route('musicStream') }}" class="button">Musikk</a>
			</p>
		</div>

		<p class="form-control">
			{{ Form::label('poem_title', 'Tittelen', ['class' => 'hide']) }}
			@if ($errors->poem->has('poem_title'))
				<span class="help-block">
					<i class="fa fa-exclamation-circle"></i>
					{{ $errors->poem->first('poem_title') }}
				</span>
			@endif
			{{
				Form::text(
					'poem_title',
					null,
					[
						'autocomplete' => 'off',
						'class' => 'text-field',
						'placeholder' => 'Her skal diktets tittel',
						'spellcheck' => 'false',
					]
				)
			}}
		</p>

		<p class="form-control">
			{{ Form::label('poem_text', 'Teksten', ['class' => 'hide']) }}
			@if ($errors->poem->has('poem_text'))
				<span class="help-block">
					<i class="fa fa-exclamation-circle"></i>
					{{ $errors->poem->first('poem_text') }}
				</span>
			@endif
			{{
				Form::textarea(
					'poem_text',
					null,
					[
						'class' => 'text-field',
						'placeholder' => 'Og her dets kapittel',
						'spellcheck' => 'false',
					]
				)
			}}
		</p>
	@endif

{{ Form::close() }}
