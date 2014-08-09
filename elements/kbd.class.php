<?php

class kbd extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('kbd', $opts);
		$this->build_inner($inner);
	}
}
