<?php

class embed extends Element {
	public function __construct($src=false, $type=false, $opts=array()) {
		parent::__construct('embed', $opts);
		if ($src !== false) {
			$this->attr('src', $src);
		}
		if ($type !== false) {
			$this->attr('type', $type);
		}
	}
}
