<?php

class acronym extends Element {
	public function __construct($inner=array(), $title=false, $opts=array()) {
		parent::__construct('acronym', $opts);
		$this->build_inner($inner);
		if ($title !== false) {
			$this->attr('title', $title);
		}
	}
}
