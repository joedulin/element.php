#! /usr/bin/env php
<?php

include('element.php');
$html = '<body><div class="something" style="float: left; margin-top: 2em;"><p style="margin-top: 3em; margin-bottom: 2em;">Blarg!<br>More text</p></div><hr><div class="anotherdiv"><button>Click</button><br><p>Wonka</p></div></body>';
$x = Element::load($html);
echo $x;
