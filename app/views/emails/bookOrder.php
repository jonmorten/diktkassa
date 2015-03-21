<?php

foreach ([
	'time' => 'Tid',
	'name' => 'Navn',
	'email' => 'E-post',
	'phone' => 'Telefon',
	'address' => 'Adresse',
	'postal_area' => 'Poststed',
	'zip' => 'Postnummer',
] as $variable => $label) {
	echo sprintf('%s: %s<br>', $label, $$variable);
}

if (! empty($other)) {
	echo 'Annet:<br>' . $other . '<br>';
}
