<?php if ($poem) { ?>
    <div class="columns small-12 small-centered medium-7 medium-centered large-5 large-centered">
        <div class="row">
            <p class="form-action columns small-12 medium-6">
                <a class="button" href="{{ URL::route('frontpage') }}">Skriv</a>
            </p>
            <p class="form-action columns small-12 medium-6">
                <a class="button" href="{{ URL::route('randomPoem') }}">Les et til</a>
            </p>
        </div>
        <article class="poem">
            <h1 class="poem-title">
                <?php echo $poem['title']; ?>
            </h1>
            <div class="poem-text">
                <?php echo $poem['text']; ?>
            </div>
        </article>
    </div>
<?php } ?>