<?php

class br extends Element {
	public function __construct($opts=array()) {
		parent::__construct('br', $opts);
		$this->requires_close = false;
	}
}
