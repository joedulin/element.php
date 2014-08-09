<?php

class style extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('style', $opts);
		$this->build_inner($inner);
	}
}
