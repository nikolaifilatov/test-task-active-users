<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$this->setFrameMode(true);
?>

<table class="zebra">
	<thead>
		<tr>
			<th><?= Loc::getMessage('NFAU_LAST_NAME_TAB') ?></th>
			<th><?= Loc::getMessage('NFAU_NAME_TAB') ?></th>
			<th><?= Loc::getMessage('NFAU_LOGIN_TAB') ?></th>
			<th><?= Loc::getMessage('NFAU_EMAIL_TAB') ?></th>
			<th><?= Loc::getMessage('NFAU_DATE_REGISTER_TAB') ?></th>
		</tr>
	</thead>
	<tbody>
		<?foreach($arResult['ACTIVE_USERS'] as $arItem):?>
		<tr>
			<td><?= $arItem['LAST_NAME'] ?></td>
			<td><?= $arItem['NAME'] ?></td>
			<td><?= $arItem['LOGIN'] ?></td>
			<td><?= $arItem['EMAIL'] ?></td>
			<td><?= $arItem['DATE_REGISTER'] ?></td>
		</tr>
		<?endforeach;?>
	</tbody>
</table>
<?php
$APPLICATION->IncludeComponent(
	'bitrix:main.pagenavigation',
	'',
	array(
		'NAV_OBJECT' => $arResult['NAV_OBJECT'],
	),
	$this->getComponent()
);
?>
