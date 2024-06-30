<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UserTable;
use Bitrix\Main\UI\PageNavigation;


class UserActiveList extends CBitrixComponent
{
	protected $navParamName = 'active_users_page';

        public function executeComponent()
        {
		$this->arResult['ACTIVE_USERS'] = $this->getActiveUsers();
                $this->includeComponentTemplate();
        }

	protected function getActiveUsers()
	{
		$pager = $this->getPager();
		$active_users = UserTable::getList([
                        'select' => [
                                'LAST_NAME',
                                'NAME',
                                'LOGIN',
                                'EMAIL',
                                'DATE_REGISTER',
                        ],
			'filter' => ['ACTIVE' => 'Y'],
			'offset' => $pager->getOffset(),
			'limit' => $pager->getLimit(),
			'count_total' => true,
                ]);
		$pager->setRecordCount($active_users->getCount());
		$this->arResult['NAV_OBJECT'] = $pager;
		return $active_users->fetchAll();
	}

	protected function getPager()
	{
		$pager = new PageNavigation($this->navParamName);
		$pager->setPageSize((int)$this->arParams['ITEMS_ON_PAGE'] ?: 10);
		$pager->initFromUri();
		return $pager;
	}
}
