<?php

class Paulus_Quotes_Widget_Holiday extends WP_Widget
{
    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname'   => 'paulus_quotes_holiday',
            'description' => 'Edycja.pl - Wspomnienie',
        );
        parent::__construct('paulus_quotes_holiday', 'Edycja.pl - Wspomnienie', $widget_ops);
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        $service = Paulus_Quotes_Widget_Service::getInstance();
        $holiday = $service->getHoliday();

        require __DIR__.'/partials/paulus-quotes-public-widget-holiday.php';
    }

    public function form($instance)
    {
        return $instance;
    }

    public function update($new_instance, $old_instance)
    {
        return $new_instance;
    }
}
