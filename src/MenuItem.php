<?php namespace JasonLewis\Menu;

class MenuItem {

	/**
	 * HTML builder instance.
	 * 
	 * @var \JasonLewis\Menu\HtmlBuilder
	 */
	protected $html;

	/**
	 * Menu item title.
	 * 
	 * @var string
	 */
	protected $title;

	/**
	 * Menu item link.
	 * 
	 * @var string
	 */
	protected $link;

	/**
	 * Nested menu.
	 * 
	 * @var \JasonLewis\Menu\Menu
	 */
	protected $nested;

	/**
	 * Array of attributes.
	 * 
	 * @var array
	 */
	protected $attributes = [];

	/**
	 * Create a new menu item instance.
	 * 
	 */
	public function __construct()
	{
		$this->html = new HtmlBuilder;
	}

	/**
	 * Set the menu item link.
	 * 
	 * @param  string  $link
	 * @return \JasonLewis\Menu\MenuItem
	 */
	public function link($link)
	{
		$this->link = $link;

		return $this;
	}

	/**
	 * Set the menu item title.
	 * 
	 * @param  string  $link
	 * @return \JasonLewis\Menu\MenuItem
	 */
	public function title($title)
	{
		$this->title = $title;

		return $this;
	}

	/**
	 * Set the menu item attributes.
	 * 
	 * @param  array  $attributes
	 * @return \JasonLewis\Menu\MenuItem
	 */
	public function attributes(array $attributes)
	{
		$this->attributes = $attributes;

		return $this;
	}

	/**
	 * Nest another menu.
	 * 
	 * @param  \JasonLewis\Menu\Menu  $menu
	 * @return \JasonLewis\Menu\MenuItem
	 */
	public function nest(Menu $menu)
	{
		$this->nested = $menu;

		return $this;
	}

	/**
	 * Render the menu item.
	 * 
	 * @return string
	 */
	public function render()
	{
		return '<li>'.$this->html->link($this->link, $this->title, $this->attributes).$this->renderNestedMenu().'</li>';
	}

	/**
	 * Render the nested menu.
	 * 
	 * @return string
	 */
	public function renderNestedMenu()
	{
		if ($this->nested)
		{
			return $this->nested->render();
		}
	}

	/**
	 * Render the menu item.
	 * 
	 * @return string
	 */
	public function __toString()
	{
		return $this->render();
	}

}