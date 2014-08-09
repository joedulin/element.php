<?php

class bdi extends Element {
	public function __construct($inner=array(), $dir='auto', $opts=array()) {
		parent::__construct('bdi', $opts);
		$this->build_inner($inner);
		$this->attr('dir', $dir);
	}
}
