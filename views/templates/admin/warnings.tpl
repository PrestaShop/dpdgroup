{**
* 2014 Apple Inc.
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to telco.csee@geopost.pl so we can send you a copy immediately.
*
*  @author    JSC INVERTUS www.invertus.lt <help@invertus.lt>
*  @copyright 2014 DPD Polska sp. z o.o. 
*  @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
*  International Registered Trademark & Property of DPD Polska sp. z o.o. 
*}
{if count($warnings)}
	<div class="warning warn">
		{if count($warnings) == 1}
			{$warnings[0]|escape:'htmlall':'UTF-8'}
		{else}
			{l s='%d warnings' mod='dpdgeopost' sprintf=$warnings|count}
			<br/>
			<ol>
				{foreach $warnings as $warning}
					<li>{$warning|escape:'htmlall':'UTF-8'}</li>
				{/foreach}
			</ol>
		{/if}
	</div>
{/if}