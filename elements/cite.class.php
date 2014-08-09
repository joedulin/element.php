<?php

class cite extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('cite', $opts);
		$this->build_inner($inner);
	}
}
