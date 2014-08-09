<?php

class abbr extends Element {
	public function __construct($inner=array(), $title=false, $opts=array()) {
		parent::__construct('abbr', $opts);
		$this->build_inner($inner);
		if ($title !== false) {
			$this->attr('title', $title);
		}
	}
}
