<?php

class span extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('span', $opts);
		$this->build_inner($inner);
	}
}
