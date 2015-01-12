<?php
/*--------------------------------------------+
| RSS Parser version 2.00                     |
|---------------------------------------------|
| author: Scott Rutherford (surreal) © 2005   |
| web: http://www.maiden-city.co.uk           |
| email: scott@maiden-city.co.uk              |
|---------------------------------------------|
| Released under the terms and conditions of  |
| the GNU General Public License (Version 2)  |
+--------------------------------------------*/
/*
	Converted to v7.0 by:
	
	php-Invent Team
	http://www.php-invent.com
	
	Developer: SoBeNoFear (ianunruh@gmail.com)
*/
class rss_parser  {
	var $parser;
	var $news = array();
	var $itemCount = -1;
	var $items = array();
	var $inItem = false;
	var $elName = '';
	var $data = '';
	var $cacheFile = '';

	function rss_parser() {
		
		$this->parser = xml_parser_create();
		
		xml_set_object($this->parser, $this);
		xml_set_element_handler($this->parser, "elementOpen", "elementClose");
		xml_set_character_data_handler($this->parser, "characterData");
	}
	
	function parse($file='', $num=0, $cacheTime=0) {
		
		$cacheFile = INFUSIONS.'rss_parser_panel/cache/';
		$cacheFile .= 'cache_'.md5($file).'.txt';
		$this->cacheFile = $cacheFile;
		
		$this->getFile($file, $cacheTime);
		xml_parse($this->parser, $this->data);
		
		if(empty($num)) {
			$this->news['news'] = $this->items;
		} else {
			$this->news['news'] = array_slice($this->items, 0, $num);
		}
		
		return $this->news;
	}
	
	function checkCachedStatus($file='', $cacheTimeOut=0) {
		// get the time the cached file was last modified
		if(file_exists($this->cacheFile)) {
			$cacheTS = filemtime($this->cacheFile);
		} else {
			$cacheTS = 0;
		}
		
		$cacheExpire = $cacheTimeOut * 60 * 60;
		$cacheTime = $cacheTS + $cacheExpire;
		$cacheAge = time() - $cacheTS;
		$cacheRefresh = $cacheExpire - $cacheAge;

		if($cacheTime < time()) {	// cache has expired
			$this->news['info']['cache_last_update'] = 0;
			$this->news['info']['cache_next_update'] = $cacheExpire;
			return true;
		} else {						// cache has not expired
			$this->news['info']['cache_last_update'] = $cacheAge;
			$this->news['info']['cache_next_update'] = $cacheRefresh;
			return false;
		}
		
	}
	
	function getFile($file='', $cacheTime=0) {
		if($this->checkCachedStatus($file, $cacheTime)) {
			// get a new copy of the remote file
			if (!($fp = fopen($file, "r"))) {
				die("could not open source file");
			}
			while (!feof($fp)) {
				$this->data .= fgets ($fp, 4026);
			}
			fclose($fp);
			// write the data to the cache file
			$cfp = fopen($this->cacheFile, "w");
			fputs($cfp, $this->data);
			fclose($cfp);
		} else {
			// load the contents of the cached file
			$this->data = file_get_contents($this->cacheFile);
		}
	}
	
	function elementOpen($parser, $name, $attributes) {
		$this->elName = $name;
		
		if($name == 'ITEM') {
			$this->inItem = true;
			$this->itemCount ++;
		};
	}

	function characterData($parser, $data) {
		$this->data .= $data;
	}

   function elementClose($parser, $name) {
		if($name == 'ITEM') {
			$this->inItem = false;
		} else {
			if($this->inItem) {
				switch ($this->elName) {
					case 'TITLE':
						$this->items[$this->itemCount]['title'] = trim($this->data);
						break;
					case 'DESCRIPTION':
						$this->items[$this->itemCount]['description'] = trim($this->data);
						break;
					case 'LINK':
						$this->items[$this->itemCount]['link'] = trim($this->data);
						break;
						case 'PUBDATE':
						$this->items[$this->itemCount]['pubDate'] = trim($this->data);
						break;
						break;
						case 'AUTHOR':
						$this->items[$this->itemCount]['author'] = trim($this->data);
						break;
						case 'COPYRIGHT':
						$this->items[$this->itemCount]['copyright'] = trim($this->data);
						break;
				}
			} else {
				switch ($this->elName) {
					case 'TITLE':
						$this->news['info']['title'] = trim($this->data);
						break;
					case 'DESCRIPTION':
						$this->news['info']['description'] = trim($this->data);
						break;
					case 'LINK':
						$this->news['info']['link'] = trim($this->data);
						break;
					case 'LANGUAGE':
						$this->news['info']['lang'] = trim($this->data);
						break;
					case 'COPYRIGHT':
						$this->news['info']['copyright'] = trim($this->data);
						break;
					case 'LASTBUILDDATE':
						$this->news['info']['lastUpdate'] = trim($this->data);
						break;
					case 'PUBDATE':
						$this->news['info']['pubDate'] = trim($this->data);
						break;
					case 'AUTHOR':
						$this->news['info']['author'] = trim($this->data);
						break;
				}
			}
			$this->data = '';
		}
	}
}

?> 