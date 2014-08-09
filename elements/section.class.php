<?php

class section extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('section', $opts);
		$this->build_inner($inner);
	}
}
