<?php

namespace Waveform;
use Symfony\Component\Process\Process;

class WaveformGenerator
{
    private $binPath;
    private $options;
    private $pngfile;
    private $audiofile;

    public function __construct($binPath)
    {
        $this->binPath = $binPath;
    }

    public function run($audiofile, $pngfile, array $options = array()) {
        $this->audiofile = $audiofile;
        $this->pngfile = $pngfile;
        $this->options = $options;
        $process = $this->getProcess();
        $process->setTimeout(3600);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }
    }

    protected function getProcess() {
        $command = sprintf('%s %s %s', $this->binPath, $this->audiofile, $this->pngfile);
        foreach($this->options as $key => $value)
        {
            $command.= sprintf('--%s %s', $key, $value);
        }
        return new Process($command);
    }
}
