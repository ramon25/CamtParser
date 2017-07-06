<?php

namespace Ongoing\CamtParser;


include __DIR__.'/vendor/autoload.php';

/**
 * @author: Ramon Rainer <ramon.rainer@ongoing.ch>
 *
 * Date: 06.07.17
 */

$parser = new CamtParser('testfile.xml');

$result = $parser->parse();

var_dump($result);