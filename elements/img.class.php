<?php

class img extends Element {
	public function __construct($src=false, $alt=false, $opts=array()) {
		parent::__construct('img', $opts);
		if ($src !== false) {
			$this->attr('src', $src);
		}
		if ($alt !== false) {
			$this->attr('alt', $alt);
		}
	}
}
