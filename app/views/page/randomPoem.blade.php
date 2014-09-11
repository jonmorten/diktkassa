<?php if ($poem) { ?>
    <div class="columns small-12 small-centered medium-7 medium-centered large-5 large-centered">
        <div class="row">
            <div class="form-action columns small-6">
                <a href="#" class="button split">Les et til <span class="split-button-icon" data-dropdown="drop"></span></a>
                <ul id="drop" class="f-dropdown" data-dropdown-content>
                    <li><a href="#">Alle</a></li>
                    <li><a href="#">Nyeste</a></li>
                </ul>
            </div>
            <p class="form-action columns small-6">
                <a class="button" href="{{ URL::route('frontpage') }}">Skriv</a>
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
