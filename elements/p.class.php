<?php

class p extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('p', $opts);
		$this->build_inner($inner);
	}
}
