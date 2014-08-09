<?php

class samp extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('samp', $opts);
		$this->build_inner($inner);
	}
}
