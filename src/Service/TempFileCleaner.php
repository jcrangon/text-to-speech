<?php
namespace App\Service;


use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Finder\Finder;

class TempFileCleaner
{
    private $projectDir;
    private $params;

    public function __construct(ContainerBagInterface $paramBag)
    {
        $this->setParams($paramBag);
        $this->setProjectDir(str_replace('\\','/',$this->getParams()->get('app.project_dir')));
        $this->cleanUp();
    }

    /**
     * @param string $projectDir
     * @return TempFileCleaner
     */
    public function setProjectDir(string $projectDir): self
    {
        $this->projectDir = $projectDir;
        return $this;
    }

    /**
     * @return String
     */
    public function getProjectDir(): string
    {
        return $this->projectDir;
    }

    /**
     * @return void
     */
    public function cleanUp(): void
    {
        $finder = new Finder();
        $finder->files()->in($this->getProjectDir().'/public/lib/audio');
        if($finder->hasResults()){
            foreach($finder as $file){
                if($file->isFile() && (time() - $file->getMTime() > 600)){
                    unlink($file);
                }
            }
        }
    }

    /**
     * @param mixed $params
     * @return TempFileCleaner
     */
    public function setParams($params): self
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }
}