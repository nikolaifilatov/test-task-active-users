<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = array(
	'NAME' => Loc::getMessage('NFAU_NAME'),
	'DESCRIPTION' => Loc::getMessage('NFAU_DESCRIPTION'),
	'PATH' => array(
		'ID' => 'test_works',
		'NAME' => Loc::getMessage('NFAU_TEST'),
		'CHILD' => array(
			'ID' => 'author',
			'NAME' => Loc::getMessage('NFAU_AUTHOR'),
		),
	)
);
?>
