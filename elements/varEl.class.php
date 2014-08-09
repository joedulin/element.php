<?php

class varEl extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('var', $opts);
		$this->build_inner($inner);
	}
}
