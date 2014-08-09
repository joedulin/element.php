<?php

class small extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('small', $opts);
		$this->build_inner($inner);
	}
}
