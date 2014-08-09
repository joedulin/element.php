<?php

class article extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('article', $opts);
		$this->build_inner($inner);
	}
}
