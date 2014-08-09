<?php

class figcaption extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('figcaption', $opts);
		$this->build_inner($inner);
	}
}
