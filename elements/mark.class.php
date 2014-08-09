<?php

class mark extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('mark', $opts);
		$this->build_inner($inner);
	}
}
