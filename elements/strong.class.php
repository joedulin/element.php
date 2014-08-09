<?php

class strong extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('strong', $opts);
		$this->build_inner($inner);
	}
}
