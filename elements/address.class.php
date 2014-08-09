<?php

class address extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('address', $opts);
		$this->build_inner($inner);
	}
}
