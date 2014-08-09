<?php

class iframe extends Element {
	public function __construct($src=false, $opts=array()) {
		parent::__construct('iframe', $opts);
		if ($src !== false) {
			$this->attr('src', $src);
		}
	}
}
