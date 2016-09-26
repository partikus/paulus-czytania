<?php

class Paulus_Quotes_Widget extends WP_Widget
{
    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname'   => 'paulus_quotes',
            'description' => 'Edycja.pl - cytaty',
        );
        parent::__construct('paulus_quotes', 'Edycja.pl - cytaty', $widget_ops);
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        $option = get_option('paulus_quotes_options');
        $now = new \DateTime();
        global $wpdb;
        $entry = $wpdb->get_row(
            $wpdb->prepare('SELECT * FROM `wp_paulus_quotes` WHERE publishedAt = %s LIMIT 1', [$now->format('Y-m-d')]),
            ARRAY_A
        );

        if ($entry) {
            $content = $entry['json'];
        } else {
            $response = wp_remote_get($option['api_url']);
            $content = $response['body'];
            $wpdb->insert('wp_paulus_quotes', [
                'publishedAt' => $now->format('Y-m-d'),
                'json' => $content,
            ]);
        }

        $data = json_decode($content, true);
        require __DIR__.'/partials/paulus-quotes-public-widget.php';
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form($instance)
    {
        $showHoliday = ! empty( $instance['showHoliday'] ) ? 1 : 0;
        $showThinkOfTheDay = ! empty( $instance['showThinkOfTheDay'] ) ? 1 : 0;
        $showThinkOfTheDayAuthor = ! empty( $instance['showThinkOfTheDayAuthor'] ) ? 1 : 0;
        $showReading = ! empty( $instance['showReading'] ) ? 1 : 0;
        $showNameday = ! empty( $instance['showNameday'] ) ? 1 : 0;

        ?>
        <p>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('showHoliday')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('showHoliday')); ?>"
                   type="checkbox"
                <?php echo ($showHoliday) ? 'checked="checked"' : '' ?>">
            <label for="<?php echo esc_attr($this->get_field_id('showHoliday')); ?>"><?php _e(
                    esc_attr('Pokaż wspomnienie')
                ); ?></label>
        </p>
        <p>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('showThinkOfTheDay')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('showThinkOfTheDay')); ?>"
                   type="checkbox"
            <?php echo ($showThinkOfTheDay) ? 'checked="checked"' : '' ?>">
            <label for="<?php echo esc_attr($this->get_field_id('showThinkOfTheDay')); ?>"><?php _e(
                    esc_attr('Pokaż cytat')
                ); ?></label>
        </p>
        <p>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('showThinkOfTheDayAuthor')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('showThinkOfTheDayAuthor')); ?>"
                   type="checkbox"
            <?php echo ($showThinkOfTheDayAuthor) ? 'checked="checked"' : '' ?>">
            <label for="<?php echo esc_attr($this->get_field_id('showThinkOfTheDayAuthor')); ?>"><?php _e(
                    esc_attr('Pokaż autora')
                ); ?></label>
        </p>
        <p>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('showReading')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('showReading')); ?>"
                   type="checkbox"
                   <?php echo ($showReading) ? 'checked="checked"' : '' ?>">
            <label for="<?php echo esc_attr($this->get_field_id('showReading')); ?>"><?php _e(
                    esc_attr('Pokaż sigla')
                ); ?></label>
        </p>
        <p>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('showNameday')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('showNameday')); ?>"
                   type="checkbox"
            <?php echo ($showNameday) ? 'checked="checked"' : '' ?>">
            <label for="<?php echo esc_attr($this->get_field_id('showNameday')); ?>"><?php _e(
                    esc_attr('Pokaż imieniny')
                ); ?></label>
        </p>
        <?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update($new_instance, $old_instance)
    {
        $keys = array('showHoliday', 'showThinkOfTheDay', 'showThinkOfTheDayAuthor', 'showReading', 'showNameday');
        $instance = array();
        foreach ($keys as $key) {
            if (!isset($new_instance[$key])) {
                $instance[$key] = 0;
            }

            $value = $new_instance[$key];
            $instance[$key] = ($value === 'on') ? 1 : 0;
        }

        return $instance;
    }
}
