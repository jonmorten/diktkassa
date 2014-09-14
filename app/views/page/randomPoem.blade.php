<?php if ($poem) { ?>
    <div class="columns small-12 small-centered medium-7 medium-centered large-5 large-centered">
        <div class="row">
            <p class="form-action columns small-6">
                <a class="button" href="{{ URL::route('randomPoem') }}">Les et til</a>
            </p>
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
