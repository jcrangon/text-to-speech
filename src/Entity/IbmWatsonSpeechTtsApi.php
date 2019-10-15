<?php
namespace App\Entity;

use App\CustomInterfaces\TtsApi;

/**
 * Heritage:
 *
 * Parent: 'App\Entity\Api' abstract class
 * Parent Param: String apiKey
 * Parent Param: Array Credentials
 * Parent Param: String BaseUrl
 *
 * Parent method: setApiKey(String apikey) Returns: Api obj
 * Parent method: getApiKey() Returns: String
 * Parent method: setCredentials(String username, String password) Returns: Api Obj
 * parent method: getCredentials() Returns: Assoc Array
 * Parent method: setBaseUrl(String baseurl) Return: Api obj
 * parent method: getBaseurl() Returns String baseUrl
 *
 * Interfaces
 *
 * Etude\POO\api\interfaces\TtsApi
 *    method: setApiName(String $apiName)
 *    method: getApiName()
 *    method: setApiType(String $apiType)
 *    method getApiType()
 *
 * class Etude\POO\api\IbmWatsonSpeechTtsApi
 *    extends: Etude\POO\api\Api
 *    Implements: Etude\POO\api\interfaces\TtsApi
 *
 * Params:
 * param: String $apiType
 * param: String $apiName
 * param: String $voiceUrl
 * param: String $synthUrl
 *
 * methods:
 * Interface (Etude\POO\api\interfaces\TtsApi) methods implementation -> 4 :
 *    method: setApiName(String $apiName) Returns Self
 *    method: getApiName()
 *    method: setApiType(String $apiType) Returns Self
 *    method getApiType()
 * native:
 *    method: setVoiceUrl(String $voiceUrl) Returns Self
 *    method: getVoiceUrl()
 *    method: setSynthUrl(String $synthUrl) Returns Self
 *    method: getSynthUrl()
 *    method: autoConf(String $source) Returns Self
 *    method: __toString() Returns String with API's Name and Type
 */
final class IbmWatsonSpeechTtsApi extends Api implements TtsApi
{
    private $apiType='';
    private $apiName='';
    private $voiceUrl='';
    private $synthUrl='';

    public function __construct(){
        $this->setApiName('IBM Watson Speech TTS API');
        $this->setApiType('TTS_API');
    }

    /**
     * @param String $apiType
     * @return IbmWatsonSpeechTtsApi
     */
    public function setApiType(String $apiType) : self
    {
        $this->apiType = $apiType;
        return $this;
    }

    /**
     * @Param: NONE
     * @Return: String
     *
     * */
    public function getApiType() : String
    {
        return $this->apiType;
    }

    /**
     * @param String $apiName
     * @return IbmWatsonSpeechTtsApi
     */
    public function setApiName(String $apiName) : self
    {
        $this->apiName = $apiName;
        return $this;
    }

    /**
     * @Param: NONE
     * @Return: String
     *
     * */
    public function getApiName() : String
    {
        return $this->apiName;
    }

    /**
     * @param String $voiceUrl
     * @return IbmWatsonSpeechTtsApi
     */
    public function setVoiceUrl(String $voiceUrl) : self
    {
        $this->voiceUrl = $voiceUrl;
        return $this;
    }

    /**
     * @Param: NONE
     * @Return: String
     *
     * */
    public function getVoiceUrl() : String
    {
        return $this->voiceUrl;
    }

    /**
     * @param String $synthUrl
     * @return IbmWatsonSpeechTtsApi
     */
    public function setSynthUrl(String $synthUrl) : self
    {
        $this->synthUrl = $synthUrl;
        return $this;
    }

    /**
     * @Param: NONE
     * @Return: String
     *
     * */
    public function getSynthUrl() : String
    {
        return $this->synthUrl;
    }

    /**
     * @param String $source
     * @return IbmWatsonSpeechTtsApi
     */
    public function autoConf(String $source) : self
    {
        if($source==='env'){
            if(isset($_SERVER['WATSON_TTS_API_KEY']) && !empty($_SERVER['WATSON_TTS_API_KEY'])){
                $this->setApiKey($_SERVER['WATSON_TTS_API_KEY']);
            }

            if(isset($_SERVER['WATSON_TTS_USERNAME']) && !empty($_SERVER['WATSON_TTS_USERNAME'])){
                if(isset($_SERVER['WATSON_TTS_PWD']) && !empty($_SERVER['WATSON_TTS_PWD'])){
                    $this->setCredentials($_SERVER['WATSON_TTS_USERNAME'],$_SERVER['WATSON_TTS_PWD']);
                }

            }

            if(isset($_SERVER['WATSON_TTS_BASE_URL']) && !empty($_SERVER['WATSON_TTS_BASE_URL'])){
                $this->setBaseUrl($_SERVER['WATSON_TTS_BASE_URL']);
            }

            if(isset($_SERVER['WATSON_TTS_VOICE_URL']) && !empty($_SERVER['WATSON_TTS_VOICE_URL'])){
                $this->setVoiceUrl($_SERVER['WATSON_TTS_VOICE_URL']);
            }

            if(isset($_SERVER['WATSON_TTS_SYNTH_URL']) && !empty($_SERVER['WATSON_TTS_SYNTH_URL'])){
                $this->setSynthUrl($_SERVER['WATSON_TTS_SYNTH_URL']);
            }
        }
        return $this;
    }

    /**
     * @Param: NONE
     * @Return: String
     *
     * */
    public function __toString() : String
    {
        return 'API Name: ['.$this->apiName.'] API Type:['.$this->apiType.']';
    }
}