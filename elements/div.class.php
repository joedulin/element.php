<?php

class div extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('div', $opts);
		$this->build_inner($inner);
	}
}
