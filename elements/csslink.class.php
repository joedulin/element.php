<?php

class csslink extends Element {
	public function __construct($href=false, $opts=array()) {
		parent::__construct('link', $opts);
		if ($href !== false) {
			$this->attr('href', $href);
		}
	}
}
