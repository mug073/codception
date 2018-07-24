<?php

use Page\HomePage as HomePage;
use Page\ApparelCatalogPage as ApparelCatalogPage;
use Page\ProductPage as ProductPage;
use Page\CartPage as CartPage;

class MainTestCest
{

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        // $I = new WebGuy($scenario); 
        $I->wantTo('check the basic x-cart func'); 
        $I->amOnPage(HomePage::$URL); //открываем домашнюю страницу
        $I->wait(5); //тут можно было воткнуть ожидание элемента с страницы, но хотелось разнообразия
        //проверяем что заголовок содержит уникальное слово Catalog
        $I->seeInTitle(HomePage::$titlePart);
        //ожидаем до 30 секунд появление ссылки на первую категорию. 
        //можно было сделать через выпадающее меню и ожидание
        // когда элемент будет кликабелен, но я считерил
        $I->waitForElement(HomePage::$firstCategory, 30);
        //переходим на страницу каталога
        $I->click(HomePage::$firstCategory);
        //ожидаем когда появится заголовок категории
        $I->waitForElement(ApparelCatalogPage::$catalogTitle, 30);
        //смотрим на содержимое заголовка страницы
        $I->see('Apparel', ApparelCatalogPage::$catalogTitle); 
        
        //дергаем название первого товара в переменную
        $firstProduct = $I->grabTextFrom(ApparelCatalogPage::$firstProductName);
        //в данном случае li[1] указывает на первый продукт
        $I->click(ApparelCatalogPage::$firstProductCase);
        //проверяем что открылся товар именно тот по которому тыкнули
        $I->waitForElement(ProductPage::$productTitle, 30);
        $I->see($firstProduct, ProductPage::$productTitle); 
        //добавляем товар в корзину
        //тут использование не xpath, а название класса кнопки
        $I->click(['class' => 'add2cart']); 
        //ждем элемент regular-button cart появится и кликаем по нему
        $I->waitForElement(ProductPage::$viewCartButton, 30);
        $I->click(ProductPage::$viewCartButton);
        //переходим в корзину и проверяем что есть товар с таким названием
        $I->see($firstProduct, CartPage::$firstProductInCartName); 
        $I->wait(5);
    }
}