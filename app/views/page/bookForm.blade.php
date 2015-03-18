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
    @if ($errors->poem->has('user_time'))
        <p>
            <span class="help-block">
                <i class="fa fa-exclamation-circle"></i>
                {{ $errors->poem->first('user_time') }}
            </span>
        </p>
    @else
        <div class="row">
            <p class="form-action columns small-6">
                <a href="{{ URL::route('randomPoem') }}" class="button"><i></i>Les</a>
            </p>
            <p class="form-action columns small-6">
                {{ Form::button('Bestill', ['type' => 'submit', 'class' => 'button']) }}
            </p>
        </div>

        <p class="form-control">
            {{ Form::label('name', 'Navn', ['class' => 'hide']) }}
            @if ($errors->poem->has('name'))
                <span class="help-block">
                    <i class="fa fa-exclamation-circle"></i>
                    {{ $errors->poem->first('name') }}
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
    @endif

{{ Form::close() }}
