<?php
namespace App\Entity;


use Symfony\Component\Finder\Finder;

class TempFileCleaner
{
    private $projectDir;

    public function __construct()
    {
        $this->setProjectDir($_SERVER['PROJECT_DIR']);
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
     *
     */
    public function getProjectDir()
    {
        return $this->projectDir;
    }

    /**
     * @return void
     */
    public function cleanUp(): void
    {
        $finder = new Finder();
        $finder->files()->in($this->getProjectDir().'/lib/audio');
        if($finder->hasResults()){
            foreach($finder as $file){
                if($file->isFile() && (time() - $file->getMTime() > 600)){
                    unlink($file);
                }
            }
        }
    }
}