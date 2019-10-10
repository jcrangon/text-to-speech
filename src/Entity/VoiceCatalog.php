<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpClient\HttpClient;
/**
 * @ORM\Entity(repositoryClass="App\Repository\VoiceCatalogRepository")
 */
class VoiceCatalog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $voiceList = [];

    public function __construct()
    {
        $apiKey=$_SERVER["API_KEY"];
        $voiceUrl=$_SERVER["API_VOICE_URL"];
        $client=HttpClient::create();
        $response=$client->request('GET', $voiceUrl, [
            'headers' => [
                'Authorization' => 'Basic '.base64_encode('apikey:'.$apiKey),
            ],
        ]);
        $phpResponse=$response->toArray();
        asort($phpResponse['voices']);
        $rawVoiceList=$phpResponse['voices'];
        $voiceList=[];
        foreach($rawVoiceList as $entry){
            $splitVoice=explode('_',$entry['name']);
            $optionVal=$entry['name'];
            $optionText=$splitVoice[1].' - Lang: '.$splitVoice[0].' - Gender: '.$entry['gender'];
            $voiceList[$optionText]=$optionVal;
        }
        $this->setVoiceList($voiceList);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoiceList(): ?array
    {
        return $this->voiceList;
    }

    public function setVoiceList(?array $voiceList): self
    {
        $this->voiceList = $voiceList;

        return $this;
    }
}
