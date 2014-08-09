<?php

class b extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('b', $opts);
		$this->build_inner($inner);
	}
}
