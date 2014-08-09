<?php

class title extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('title', $opts);
		$this->build_inner($inner);
	}
}
