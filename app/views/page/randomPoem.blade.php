<?php if ($poem) { ?>
    <div class="columns small-12 small-centered medium-7 medium-centered large-5 large-centered">
        <div class="row">
            <div class="form-action columns small-6">
                <div class="split-button-wrapper">
                    <?php if ($mode === 'nyeste') { ?>
                        <a class="button" href="{{ URL::route('randomPoem') }}/nyeste">Les et til</a>
                    <?php } else { ?>
                        <a class="button" href="{{ URL::route('randomPoem') }}">Les et til</a>
                    <?php } ?>
                    <span
                        class="split-button-icon"
                        data-dropdown="random-poem-mode-selector"
                    >
                        <?php if ($mode === 'nyeste') { ?>
                            <i class="fa fa-calendar"></i>
                        <?php } else { ?>
                            <i class="fa fa-bars"></i>
                        <?php } ?>
                    </span>
                </div>
                <ul
                    id="random-poem-mode-selector"
                    class="f-dropdown"
                    data-dropdown-content
                >
                    <li>
                        <a href="{{ URL::route('randomPoem') }}">
                            <?php if ($mode === 'alle') { ?>
                                <i class="fa fa-caret-right"></i>
                            <?php } ?>
                            Alle
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::route('randomPoem') }}/nyeste">
                            <?php if ($mode === 'nyeste') { ?>
                                <i class="fa fa-caret-right"></i>
                            <?php } ?>
                            Siste
                        </a>
                    </li>
                </ul>
            </div>
            <p class="form-action columns small-6">
                <a class="button" href="{{ URL::route('frontpage') }}">Skriv</a>
            </p>
        </div>
        <article class="poem">
            <div class="poem-content">
                <h1 class="poem-title">
                    <?php echo $poem['title']; ?>
                </h1>
                <div class="poem-text">
                    <?php echo $poem['text']; ?>
                </div>
            </div>
            <div class="poem-rating">
                <a
                    href="#"
                    data-rate-poem="<?php echo $poem['id']; ?>"
                >
                    <span
                        data-poem-rating="<?php echo $poem['rating_markup_display_value']; ?>"
                        class="poem-rating poem-rating-<?php echo $poem['rating_markup_class_value']; ?>"
                    >
                        <span
                            data-rate-poem="1"
                            class="poem-rating-star star-1 star-set"
                        >
                            <i class="icon icon-full fa fa-star"></i>
                            <i class="icon icon-half fa fa-star-half-o"></i>
                            <i class="icon icon-empty fa fa-star-o"></i>
                        </span>
                        <span
                            data-rate-poem="2"
                            class="poem-rating-star star-2 star-set"
                        >
                            <i class="icon icon-full fa fa-star"></i>
                            <i class="icon icon-half fa fa-star-half-o"></i>
                            <i class="icon icon-empty fa fa-star-o"></i>
                        </span>
                        <span
                            data-rate-poem="3"
                            class="poem-rating-star star-3 star-set"
                        >
                            <i class="icon icon-full fa fa-star"></i>
                            <i class="icon icon-half fa fa-star-half-o"></i>
                            <i class="icon icon-empty fa fa-star-o"></i>
                        </span>
                        <span
                            data-rate-poem="4"
                            class="poem-rating-star star-4 star-set"
                        >
                            <i class="icon icon-full fa fa-star"></i>
                            <i class="icon icon-half fa fa-star-half-o"></i>
                            <i class="icon icon-empty fa fa-star-o"></i>
                        </span>
                        <span
                            data-rate-poem="5"
                            class="poem-rating-star star-5 star-set"
                        >
                            <i class="icon icon-full fa fa-star"></i>
                            <i class="icon icon-half fa fa-star-half-o"></i>
                            <i class="icon icon-empty fa fa-star-o"></i>
                        </span>
                    </span>
                </a>
            </div>
        </article>
    </div>
<?php } ?>
