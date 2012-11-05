<?php

namespace Waveform;
use Symfony\Component\Process\Process;

/**
 * WaveformGenerator
 *
 * @author Paul-Emile MINY <paulemile.miny@gmail.com>
 */
class WaveformGenerator
{
    private $binPath;
    private $options;
    private $pngfile;
    private $audiofile;

    /**
     * __construct
     *
     * @param  string            $binPath
     * @return WaveformGenerator
     */
    public function __construct($binPath)
    {
        $this->binPath = $binPath;
    }

    /**
     * run
     *
     * @param  string $audiofile
     * @param  string $pngfile
     * @return void
     */
    public function run($audiofile, $pngfile)
    {
        $this->audiofile = $audiofile;
        $this->pngfile = $pngfile;
        $process = $this->getProcess();
        $process->setTimeout(3600);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }
    }

    /**
     * setOption
     *
     * @param  string            $key
     * @param  string            $value
     * @return WaveformGenerator
     */
    protected function setOption($key, $value)
    {
        $this->options[$key] = $value;

        return $this;
    }

    /**
     * setWidth
     *
     * @param  int               $width
     * @return WaveformGenerator
     */
    public function setWidth($width)
    {
        $this->setOption('width', $width);

        return $this;
    }

    /**
     * setHeight
     *
     * @param  mixed             $height
     * @return WaveformGenerator
     */
    public function setHeight($height)
    {
        $this->setOption('height', $height);

        return $this;
    }

    /**
     * setColorBg
     *
     * @param  string            $color
     * @param  int               $alpha
     * @return WaveformGenerator
     */
    public function setColorBg($color, $alpha = 1)
    {
        $this->setOption('color-bg', $color . self::convertAlphaToHex($alpha));

        return $this;
    }

    /**
     * setColorCenter
     *
     * @param  string            $color
     * @param  int               $alpha
     * @return WaveformGenerator
     */
    public function setColorCenter($color, $alpha = 1)
    {
        $this->setOption('color-center', $color . self::convertAlphaToHex($alpha));

        return $this;
    }

    /**
     * setColorOuter
     *
     * @param  string            $color
     * @param  int               $alpha
     * @return WaveformGenerator
     */
    public function setColorOuter($color, $alpha = 1)
    {
        $this->setOption('color-outer', $color . self::convertAlphaToHex($alpha));

        return $this;
    }

    /**
     * convertAlphaToHex
     *
     * @param  int    $alpha
     * @return string
     */
    public static function convertAlphaToHex($alpha)
    {
        return sprintf("%02X", round($alpha * 255));
    }

    /**
     * getProcess
     *
     * @return Process
     */
    protected function getProcess()
    {
        $command = sprintf('%s "%s" "%s"', $this->binPath, $this->audiofile, $this->pngfile);
        foreach ($this->options as $key => $value) {
            $command.= sprintf(' --%s %s', $key, $value);
        }

        return new Process($command);
    }
}
