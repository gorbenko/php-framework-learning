#Простейший php-фреймворк

Создан в демонстрационных целях для обучения студентов по курсу "Веб-технологии".

##Принцип работы
Фреймворк реализует модульную архитектуру.
За вывод верстки модулей отвечает класс ```Section```. Он имеет статический метод ```_``` принимающий на вход имя т.н. зоны верстки, которую определяет верстальщик. Примеры зон: ```left```, ```sidebar```, ```footer```. Чтобы вывести модуль в зону верстки, необходимо добавить в файл ```config.php```, в раздел ```sections``` имя модуля.

##Именование модулей
Модуль следует именовать в нижнем регистре. Из имени модуля строится имя его класса.<br>
Например, модуль ```guestbook```, будет иметь имя класса ```ModuleGuestbook```.

##Обработка запроса
Данные формы следует отправлять на url: ```/?mod=```%module-name%```&action=```%action-name%<br>
Где ```mod``` &mdash; имя модуля, ```action``` &mdash; имя метода обрабатывающего запрос.<br>
В классе, имя метода имеет префикс ```action_```, для явного указания предназначения.<br>
Так же в модуле могут содержаться методы ```before``` и ```after```, которые будут выполняться до и после ```action```.

###AJAX-запросы
AJAX-запросы, следует отправлять на ```index2.php```. Параметры запроса те же что и у простого запроса.

##JavaScript
Клиентский код следует заворачивать в функцию передаваемую аргументом в глобальный объект ```Site```.<br>
```javascript
Site.addFunction(function () {
    console.log('Hello world!');
});
```
Код выполняется по событию ```domReady``` в порядке добавления функций в стек.

##Модули из коробки
Модуль гостевой книги ```guestbook```, записывающий сообщения в текстовый файл.<br>
Пример ajax-запроса, смотрите в модуле ```gallery```.
