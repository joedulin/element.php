<?php

class blockquote extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('blockquote', $opts);
		$this->build_inner($inner);
	}
}
