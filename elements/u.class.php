<?php

class u extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('u', $opts);
		$this->build_inner($inner);
	}
}
