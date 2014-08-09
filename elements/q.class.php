<?php

class q extends Element {
	public function __construct($inner=array(), $cite=false, $opts=array()) {
		parent::__construct('q', $opts);
		$this->build_inner($inner);
		if ($cite !== false) {
			$this->attr('cite', $cite);
		}
	}
}
