<?php 
// nmea-sentence.php
//
// Houses the nmea-sentence class 

	$arrTalker = array(
		"GP", 
		);  

	$arrMessageType = array(
		"BOD", 
		"BWC", 
		"GLL", 
		"GSA", 
		"GSV", 
		"ZDA"
	);  


class nmeaSentence { 

	public $sentence; 
	public $messageType; 
	public $talker; 
	
	function __construct($sentence) { 

		global $arrTalker; 
		global $arrMessageType; 

		print "$sentence \n"; 
		$this->sentence = strtoupper($sentence); 

		if ( substr($sentence, 0, 1) != '$' ) { 
			print "Error: not an NMEA sentence\n"; 
			return -1; 
		} 

		$talker = substr($sentence, 1, 2); 
		if ( ! in_array( $talker, $arrTalker) ) { 
			print "Error: unknown talker\n"; 
			return -1; 
		} else { 
			$this->talker = $talker; 
		}

		$messageType = substr($sentence, 3, 3); 
		if ( ! in_array( $messageType , $arrMessageType) ) { 
			print "Error: unknown message type\n"; 
			return -1; 
		} else { 
			$this->messageType = $messageType; 
		}

		return; 
	} // end constructor

	function parseSentence() { 
		switch($this->talker) { 
			case "GP":
				switch($this->messageType) { 
					// information on the message types is taken from this url: 
					// http://aprs.gids.nl/nmea/
					case "BOD": 
						// Bearing Origin to Destination
						// Fields are: 
						// 	$GPBOD
						//		bearing X degrees True from Start to Destination
						// 	bearing Y degrees Magnetic from Start to Destination
						//		Destination Waypoint ID
						//		Origin Waypoint ID
						break; 
					case "BWC": 
						// Bearing and distance to Waypoint, Great Circle
						//	Fields are: 
						// 	$GPBWC
						//		UTC Time of fix in format HHMMSS
						//		Latitude of waypoint
						//		Longitude of waypoint
						//		Bearing to waypoint, degrees true
						//		Bearing to waypoint, degrees magnetic
						//		Distance to waypoint, nautical miles
						//		Waypoint ID
						break; 
					case "GLL": 
						// Geographic position, Latitude / Longitude and time
						// Fields are: 
						//		$GPGLL
						//		Latitude
						//		Longitude
						//		UTC Time of fix in format HHMMSS
						//		Data valid (A = valid data)
						break; 
					case "GSA": 
						// GPS DOP (Dilution of Precision) and Active Satellites 
						// Fields are: 
						//		$GPGSA
						//		Mode (M = manual, A = automatic)
						//		Dimensional Fix ( 2 = 2d, 3 = 3d ) 
						//		3-14 - comma separated list of satellites
						//		PDOP (Positional Dilution of Precision)
						//		HDOP (Horizontal Dilution of Precision)
						//		VDOP (Vertical Dilution of Precision)
						// 		for more information, see
						//			http://en.wikipedia.org/wiki/Dilution_of_precision_(GPS)
						break; 
					case "GSV": 
						// GPS Satellites in View
						// Fields are: 
						//		$GPGSV
						//		Total number of messages of this type in this cycle 
						//		Message number
						//		Total number of Space Vehicles (SVs) in view (SVs are satellites) 
						//		SV 1 Pseudo Random Noise (PRN) code
						//			for more information, see 
						//			http://www.colorado.edu/geography/gcraft/notes/gps/gps.html
						//		SV 1 Elevation in degrees (90 maximum)
						//		SV 1 Azimuth, degrees from true North
						//		SV 1 Signal to Noise Ration (SNR), 00-99dB (null when not tracking)
						//		8-11 - repeat previous 4 fields, but for SV 2
						//		12-15 - repeat for SV 3
						//		16-19 - repeat for SV 4
						break; 
					case "ZDA": 
						// Date and Time 
						//	Fields are: 
						//		$--ZDA
						//		UTC in the format HHMMSS.ss
						//		Day, 01 - 31
						//		Month, 01-12
						//		Year
						//		Local zone description (00 to +/- 13 hours)
						//		Local zone minutes description
						break; 
					default: 
						print "Unknown talker. Probably a programming error.\n"; 
				break; 
			default: 
				print "Error: unknown talker. Probably a programming error.\n"; 
		}

	} // end function parseSentence()

	function printSent() { 
		print "Sentence is " . $this->sentence . "\n"; 
		print "Talker: " . $this->talker . "\n"; 
		print "Type: " . $this->messageType . "\n"; 
	}
	
} // end class nmeaSentence
