<?php

class em extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('em', $opts);
		$this->build_inner($inner);
	}
}
