<?php

class dl extends Element {
	public $dt_opts;
	public $dd_opts;

	//I'm too lazy to write the code to do anything special in the constructor
	public function __construct($inner=array(), $opts=array(), $dt_opts=array(), $dd_opts=array()) {
		parent::__construct('dl', $opts);
		$this->build_inner($inner);
		$this->dt_opts = $dt_opts;
		$this->dd_opts = $dd_opts;
	}

	public function addTerm ($dt) {
		$this->array_wrap($dt);
		foreach ($dt as $i => $v) {
			if ($v->tag != 'dt') {
				$dt[$i] = new dt($v, $this->dt_opts);
			}
		}
		$this->append($dt);
		return $this;
	}

	public function addDefinition ($dd) {
		$this->array_wrap($dd);
		foreach ($dd as $i => $v) {
			if ($v->tag != 'dd') {
				$dd[$i] = new dd($v, $this->dd_opts);
			}
		}
		$this->append($dd);
		return $this;
	}
}
