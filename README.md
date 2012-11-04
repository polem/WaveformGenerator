Waveform Generator
==================

Just a simple wrapper for "[waveform](/superjoe30/waveform)" c script written by "[Andrew Kelley](/superjoe30)"

Installation
------------

### Using Composer

``` json
{
    "require" : {
        "polem/waveform" : "*"
    }
}
```

```
php composer.phar install
```

Running tests
-------------

```
TODO
```

Usage
-----

```php
<?php

include __DIR__ . '/vendor/autoload.php';

use Waveform\WaveformGenerator;

// instanciation with the waveform binary path
$waveformGenerator = new WaveformGenerator(__DIR__ . '/bin/waveform');

// configuration
$waveformGenerator
    ->setWidth(720)
    ->setHeight(120)                                                                                              
    ->setColorBg('FFFFFF', 1)
    ->setColorCenter('FFCC00', 1)
    ->setColorOuter('FFCC00', 1)
    ;   

// generation
$waveformGenerator->run('medias/audiofile.mp3', 'waveform.png');
```
