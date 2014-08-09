<?php

class main extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('main', $opts);
		$this->build_inner($inner);
	}
}
