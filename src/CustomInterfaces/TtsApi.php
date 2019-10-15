<?php
namespace App\CustomInterfaces;

interface TtsApi{
    public function setApiType(String $apiType);
    public function getApiType();
    public function setApiName(String $apiName);
    public function getApiName();
    public function setApiKey(String $apiKey);
    public function getApiKey();
    public function setVoiceUrl(String $voiceUrl);
    public function getVoiceUrl();
    public function setSynthUrl(String $synthUrl);
    public function getSynthUrl();
}