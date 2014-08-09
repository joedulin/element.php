<?php

class code extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('code', $opts);
		$this->build_inner($inner);
	}
}
