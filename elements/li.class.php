<?php

class li extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('li', $opts);
		$this->build_inner($inner);
	}
}
