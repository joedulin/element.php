<?php

class aside extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('aside', $opts);
		$this->build_inner($inner);
	}
}
