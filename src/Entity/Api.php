<?php
namespace App\Entity;


abstract class Api{
    protected $apiKey='';
    protected $credentials=[];
    protected $baseUrl='';

    public function setApiKey(String $apiKey) : self
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    public function getApiKey() : String
    {
        return $this->apiKey;
    }

    public function setCredentials(String $username, String$password) : self
    {
        $this->credentials['username'] = $username;
        $this->credentials['password'] = $password;
        return $this;
    }

    public function getCredentials(){
        return $this->credentials;
    }

    public function setBaseUrl( String $baseUrl) : self
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    public function getBaseUrl() : String
    {
        return $this->baseUrl;
    }

}