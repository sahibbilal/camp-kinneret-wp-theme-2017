<?php
/**
 * The search form template.
 *
 *
 * @package WordPress
 * @subpackage CK
 * @since CK 1.0
 */
?>
<form method="get" action="<?php echo bloginfo('url'); ?>" >
	<input placeholder="Search Blog" type="text" name="s" id="s"/>
	<input type="submit" value="search" />
</form>