<?php

// Web Browser Identifier v0.9
// Written by Marcin Krol <hawk@limanowa.net>
// License: GPL

function parse_user_agent($user_agent)
{
    $client_data = array(
    'system' => "",
    'system_icon' => "unknown",
    'browser' => "",
    'browser_icon' => "unknown"
    );
    $tmp_array = array();

    // 
    // Check browsers
    // 
  
    // Camino
    if(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*camino\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Camino" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'camino';
      }

    // Netscape
    if(preg_match('/mozilla.*netscape[0-9]?\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Netscape" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'netscape';
      }

    if(preg_match('/mozilla.*navigator[0-9]?\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Netscape" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'netscape';
      }

    // Epiphany
    if(preg_match('/mozilla.*gecko\/[0-9]+.*epiphany\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Epiphany" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'epiphany';
      }

    // Galeon
    if(preg_match('/mozilla.*gecko\/[0-9]+.*galeon\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Galeon" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'galeon';
      }

    // Flock
    if(preg_match('/mozilla.*gecko\/[0-9]+.*flock\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Flock" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'flock';
      }

    // Minimo
    if(preg_match('/mozilla.*gecko\/[0-9]+.*minimo\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Minimo" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'mozilla';
      }

    // K-Meleon
    if(preg_match('/mozilla.*gecko\/[0-9]+.*k\-meleon\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "K-Meleon" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'k-meleon';
      }

    // K-Ninja
    if(preg_match('/mozilla.*gecko\/[0-9]+.*k-ninja\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "K-Ninja" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'k-ninja';
      }

    // Kazehakase
    if(preg_match('/mozilla.*gecko\/[0-9]+.*kazehakase\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Kazehakase" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'kazehakase';
      }

    // SeaMonkey
    if(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*seamonkey\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "SeaMonkey" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'seamonkey';
      }

    // Iceape
    if(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*iceape\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Iceape" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'iceape';
      }

    // Firefox
    if(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*firefox\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Firefox" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'firefox';
      }

    // Iceweasel
    if(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*iceweasel\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Iceweasel" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'iceweasel';
      }

    // Bon Echo
    if(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*BonEcho\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Bon Echo" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'deerpark';
      }

    // Gran Paradiso
    if(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*GranParadiso\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Gran Paradiso" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'deerpark';
      }

    // Shiretoko
    if(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*Shiretoko\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Shiretoko" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'deerpark';
      }

    // Minefield
    if(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*Minefield\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Minefield" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'minefield';
      }

    // Thunderbird
    if(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*thunderbird\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Thunderbird" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'thunderbird';
      }

    // Icedove
    if(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*icedove\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Icedove" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'icedove';
      }

    // Firebird
    if(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*firebird\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Firebird" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'phoenix';
      }

    // Phoenix
    if(preg_match('/mozilla.*rv:[0-9\.]+.*gecko\/[0-9]+.*phoenix\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Phoenix" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'phoenix';
      }

    // Mozilla Suite
    if(preg_match('/mozilla.*rv:([0-9\.]+).*gecko\/[0-9]+.*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Mozilla";
      $client_data['browser_icon'] = 'mozilla';
    // Last official version was 1.7.13, drop all versions where second number > 7
    if((int)substr($tmp_array[1],2,1) <= 7)
      {
      $client_data['browser'] .= ($tmp_array[1] ? " ".$tmp_array[1] : "");
      }
    else
      {
      $client_data['browser'] .= " compatible";
      }
    }

    // Konqueror
    if(preg_match('/mozilla.*konqueror\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Konqueror" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'konqueror';
      if(preg_match('/khtml\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array))
        {
        $client_data['browser'] = "Konqueror" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	}
      }

    // Opera
    if((preg_match('/mozilla.*opera ([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) || preg_match('/^opera\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array)) && !$client_data['browser'])
      {
      $client_data['browser'] = "Opera" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'opera';
      if(preg_match('/opera mini/si', $user_agent))
        {
        preg_match('/opera mini\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array);
        $client_data['browser'] .= " (Opera Mini" . ($tmp_array[1] ? " ".$tmp_array[1] : "") . ")";
        }
    }

    // OmniWeb
    if(preg_match('/mozilla.*applewebkit\/[0-9]+.*omniweb\/v[0-9\.]+/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "OmniWeb";
      $client_data['browser_icon'] = 'omniweb';
      }

    // SunriseBrowser
    if(preg_match('/mozilla.*applewebkit\/[0-9]+.*sunrisebrowser\/([0-9a-z\+\-\.]+)/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "SunriseBrowser" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'sunrise';
      }

    // DeskBrowse
    if(preg_match('/mozilla.*applewebkit\/[0-9]+.*deskbrowse\/([0-9a-z\+\-\.]+)/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "DeskBrowse" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'deskbrowse';
      }

    // Shiira
    if(preg_match('/mozilla.*applewebkit.*shiira\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Shiira" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'shiira';
      }

    // Chrome
    if(preg_match('/mozilla.*applewebkit.*chrome\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Chrome" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'chrome';
      }

    // Safari (use version string if available)
    if(preg_match('/mozilla.*applewebkit.*version\/([0-9\.]+).*safari\/[0-9a-z\+\-\.]+/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Safari" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'safari';
      }

    // Safari (detect version using Safari build number)
    if(preg_match('/mozilla.*applewebkit.*safari\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Safari";
      $client_data['browser_icon'] = 'safari';

      // Translate Safari build into version number
      if($tmp_array[1] == "525.17" || $tmp_array[1] == "525.18" || $tmp_array[1] == "525.20")
        {
        $client_data['browser'] .= " 3.1.1";
        }
      elseif(substr($tmp_array[1], 0, 6) == "525.13")
        {
        $client_data['browser'] .= " 3.1";
        }
      elseif($tmp_array[1] == "523.10" || $tmp_array[1] == "523.12" || $tmp_array[1] == "523.12.9" || $tmp_array[1] == "523.15")
        {
        $client_data['browser'] .= " 3.0.4";
        }
      elseif($tmp_array[1] == "522.12.1" || $tmp_array[1] == "522.15.5")
        {
        $client_data['browser'] .= " 3.0.3";
        }
      elseif($tmp_array[1] == "522.12" || $tmp_array[1] == "522.13.1")
        {
        $client_data['browser'] .= " 3.0";
        }
      elseif($tmp_array[1] == "522.11.3")
        {
        $client_data['browser'] .= " 3.0 beta";
        }
      elseif(substr($tmp_array[1], 0, 3) == "419")
        {
        $client_data['browser'] .= " 2.0.4";
        }
      elseif(substr($tmp_array[1], 0, 3) == "417")
        {
        $client_data['browser'] .= " 2.0.3";
        }
      elseif(substr($tmp_array[1], 0, 3) == "416")
        {
        $client_data['browser'] .= " 2.0.2";
        }
      elseif($tmp_array[1] == "412.5")
        {
        $client_data['browser'] .= " 2.0.1";
        }
      elseif(substr($tmp_array[1], 0, 3) == "412")
        {
        $client_data['browser'] .= " 2.0";
        }
      elseif($tmp_array[1] == "312.6" || $tmp_array[1] == "312.5")
        {
        $client_data['browser'] .= " 1.3.2";
        }
      elseif(substr($tmp_array[1], 0, 5) == "312.3")
        {
        $client_data['browser'] .= " 1.3.1";
        }
      elseif(substr($tmp_array[1], 0, 3) == "312")
        {
        $client_data['browser'] .= " 1.3";
        }
      elseif($tmp_array[1] == "125.12" || $tmp_array[1] == "125.11")
        {
        $client_data['browser'] .= " 1.2.4";
        }
      elseif($tmp_array[1] == "125.9")
        {
        $client_data['browser'] .= " 1.2.3";
        }
      elseif($tmp_array[1] == "125.8" || $tmp_array[1] == "125.7")
        {
        $client_data['browser'] .= " 1.2.2";
        }
      elseif($tmp_array[1] == "125.1")
        {
        $client_data['browser'] .= " 1.2.1";
        }
      elseif(substr($tmp_array[1], 0, 3) == "125")
        {
        $client_data['browser'] .= " 1.2";
        }
      elseif($tmp_array[1] == "101.1")
        {
        $client_data['browser'] .= " 1.1.1";
        }
      elseif(substr($tmp_array[1], 0, 3) == "100")
        {
        $client_data['browser'] .= " 1.1";
        }
      elseif(substr($tmp_array[1], 0, 4) == "85.8")
        {
        $client_data['browser'] .= " 1.0.3";
        }
      elseif($tmp_array[1] == "85.7")
        {
        $client_data['browser'] .= " 1.0.2";
        }
      elseif(substr($tmp_array[1], 0, 2) == "85")
        {
        $client_data['browser'] .= " 1.0";
        }
      elseif(substr($tmp_array[1], 0, 2) == "74")
        {
        $client_data['browser'] .= " 1.0b2";
        }
      elseif(substr($tmp_array[1], 0, 2) == "73")
        {
        $client_data['browser'] .= " 0.9";
        }
      elseif(substr($tmp_array[1], 0, 2) == "60")
        {
        $client_data['browser'] .= " 0.8.2";
        }
      elseif(substr($tmp_array[1], 0, 2) == "51")
        {
        $client_data['browser'] .= " 0.8.1";
        }
      elseif(substr($tmp_array[1], 0, 2) == "48")
        {
        $client_data['browser'] .= " 0.8";
        }
      }
  
    // Dillo
    if(preg_match('/dillo\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Dillo" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'dillo';
      }

    // iCab
    if(preg_match('/icab\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "iCab" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'icab';
      }

    // Lynx
    if(preg_match('/^lynx\/([0-9a-z\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Lynx" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'lynx';
      }

    // Links
    if(preg_match('/^links \(([0-9a-z\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Links" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'links';
      }

    // Elinks
    if(preg_match('/^elinks \(([0-9a-z\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "ELinks" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'links';
      }
    if(preg_match('/^elinks\/([0-9a-z\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "ELinks" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'links';
      }
    if(preg_match('/^elinks$/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "ELinks";
      $client_data['browser_icon'] = 'links';
      }

    // Wget
    if(preg_match('/^Wget\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Wget" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'wget';
      }

    // Amiga Aweb
    if(preg_match('/Amiga\-Aweb\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Amiga Aweb" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'aweb';
      }

    // Amiga Voyager
    if(preg_match('/AmigaVoyager\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Amiga Voyager" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'voyager';
      }

    // QNX Voyager
    if(preg_match('/QNX Voyager ([0-9a-z.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "QNX Voyager" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'qnx';
      }

    // IBrowse
    if(preg_match('/IBrowse\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "IBrowse" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'ibrowse';
      }

    // Openwave
    if(preg_match('/UP\.Browser\/([0-9a-zA-Z\.]+).*/s', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Openwave" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'openwave';
      }
    if(preg_match('/UP\/([0-9a-zA-Z\.]+).*/s', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Openwave" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'openwave';
      }

    // NetFront
    if(preg_match('/NetFront\/([0-9a-z\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "NetFront" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'netfront';
      }

    // PlayStation Portable
    if(preg_match('/psp.*playstation.*portable[^0-9]*([0-9a-z\.]+)\)/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "PSP" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'playstation';
      }

    // Various robots...

    // Googlebot
    if(preg_match('/Googlebot\/([0-9a-z\+\-\.]+).*/s', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Googlebot" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // Googlebot Image
    if(preg_match('/Googlebot\-Image\/([0-9a-z\+\-\.]+).*/s', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Googlebot Image " . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // Gigabot
    if(preg_match('/Gigabot\/([0-9a-z\+\-\.]+).*/s', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Gigabot" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // W3C Validator
    if(preg_match('/^W3C_Validator\/([0-9a-z\+\-\.]+)$/s', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "W3C Validator" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // W3C CSS Validator
    if(preg_match('/W3C_CSS_Validator_[a-z]+\/([0-9a-z\+\-\.]+)$/s', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "W3C CSS Validator" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // MSN Bot
    if(preg_match('/msnbot(-media|)\/([0-9a-z\+\-\.]+).*/s', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "MSNBot" . ($tmp_array[2] ? " ".$tmp_array[2] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // Psbot
    if(preg_match('/psbot\/([0-9a-z\+\-\.]+).*/s', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Psbot" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // IRL crawler
    if(preg_match('/IRLbot\/([0-9a-z\+\-\.]+).*/s', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "IRL crawler" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // Seekbot
    if(preg_match('/Seekbot\/([0-9a-z\+\-\.]+).*/s', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Seekport Robot" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // Microsoft Research Bot
    if(preg_match('/^MSRBOT /s', $user_agent) && !$client_data['browser'])
      {
      $client_data['browser'] = "MSRBot";
      $client_data['browser_icon'] = 'robot';
      }

    // cfetch/voyager
    if(preg_match('/^(cfetch|voyager)\/([0-9a-z\+\-\.]+)$/s', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "voyager" . ($tmp_array[2] ? " ".$tmp_array[2] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // BecomeBot
    if(preg_match('/BecomeBot\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "BecomeBot" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // SnapBot
    if(preg_match('/SnapBot\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "SnapBot" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // Yeti
    if(preg_match('/Yeti\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Yeti" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // Yandex
    if(preg_match('/Yandex\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Yandex Crawler" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // spbot
    if(preg_match('/spbot\/([0-9a-z\+\-\.]+); \+http:\/\/www\.seoprofiler\.com\//si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "SEOprofiler.com bot" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // DotBot
    if(preg_match('/DotBot\/([0-9a-z\+\-\.]+); http:\/\/www\.dotnetdotcom\.org\//si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "DotBot" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // Twiceler
    if(preg_match('/Twiceler-([0-9\.]+) http:\/\/www\.cuil[l]?\.com/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Twiceler" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'robot';
      }

    // Alexa
    if(preg_match('/^ia_archiver$/s', $user_agent) && !$client_data['browser'])
      {
      $client_data['browser'] = "Alexa";
      $client_data['browser_icon'] = 'robot';
      }

    // Inktomi Slurp
    if(preg_match('/Slurp.*inktomi/s', $user_agent) && !$client_data['browser'])
      {
      $client_data['browser'] = "Inktomi Slurp";
      $client_data['browser_icon'] = 'robot';
      }

    // Yahoo Slurp
    if(preg_match('/Yahoo!.*Slurp/s', $user_agent) && !$client_data['browser'])
      {
      $client_data['browser'] = "Yahoo! Slurp";
      $client_data['browser_icon'] = 'robot';
      }

    // Ask.com
    if(preg_match('/Ask Jeeves\/Teoma/s', $user_agent) && !$client_data['browser'])
      {
      $client_data['browser'] = "Ask.com";
      $client_data['browser_icon'] = 'robot';
      }

    // end of robots

    // MSIE
    if(preg_match('/microsoft.*internet.*explorer/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Microsoft Internet Explorer 1.0";
      $client_data['browser_icon'] = 'msie';
      }
    if(preg_match('/mozilla.*MSIE ([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Microsoft Internet Explorer" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'msie';
      }

    // Netscape Navigator
    if(preg_match('/Mozilla\/([0-4][0-9\.]+).*/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Netscape Navigator" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['browser_icon'] = 'netscape_old';
      }

    // Catchall for other Mozilla compatible browsers
    if(preg_match('/mozilla/si', $user_agent, $tmp_array) && !$client_data['browser'])
      {
      $client_data['browser'] = "Mozilla compatible";
      $client_data['browser_icon'] = 'mozilla';
      }

    // 
    // Check system
    // 

    // Linux
    if(preg_match('/linux/si', $user_agent) && !$client_data['system'])
      {
      $client_data['system'] = "Linux";
      $client_data['system_icon'] = "linux";
      if(preg_match('/mdv/si', $user_agent) || preg_match('/mandriva/si', $user_agent))
        {
        $client_data['system'] .= " (Mandriva";
        $client_data['system_icon'] = "mandriva";
        // Try to detect version
        if(preg_match('/mdv([0-9.]*)/si', $user_agent, $tmp_array))
          {
          $client_data['system'] .= ($tmp_array[1] ? " ".$tmp_array[1].")" : ")");
          }
        else
	  {
          $client_data['system'] .= ")";
	  }
        }
      elseif(preg_match('/mdk/si', $user_agent))
        {
        $client_data['system'] .= " (Mandrake)";
        $client_data['system_icon'] = "mandriva";
        }
      elseif(preg_match('/kanotix/si', $user_agent))
        {
        $client_data['system'] .= " (Kanotix)";
        $client_data['system_icon'] = "kanotix";
        }
      elseif(preg_match('/lycoris/si', $user_agent))
        {
        $client_data['system'] .= " (Lycoris)";
        $client_data['system_icon'] = "lycoris";
        }
      elseif(preg_match('/knoppix/si', $user_agent))
        {
        $client_data['system'] .= " (Knoppix)";
        $client_data['system_icon'] = "knoppix";
        }
      elseif(preg_match('/centos/si', $user_agent))
        {
        $client_data['system'] .= " (CentOS";
        $client_data['system_icon'] = "centos";
        // Try to detect version
        if(preg_match('/\.el3/si', $user_agent))
          {
          $client_data['system'] .= " 3.x)";
          }
        elseif(preg_match('/\.el4/si', $user_agent))
          {
          $client_data['system'] .= " 4.x)";
          }
        elseif(preg_match('/\.el5/si', $user_agent))
          {
          $client_data['system'] .= " 5.x)";
          }
        else
	  {
          $client_data['system'] .= ")";
	  }
        }
      elseif(preg_match('/gentoo/si', $user_agent))
        {
        $client_data['system'] .= " (Gentoo)";
        $client_data['system_icon'] = "gentoo";
        }
      elseif(preg_match('/fedora/si', $user_agent))
        {
        $client_data['system'] .= " (Fedora";
        $client_data['system_icon'] = "fedora";
        // Try to detect version
        if(preg_match('/\.fc3/si', $user_agent))
          {
          $client_data['system'] .= " Core 3 Heidelberg)";
          }
        elseif(preg_match('/\.fc4/si', $user_agent))
          {
          $client_data['system'] .= " Core 4 Stentz)";
          }
        elseif(preg_match('/\.fc5/si', $user_agent))
          {
          $client_data['system'] .= " Core 5 Bordeaux)";
          }
        elseif(preg_match('/\.fc6/si', $user_agent))
          {
          $client_data['system'] .= " Core 6 Zod)";
          }
        elseif(preg_match('/\.fc7/si', $user_agent))
          {
          $client_data['system'] .= " 7 Moonshine)";
          }
        elseif(preg_match('/\.fc8/si', $user_agent))
          {
          $client_data['system'] .= " 8 Werewolf)";
          }
        elseif(preg_match('/\.fc9/si', $user_agent))
          {
          $client_data['system'] .= " 9 Sulphur)";
          }
        elseif(preg_match('/\.fc10/si', $user_agent))
          {
          $client_data['system'] .= " 10 Cambridge)";
          }
        elseif(preg_match('/\.fc11/si', $user_agent))
          {
          $client_data['system'] .= " 11 Leonidas)";
          }
        elseif(preg_match('/\.fc12/si', $user_agent))
          {
          $client_data['system'] .= " 12 Constantine)";
          }
        elseif(preg_match('/\.fc13/si', $user_agent))
          {
          $client_data['system'] .= " 13 Goddard)";
          }
        else
	  {
          $client_data['system'] .= ")";
	  }
        }
      elseif(preg_match('/ubuntu/si', $user_agent))
        {
        // Which *ubuntu do we have?
        if(preg_match('/kubuntu/si', $user_agent))
          {
          $client_data['system'] .= " (Kubuntu";
          $client_data['system_icon'] = "kubuntu";
          }
        elseif(preg_match('/xubuntu/si', $user_agent))
          {
          $client_data['system'] .= " (Xubuntu";
          $client_data['system_icon'] = "xubuntu";
          }
	else
          {
          $client_data['system'] .= " (Ubuntu";
          $client_data['system_icon'] = "ubuntu";
          }
        // Try to detect version
        if(preg_match('/lucid/si', $user_agent))
          {
          $client_data['system'] .= " 10.04 LTS Lucid Lynx)";
          }
        elseif(preg_match('/karmic/si', $user_agent))
          {
          $client_data['system'] .= " 9.10 Karmic Koala)";
          }
        elseif(preg_match('/jaunty/si', $user_agent))
          {
          $client_data['system'] .= " 9.04 Jaunty Jackalope)";
          }
        elseif(preg_match('/intrepid/si', $user_agent))
          {
          $client_data['system'] .= " 8.10 Intrepid Ibex)";
          }
        elseif(preg_match('/hardy/si', $user_agent))
          {
          $client_data['system'] .= " 8.04 LTS Hardy Heron)";
          }
        elseif(preg_match('/gutsy/si', $user_agent))
          {
          $client_data['system'] .= " 7.10 Gutsy Gibbon)";
          }
        elseif(preg_match('/ubuntu.feist/si', $user_agent))
          {
          $client_data['system'] .= " 7.04 Feisty Fawn)";
          }
        elseif(preg_match('/ubuntu.edgy/si', $user_agent))
          {
          $client_data['system'] .= " 6.10 Edgy Eft)";
          }
        elseif(preg_match('/ubuntu.dapper/si', $user_agent))
          {
          $client_data['system'] .= " 6.06 LTS Dapper Drake)";
          }
        elseif(preg_match('/ubuntu.breezy/si', $user_agent))
          {
          $client_data['system'] .= " 5.10 Breezy Badger)";
          }
        else
	  {
          $client_data['system'] .= ")";
	  }
        }
      elseif(preg_match('/slackware/si', $user_agent))
        {
        $client_data['system'] .= " (Slackware)";
        $client_data['system_icon'] = "slackware";
        }
      elseif(preg_match('/pclinuxos/si', $user_agent))
        {
        $client_data['system'] .= " (PCLinuxOS)";
        $client_data['system_icon'] = "pclinuxos";
        }
      elseif(preg_match('/zenwalk ([0-9.]*)/si', $user_agent, $tmp_array))
        {
        $client_data['system'] .= " (Zenwalk".($tmp_array[1] ? " ".$tmp_array[1] : "").")";
        $client_data['system_icon'] = "zenwalk";
        }
      elseif(preg_match('/suse/si', $user_agent))
        {
        $client_data['system'] .= " (Suse)";
        $client_data['system_icon'] = "suse";
        }
      elseif(preg_match('/redhat/si', $user_agent) || preg_match('/red hat/si', $user_agent))
        {
        $client_data['system'] .= " (Red Hat";
        $client_data['system_icon'] = "redhat";
        // Try to detect version
        if(preg_match('/\.el4/si', $user_agent))
          {
          $client_data['system'] .= " Enterprise Linux 4.x)";
          }
        elseif(preg_match('/\.el5/si', $user_agent))
          {
          $client_data['system'] .= " Enterprise Linux 5.x)";
          }
        else
	  {
          $client_data['system'] .= ")";
	  }
        }
      elseif(preg_match('/debian/si', $user_agent) )
        {
        $client_data['system'] .= " (Debian)";
        $client_data['system_icon'] = "debian";
        }
      elseif(preg_match('/PLD\/([0-9.]*) \(([a-z]{2})\)/si', $user_agent, $tmp_array))
        {
        $client_data['system'] .= " (PLD".($tmp_array[1] ? " ".$tmp_array[1] : "").($tmp_array[2] ? " ".$tmp_array[2] : "").")";
        $client_data['system_icon'] = "pld";
        }
      elseif(preg_match('/PLD\/([a-zA-Z.]*)/si', $user_agent, $tmp_array))
        {
        $client_data['system'] .= " (PLD".($tmp_array[1] ? " ".$tmp_array[1] : "").")";
        $client_data['system_icon'] = "pld";
        }
      }

    // BSD
    if(preg_match('/bsd/si', $user_agent) && !$client_data['system'])
      {
      $client_data['system'] = "BSD";
      $client_data['system_icon'] = "bsd";
      if(preg_match('/freebsd/si', $user_agent))
        {
        $client_data['system'] = "FreeBSD";
        }
      elseif(preg_match('/openbsd/si', $user_agent))
        {
        $client_data['system'] = "OpenBSD";
        }
      elseif(preg_match('/netbsd/si', $user_agent))
        {
        $client_data['system'] = "NetBSD";
        }
      }

    // Mac OS (X)
    if((preg_match('/mac_/si', $user_agent) || preg_match('/macos/si', $user_agent) || preg_match('/powerpc/si', $user_agent) || preg_match('/mac os/si', $user_agent) || preg_match('/68k/si', $user_agent) || preg_match('/macintosh/si', $user_agent)) && !$client_data['system'])
    {
      $client_data['system'] = "Mac OS";
      $client_data['system_icon'] = "macos";
      if(preg_match('/mac os x/si', $user_agent))
        {
        $client_data['system'] .= " X";

        // use version string if available
        if(preg_match('/mac os x ([0-9\._]+)/si', $user_agent, $tmp_array))
          {
            $client_data['system'] .= ($tmp_array[1] ? " ".$tmp_array[1] : "");
            $client_data['system'] = preg_replace('/_/', '.', $client_data['system']);
          }
        // if browser == safari try to detect Mac OS X version using WebKit and Safari build numbers
        elseif(preg_match('/applewebkit\/([0-9\.]+).*safari\/([0-9\.]+)/si', $user_agent, $tmp_array))
          {
          if($tmp_array[1] == "523.10.3")
            {
            $client_data['system'] .= " 10.5/10.5.1";
            }
          elseif($tmp_array[1] == "419.3")
            {
            $client_data['system'] .= " 10.4.10";
            }
          elseif($tmp_array[1] == "419.2.1")
            {
            $client_data['system'] .= " 10.4.9/10.4.10";
            }
          elseif($tmp_array[1] == "419")
            {
            $client_data['system'] .= " 10.4.9";
            }
          elseif($tmp_array[1] == "418.9.1")
            {
            $client_data['system'] .= " 10.4.8";
            }
          elseif($tmp_array[1] == "418.9")
            {
            $client_data['system'] .= " 10.4.8";
            }
          elseif($tmp_array[1] == "418.8")
            {
            $client_data['system'] .= " 10.4.7";
            }
          elseif(substr($tmp_array[1], 0, 3) == "418")
            {
            $client_data['system'] .= " 10.4.6";
            }
          elseif($tmp_array[1] == "417.9")
            {
            $client_data['system'] .= " 10.4.4/10.4.5";
            }
          elseif(substr($tmp_array[1], 0, 3) == "416")
            {
            $client_data['system'] .= " 10.4.3";
            }
          elseif(substr($tmp_array[1], 0, 4) == "412.")
            {
            $client_data['system'] .= " 10.4.2";
            }
          elseif(substr($tmp_array[1], 0, 3) == "412")
            {
            $client_data['system'] .= " 10.4/10.4.1";
            }
          elseif(substr($tmp_array[1], 0, 3) == "312")
            {
            $client_data['system'] .= " 10.3.9";
            }
          elseif($tmp_array[1] == "125.5.7")
            {
            $client_data['system'] .= " 10.3.8";
            }
          elseif($tmp_array[1] == "125.5.5" && $tmp_array[2] == "125.11")
            {
            $client_data['system'] .= " 10.3.6";
            }
          elseif(($tmp_array[1] == "125.5.6" || $tmp_array[1] == "125.5.5") && substr($tmp_array[2], 0, 5) == "125.1")
            {
            $client_data['system'] .= " 10.3.6/10.3.7/10.3.8";
            }
          elseif($tmp_array[1] == "125.5" || $tmp_array[1] == "125.4")
            {
            $client_data['system'] .= " 10.3.5";
            }
          elseif($tmp_array[1] == "125.2")
            {
            $client_data['system'] .= " 10.3.4";
            }
          elseif($tmp_array[1] == "100"  && $tmp_array[2] == "100.1")
            {
            $client_data['system'] .= " 10.3.2";
            }
          elseif(substr($tmp_array[1], 0, 3) == "100")
            {
            $client_data['system'] .= " 10.3";
            }
          elseif(substr($tmp_array[1], 0, 2) == "85")
            {
            $client_data['system'] .= " 10.2.8";
            }
          }
        }
      }

    // ReactOS
    if(preg_match('/ReactOS ([0-9a-zA-Z\+\-\. ]+).*/s', $user_agent, $tmp_array))
      {
      $client_data['system'] = "ReactOS" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['system_icon'] = "reactos";
      }

    // SunOs
    if(preg_match('/sunos/si', $user_agent) && !$client_data['system'])
      {
      $client_data['system'] = "Solaris";
      $client_data['system_icon'] = "solaris";
      }

    // Syllable
    if(preg_match('/syllable/si', $user_agent) && !$client_data['system'])
      {
      $client_data['system'] = "Syllable";
      $client_data['system_icon'] = "syllable";
      }

    // Amiga
    if(preg_match('/amiga/si', $user_agent) && !$client_data['system'])
      {
      $client_data['system'] = "Amiga";
      $client_data['system_icon'] = "amiga";
      }

    // Irix
    if(preg_match('/irix/si', $user_agent) && !$client_data['system'])
      {
      $client_data['system'] = "IRIX";
      $client_data['system_icon'] = "irix";
      }

    // OpenVMS
    if(preg_match('/open.*vms/si', $user_agent) && !$client_data['system'])
      {
      $client_data['system'] = "OpenVMS";
      $client_data['system_icon'] = "openvms";
      }

    // BeOs
    if(preg_match('/beos/si', $user_agent) && !$client_data['system'])
      {
      $client_data['system'] = "BeOS";
      $client_data['system_icon'] = "beos";
      }

    // QNX
    if(preg_match('/QNX/si', $user_agent) && preg_match('/Photon/si', $user_agent) && !$client_data['system'])
      {
      $client_data['system'] = "QNX";
      $client_data['system_icon'] = "qnx";
      }

    // OS/2 Warp
    if(preg_match('/OS\/2.*Warp ([0-9.]+).*/si', $user_agent, $tmp_array) && !$client_data['system'])
      {
      $client_data['system'] = "OS/2 Warp" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['system_icon'] = "os2";
      }

    // Java on mobile
    if(preg_match('/j2me/si', $user_agent) && !$client_data['system'])
      {
      $client_data['system'] = "Java Platform Micro Edition";
      $client_data['system_icon'] = "java";
      }

    // Symbian Os
    if(preg_match('/symbian/si', $user_agent) && !$client_data['system'])
      {
      $client_data['system'] = "Symbian OS";
      $client_data['system_icon'] = "symbian";
      // try to get version
      if(preg_match('/SymbianOS\/([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array))
        {
	$client_data['system'] .= ($tmp_array[1] ? " ".$tmp_array[1] : "");
	}
      }

    // Palm Os
    if(preg_match('/palmos/si', $user_agent) && !$client_data['system'])
      {
      $client_data['system'] = "Palm OS";
      $client_data['system_icon'] = "palmos";
      // try to get version
      if(preg_match('/PalmOS ([0-9a-z\+\-\.]+).*/si', $user_agent, $tmp_array))
        {
	$client_data['system'] .= ($tmp_array[1] ? " ".$tmp_array[1] : "");
	}
      }

    // PlayStation Portable
    if(preg_match('/psp.*playstation.*portable/si', $user_agent) && !$client_data['system'])
      {
      $client_data['system'] = "PlayStation Portable";
      $client_data['system_icon'] = 'playstation';
      }

    // Nintentdo Wii
    if(preg_match('/Nintendo Wii/si', $user_agent) && !$client_data['system'])
      {
      $client_data['system'] = "Nintendo Wii";
      $client_data['system_icon'] = 'wii';
      }

    // Try to detect some mobile devices...

    // Nokia
    if(preg_match('/Nokia[ ]{0,1}([0-9a-zA-Z\+\-\.]+){0,1}.*/s', $user_agent, $tmp_array))
      {
      if(!$client_data['system'])
        {
	$client_data['system'] = "Nokia" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	$client_data['system_icon'] = "mobile";
	}
      else
        {
	$client_data['system'] .= " / Nokia" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	}
      }

    // Motorola
    if(preg_match('/mot\-([0-9a-zA-Z\+\-\.]+){0,1}\//si', $user_agent, $tmp_array))
      {
      if(!$client_data['system'])
        {
	$client_data['system'] = "Motorola" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	$client_data['system_icon'] = "mobile";
	}
      else
        {
	$client_data['system'] .= " / Motorola" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	}
      }

    // Siemens
    if(preg_match('/sie\-([0-9a-zA-Z\+\-\.]+){0,1}\//si', $user_agent, $tmp_array))
      {
      if(!$client_data['system'])
        {
	$client_data['system'] = "Siemens" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	$client_data['system_icon'] = "mobile";
	}
      else
        {
	$client_data['system'] .= " / Siemens" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	}
      }

    // Samsung
    if(preg_match('/samsung\-([0-9a-zA-Z\+\-\.]+){0,1}\//si', $user_agent, $tmp_array))
      {
      if(!$client_data['system'])
        {
	$client_data['system'] = "Samsung" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	$client_data['system_icon'] = "mobile";
	}
      else
        {
	$client_data['system'] .= " / Samsung" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	}
      }
    
    // SonyEricsson & Ericsson
    if(preg_match('/SonyEricsson[ ]{0,1}([0-9a-zA-Z\+\-\.]+){0,1}.*/s', $user_agent, $tmp_array))
      {
      if(!$client_data['system'])
        {
	$client_data['system'] = "Sony Ericsson" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	$client_data['system_icon'] = "mobile";
	}
      else
        {
	$client_data['system'] .= " / Sony Ericsson" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	}
      }
    elseif(preg_match('/Ericsson[ ]{0,1}([0-9a-zA-Z\+\-\.]+){0,1}.*/s', $user_agent, $tmp_array))
      {
      if(!$client_data['system'])
        {
	$client_data['system'] = "Ericsson" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	$client_data['system_icon'] = "mobile";
	}
      else
        {
	$client_data['system'] .= " / Ericsson" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	}
      }

    // Alcatel
    if(preg_match('/Alcatel\-([0-9a-zA-Z\+\-\.]+){0,1}.*/s', $user_agent, $tmp_array))
      {
      if(!$client_data['system'])
        {
	$client_data['system'] = "Alcatel" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	$client_data['system_icon'] = "mobile";
	}
      else
        {
	$client_data['system'] .= " / Alcatel" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	}
      }

    // Panasonic
    if(preg_match('/Panasonic\-{0,1}([0-9a-zA-Z\+\-\.]+){0,1}.*/s', $user_agent, $tmp_array))
      {
      if(!$client_data['system'])
        {
	$client_data['system'] = "Panasonic" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	$client_data['system_icon'] = "mobile";
	}
      else
        {
	$client_data['system'] .= " / Panasonic" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	}
      }

    // Philips
    if(preg_match('/Philips\-([0-9a-z\+\-\@\.]+){0,1}.*/si', $user_agent, $tmp_array))
      {
      if(!$client_data['system'])
        {
	$client_data['system'] = "Philips" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	$client_data['system_icon'] = "mobile";
	}
      else
        {
	$client_data['system'] .= " / Philips" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	}
      }

    // Acer
    if(preg_match('/Acer\-([0-9a-z\+\-\.]+){0,1}.*/si', $user_agent, $tmp_array))
      {
      if(!$client_data['system'])
        {
	$client_data['system'] = "Acer" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	$client_data['system_icon'] = "mobile";
	}
      else
        {
	$client_data['system'] .= " / Acer" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	}
      }

    // BlackBerry
    if(preg_match('/BlackBerry([0-9a-zA-Z\+\-\.]+){0,1}\//s', $user_agent, $tmp_array))
      {
      if(!$client_data['system'])
        {
	$client_data['system'] = "BlackBerry" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	$client_data['system_icon'] = "mobile";
	}
      else
        {
	$client_data['system'] .= " / BlackBerry" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
	}
      }

    // Windows 3.x, 95, 98 and other numerical
    if(preg_match('/windows ([0-9\.]+).*/si', $user_agent, $tmp_array) && !$client_data['system'])
      {
      $client_data['system'] = "Windows" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
      $client_data['system_icon'] = "win_old";
      }

    if(preg_match('/[ \(]win([0-9\.]+).*/si', $user_agent, $tmp_array) && !$client_data['system'])
      {
      if($tmp_array[1] == "16")
        {
        $client_data['system'] = "Windows 3.x";
        $client_data['system_icon'] = "win_old";
        }
      elseif($tmp_array[1] == "32")
        {
        $client_data['system'] = "Windows";
        $client_data['system_icon'] = "win_old";
        }
      else
        {
        $client_data['system'] = "Windows" . ($tmp_array[1] ? " " . $tmp_array[1] : "");
        $client_data['system_icon'] = "win_old";
        }
      }

    // Windows ME
    if(preg_match('/windows me/si', $user_agent, $tmp_array) || preg_match('/win 9x 4\.90/si', $user_agent, $tmp_array) && !$client_data['system'])
      {
      $client_data['system'] = "Windows Millenium";
      $client_data['system_icon'] = "win_old";
      }

    // Windows CE
    if(preg_match('/windows ce/si', $user_agent, $tmp_array) && !$client_data['system'])
      {
      $client_data['system'] = "Windows CE";
      $client_data['system_icon'] = "win_old";
      }

    // Windows XP
    if(preg_match('/windows xp/si', $user_agent, $tmp_array) && !$client_data['system'])
      {
      $client_data['system'] = "Windows XP";
      $client_data['system_icon'] = "win_new";
      }

    // Windows NT, no version, to be sure it will catch
    if(preg_match('/windows nt/si', $user_agent, $tmp_array) || preg_match('/winnt/si', $user_agent, $tmp_array) && !$client_data['system'])
      {
      $client_data['system'] = "Windows NT";
      $client_data['system_icon'] = "win_old";
      }

    // Windows NT with version
    if(preg_match('/windows nt ([0-9\.]+).*/si', $user_agent, $tmp_array) || preg_match('/winnt([0-9\.]+).*/si', $user_agent, $tmp_array) && !$client_data['system'])
      {
      if($tmp_array[1] == "6.1")
        {
        $client_data['system'] = "Windows 7/Server 2008 R2";
        $client_data['system_icon'] = "win_new";
        }
      elseif($tmp_array[1] == "6.0")
        {
        $client_data['system'] = "Windows Vista/Server 2008";
        $client_data['system_icon'] = "win_new";
        }
      elseif($tmp_array[1] == "5.2")
        {
        $client_data['system'] = "Windows Server Home/Server 2003";
        $client_data['system_icon'] = "win_new";
        }
      elseif($tmp_array[1] == "5.1")
        {
        $client_data['system'] = "Windows XP";
        $client_data['system_icon'] = "win_new";
        }
      elseif($tmp_array[1] == "5.0" || $tmp_array[1] == "5.01")
        {
        $client_data['system'] = "Windows 2000";
        $client_data['system_icon'] = "win_old";
        }
      else
        {
        $client_data['system'] = "Windows NT" . ($tmp_array[1] ? " ".$tmp_array[1] : "");
        $client_data['system_icon'] = "win_old";
        }
      }

    // Catchall for all other windozez
    if(preg_match('/windows/si', $user_agent, $tmp_array) && !$client_data['system'])
      {
      $client_data['system'] = "Windows";
      $client_data['system_icon'] = "win_old";
      }

    // Nullify system for robots
    if($client_data['browser_icon'] == "robot")
      {
      $client_data['system'] = "";
      $client_data['system_icon'] = "unknown";
      }
    return $client_data;
}
?>