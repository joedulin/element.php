<?php

class timeEl extends Element {
	public function __construct($inner=array(), $dt=false, $opts=array()) {
		parent::__construct('time', $opts);
		$this->build_inner($inner);
		if ($dt !== false) {
			$this->attr('datetime', $dt);
		}
	}
}
