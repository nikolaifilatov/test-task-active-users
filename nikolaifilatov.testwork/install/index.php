<?php

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);


class nikolaifilatov_testwork extends CModule
{

	protected $errors = array();

	function __construct()
	{
		$arModuleVersion = array();
		require(__DIR__ . '/version.php');

		$this->MODULE_ID = 'nikolaifilatov.testwork';

		$this->COMPONENTS_PATH = $_SERVER['DOCUMENT_ROOT'] . '/local/components';
		$this->MODULE_VERSION = $arModuleVersion['VERSION'];
		$this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
		$this->MODULE_NAME = Loc::getMessage('NFAU_MODULE_NAME');
		$this->MODULE_DESCRIPTION = Loc::getMessage('NFAU_MODULE_DESCRIPTION');
		$this->PARTNER_NAME = Loc::getMessage('NFAU_PARTNER_NAME');
	}

	public function DoInstall()
	{
		global $APPLICATION;

		$this->installFiles();
		if (empty($this->errors))
			ModuleManager::registerModule($this->MODULE_ID);
		else
			$APPLICATION->ThrowException(implode('<br>', $this->errors));

		$APPLICATION->IncludeAdminFile(
			Loc::getMessage('NFAU_INSTALL_TITLE'),
			__DIR__ . '/step.php'
		);
	}

	public function DoUnInstall()
	{
		global $APPLICATION;

		$this->unInstallFiles();
		if (empty($this->errors))
		{
			ModuleManager::unRegisterModule($this->MODULE_ID);
			return;
		}
		$APPLICATION->ThrowException(implode('<br>', $this->errors));
		$APPLICATION->IncludeAdminFile(
			Loc::getMessage('NFAU_UNINSTALL_TITLE'),
			__DIR__ . '/step.php'
		);
	}

	public function installFiles()
	{
		$this->unInstallFiles();
		$res = CopyDirFiles(
			__DIR__ . '/components',
			$_SERVER['DOCUMENT_ROOT'] . '/bitrix/components',
			true,
			true
		);
		if ($res) return;

		$this->errors[] = Loc::getMessage('NFAU_INSTALL_ERROR_COPY_COMPONENT');
	}

	public function unInstallFiles()
	{
		$module_components_dir = '/bitrix/components/' . $this->MODULE_ID;
		if (!is_dir($_SERVER['DOCUMENT_ROOT'] . $module_components_dir)) return;
		if (DeleteDirFilesEx($module_components_dir)) return;
		$this->errors[] = Loc::getMessage('NFAU_UNINSTALL_ERROR_DELETE_COMPONENT');
	}
}
