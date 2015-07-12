<?php

/**
 * @copyright Copyright (c) Metaways Infosystems GmbH, 2014
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @package Client
 * @subpackage Html
 */


/**
 * Default implementation of product notifiction e-mail html detail part.
 *
 * @package Client
 * @subpackage Html
 */
class Client_Html_Email_Watch_Html_Detail_Default
	extends Client_Html_Abstract
{
	/** client/html/email/watch/html/detail/default/subparts
	 * List of HTML sub-clients rendered within the product notifiction e-mail html detailduction section
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
	private $_subPartPath = 'client/html/email/watch/html/detail/default/subparts';
	private $_subPartNames = array();


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

		$content = '';
		foreach( $this->_getSubClients() as $subclient ) {
			$content .= $subclient->setView( $view )->getBody( $uid, $tags, $expire );
		}
		$view->detailBody = $content;

		/** client/html/email/watch/html/detail/default/template-body
		 * Relative path to the HTML body template of the product notifiction e-mail html detailduction client.
		 *
		 * The template file contains the HTML code and processing instructions
		 * to generate the result shown in the body of the e-mail. The
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
		 * The product notifiction e-mail html client allows to use a different template for
		 * each watch status value. You can create a template for each watch
		 * status and store it in the "email/watch/<status number>/" directory
		 * below the "layouts" directory (usually in client/html/layouts). If no
		 * specific layout template is found, the common template in the
		 * "email/watch/" directory is used.
		 *
		 * @param string Relative path to the template creating code for the HTML e-mail body
		 * @since 2014.09
		 * @category Developer
		 * @see client/html/email/watch/html/detail/default/template-header
		 */
		$tplconf = 'client/html/email/watch/html/detail/default/template-body';

		return $view->render( $this->_getTemplate( $tplconf, 'email/watch/html-detail-body-default.html' ) );
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

		$content = '';
		foreach( $this->_getSubClients() as $subclient ) {
			$content .= $subclient->setView( $view )->getHeader( $uid, $tags, $expire );
		}
		$view->detailHeader = $content;

		/** client/html/email/watch/html/detail/default/template-header
		 * Relative path to the HTML header template of the product notifiction e-mail html detailduction client.
		 *
		 * The template file contains the HTML code and processing instructions
		 * to generate the HTML code that is inserted into the header
		 * of the e-mail. The configuration string is the
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
		 * The product notifiction e-mail HTML client allows to use a different template for
		 * each watch status value. You can create a template for each watch
		 * status and store it in the "email/watch/<status number>/" directory
		 * below the "layouts" directory (usually in client/html/layouts). If no
		 * specific layout template is found, the common template in the
		 * "email/watch/" directory is used.
		 *
		 * @param string Relative path to the template creating code for the e-mail header
		 * @since 2014.09
		 * @category Developer
		 * @see client/html/email/watch/html/detail/default/template-body
		 */
		$tplconf = 'client/html/email/watch/html/detail/default/template-header';

		return $view->render( $this->_getTemplate( $tplconf, 'email/watch/html-detail-header-default.html' ) );
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
		return $this->_createSubClient( 'email/watch/html/detail/' . $type, $name );
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
}