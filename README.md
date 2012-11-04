Waveform Generator
==================

Just a simple wraper for "[waveform](superjoe30/waveform)" c script written by Andrew Kelley

Installation
------------

php composer.phar install

Usage
-----

```php
<?php

include __DIR__ . '/vendor/autoload.php';

use Waveform\WaveformGenerator;

$waveformGenerator = new WaveformGenerator(__DIR__ . '/bin/waveform');

$waveformGenerator->run('medias/audiofile.mp3', 'generated/waveform.png');
```
