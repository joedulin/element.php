<?php

class sub extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('sub', $opts);
		$this->build_inner($inner);
	}
}
