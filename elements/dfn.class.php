<?php

class dfn extends Element {
	public function __construct($inner=array(), $id=false, $opts=array()) {
		parent::__construct('dfn', $opts);
		$this->build_inner($inner);
		if ($id !== false) {
			$this->attr('id', $id);
		}
	}
}
