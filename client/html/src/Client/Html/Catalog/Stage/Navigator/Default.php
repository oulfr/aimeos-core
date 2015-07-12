<?php

/**
 * @copyright Copyright (c) Metaways Infosystems GmbH, 2014
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @package Client
 * @subpackage Html
 */


/**
 * Default implementation of catalog stage navigator section for HTML clients.
 *
 * @package Client
 * @subpackage Html
 */
class Client_Html_Catalog_Stage_Navigator_Default
	extends Client_Html_Catalog_Abstract
{
	/** client/html/catalog/stage/navigator/default/subparts
	 * List of HTML sub-clients rendered within the catalog stage navigator section
	 *
	 * The output of the frontend is composed of the code generated by the HTML
	 * clients. Each HTML client can consist of serveral (or none) sub-clients
	 * that are responsible for rendering certain sub-parts of the output. The
	 * sub-clients can contain HTML clients themselves and therefore a
	 * hierarchical tree of HTML clients is composed. Each HTML client creates
	 * the output that is placed inside the container of its parent.
	 *
	 * At first, always the HTML code generated by the parent is printed, then
	 * the HTML code of its sub-clients. The order of the HTML sub-clients
	 * determines the order of the output of these sub-clients inside the parent
	 * container. If the configured list of clients is
	 *
	 *  array( "subclient1", "subclient2" )
	 *
	 * you can easily change the order of the output by reordering the subparts:
	 *
	 *  client/html/<clients>/subparts = array( "subclient1", "subclient2" )
	 *
	 * You can also remove one or more parts if they shouldn't be rendered:
	 *
	 *  client/html/<clients>/subparts = array( "subclient1" )
	 *
	 * As the clients only generates structural HTML, the layout defined via CSS
	 * should support adding, removing or reordering content by a fluid like
	 * design.
	 *
	 * @param array List of sub-client names
	 * @since 2014.03
	 * @category Developer
	 */
	private $_subPartPath = 'client/html/catalog/stage/navigator/default/subparts';
	private $_subPartNames = array();
	private $_view;


	/**
	 * Returns the HTML code for insertion into the body.
	 *
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @param array &$tags Result array for the list of tags that are associated to the output
	 * @param string|null &$expire Result variable for the expiration date of the output (null for no expiry)
	 * @return string HTML code
	 */
	public function getBody( $uid = '', array &$tags = array(), &$expire = null )
	{
		$view = $this->_setViewParams( $this->getView(), $tags, $expire );

		$html = '';
		foreach( $this->_getSubClients() as $subclient ) {
			$html .= $subclient->setView( $view )->getBody( $uid, $tags, $expire );
		}
		$view->navigatorBody = $html;

		/** client/html/catalog/stage/navigator/default/template-body
		 * Relative path to the HTML body template of the catalog stage navigator client.
		 *
		 * The template file contains the HTML code and processing instructions
		 * to generate the result shown in the body of the frontend. The
		 * configuration string is the path to the template file relative
		 * to the layouts directory (usually in client/html/layouts).
		 *
		 * You can overwrite the template file configuration in extensions and
		 * provide alternative templates. These alternative templates should be
		 * named like the default one but with the string "default" replaced by
		 * an unique name. You may use the name of your project for this. If
		 * you've implemented an alternative client class as well, "default"
		 * should be replaced by the name of the new class.
		 *
		 * @param string Relative path to the template creating code for the HTML page body
		 * @since 2014.03
		 * @category Developer
		 * @see client/html/catalog/stage/navigator/default/template-header
		 */
		$tplconf = 'client/html/catalog/stage/navigator/default/template-body';
		$default = 'catalog/stage/navigator-body-default.html';

		return $view->render( $this->_getTemplate( $tplconf, $default ) );
	}


	/**
	 * Returns the HTML string for insertion into the header.
	 *
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @param array &$tags Result array for the list of tags that are associated to the output
	 * @param string|null &$expire Result variable for the expiration date of the output (null for no expiry)
	 * @return string|null String including HTML tags for the header on error
	 */
	public function getHeader( $uid = '', array &$tags = array(), &$expire = null )
	{
		$view = $this->_setViewParams( $this->getView(), $tags, $expire );

		$html = '';
		foreach( $this->_getSubClients() as $subclient ) {
			$html .= $subclient->setView( $view )->getHeader( $uid, $tags, $expire );
		}
		$view->navigatorHeader = $html;

		/** client/html/catalog/stage/navigator/default/template-header
		 * Relative path to the HTML header template of the catalog stage navigator client.
		 *
		 * The template file contains the HTML code and processing instructions
		 * to generate the HTML code that is inserted into the HTML page header
		 * of the rendered page in the frontend. The configuration string is the
		 * path to the template file relative to the layouts directory (usually
		 * in client/html/layouts).
		 *
		 * You can overwrite the template file configuration in extensions and
		 * provide alternative templates. These alternative templates should be
		 * named like the default one but with the string "default" replaced by
		 * an unique name. You may use the name of your project for this. If
		 * you've implemented an alternative client class as well, "default"
		 * should be replaced by the name of the new class.
		 *
		 * @param string Relative path to the template creating code for the HTML page head
		 * @since 2014.03
		 * @category Developer
		 * @see client/html/catalog/stage/navigator/default/template-body
		 */
		$tplconf = 'client/html/catalog/stage/navigator/default/template-header';
		$default = 'catalog/stage/navigator-header-default.html';

		return $view->render( $this->_getTemplate( $tplconf, $default ) );
	}


	/**
	 * Returns the sub-client given by its name.
	 *
	 * @param string $type Name of the client type
	 * @param string|null $name Name of the sub-client (Default if null)
	 * @return Client_Html_Interface Sub-client object
	 */
	public function getSubClient( $type, $name = null )
	{
		return $this->_createSubClient( 'catalog/stage/navigator/' . $type, $name );
	}


	/**
	 * Modifies the cached body content to replace content based on sessions or cookies.
	 *
	 * @param string $content Cached content
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @return string Modified body content
	 */
	public function modifyBody( $content, $uid )
	{
		return $this->_replaceSection( $content, $this->getBody( $uid ), 'catalog.stage.navigator' );
	}


	/**
	 * Modifies the cached header content to replace content based on sessions or cookies.
	 *
	 * @param string $content Cached content
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @return string Modified body content
	 */
	public function modifyHeader( $content, $uid )
	{
		return $this->_replaceSection( $content, $this->getHeader( $uid ), 'catalog.stage.navigator' );
	}


	/**
	 * Returns the list of sub-client names configured for the client.
	 *
	 * @return array List of HTML client names
	 */
	protected function _getSubClientNames()
	{
		return $this->_getContext()->getConfig()->get( $this->_subPartPath, $this->_subPartNames );
	}


	/**
	 * Sets the necessary parameter values in the view.
	 *
	 * @param MW_View_Interface $view The view object which generates the HTML output
	 * @param array &$tags Result array for the list of tags that are associated to the output
	 * @param string|null &$expire Result variable for the expiration date of the output (null for no expiry)
	 * @return MW_View_Interface Modified view object
	 */
	protected function _setViewParams( MW_View_Interface $view, array &$tags = array(), &$expire = null )
	{
		if( !isset( $this->_view ) )
		{
			if( ( $pos = $view->param( 'l_pos' ) ) !== null && ( $pid = $view->param( 'd_prodid' ) ) !== null )
			{
				if( $pos < 1 ) {
					$start = 0; $size = 2;
				} else {
					$start = $pos - 1; $size = 3;
				}

				$filter = $this->_getProductListFilterByParam( $view->get( 'stageParams', array() ) );
				$filter->setSlice( $start, $size );
				$total = null;

				$controller = Controller_Frontend_Factory::createController( $this->_getContext(), 'catalog' );
				$products = $controller->getProductList( $filter, $total, array( 'text' ) );

				if( ( $count = count( $products ) ) > 1 )
				{
					$enc = $view->encoder();
					$listPos = array_search( $pid, array_keys( $products ) );

					$target = $view->config( 'client/html/catalog/detail/url/target' );
					$controller = $view->config( 'client/html/catalog/detail/url/controller', 'catalog' );
					$action = $view->config( 'client/html/catalog/detail/url/action', 'detail' );
					$config = $view->config( 'client/html/catalog/detail/url/config', array() );

					if( $listPos > 0 && ( $product = reset( $products ) ) !== false )
					{
						$param = array(
							'd_prodid' => $product->getId(),
							'd_name' => $enc->url( $product->getName( 'url ') ),
							'l_pos' => $pos - 1
						);
						$view->navigationPrev = $view->url( $target, $controller, $action, $param, array(), $config );
					}

					if( $listPos < $count - 1 && ( $product = end( $products ) ) !== false )
					{
						$param = array(
							'd_prodid' => $product->getId(),
							'd_name' => $enc->url( $product->getName( 'url' ) ),
							'l_pos' => $pos + 1
						);
						$view->navigationNext = $view->url( $target, $controller, $action, $param, array(), $config );
					}
				}
			}

			$this->_view = $view;
		}

		return $this->_view;
	}
}