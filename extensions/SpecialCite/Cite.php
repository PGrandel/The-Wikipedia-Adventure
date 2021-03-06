<?php
if ( ! defined( 'MEDIAWIKI' ) )
	die();
/**#@+
 * A parser extension that adds two tags, <ref> and <references> for adding
 * citations to pages
 *
 * @file
 * @ingroup Extensions
 *
 * @link http://www.mediawiki.org/wiki/Extension:Cite/Cite.php Documentation
 *
 * @bug 4579
 *
 * @author Ævar Arnfjörð Bjarmason <avarab@gmail.com>
 * @copyright Copyright © 2005, Ævar Arnfjörð Bjarmason
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */

$wgHooks['ParserFirstCallInit'][] = 'wfCite';

$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'Cite',
	'author' => 'Ævar Arnfjörð Bjarmason',
	'descriptionmsg' => 'cite-desc',
	'url' => 'http://www.mediawiki.org/wiki/Extension:Cite/Cite.php'
);
$wgParserTestFiles[] = dirname( __FILE__ ) . "/citeParserTests.txt";
$wgParserTestFiles[] = dirname( __FILE__ ) . "/citeCatTreeParserTests.txt";
$wgExtensionMessagesFiles['Cite'] = dirname( __FILE__ ) . "/Cite.i18n.php";
$wgAutoloadClasses['Cite'] = dirname( __FILE__ ) . "/Cite_body.php";
$wgSpecialPageGroups['Cite'] = 'pagetools';

define( 'CITE_DEFAULT_GROUP', '' );
/**
 * The emergency shut-off switch.  Override in local settings to disable
 * groups; or remove all references from this file to enable unconditionally
 */
$wgAllowCiteGroups = true;

/**
 * An emergency optimisation measure for caching cite <references /> output.
 */
$wgCiteCacheReferences = false;

/**
 * Performs the hook registration.
 * Note that several extensions (and even core!) try to detect if Cite is 
 * installed by looking for wfCite().
 *
 * @param $parser Parser
 *
 * @return bool
 */
function wfCite( $parser ) {
	return Cite::setHooks( $parser );
}

/**#@-*/
