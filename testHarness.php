<?php 
// testHarness.php
// 
// Tests things as we build

include_once("nmea-sentence.php"); 

$sentence1 = '$GPGSV,3,3,12,14,00,000,-0,08,00,000,-0,09,00,000,-0,15,00,000,-0*7A'; 

$mySentence = new nmeaSentence($sentence1); 

$mySentence->printSent(); 

