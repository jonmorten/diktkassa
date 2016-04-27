<div class="columns small-12 small-centered medium-7 medium-centered large-centered musiclist">
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

	<br>
	<p>
		På samme måte som vi har fått inn dikt fra anonyme forfattere, <br>
		har vi fått inn musikk fra anonyme musikere.
	</p>

	<p>
		Sangene er enten skrevet med et dikt fra diktkassa som tekst, <br>
		eller med et av diktene som inspirasjon.
	</p>

	<p>
		Under finner du en liste over sangene. <br>
		Vi kommer til å publisere flere sanger i tiden framover.
	</p>

	<?php if ($songs) { ?>
		<?php foreach ($songs as $song) { ?>
			<a class="song" href="<?php print URL::route('musicStream').'/'.$song['attributes']['urlalias']; ?>">
				<?php print $song['attributes']['title']; ?>
			</a>
		<?php } ?>
	<?php } else { ?>
		<i>Ingen sanger enda. Kommer snart.</i>
	<?php } ?>
</div>
