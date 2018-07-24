<?php


class MainTestCest
{
    // public function _before(AcceptanceTester $I)
    // {
    // }

    // public function _after(AcceptanceTester $I)
    // {
    // }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        // $I = new WebGuy($scenario); 
        $I->wantTo('check the basic x-cart func'); 
        $I->amOnPage('/'); //открываем домашнюю страницу
        $I->wait(5); //тут можно было воткнуть ожидание элемента с страницы, но хотелось разнообразия
        //проверяем что заголовок содержит уникальное слово Catalog
        $I->seeInTitle('Catalog');
        //ожидаем до 30 секунд появление ссылки на первую категорию. 
        //можно было сделать через выпадающее меню и ожидание
        // когда элемент будет кликабелен, но я считерил
        $I->waitForElement('//*[@id="secondary-menu"]/ul/li[1]/ul/li[1]/a', 30);
        //переходим на страницу каталога
        $I->click('//*[@id="secondary-menu"]/ul/li[1]/ul/li[1]/a');
        //ожидаем когда появится заголовок категории
        $I->waitForElement('//h1[@id="page-title"]', 30);
        //смотрим на содержимое заголовка страницы
        $I->see('Apparel', "//h1[@id='page-title']"); 
        
        //дергаем название первого товара в переменную
        $firstProduct = $I->grabTextFrom('//div[3]/ul/li[1]/div/h5/a');
        //в данном случае li[1] указывает на первый продукт
        $I->click('//div[2]/div/div/div[3]/ul/li[1]/div/div[1]'); 
        //проверяем что открылся товар именно тот по которому тыкнули
        $I->waitForElement('//div[5]/h1', 30);
        $I->see($firstProduct, "//div[5]/h1"); 
        //добавляем товар в корзину
        //тут использование не xpath, а название класса кнопки
        $I->click(['class' => 'add2cart']); 
        //ждем элемент regular-button cart появится и кликаем по нему
        $I->waitForElement('//div[1]/div[6]/a[1]', 30);
        $I->click('//div[1]/div[6]/a[1]');
        //переходим в корзину и проверяем что есть товар с таким названием
        $I->see($firstProduct, "//p[1]/a"); 
        $I->wait(5);
    }
}