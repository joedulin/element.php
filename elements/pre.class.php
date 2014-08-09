<?php

class pre extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('pre', $opts);
		$this->build_inner($inner);
		$this->no_format_inner = true;
	}
}
