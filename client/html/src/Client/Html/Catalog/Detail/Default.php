<?php

/**
 * @copyright Copyright (c) Metaways Infosystems GmbH, 2012
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @package Client
 * @subpackage Html
 */


/**
 * Default implementation of catalog detail section HTML clients.
 *
 * @package Client
 * @subpackage Html
 */
class Client_Html_Catalog_Detail_Default
	extends Client_Html_Abstract
{
	/** client/html/catalog/detail/default/subparts
	 * List of HTML sub-clients rendered within the catalog detail section
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
	private $_subPartPath = 'client/html/catalog/detail/default/subparts';

	/** client/html/catalog/detail/social/name
	 * Name of the social part used by the catalog detail client implementation
	 *
	 * Use "Myname" if your class is named "Client_Html_Catalog_Detail_Social_Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the client class name
	 * @since 2014.09
	 * @category Developer
	 */

	/** client/html/catalog/detail/image/name
	 * Name of the image part used by the catalog detail client implementation
	 *
	 * Use "Myname" if your class is named "Client_Html_Catalog_Detail_Image_Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the client class name
	 * @since 2014.03
	 * @category Developer
	 */

	/** client/html/catalog/detail/basic/name
	 * Name of the basic part used by the catalog detail client implementation
	 *
	 * Use "Myname" if your class is named "Client_Html_Catalog_Detail_Basic_Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the client class name
	 * @since 2014.03
	 * @category Developer
	 */

	/** client/html/catalog/detail/actions/name
	 * Name of the actions part used by the catalog detail client implementation
	 *
	 * Use "Myname" if your class is named "Client_Html_Catalog_Detail_Actions_Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the client class name
	 * @since 2014.09
	 * @category Developer
	 */

	/** client/html/catalog/detail/basket/name
	 * Name of the basket part used by the catalog detail client implementation
	 *
	 * Use "Myname" if your class is named "Client_Html_Catalog_Detail_Basket_Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the client class name
	 * @since 2014.03
	 * @category Developer
	 */

	/** client/html/catalog/detail/bundle/name
	 * Name of the bundle part used by the catalog detail client implementation
	 *
	 * Use "Myname" if your class is named "Client_Html_Catalog_Detail_Bundle_Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the client class name
	 * @since 2014.11
	 * @category Developer
	 */

	/** client/html/catalog/detail/additional/name
	 * Name of the additional part used by the catalog detail client implementation
	 *
	 * Use "Myname" if your class is named "Client_Html_Catalog_Detail_Additional_Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the client class name
	 * @since 2014.03
	 * @category Developer
	 */

	/** client/html/catalog/detail/suggest/name
	 * Name of the suggest part used by the catalog detail client implementation
	 *
	 * Use "Myname" if your class is named "Client_Html_Catalog_Detail_Suggest_Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the client class name
	 * @since 2014.03
	 * @category Developer
	 */

	/** client/html/catalog/detail/bought/name
	 * Name of the bought together part used by the catalog detail client implementation
	 *
	 * Use "Myname" if your class is named "Client_Html_Catalog_Detail_Bought_Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the client class name
	 * @since 2014.09
	 * @category Developer
	 */

	/** client/html/catalog/detail/seen/name
	 * Name of the seen part used by the catalog detail client implementation
	 *
	 * Use "Myname" if your class is named "Client_Html_Catalog_Detail_Seen_Myname".
	 * The name is case-sensitive and you should avoid camel case names like "MyName".
	 *
	 * @param string Last part of the client class name
	 * @since 2014.03
	 * @category Developer
	 */
	private $_subPartNames = array( 'social', 'image', 'basic', 'actions', 'basket', 'bundle', 'additional', 'suggest', 'bought', 'seen' );

	private $_tags = array();
	private $_expire;
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
		$prefixes = array( 'd' );

		/** client/html/catalog/detail
		 * All parameters defined for the catalog detail component and its subparts
		 *
		 * This returns all settings related to the detail component.
		 * Please refer to the single settings for details.
		 *
		 * @param array Associative list of name/value settings
		 * @category Developer
		 * @see client/html/catalog#detail
		 */
		$confkey = 'client/html/catalog/detail';

		if( ( $html = $this->_getCached( 'body', $uid, $prefixes, $confkey ) ) === null )
		{
			$context = $this->_getContext();
			$view = $this->getView();

			try
			{
				$view = $this->_setViewParams( $view, $tags, $expire );

				$output = '';
				foreach( $this->_getSubClients() as $subclient ) {
					$output .= $subclient->setView( $view )->getBody( $uid, $tags, $expire );
				}
				$view->detailBody = $output;
			}
			catch( Client_Html_Exception $e )
			{
				$error = array( $context->getI18n()->dt( 'client/html', $e->getMessage() ) );
				$view->detailErrorList = $view->get( 'detailErrorList', array() ) + $error;
			}
			catch( Controller_Frontend_Exception $e )
			{
				$error = array( $context->getI18n()->dt( 'controller/frontend', $e->getMessage() ) );
				$view->detailErrorList = $view->get( 'detailErrorList', array() ) + $error;
			}
			catch( MShop_Exception $e )
			{
				$error = array( $context->getI18n()->dt( 'mshop', $e->getMessage() ) );
				$view->detailErrorList = $view->get( 'detailErrorList', array() ) + $error;
			}
			catch( Exception $e )
			{
				$context->getLogger()->log( $e->getMessage() . PHP_EOL . $e->getTraceAsString() );

				$error = array( $context->getI18n()->dt( 'client/html', 'A non-recoverable error occured' ) );
				$view->detailErrorList = $view->get( 'detailErrorList', array() ) + $error;
			}

			/** client/html/catalog/detail/default/template-body
			 * Relative path to the HTML body template of the catalog detail client.
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
			 * @see client/html/catalog/detail/default/template-header
			 */
			$tplconf = 'client/html/catalog/detail/default/template-body';
			$default = 'catalog/detail/body-default.html';

			$html = $view->render( $this->_getTemplate( $tplconf, $default ) );

			$this->_setCached( 'body', $uid, $prefixes, $confkey, $html, $tags, $expire );
		}
		else
		{
			$html = $this->modifyBody( $html, $uid );
		}

		return $html;
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
		$prefixes = array( 'd' );
		$confkey = 'client/html/catalog/detail';

		if( ( $html = $this->_getCached( 'header', $uid, $prefixes, $confkey ) ) === null )
		{
			$view = $this->getView();

			try
			{
				$view = $this->_setViewParams( $view, $tags, $expire );

				$output = '';
				foreach( $this->_getSubClients() as $subclient ) {
					$output .= $subclient->setView( $view )->getHeader( $uid, $tags, $expire );
				}
				$view->detailHeader = $output;

				/** client/html/catalog/detail/default/template-header
				 * Relative path to the HTML header template of the catalog detail client.
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
				 * @see client/html/catalog/detail/default/template-body
				 */
				$tplconf = 'client/html/catalog/detail/default/template-header';
				$default = 'catalog/detail/header-default.html';

				$html = $view->render( $this->_getTemplate( $tplconf, $default ) );

				$this->_setCached( 'header', $uid, $prefixes, $confkey, $html, $tags, $expire );
			}
			catch( Exception $e )
			{
				$this->_getContext()->getLogger()->log( $e->getMessage() . PHP_EOL . $e->getTraceAsString() );
			}
		}
		else
		{
			$html = $this->modifyHeader( $html, $uid );
		}

		return $html;
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
		return $this->_createSubClient( 'catalog/detail/' . $type, $name );
	}


	/**
	 * Processes the input, e.g. store given values.
	 * A view must be available and this method doesn't generate any output
	 * besides setting view variables.
	 */
	public function process()
	{
		$context = $this->_getContext();
		$view = $this->getView();

		try
		{
			$params = $this->_getClientParams( $view->param() );
			$context->getSession()->set( 'arcavias/catalog/detail/params/last', $params );

			parent::process();
		}
		catch( Client_Html_Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'client/html', $e->getMessage() ) );
			$view->detailErrorList = $view->get( 'detailErrorList', array() ) + $error;
		}
		catch( Controller_Frontend_Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'controller/frontend', $e->getMessage() ) );
			$view->detailErrorList = $view->get( 'detailErrorList', array() ) + $error;
		}
		catch( MShop_Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'mshop', $e->getMessage() ) );
			$view->detailErrorList = $view->get( 'detailErrorList', array() ) + $error;
		}
		catch( Exception $e )
		{
			$context->getLogger()->log( $e->getMessage() . PHP_EOL . $e->getTraceAsString() );

			$error = array( $context->getI18n()->dt( 'client/html', 'A non-recoverable error occured' ) );
			$view->detailErrorList = $view->get( 'detailErrorList', array() ) + $error;
		}
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
			$context = $this->_getContext();
			$config = $context->getConfig();

			$prodid = $view->param( 'd_prodid' );
			$default = array( 'media', 'price', 'text', 'attribute', 'product' );

			/** client/html/catalog/domains
			 * A list of domain names whose items should be available in the catalog view templates
			 *
			 * @see client/html/catalog/detail/domains
			 */
			$domains = $config->get( 'client/html/catalog/domains', $default );

			/** client/html/catalog/detail/domains
			 * A list of domain names whose items should be available in the product detail view template
			 *
			 * The templates rendering product details usually add the images,
			 * prices, texts, attributes, products, etc. associated to the product
			 * item. If you want to display additional or less content, you can
			 * configure your own list of domains (attribute, media, price, product,
			 * text, etc. are domains) whose items are fetched from the storage.
			 * Please keep in mind that the more domains you add to the configuration,
			 * the more time is required for fetching the content!
			 *
			 * Since version 2014.05 this configuration option overwrites the
			 * "client/html/catalog/domains" option that allows to configure the
			 * domain names of the items fetched for all catalog related data.
			 *
			 * @param array List of domain names
			 * @since 2014.03
			 * @category Developer
			 * @see client/html/catalog/domains
			 * @see client/html/catalog/list/domains
			 */
			$domains = $config->get( 'client/html/catalog/detail/domains', $domains );

			$manager = MShop_Factory::createManager( $context, 'product' );
			$productItem = $manager->getItem( $prodid, $domains );

			$this->_addMetaItem( $productItem, 'product', $this->_expire, $this->_tags );
			$this->_addMetaList( $prodid, 'product', $this->_expire );


			$attrManager = MShop_Factory::createManager( $context, 'attribute' );
			$attrSearch = $attrManager->createSearch( true );
			$expr = array(
				$attrSearch->compare( '==', 'attribute.id', array_keys( $productItem->getRefItems( 'attribute' ) ) ),
				$attrSearch->getConditions(),
			);
			$attrSearch->setConditions( $attrSearch->combine( '&&', $expr ) );
			$attributes = $attrManager->searchItems( $attrSearch, $default );

			$this->_addMetaItem( $attributes, 'attribute', $this->_expire, $this->_tags );
			$this->_addMetaList( array_keys( $attributes ), 'attribute', $this->_expire );


			$mediaManager = MShop_Factory::createManager( $context, 'media' );
			$mediaSearch = $mediaManager->createSearch( true );
			$expr = array(
				$mediaSearch->compare( '==', 'media.id', array_keys( $productItem->getRefItems( 'media' ) ) ),
				$mediaSearch->getConditions(),
			);
			$mediaSearch->setConditions( $mediaSearch->combine( '&&', $expr ) );
			$media = $mediaManager->searchItems( $mediaSearch, $default );

			$this->_addMetaItem( $media, 'media', $this->_expire, $this->_tags );
			$this->_addMetaList( array_keys( $media ), 'media', $this->_expire );


			$view->detailProductItem = $productItem;
			$view->detailProductAttributeItems = $attributes;
			$view->detailProductMediaItems = $media;
			$view->detailParams = $this->_getClientParams( $view->param() );

			$this->_cache = $view;
		}

		$expire = $this->_expires( $this->_expire, $expire );
		$tags = array_merge( $tags, $this->_tags );

		return $this->_cache;
	}
}