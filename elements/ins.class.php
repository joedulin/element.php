<?php

class ins extends Element {
	public function __construct($inner=array(), $cite=false, $dt=false, $opts=array()) {
		parent::__construct('ins', $opts);
		$this->build_inner($inner);
		if ($cite !== false) {
			$this->attr('cite', $cite);
		}
		if ($dt !== false) {
			$this->attr('datetime', $datetime);
		}
	}
}
