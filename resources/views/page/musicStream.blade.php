<?php if ($music) { ?>
	<div class="columns small-12 small-centered medium-7 medium-centered large-centered">
		<div class="row">
			<p class="form-action columns small-4">
				<a href="{!! URL::route('randomPoem') !!}" class="button">Les</a>
			</p>
			<p class="form-action columns small-4">
	            <a class="button" href="{!! URL::route('frontpage') !!}">Skriv</a>
	        </p>
			<p class="form-action columns small-4">
				<a href="{!! URL::route('musicStream') !!}" class="button">Musikk</a>
			</p>
		</div>

		<p class="music-wrapper"><?php echo $music ?></p>

		<footer class="main">
			<a class="music-info-button music-poem-title" href="#">
				<?php print $title; ?>
			</a>
			<div class="music-info-text">
				<p><?php print $poem; ?></p>
			</div>
		</footer>
	</div>
<?php } ?>
