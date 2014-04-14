<?php namespace JasonLewis\Menu;

class HtmlBuilder {

	/**
	 * Create an HTML link.
	 * 
	 * @param  string  $url
	 * @param  string  $title
	 * @param  array  $attributes
	 * @return string
	 */
	public function link($url, $title, $attributes = [])
	{
		return '<a href="'.$url.'"'.$this->attributes($attributes).'">'.$this->entities($title).'</a>';
	}

	/**
	 * Convert an HTML string to entities.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function entities($value)
	{
		return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
	}

	/**
	 * Build an HTML attribute string from an array.
	 *
	 * @param  array  $attributes
	 * @return string
	 */
	public function attributes(array $attributes)
	{
		$html = [];

		foreach ($attributes as $key => $value)
		{
			if (is_numeric($key)) $key = $value;

			$html[] = $key.'="'.$this->entities($value).'"';
		}

		return empty($html) ? '' : ' '.implode(' ', $html);
	}

}