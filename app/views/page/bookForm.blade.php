<?php if ($message) { ?>
    <div class="columns small-12 small-centered medium-7 medium-centered large-5 large-centered">
        <p class="feedback"><?php echo $message ?></p>
    </div>
<?php } ?>

{{
    Form::open([
        'class' => 'columns small-12 small-centered medium-7 medium-centered large-5 large-centered',
        'route' => 'bookFormSubmit',
    ])
}}

    {{ Form::honeypot('user_name', 'user_time') }}
    @if ($errors->bookForm->has('user_time'))
        <p>
            <span class="help-block">
                <i class="fa fa-exclamation-circle"></i>
                {{ $errors->bookForm->first('user_time') }}
            </span>
        </p>
    @else
        <p class="form-control">
            Lorem ipsum please don't sue dolor sit amet.
        </p>

        <p class="form-control">
            {{ Form::label('name', 'Navn', ['class' => 'hide']) }}
            @if ($errors->bookForm->has('name'))
                <span class="help-block">
                    <i class="fa fa-exclamation-circle"></i>
                    {{ $errors->bookForm->first('name') }}
                </span>
            @endif
            {{
                Form::text(
                    'name',
                    null,
                    [
                        'autocomplete' => 'off',
                        'class' => 'text-field',
                        'placeholder' => 'Navn',
                        'spellcheck' => 'false',
                    ]
                )
            }}
        </p>

        <p class="form-control">
            {{ Form::label('address', 'Adresse', ['class' => 'hide']) }}
            @if ($errors->bookForm->has('address'))
                <span class="help-block">
                    <i class="fa fa-exclamation-circle"></i>
                    {{ $errors->bookForm->first('address') }}
                </span>
            @endif
            {{
                Form::text(
                    'address',
                    null,
                    [
                        'autocomplete' => 'off',
                        'class' => 'text-field',
                        'placeholder' => 'Adresse',
                        'spellcheck' => 'false',
                    ]
                )
            }}
        </p>

        <p class="row form-control">
            <span class="columns small-6">
                {{ Form::label('postal_area', 'Poststed', ['class' => 'hide']) }}
                @if ($errors->bookForm->has('postal_area'))
                    <span class="help-block">
                        <i class="fa fa-exclamation-circle"></i>
                        {{ $errors->bookForm->first('postal_area') }}
                    </span>
                @endif
                {{
                    Form::text(
                        'postal_area',
                        null,
                        [
                            'autocomplete' => 'off',
                            'class' => 'text-field',
                            'placeholder' => 'Poststed',
                            'spellcheck' => 'false',
                        ]
                    )
                }}
            </span>

            <span class="columns small-6">
                {{ Form::label('zip', 'Postnummer', ['class' => 'hide']) }}
                @if ($errors->bookForm->has('zip'))
                    <span class="help-block">
                        <i class="fa fa-exclamation-circle"></i>
                        {{ $errors->bookForm->first('zip') }}
                    </span>
                @endif
                {{
                    Form::text(
                        'zip',
                        null,
                        [
                            'autocomplete' => 'off',
                            'class' => 'text-field',
                            'placeholder' => 'Postnummer',
                            'spellcheck' => 'false',
                        ]
                    )
                }}
            </span>
        </p>

        <p class="form-control">
            {{ Form::button('Bestill', ['type' => 'submit', 'class' => 'button']) }}
        </p>
    @endif

{{ Form::close() }}
