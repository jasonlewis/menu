<?php namespace JasonLewis\Menu;

class Menu {

	/**
	 * HTML builder instance.
	 * 
	 * @var \JasonLewis\Menu\HtmlBuilder
	 */
	protected $html;

	/**
	 * Array of attribtues.
	 * 
	 * @var array
	 */
	protected $attributes = [];

	/**
	 * Array of menu items.
	 * 
	 * @var array
	 */
	protected $items = [];

	/**
	 * Create a new Menu instance.
	 * 
	 * @param  array  $attributes
	 * @return void
	 */
	public function __construct($attributes = [])
	{
		$this->attributes = $attributes;
		$this->html = new HtmlBuilder;
	}

	/**
	 * Add a menu item.
	 * 
	 * @param  string  $link
	 * @param  string  $title
	 * @param  array  $attributes
	 * @return \JasonLewis\Menu\Menu
	 */
	public function add($link, $title, $attributes = [])
	{
		$this->items[] = (new MenuItem)->link($link)->title($title)->attributes($attributes);

		return $this;
	}

	/**
	 * Nest a menu on the previous item.
	 * 
	 * @param  array  $attributes
	 * @return \JasonLewis\Menu\Menu
	 */
	public function nestMenu($attributes = [])
	{
		$key = count($this->items) - 1;

		$this->items[$key]->nest($menu = new Menu($attributes));

		return $menu;
	}

	/**
	 * Render the menu.
	 * 
	 * @return string
	 */
	public function render()
	{
		$attributes = $this->html->attributes($this->attributes);

		$menu[] = "<ul{$attributes}>";

		foreach ($this->items as $item)
		{
			$menu[] = $item->render();
		}

		$menu[] = '</ul>';

		return implode(PHP_EOL, $menu);
	}

	/**
	 * Render the menu.
	 * 
	 * @return string
	 */
	public function __toString()
	{
		return $this->render();
	}

}