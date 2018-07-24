# x-cart test

**Test with codcept and facebook WebDriver**

Simple test for check main function in x-cart app on address http://demostore.x-cart.com
Requirements:
1. [Codeception](https://github.com/Codeception/Codeception)
2. [Chromedriver](https://chromedriver.storage.googleapis.com/index.html?path=2.40/)
3. [Selenium server](https://github.com/SeleniumHQ/selenium)

Getting Started
How to start test:
1. Start selenium server with chrome driver. As exemple:

``` 
java -Dwebdriver.chrome.driver=/path/to/file/chromedriver -jar /path/to/file/selenium-server-stanlone-3.13.0.jar 
```
2. In main project directory execute:
``` 
codecept run acceptance --steps
```
