<?php

class s extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('s', $opts);
		$this->build_inner($inner);
	}
}
