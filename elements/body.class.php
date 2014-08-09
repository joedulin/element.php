<?php

class body extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('body', $opts);
		$this->build_inner($inner);
	}
}
