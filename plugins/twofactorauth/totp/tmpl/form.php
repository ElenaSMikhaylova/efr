<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Twofactorauth.totp.tmpl
 *
 * @copyright   (C) 2013 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;

HTMLHelper::_('script', 'plg_twofactorauth_totp/qrcode.min.js', array('version' => 'auto', 'relative' => true));

$js = "
(function(document)
{
	document.addEventListener('DOMContentLoaded', function()
	{
		var qr = qrcode(0, 'H');
		qr.addData('" . $url . "');
		qr.make();

		document.getElementById('totp-qrcode').innerHTML = qr.createImgTag(4);
	});
})(document);
";

Factory::getDocument()->addScriptDeclaration($js);
?>
<input type="hidden" name="jform[twofactor][totp][key]" value="<?php echo $secret ?>" />

<div class="well">
	<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_INTRO') ?>
</div>

<fieldset>
	<legend>
		<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_STEP1_HEAD') ?>
	</legend>
	<p>
		<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_STEP1_TEXT') ?>
	</p>
	<ul>
		<li>
			<a href="<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_STEP1_ITEM1_LINK') ?>" target="_blank" rel="noopener noreferrer">
				<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_STEP1_ITEM1') ?>
			</a>
		</li>
		<li>
			<a href="<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_STEP1_ITEM2_LINK') ?>" target="_blank" rel="noopener noreferrer">
				<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_STEP1_ITEM2') ?>
			</a>
		</li>
	</ul>
	<div class="alert">
		<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_STEP1_WARN') ?>
	</div>
</fieldset>

<fieldset>
	<legend>
		<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_STEP2_HEAD') ?>
	</legend>

	<div class="span6">
		<p>
			<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_STEP2_TEXT') ?>
		</p>
		<table class="table table-striped">
			<tr>
				<td>
					<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_STEP2_ACCOUNT') ?>
				</td>
				<td>
					<?php echo $username ?>@<?php echo $hostname ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_STEP2_KEY') ?>
				</td>
				<td>
					<?php echo $secret ?>
				</td>
			</tr>
		</table>
	</div>

	<div class="span6">
		<p>
			<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_STEP2_ALTTEXT') ?>
			<br />
			<div id="totp-qrcode"></div>
		</p>
	</div>

	<div class="clearfix"></div>

	<div class="alert alert-info">
		<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_STEP2_RESET') ?>
	</div>
</fieldset>

<?php if ($new_totp): ?>
<fieldset>
	<legend>
		<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_STEP3_HEAD') ?>
	</legend>
	<p>
		<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_STEP3_TEXT') ?>
	</p>
	<div class="control-group">
		<label class="control-label" for="totpsecuritycode">
			<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_STEP3_SECURITYCODE') ?>
		</label>
		<div class="controls">
			<input type="text" class="input-small" name="jform[twofactor][totp][securitycode]" id="totpsecuritycode" autocomplete="0">
		</div>
	</div>
</fieldset>
<?php endif; ?>
