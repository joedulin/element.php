<?php

class footer extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('footer', $opts);
		$this->build_inner($inner);
	}
}
