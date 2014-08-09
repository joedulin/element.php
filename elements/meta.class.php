<?php

class meta extends Element {
	public function __construct($key_or_assoc=false, $value=false, $opts=array()) {
		parent::__construct('meta', $opts);
		if (is_array($key_or_assoc)) {
			foreach ($key_or_assoc as $k => $v) {
				$this->attr($k, $v);
			}
		} else {
			if ($key_or_assoc !== false && $value !== false) {
				$this->attr($key_or_assoc, $value);
			}
		}
	}
}
