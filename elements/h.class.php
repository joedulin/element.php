<?php

class h extends Element {
	public function __construct($inner=array(), $size='4', $opts=array()) {
		$tag = "h{$size}";
		parent::__construct($tag, $opts);
		$this->build_inner($inner);
	}
}
