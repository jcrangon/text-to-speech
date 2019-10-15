<?php
namespace App\CustomInterfaces;


interface TtsVoiceCatalog
{
    public function setVoiceList( TtsApi $ttsApi, array $voiceList=[]);
    public function getVoiceList();
}