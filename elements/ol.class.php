<?php

class ol extends Element {
	public $li_options;

	public function __construct($inner=array(), $opts=array(), $li_options=array()) {
		parent::__construct('ol', $opts);
		$this->array_wrap($inner);
		$this->li_options = $li_options;
		foreach ($inner as $i => $el) {
			if ($el->tag != 'li') {
				$inner[$i] = new li($el, $this->li_options);
			}
		}
		$this->build_inner($inner);
		return $this;
	}

	public function addItem($els) {
		$this->array_wrap($els);
		foreach ($els as $i => $el) {
			if ($el->tag != 'li') {
				$els[$i] = new li($el, $this->li_options);
			}
		}
		$this->append($els);
		return $this;
	}
}
