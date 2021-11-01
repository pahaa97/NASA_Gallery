<?php

class NASA
{
    public $last_post;

    public function __construct()
    {
        $this->last_post = $this->last_post();
    }

    public function get_from_nasa($start_date = null, $end_date = null)
    {
        $api_nasa = 'Sn73nVcQNO6aiKZs4OJKZDQnCh4rCx1zSTr1mDDF';
        $url = 'https://api.nasa.gov/planetary/apod?';

        $get_request = $url . '&start_date=' . $start_date . '&end_date=' . $end_date . '&api_key=' . $api_nasa;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $get_request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);

        return $result;
    }

    public function last_post()
    {
        return $this->get_from_nasa();
    }

    public function get_last_five_post()
    {
        $end_date = $this->last_post->date;
        $start_date = date("Y-m-d", strtotime($end_date.'- 4 days'));

        return $this->get_from_nasa($start_date, $end_date);
    }
}