```php
<?php

include __DIR__ . '/vendor/autoload.php';

use Waveform\WaveformGenerator;

$waveformGenerator = new WaveformGenerator(__DIR__ . '/bin/waveform');

$waveformGenerator->run('medias/audiofile.mp3', 'generated/waveform.png');
```
