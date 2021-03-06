<?php
/**
 * 2015 XXXXX.
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
 *  @copyright 2015 DPD Polska sp. z o.o.
 *  @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 *  International Registered Trademark & Property of DPD Polska sp. z o.o.
 */

if (!defined('_PS_VERSION_'))
	exit;

class DpdGroupCarrier extends DpdGroupObjectModel
{
	public $id_dpd_geopost_carrier;

	public $id_carrier;

	public $id_reference;

	public $date_add;

	public $date_upd;

	public static $definition = array(
		'table' => _DPDGROUP_CARRIER_DB_,
		'primary' => 'id_dpd_geopost_carrier',
		'multilang_shop' => true,
		'multishop' => true,
		'fields' => array(
			'id_dpd_geopost_carrier'	=>	array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
			'id_carrier'				=>	array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
			'id_reference'				=>	array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
			'date_add' 					=> 	array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
			'date_upd' 					=> 	array('type' => self::TYPE_DATE, 'validate' => 'isDate')
		)
	);

	public static function getReferenceByIdCarrier($id_carrier)
	{
		return DB::getInstance()->getValue('
			SELECT `id_reference`
			FROM `'._DB_PREFIX_._DPDGROUP_CARRIER_DB_.'`
			WHERE `id_carrier` = "'.(int)$id_carrier.'"
		');
	}

	public static function getIdCarrierByReference($id_reference)
	{
		return DB::getInstance()->getValue('
			SELECT MAX(`id_carrier`)
			FROM `'._DB_PREFIX_._DPDGROUP_CARRIER_DB_.'`
			WHERE `id_reference` = "'.(int)$id_reference.'"
		');
	}
}