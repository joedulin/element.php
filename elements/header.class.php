<?php

class header extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('header', $opts);
		$this->build_inner($inner);
	}
}
