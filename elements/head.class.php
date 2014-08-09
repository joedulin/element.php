<?php

class head extends Element {
	public function __construct($inner=array(), $opts=array()) {
		parent::__construct('head', $opts);
		$this->build_inner($inner);
	}

	public function addMeta($kv_array) {
		$meta = new meta();
		$meta->attr($kv_array);
		$this->prepend($meta);
		return $this;
	}

	public function setTitle($string) {
		$title = $this->find('title');
		if (count($title) == 0) {
			$title = new title($string);
			$this->append($title);
		} else {
			$title = $title[0];
			$title
				->empty_inner()
				->append($string);
		}
		return $this;
	}

	public function addJS($src) {
		$this->append(new script($src));
		return $this;
	}

	public function addCSS($href) {
		$this->append(new csslink($href));
		return $this;
	}

	public function setBase($href) {
		$base = $this->find('base');
		if (count($base) == 0) {
			$base = new base($href);
			$this->append($base);
		} else {
			$base = $base[0];
			$base->attr('href', $href);
		}
		return $this;
	}

	public function addInlineCss($string) {
		$style = new style($string);
		$this->append($style);
		return $this;
	}
}
