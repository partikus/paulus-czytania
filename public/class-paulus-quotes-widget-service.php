<?php

class Paulus_Quotes_Widget_Service
{
    /**
     * @var wpdb
     */
    private $wpdb;
    private static $instance;

    private function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getAll()
    {
        return $this->getTodayResultDecoded();
    }

    public function getHoliday()
    {
        $result = $this->getTodayResultDecoded();

        return (isset($result['holiday'])) ? $result['holiday'] : null;
    }

    public function getReading()
    {
        $result = $this->getTodayResultDecoded();

        return (isset($result['reading'])) ? $result['reading'] : null;
    }

    public function getThinkOfTheDay()
    {
        $result = $this->getTodayResultDecoded();

        return (isset($result['think_of_the_day'])) ? $result['think_of_the_day'] : null;
    }

    public function getThinkOfTheDayAuthor()
    {
        $result = $this->getTodayResultDecoded();

        return (isset($result['think_of_the_day_author'])) ? $result['think_of_the_day_author'] : null;
    }

    public function getNameday()
    {
        $result = $this->getTodayResultDecoded();

        return (isset($result['nameday'])) ? $result['nameday'] : null;
    }

    private function getTodayResultDecoded()
    {
        $result = $this->getTodayResult();

        return json_decode($result['json']);
    }

    /**
     * @return array|null
     */
    private function getTodayResult()
    {
        $todayResult = $this->wpdb->get_row(
            $this->wpdb->prepare('SELECT * FROM `wp_paulus_quotes` WHERE publishedAt = %s LIMIT 1', [$now->format('Y-m-d')]),
            ARRAY_A
        );

        if (empty($todayResult)) {
            $todayResult = $this->fetchDataFromApi();
        }

        return $todayResult;
    }

    private function fetchDataFromApi()
    {
        $option = get_option('paulus_quotes_options');
        $today = new \DateTime();
        $response = wp_remote_get($option['api_url']);
        $content = $response['body'];
        $this->wpdb->insert('wp_paulus_quotes', [
            'publishedAt' => $today->format('Y-m-d'),
            'json' => $content,
        ]);

        return [
            'publishedAt' => $today->format('Y-m-d'),
            'json' => $content,
        ];
    }
}
