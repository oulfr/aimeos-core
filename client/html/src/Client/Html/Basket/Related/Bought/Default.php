<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @package Client
 * @subpackage Html
 */


/**
 * Default implementation of related basket bought HTML client.
 *
 * @package Client
 * @subpackage Html
 */
class Client_Html_Basket_Related_Bought_Default
	extends Client_Html_Basket_Abstract
{
	/** client/html/basket/related/bought/default/subparts
	 * List of HTML sub-clients rendered within the basket related bought section
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
	private $_subPartPath = 'client/html/basket/related/bought/default/subparts';
	private $_subPartNames = array();
	private $_cache;


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
		$view->boughtBody = $html;

		/** client/html/basket/related/bought/default/template-body
		 * Relative path to the HTML body template of the basket related bought client.
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
		 * @see client/html/basket/related/bought/default/template-header
		 */
		$tplconf = 'client/html/basket/related/bought/default/template-body';
		$default = 'basket/related/bought-body-default.html';

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
		$view->boughtHeader = $html;

		/** client/html/basket/related/bought/default/template-header
		 * Relative path to the HTML header template of the basket related bought client.
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
		 * @see client/html/basket/related/bought/default/template-body
		 */
		$tplconf = 'client/html/basket/related/bought/default/template-header';
		$default = 'basket/related/bought-header-default.html';

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
		return $this->_createSubClient( 'basket/related/bought/' . $type, $name );
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
		if( !isset( $this->_cache ) )
		{
			if( isset( $view->relatedBasket ) )
			{
				$refIds = $items = array();
				$context = $this->_getContext();

				$prodIds = $this->_getProductIdsFromBasket( $view->relatedBasket );

				foreach( $this->_getListItems( $prodIds ) as $listItem )
				{
					$refId = $listItem->getRefId();

					if( !isset( $prodIds[$refId] ) ) {
						$refIds[$refId] = $refId;
					}
				}

				$products = $this->_getProductItems( $refIds );

				foreach( $refIds as $id )
				{
					if( isset( $products[$id] ) ) {
						$items[$id] = $products[$id];
					}
				}

				/** client/html/basket/related/bought/default/limit
				 * Number of items in the list of bought together products
				 *
				 * This option limits the number of suggested products in the
				 * list of bought together products. The suggested items are
				 * calculated using the products that are in the current basket
				 * of the customer.
				 *
				 * Note: You need to start the job controller for calculating
				 * the bought together products regularly to get up to date
				 * product suggestions.
				 *
				 * @param integer Number of products
				 * @since 2014.09
				 */
				$size = $context->getConfig()->get( 'client/html/basket/related/bought/default/limit', 6 );


				$view->boughtItems = array_slice( $items, 0, $size, true );
			}

			$this->_cache = $view;
		}

		return $this->_cache;
	}


	/**
	 * Returns the list items of type "bought-together" associated to the given product IDs.
	 *
	 * @param string[] $prodIds List of product IDs
	 * @return MShop_Product_Item_List_Interface[] List of product list items
	 */
	protected function _getListItems( array $prodIds )
	{
		$typeItem = $this->_getTypeItem( 'product/list/type', 'product', 'bought-together' );
		$manager = MShop_Factory::createManager( $this->_getContext(), 'product/list' );

		$search = $manager->createSearch( true );
		$expr = array(
				$search->compare( '==', 'product.list.parentid', $prodIds ),
				$search->compare( '==', 'product.list.typeid', $typeItem->getId() ),
				$search->compare( '==', 'product.list.domain', 'product' ),
				$search->getConditions(),
		);
		$search->setConditions( $search->combine( '&&', $expr ) );
		$search->setSortations( array( $search->sort( '+', 'product.list.position' ) ) );

		return $manager->searchItems( $search );
	}


	/**
	 * Returns the IDs of the products in the current basket.
	 *
	 * @param MShop_Order_Item_Base_Interface $basket Basket object
	 * @return string[] List of product IDs
	 */
	protected function _getProductIdsFromBasket( MShop_Order_Item_Base_Interface $basket )
	{
		$list = array();

		foreach( $basket->getProducts() as $orderProduct )
		{
			$list[ $orderProduct->getProductId() ] = true;

			foreach( $orderProduct->getProducts() as $subProduct ) {
				$list[ $subProduct->getProductId() ] = true;
			}
		}

		return array_keys( $list );
	}


	/**
	 * Returns the product items for the given IDs.
	 *
	 * @param string[] $ids List of product IDs
	 * @return MShop_Product_Item_Interface[] List of product items
	 */
	protected function _getProductItems( array $ids )
	{
		$context = $this->_getContext();
		$config = $context->getConfig();

		$manager = MShop_Factory::createManager( $context, 'product' );

		$search = $manager->createSearch( true );
		$expr = array(
				$search->compare( '==', 'product.id', $ids ),
				$search->getConditions(),
		);
		$search->setConditions( $search->combine( '&&', $expr ) );


		$domains = array( 'text', 'price', 'media' );

		/** client/html/basket/related/bought/default/domains
		 * The list of domain names whose items should be available in the template for the products
		 *
		 * The templates rendering product details usually add the images,
		 * prices and texts, etc. associated to the product
		 * item. If you want to display additional or less content, you can
		 * configure your own list of domains (attribute, media, price, product,
		 * text, etc. are domains) whose items are fetched from the storage.
		 * Please keep in mind that the more domains you add to the configuration,
		 * the more time is required for fetching the content!
		 *
		 * @param array List of domain names
		 * @since 2014.09
		 * @category Developer
		 */
		$domains = $config->get( 'client/html/basket/related/bought/default/domains', $domains );

		return $manager->searchItems( $search, $domains );
	}
}