<?php

class base extends Element {
	public function __construct($href=false, $opts=array()) {
		parent::__construct('base', $opts);
		if ($href !== false) {
			$this->attr('href', $href);
		}
		$this->requires_close = false;
		$this->requires_slash = true;
	}
}
