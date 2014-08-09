<?php

class a extends Element {

	public function __construct($inner=array(), $href='#', $opts=array()) {
		parent::__construct('a', $opts);
		$this->build_inner($inner);
		$this->attr('href', $href);
	}

}
