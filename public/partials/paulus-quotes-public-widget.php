<!-- CSS written with SUIT convention -->
<div class="EdycjaPlWidget">
    <?php if ($instance['showHoliday'] && isset($data['holiday']) && ! empty($data['holiday'])): ?>
        <p class="EdycjaPlWidget-holiday"><?= $data['holiday']; ?></p>
    <?php endif; ?>

    <?php if ($instance['showThinkOfTheDay'] && isset($data['think_of_the_day']) && ! empty($data['think_of_the_day'])): ?>
        <div class="EdycjaPlWidget-thinkOfTheDay">
            <blockquote><?= $data['think_of_the_day']; ?></blockquote>

            <?php if ($instance['showThinkOfTheDayAuthor'] && isset($data['think_of_the_day_author']) && ! empty($data['think_of_the_day_author'])): ?>
                <cite><?= $data['think_of_the_day_author']; ?></cite>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($instance['showReading'] && isset($data['reading']) && ! empty($data['reading'])): ?>
        <p class="EdycjaPlWidget-reading">
            <a href="http://mateusz.pl/czytania/<?= $now->format('Y') ?>/<?= $now->format('Ymd') ?>.html"
               target="_blank">
                <?= $data['reading']; ?>
            </a>
        </p>
    <?php endif; ?>

    <?php if ($instance['showNameday'] && isset($data['nameday']) && ! empty($data['nameday'])): ?>
        <p class="EdycjaPlWidget-nameday"><?= $data['nameday']; ?></p>
    <?php endif; ?>
</div>