<?php

class i extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('i', $opts);
		$this->build_inner($inner);
	}
}
