<?php

class figure extends Element {
	public $caption_opts;

	public function __construct($inner=array(), $opts=array(), $caption_opts=array()) {
		parent::__construct('figure', $opts);
		$this->build_inner($inner);
		$this->caption_opts = $caption_opts;
	}

	public function setCaption($caption) {
		$this->array_wrap($caption);
		$cap = $this->find('figcaption');
		if (count($cap) == 0) {
			$cap = new figcaption($caption, $caption_opts);
		} else {
			$cap = $cap[0];
			$cap->empty_inner()->append($caption);
		}
		return $this;
	}

	public function removeCaption() {
		$cap = $this->find('figcaption');
		$this->remove($cap);
	}
}
