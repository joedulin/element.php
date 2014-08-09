<?php

class hr extends Element {
	public function __construct($opts = array()) {
		parent::__construct('hr', $opts);
		$this->requires_close = false;
	}
}
