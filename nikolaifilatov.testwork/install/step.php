<?
if(!check_bitrix_sessid()) return;

use \Bitrix\Main\Localization\Loc;

if($ex = $APPLICATION->GetException())
	echo CAdminMessage::ShowMessage(Array(
		'TYPE' => 'ERROR',
		'MESSAGE' => Loc::getMessage('MOD_INST_ERR'),
		'DETAILS' => $ex->GetString(),
		'HTML' => true,
	));
else
	echo CAdminMessage::ShowNote(Loc::getMessage('MOD_INST_OK'));
?>
<form action="<?= $APPLICATION->GetCurPage() ?>">
	<input type="hidden" name="lang" value="<?= LANGUAGE_ID ?>">
	<input type="submit" name="" value="<?= Loc::getMessage('MOD_BACK')?>">
<form>
