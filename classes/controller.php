<?php
/**
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
*/

if (!defined('_PS_VERSION_'))
	exit;

class DpdGeopostController
{
	protected 		$context;
	
	protected 		$module_instance;
	
	protected		$pagination = array(10, 20, 50, 100, 300);
	
	public static 	$errors = array();
	
	public static 	$notices = array();
	
	private   		$child_class_name;
	
	public function __construct()
	{
		$this->context = Context::getContext();
		$this->module_instance = Module::getInstanceByName('dpdgeopost');
		$this->child_class_name = get_class($this);
	}
	
	protected function l($text)
	{
		$child_class_name = $this->child_class_name;
		return $this->module_instance->l($text, $child_class_name::FILENAME);
	}
	
	protected function getFilterQuery($keys_array = array(), $table)
	{
		$sql = '';
		foreach ($keys_array as $key)
			if ($this->context->cookie->__isset($table.'Filter_'.$key))
			{
				$value = $this->context->cookie->{$table.'Filter_'.$key};
				if (Validate::isSerializedArray($value))
				{
					if (version_compare(_PS_VERSION_, '1.5', '<'))
						$date = unserialize($value);
					else
						$date = Tools::unSerialize($value);
					
					if (!empty($date[0]))
						$sql .= "`".bqSQL($key)."` > '".pSQL($date[0])."' AND ";
						
					if (!empty($date[1]))
						$sql .= "`".bqSQL($key)."` < '".pSQL($date[1])."' AND ";
				}
				else
					$sql .= "`".bqSQL($key)."` LIKE '%".pSQL($value)."%' AND ";
			}
		
		if ($sql)
			$sql = ' HAVING '.Tools::substr($sql,0,-4); // remove 'AND ' from the end of query
		
		return $sql;
	}
}