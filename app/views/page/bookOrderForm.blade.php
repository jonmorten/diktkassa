<?php if (! empty($message)) { ?>
    <div class="columns small-12 small-centered medium-7 medium-centered large-5 large-centered">
        <p class="feedback"><?php echo $message ?></p>
    </div>
<?php } ?>

{{
    Form::open([
        'class' => 'columns small-12 small-centered medium-7 medium-centered large-5 large-centered',
        'route' => 'bookOrderFormSubmit',
    ])
}}

    <?php if (! empty($bookOrder)) { ?>
        {{ Form::model($bookOrder) }}
    <?php } ?>

    {{ Form::honeypot('user_name', 'user_time') }}
    @if ($errors->bookOrderForm->has('user_time'))
        <p>
            <span class="help-block">
                <i class="fa fa-exclamation-circle"></i>
                {{ $errors->bookOrderForm->first('user_time') }}
            </span>
        </p>
    @else
        <p>
            Her kan du bestille boka «Norges&nbsp;anonyme&nbsp;diktere». Den inneholder et utvalg av diktene sendt inn. Noen er beriket med illustrasjoner.
            <br>
            Boka koster 100 kroner, inkludert frakt. Giro følger med boka. Vi sender normalt innen tre virkedager etter at bestillingen er mottatt.
        </p>

        <p class="form-control">
            {{ Form::label('name', 'Navn', ['class' => 'hide']) }}
            @if ($errors->bookOrderForm->has('name'))
                <span class="help-block">
                    <i class="fa fa-exclamation-circle"></i>
                    {{ $errors->bookOrderForm->first('name') }}
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
            {{ Form::label('email', 'E-post', ['class' => 'hide']) }}
            @if ($errors->bookOrderForm->has('email'))
                <span class="help-block">
                    <i class="fa fa-exclamation-circle"></i>
                    {{ $errors->bookOrderForm->first('email') }}
                </span>
            @endif
            {{
                Form::text(
                    'email',
                    null,
                    [
                        'autocomplete' => 'off',
                        'class' => 'text-field',
                        'placeholder' => 'E-post',
                        'spellcheck' => 'false',
                    ]
                )
            }}
        </p>

        <p class="form-control">
            {{ Form::label('phone', 'Telefon', ['class' => 'hide']) }}
            @if ($errors->bookOrderForm->has('phone'))
                <span class="help-block">
                    <i class="fa fa-exclamation-circle"></i>
                    {{ $errors->bookOrderForm->first('phone') }}
                </span>
            @endif
            {{
                Form::text(
                    'phone',
                    null,
                    [
                        'autocomplete' => 'off',
                        'class' => 'text-field',
                        'placeholder' => 'Telefon',
                        'spellcheck' => 'false',
                    ]
                )
            }}
        </p>

        <p class="form-control">
            {{ Form::label('address', 'Adresse', ['class' => 'hide']) }}
            @if ($errors->bookOrderForm->has('address'))
                <span class="help-block">
                    <i class="fa fa-exclamation-circle"></i>
                    {{ $errors->bookOrderForm->first('address') }}
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
                @if ($errors->bookOrderForm->has('postal_area'))
                    <span class="help-block">
                        <i class="fa fa-exclamation-circle"></i>
                        {{ $errors->bookOrderForm->first('postal_area') }}
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
                @if ($errors->bookOrderForm->has('zip'))
                    <span class="help-block">
                        <i class="fa fa-exclamation-circle"></i>
                        {{ $errors->bookOrderForm->first('zip') }}
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
            {{ Form::label('other', 'Annet (valgfritt)', ['class' => 'hide']) }}
            {{
                Form::textarea(
                    'other',
                    null,
                    [
                        'autocomplete' => 'off',
                        'class' => 'text-field',
                        'placeholder' => 'Annet (valgfritt)',
                        'spellcheck' => 'false',
                        'rows' => 5,
                    ]
                )
            }}
        </p>

        <p class="form-control">
            {{ Form::button('Bestill', ['type' => 'submit', 'class' => 'button']) }}
        </p>
    @endif

{{ Form::close() }}
