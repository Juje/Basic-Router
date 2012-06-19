<?php

/**
 * Basic Router
 * 
 * This file contains the Basic Router class
 * @author Jurjen Beukenhorst <info@juje007.be>
 * @version 1.0
 * @package basic-router
 */

/**
 * The Basic Router class itself.
 * This class handles basic router settings
 * @package basic-router
 */
class Router {
	/**
	 * $pages holds all of the pages in a array
	 * @access private
	 * @var array
	 */
	var $pages;

	/**
	 * __construct creates a fallback for the Home page and the error page
	 * @return void
	 */
	function __construct() {
		$this->newPage('Home', 'home', function(){
			echo 'This is home';
		});
		$this->newPage('Error', 'error', function(){
			echo 'Something went wrong';
		});
	}

	/**
	 * newPage() is used to add a new page
	 * @param string $page_name The page name
	 * @param string $page_slug The page slug
	 * @param obj $call_back This is called when the page is called
	 * @return void
	 */
	function newPage($page_name, $page_slug, $call_back) {
		$this->pages[$page_slug] = array(
			'name' => $page_name,
			'call_back' => $call_back
		);
	}

	/**
	 * getContent() is used to get the page title and the page content
	 * @param string $input The page to get
	 * @param string $title_syntax The title syntax (%title% is used)
	 * @return array An array with the content and title
	 */
	function getContent($input, $title_syntax = '') {
		if(empty($input)) {
			$content = $this->pages['home']['call_back'];
			$title = $this->pages['home']['name'];
		} else {
			if(array_key_exists($input, $this->getPages())) {
				$content = $this->pages[$input]['call_back'];
				$title = $this->pages[$input]['name'];
			} else {
				$content = $this->pages['error']['call_back'];
				$title = $this->pages['error']['name'];
			}
		}
		return array(
			'content' => $content,
			'title' => str_replace('%title%', $title, $title_syntax)
		);
	}

	/**
	 * getMenu() gets the menu
	 * @param string $mainPage The main page for the url also seen as prefix
	 * @param string $slug_syntax The slug syntax (%slug% is used)
	 * @return array An array with the menu items
	 */
	function getMenu($mainPage, $slug_syntax = '') {
		$return = array();
		foreach($this->getPages() as $slug => $name) {
			if($slug !== 'error') {
				if($slug === 'home') {
					$return[$mainPage] = $name;
				} else {
					$return[$mainPage . str_replace('%slug%', $slug, $slug_syntax)] = $name;
				}
			}
		}
		return $return;
	}

	/**
	 * getPages() is used to get an array with all the pages
	 * @access private
	 * @return array
	 */
	private function getPages() {
		$retrun = array();
		foreach($this->pages as $key => $val) {
			$return[$key] = $val['name'];
		}
		return $return;
	}
}

?>