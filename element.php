<?php

function autoload_elements($class) {
	include('elements/' . $class . '.class.php');
}
function autoload_widgets($class) {
	include('widgets/' . $class . '.class.php');
}
spl_autoload_register('autoload_elements');
spl_autoload_register('autoload_widgets');

class Element {
	//Required
	public $attrs = array();
	public $styles = array();
	public $classes = array();
	public $inner = array();
	public $tag;

	//Used for other stuff
	public $requires_slash = false;
	public $requires_close = true;
	public $no_format_inner = false;

	//Class stuffs
	public function __construct ($tag, $opts=array()) {
		$this->tag = $tag;
		foreach ($opts as $k => $v) {
			$this->$k = $v;
		}
	}

	public function __toString() {
		return $this->render(true);
	}

	//Manipulate attrs -------------------------------------------------

	public function attr ($key, $value=null) {
		if (empty($value)) {
			if (is_array($key)) {
				foreach ($key as $k => $v) {
					$this->attr($k, $v);
				}
				return $this;
			}
			if ($value === false) {
				unset($this->attrs[$key]);
				return $this;
			}
			return $this->attrs[$key];
		}
		$this->attrs[$key] = $value;
		return $this;
	}

	//Manipulate styles ------------------------------------------------

	public function css ($key, $value=null) {
		if (empty($value)) {
			if (is_array($key)) {
				foreach ($key as $k => $v) {
					$this->css($k, $v);
				}
				return $this;
			}
			if ($value === false) {
				unset($this->styles[$key]);
				return $this;
			}
			return $this->styles[$key];
		}
		$this->styles[$key] = $value;
		return $this;
	}

	//Manipulate classes -----------------------------------------------

	public function hasClass ($class) {
		return in_array($class, $this->classes);
	}

	public function addClass ($classes) {
		if (!is_array($classes)) {
			$classes = array( $classes );
		}
		foreach ($classes as $class) {
			if (!$this->hasClass($class)) {
				$this->classes[] = $class;
			}
		}
		return $this;
	}

	public function removeClass ($classes) {
		if (!is_array($classes)) {
			$classes = array( $classes );
		}
		foreach ($classes as $class) {
			foreach ($this->classes as $i => $c) {
				if ($c == $class) {
					array_splice($this->classes, $i, 1);
					break;
				}
			}
		}
		return $this;
	}

	//Manipulate inner -------------------------------------------------

	public function append ($elements) {
		if (gettype($elements) == 'string') {
			$regex = '/<(.[^\s]*)(.[^><]*)?>(.*?)?<\/\1>/is';
			$found = preg_match_all($regex, $elements, $content);
			if ($found) {
				return $this->append($this->parse($elements));
			}
		}
		if (!is_array($elements)) {
			$elements = array( $elements );
		}
		foreach ($elements as $el) {
			$this->inner[] = $el;
		}
		return $this;
	}

	//Just so the function can be used interchangably. Redefined in many classes
	public function addItem ($els) {
		$this->append($els);
	}

	public function prepend ($elements) {
		if (gettype($elements) == 'string') {
			$regex = '/<(.[^\s]*)(.[^><]*)?>(.*?)?<\/\1>/is';
			$found = preg_match_all($regex, $elements, $content);
			if ($found) {
				return $this->prepend($this->parse($elements));
			}
		}
		if (!is_array($elements)) {
			$elements = array( $elements );
		}
		foreach ($elements as $el) {
			array_unshift($this->inner, $el);
		}
		return $this;
	}

	public function empty_inner () {
		$this->inner = array();
		return $this;
	}

	public function remove ($index_or_element) {
		if (is_array($index_or_element)) {
			foreach ($index_or_element as $item) {
				$this->remove($item);
			}
			return $this;
		}
		if (is_object($index_or_element)) {
			return $this->remove_object($index_or_element);
		}
		return $this->remove_index($index_or_element);
	}

	public function remove_index ($index) {
		array_splice($this->inner, $index, 1);
		return $this;
	}

	public function remove_object ($object) {
		foreach ($this->inner as $i => $el) {
			if ($el == $object) {
				array_splice($this->inner, $i, 1);
				break;
			}
		}
		return $this;
	}

	public function before ($reference, $new) {
		if (gettype($new) == 'string') {
			$regex = '/<(.[^\s]*)(.[^><]*)?>(.*?)?<\/\1>/is';
			$found = preg_match_all($regex, $new, $content);
			if ($found) {
				return $this->before($reference, $this->parse($new));
			}
		}
		if (is_array($new)) {
			foreach ($new as $el) {
				$this->before($reference, $el);
			}
			return $this;
		}
		if (is_object($reference)) {
			return $this->before_object($reference, $new);
		}
		return $this->before_index($reference, $new);
	}

	public function before_object ($reference_el, $new_el) {
		foreach ($this->inner as $i => $el) {
			if ($el == $reference_el) {
				array_splice($this->inner, $i, 0, array($new_el));
				break;
			}
		}
		return $this;
	}

	public function before_index ($index, $new_el) {
		array_splice($this->inner, $index, 0, array($new_el));
		return $this;
	}

	public function after ($reference, $new) {
		if (gettype($new) == 'string') {
			$regex = '/<(.[^\s]*)(.[^><]*)?>(.*?)?<\/\1>/is';
			$found = preg_match_all($regex, $new, $content);
			if ($found) {
				return $this->after($reference, $this->parse($new));
			}
		}
		if (is_array($new)) {
			foreach ($new as $el) {
				$this->after($reference, $el);
			}
			return $this;
		}
		if (is_object($reference)) {
			return $this->after_object($reference, $new);
		}
		return $this->after_index($reference, $new);
	}

	public function after_object ($reference_el, $new_el) {
		foreach ($this->inner as $i => $el) {
			if ($el == $reference_el) {
				array_splice($this->inner, ($i + 1), 0, array($new_el));
				break;
			}
		}
		return $this;
	}

	public function after_index ($index, $new_el) {
		array_splice($this->inner, ($index + 1), 0, array($new_el));
		return $this;
	}

	public function find ($search) {
		$search_hint = substr($search, 0, 1);
		switch ($search_hint) {
			case '#':
				$function =  'find_id';
				break;
			case '.':
				$function = 'find_class';
				break;
			case '[':
				$search = str_replace(array('[',']','"'), '', $search);
				$search = explode('=', $search);
				if (count($search) == 1) {
					$search = $search[0];
					$function = 'find_attr_key';
				} else {
					$key = $search[0];
					$value = $search[1];
					return $this->find_attr_kv($key, $value);
				}
				break;
			default:
				$function = 'find_tag';
				break;
		}
		$bad_chars = array('[', ']', '.', '#', '"');
		$search = str_replace($bad_chars, '', $search);
		return $this->$function($search);
	}

	public function find_tag ($search) {
		$found = array();
		foreach ($this->inner as $i => $el) {
			if ($el->tag == $search) {
				$found[] = $el;
			}
		}
		return $found;
	}

	public function find_id ($search) {
		return $this->find_attr_kv('id', $search);
	}

	public function find_attr_key ($search) {
		$found = array();
		foreach ($this->inner as $i => $el) {
			if (array_key_exists($search, $el->attrs)) {
				$found[] = $el;
			}
		}
		return $found;
	}

	public function find_attr_kv ($key, $value) {
		$key_exists = $this->find_attr_key($key);
		foreach ($key_exists as $i => $v) {
			if ($v->attrs[$key] != $value) {
				array_splice($key_exists, $i, 1);
			}
		}
		return $key_exists;
	}

	public function find_class ($search) {
		$found = array();
		foreach ($this->inner as $i => $el) {
			if ($el->hasClass($search)) {
				$found[] = $el;
			}
		}
		return $found;
	}

	public function render($return=false, $depth=1) {
		$print_string = sprintf('<%s', $this->tag);

		if (count($this->attrs) > 0) {
			$attrs = array();
			foreach ($this->attrs as $attr => $value) {
				if (!empty($value)) {
					$attrs[] = sprintf('%s="%s"', $attr, $value);
				}
			}
			$print_string .= sprintf(' %s', implode(' ', $attrs));
		}

		if (count($this->classes) > 0) {
			$print_string .= sprintf(' class="%s"', implode(' ', $this->classes));
		}

		if (count($this->styles) > 0) {
			$styles = array();
			foreach ($this->styles as $style => $value) {
				if (!empty($value)) {
					$styles[] = sprintf('%s: %s;', $style, $value);
				}
			}
			$print_string .= sprintf(' style="%s"', implode(' ', $styles));
		}

		if ($this->requires_slash) {
			$print_string .= " />\n";
		} else {
			$print_string .= ">\n";
		}

		foreach ($this->inner as $el) {
			if (is_object($el)) {
				$print_string .= sprintf("%s%s", str_repeat("\t", $depth), $el->render(true, ($depth +1)));
			} else {
				if ($this->no_format_inner) {
					$print_string .= $el;
				} else {
					$print_string .= sprintf("%s%s", str_repeat("\t", $depth), $el);
				}
			}
			$print_string .= "\n";
		}

		if ($this->requires_close) {
			$print_string .= sprintf("%s</%s>", str_repeat("\t", ($depth - 1)), $this->tag);
		}

		if ($depth == 1) {
			$print_string .= "\n";
		}

		if ($return) {
			return $print_string;
		} else {
			echo $print_string;
			return $this;
		}
	}

	public function parse($html) {
		$single = 'meta|img|hr|br|link|!--|!DOCTYPE|input';
		$html = preg_replace('/<('.$single.')(.[^><]*)?>/is', '<\1\2></\1>', $html);
		
		$regex = '/<(.[^\s]*)(.[^><]*)?>(.*?)?<\/\1>/is';
		$found = preg_match_all($regex, $html, $content);
		$ret = array();
		if ($found) {
			foreach ($content[1] as $index => $root_tag) {
				$string_attrs = $content[2][$index];
				$remaining = $content[3][$index];

				$classes = array();
				$styles = array();
				$attrs = array();

				$array_attrs = preg_split('/\s(?=[^"]*("[^"]*"[^"]*)*$)/', $string_attrs);
				foreach ($array_attrs as $attr) {
					if (strlen(trim($attr)) < 1) {
						continue;
					}
					$attr = str_replace('"', '', $attr);
					$attr = explode('=', $attr);
					switch ($attr[0]) {
						case 'class':
							$classes = explode(' ', $attr[1]);
							break;
						case 'style':
							$s_arr = explode(';', $attr[1]);
							foreach ($s_arr as $style) {
								$style = str_replace(' ', '', $style);
								$style = explode(':', $style);
								if (isset($style[1])) {
									$styles[$style[0]] = $style[1];
								}
							}
							break;
						default:
							$attrs[$attr[0]] = $attr[1];
							break;
					}
				}
				$opts = array(
					'classes' => $classes,
					'styles' => $styles,
					'attrs' => $attrs
				);
				if (strlen($remaining) > 0) {
					$opts['inner'] = $this->parse($remaining);
					if (!is_array($opts['inner'])) {
						$opts['inner'] = array( $opts['inner'] );
					}
				} else {
					$opts['inner'] = array();
				}
				$ret[] = new Element($root_tag, $opts);
			}
		} else {
			if ($html && strlen($html) > 0) {
				return $html;
			} else {
				return false;
			}
		}
		return $ret;
	}

	//Helper functions ---------------------------------------------------------
	public function array_wrap(&$el) {
		if (!is_array($el)) {
			$el = array( $el );
		}
	}

	public function build_inner($inner) {
		$this->array_wrap($inner);
		foreach ($inner as $el) {
			$this->append($el);
		}
	}

	//Static functions -------------------------------------------------
	public static function load($html) {
		$single = 'meta|img|hr|br|link|!--|!DOCTYPE|input';
		$html = preg_replace('/<('.$single.')(.[^><]*)?>/is', '<~\1\2></~\1>', $html);
		
		$regex = '/<(.[^\s]*)(.[^><]*)?>(.*?)?<\/\1>/is';
		$found = preg_match_all($regex, $html, $content);
		$ret = array();
		if ($found) {
			foreach ($content[1] as $index => $root_tag) {
				if (strpos($root_tag, '~') !== false) {
					$root_tag = str_replace('~', '', $root_tag);
					$noclose = true;
				} else {
					$noclose = false;
				}
				$string_attrs = $content[2][$index];
				$remaining = $content[3][$index];

				$classes = array();
				$styles = array();
				$attrs = array();

				$array_attrs = preg_split('/\s(?=[^"]*("[^"]*"[^"]*)*$)/', $string_attrs);
				foreach ($array_attrs as $attr) {
					if (strlen(trim($attr)) < 1) {
						continue;
					}
					$attr = str_replace('"', '', $attr);
					$attr = explode('=', $attr);
					switch ($attr[0]) {
						case 'class':
							$classes = explode(' ', $attr[1]);
							break;
						case 'style':
							$s_arr = explode(';', $attr[1]);
							foreach ($s_arr as $style) {
								$style = str_replace(' ', '', $style);
								$style = explode(':', $style);
								if (isset($style[1])) {
									$styles[$style[0]] = $style[1];
								}
							}
							break;
						default:
							$attrs[$attr[0]] = $attr[1];
							break;
					}
				}
				$opts = array(
					'classes' => $classes,
					'styles' => $styles,
					'attrs' => $attrs
				);
				if (strlen($remaining) > 0) {
					$opts['inner'] = self::load($remaining);
					if (!is_array($opts['inner'])) {
						$opts['inner'] = array( $opts['inner'] );
					}
				} else {
					$opts['inner'] = array();
				}
				$el = new Element($root_tag, $opts);
				if ($noclose) {
					$el->requires_close = false;
				}
				$ret[] = $el;
			}
		} else {
			if ($html && strlen($html) > 0) {
				return $html;
			} else {
				return false;
			}
		}
		if (count($ret) == 1) {
			$ret = $ret[0];
		}
		return $ret;
	}
}
