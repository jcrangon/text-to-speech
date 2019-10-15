<?php


namespace App\CustomInterfaces;


interface TtsAudioFetcher
{
    public function fetchAudio(TtsApi $ttsApi, array $options=[]);
}