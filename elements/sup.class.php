<?php

class sup extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('sup', $opts);
		$this->build_inner($inner);
	}
}
