<?php

namespace App\Entity;

use App\CustomInterfaces\TtsApi;
use App\CustomInterfaces\TtsVoiceCatalog;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\Exception\RedirectionException;
use Symfony\Component\HttpClient\Exception\ServerException;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IbmWatsonTtsVoiceCatalogRepository")
 */
class IbmWatsonTtsVoiceCatalog implements TtsVoiceCatalog
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoiceList(): array
    {
        return $this->voiceList;
    }

    public function setVoiceList(TtsApi $ttsApi, array $voiceList=[]): self
    {
        if(empty($voiceList)){
            $this->voiceList = $this->requestWatsonApi($ttsApi);
        }
        else{
            $this->voiceList = $voiceList;
        }
        return $this;
    }

    public function requestWatsonApi(TtsApi $ttsApi) : array
    {
        $apiKey=$ttsApi->getApiKey();
        $voiceUrl=$ttsApi->getVoiceUrl();
        $client=HttpClient::create();

        try {
            $response = $client->request('GET', $voiceUrl, [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode('apikey:' . $apiKey),
                ],
            ]);
            if (200 !== $response->getStatusCode()) {
                $response = $client->request('GET', $voiceUrl, [
                    'headers' => [
                        'Authorization' => 'Basic ' . base64_encode('apikey:' . $apiKey),
                    ],
                ]);

                if (200 !== $response->getStatusCode()) {
                    throw new HttpException($response->getStatusCode(), 'Site Not Answering as Expected. - Http Error: ' . $response->getStatusCode());
                }
            }
        } catch (TransportExceptionInterface $e) {
            throw new TransportException($e->getCode());
        }

        try {
            $phpResponse = $response->toArray();
        } catch (ClientExceptionInterface $e) {
            throw new ClientException($e->getResponse());
        } catch (DecodingExceptionInterface $e) {
            throw new HttpException($e->getCode());
        } catch (RedirectionExceptionInterface $e) {
            throw new RedirectionException($e->getResponse());
        } catch (ServerExceptionInterface $e) {
            throw new ServerException($e->getResponse());
        } catch (TransportExceptionInterface $e) {
            throw new TransportException($e->getCode());
        }

        asort($phpResponse['voices']);
        return $this->formatVoiceList($phpResponse['voices']);

    }

    public function formatVoiceList(array $voiceList): array
    {
        $result=[];
        foreach($voiceList as $entry){
            $splitVoice=explode('_',$entry['name']);
            $optionVal=$entry['name'];
            $optionText=$splitVoice[1].' - Lang: '.$splitVoice[0].' - Gender: '.$entry['gender'];
            $result[$optionText]=$optionVal;
        }
        return $result;
    }
}
