<?php


namespace App\Entity;


use App\CustomInterfaces\TtsApi;
use App\CustomInterfaces\TtsAudioFetcher;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class IbmWatsonTtsAudioFetcher implements TtsAudioFetcher
{
    private $filename='';

    /**
     * @param TtsApi $ttsApi
     * @param array $options
     * @throws TransportExceptionInterface
     */
    public function fetchAudio(TtsApi $ttsApi, array $options = [])
    {
        // TODO: Implement fetchAudio() method. uses setFilename to set path to uploaded file

        if(!isset($options['selectedVoice']) || empty($options['selectedVoice'])){
            throw new \LogicException('Missing or Empty option \'selectedVoice\' parameter.');
        }
        if(!isset($options['text']) || empty($options['text'])){
            throw new \LogicException('Missing or Empty option \'text\' parameter.');
        }
        if(!isset($options['projectDir']) || empty($options['projectDir'])){
            throw new \LogicException('Missing or Empty option \'projectDir\' parameter.');
        }
        $apiKey=$ttsApi->getApiKey();
        $synthUrl=$ttsApi->getSynthUrl().'?accept=audio/ogg;codecs=opus&download=true&text=';
        $selectedVoice=$options['selectedVoice'];
        $text=$options['text'];
        $synthUrl.=$text.'&voice='.$selectedVoice;

        $client=HttpClient::create();
        try {
            $response = $client->request('GET', $synthUrl, [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode('apikey:' . $apiKey),
                ],
            ]);
            if (200 !== $response->getStatusCode()) {
                $response = $client->request('GET', $synthUrl, [
                    'headers' => [
                        'Authorization' => 'Basic ' . base64_encode('apikey:' . $apiKey),
                    ],
                ]);

                if (200 !== $response->getStatusCode()) {
                    throw new HttpException($response->getStatusCode(), 'Site Not Answering as Expected. - Http Error: ' . $response->getStatusCode());
                }
            }
        } catch (TransportExceptionInterface $e) {
            throw new TransportException("Http Request Error", $e->getCode());
        }

        $projectDir=$options['projectDir'];
        $file = '/lib/audio/'.md5(uniqid()).'.ogg';
        $fileHandler = fopen($projectDir.$file, 'w+');
        foreach ($client->stream($response) as $chunk) {
            fwrite($fileHandler, $chunk->getContent());
        }

        $this->setFilename($file);

    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     * @return IbmWatsonTtsAudioFetcher
     */
    public function setFilename(string $filename): self
    {
        $this->filename = $filename;
        return $this;
    }
}