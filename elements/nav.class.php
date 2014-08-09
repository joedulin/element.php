<?php

class nav extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('nav', $opts);
		$this->build_inner($inner);
	}
}
