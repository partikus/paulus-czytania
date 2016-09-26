<div class="wrap">

    <h2><?= __('Edycja.pl Cytaty - Ustawienia') ?></h2>
    <?php settings_errors(); ?>
    <form method="post" action="options.php">
        <?php

        settings_fields('paulus_quotes_options');
        do_settings_sections('paulus_quotes_options');

        submit_button();
        ?>
    </form>
    <h3><?= __('Edycja.pl Cytaty - Wymagania') ?></h3>
    <p>
        <?= __('API musi zwracać JSON z następującą strukturą.') ?>
        <b><?= __('Tylko pole "holiday" jest opcjonalne.') ?></b>
    </p>
    <pre>
{
    "holiday": "Podwy\u017cszenie Krzy\u017ca \u015awi\u0119tego, <i>\u015bwi\u0119to<\/i>",
    "think_of_the_day": "Te rzeczy s\u0105 dla nas najdro\u017csze, kt\u00f3re najwi\u0119cej kosztowa\u0142y.",
    "think_of_the_day_author": "Michel de Montaigne ",
    "reading": "Lb 21, 4b-9 | Ps 78 | Flp 2, 6-11 | J 3, 13-17",
    "nameday": "Bernarda, Cypriana"
}
    </pre>
    <h4>Wszystkie wyniki są cachowane, a API jest odpytywane tylko 1 dziennie.</h4>
</div>