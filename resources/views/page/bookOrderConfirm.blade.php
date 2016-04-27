<?php if (! empty($message)) { ?>
    <div class="columns small-12 small-centered medium-7 medium-centered large-5 large-centered">
        <p class="feedback"><?php echo $message ?></p>
    </div>
<?php } ?>

<?php if (! empty($bookOrder)) { ?>
    {!!
        Form::open([
            'class' => 'columns small-12 small-centered medium-7 medium-centered large-5 large-centered',
            'route' => 'bookOrderConfirmSubmit',
            'method' => 'post',
        ])
    !!}
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}">

        <p>
            <strong>Din bestilling</strong>
            <br>
            <?php foreach ([
                'name' => 'Navn',
                'email' => 'E-post',
                'phone' => 'Telefon',
                'address' => 'Adresse',
                'postal_area' => 'Poststed',
                'zip' => 'Postnummer',
            ] as $key => $label) { ?>
                {!! $label !!}: {!! $bookOrder[$key] !!}<br>
            <?php } ?>
            <?php if (! empty($bookOrder['other'])) { ?>
                Melding:
                <br>
                {!! $bookOrder['other'] !!}
            <?php } ?>
        </p>

        <p class="form-control row">
            <span class="column small-6 small-push-6">
                {!! Form::button(
                    'Fullfør',
                    [
                        'class' => 'button',
                        'name' => 'action',
                        'type' => 'submit',
                        'value' => 'confirm',
                    ]
                ) !!}
            </span>

            <span class="column small-6 small-pull-6">
                {!! Form::button(
                    'Avbryt',
                    [
                        'class' => 'button',
                        'name' => 'action',
                        'type' => 'submit',
                        'value' => 'cancel',
                    ]
                ) !!}
            </span>
        </p>

    {!! Form::close() !!}
<?php } ?>
