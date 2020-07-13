У Юзера есть организация

Заведение Organization
 - Название
 - Адрес
 - Описание
 - Время работы
 - Специализация
 - Кухня
 ProductCategory
  - Название
  - Описание
  - ? Участие в акциях, и пр..
  - Порядок сортировки
  - ? Шаблон отображения (может быть лендинг какой-то)
 Product
  - Название
  - Описание
  - Гл. Изображение
  - Доп. Изображения
  - Основная категория
  - Отображение в категориях
  - Цена
  - Порядок сортировки
  - Акционная цена (ниже обычной)
  - Вес
  - Состав
  - Популярный ли?
  - Теги


? Как делать связь много ко многим (отображение в категориях) - заметка в google keep
? Как лучше организовать теги - списком или в отдельную таблицу тегов
? Чтобы состав был кликабельным - его может быть тоже в отдельную таблицу нужно поместить



Юзер может добавить организацию
 - В рамках заведения можно добавить категории товаров
 - В рамках категории товара можно добавить товары
 - В рамках товара можно проставить связь с другими категориями
 - В рамках товара можно добавить состав
 - В рамках товара можно добавить теги

 - Написать заметки на webstool


Задачи на 08.02

- OK Подключить текстовый wysiwyg редактор
- OK Загрузка изображений
- Связь с категориями для товара (главная категория и "отображать в категориях")
- Soft-удаление товаров/категорий/организаций
- Витрина - начать


Задачи на 10.02

- Список заказов в аккаунте организации



Для показа Ивану

- Общий список заказов - для Супер-Админа
- Общий список покупателей - для Супер-Админа
- Смена статуса заказа
- ? Начисление баллов пользователю
- ? Отзывы о заведении
- Страница заведения с выводом товаров
- Главная страница с фильтром по заведениям
- Создать несколько типов акций - "Скидка за набор из 3х штук", "3 штуки за ххх рублей", "ххх в подарок при покупке yyy", "ххх в подарок при покупке от ххх руб"


Структура сайта-витрины
Главная:
Акции
[ ххх ] [ ххх ] [ ххх ] [ ххх ] 

Фильтр заведений по категориям еды
[ ххх ] [ ххх ] [ ххх ] [ ххх ] 

Рестораны
  ресторан
   - название
   - примеры товаров, может быть акции какие-то




Функции Супер-админа

Видеть списком:
 - Пользователи-партнеры
 - Заведения
 - Пользователи-покупатели
 - Заказы

Редактирование элементов:
 - Пользователь-партнер
 - Пользователь-покупатель
 - Заведение
 - Заказ

Отображение истории изменений - чтобы проследить кто/что/когда изменял






Фишечки:
- проверка размера картинки/акции товара при загрузке - чтобы нельзя было загрузить помойку
- привести номера заказов к удобному шаблону - привязать к дате
- При добавлении в корзину перенаправлять на страницу заведения, ковар которого добавлен


Оформление заказа
  - Телефон
  - Имя
  - Адрес
  -----
  - Статус заказа
  - Содержание заказа (товары, сумма, акции)

  Отдельная таблица order
  Отдельная таблица order_product
  Отдельная таблица order_delivery

  ? взаимоотношения заказов с Организациями.. Видимо 1 заказ = 1 организация
  ? Где хранить константы со статусами заказа


Акции

  Подарок при покупке от ххх рублей
   - Предложить пользователю какой-то подарок. Можно несколько вариантов, (? не больше 5 вариантов)
   - Действует ли акция в сочетании с другими акциями? Видимо нет..
   - заполняемые поля админом:
      - от скольки рублей подарок
      - какие товары нужно исключить из рассчета минимальной суммы
      - Какие товары будут идти в подарок

  Подарок при покупке определеного товара (1 или нескольких)

  3/4/5/... Элементов за ХХХ рублей
   - Какие именно товары могут участвовать в акции
   - ? Можно ли выбрать все одинаковые. Наверно да.
   - заполняемые поля админом:
      - Кол-во элементов
      - Стоимость
      - Какие товары участвуют (с возможностью указать правило, например "все пиццы такого-то размера")
      - Товары исключения (Актуально при указании не просто списка товаров, а правила)
   - Нюанс. Допустим у нас есть в корзине 4 пиццы, 3 из которых попадают в акцию, и еще есть четвертая. Та, что выбивается за пределы акции должна быть самой дешевой, чтобы не провацировать пользователя делать отдельный заказ, или просто чтобы не было негатива.

  Еще варианты акций:
   - 2 по цене 1 (то же самое, что и "подарок")
   - 3 по цене 2
   - Скидка до/после определенного времени
   - Скидка по промокоду
   - Скидка в определенные дни/день/диапозон дней

Механика работы:
  При добавлении товара в корзину система проверяет - есть ли в корзине товары, которые могут быть объединины в акционную комбинацию. Если комбинацию получается собрать, то выводится сообщение о том, что такие-то товары попадают под акцию. Соответственно меняется цена - цена итоговая уменьшаяется, при этом около сообщения о примененной акции добавляется сумма скидки, которая применена, а у товаров ценник не меняется

Пицца Такая             550 руб
Пицца Какая-то-другая   680 руб
Пицца Какая-то-еще      490 руб

Применяемые акции:
3 пиццы за 999 руб     -721 руб

Скидка:                 721 руб
Итого:                  999 руб


(Как вариант доработки - дать выбрать акцию, если товары подпадают под несколько акций сразу)


Еще можно выводить надпись типа "Чтобы получить ХХХ в подарок добавьте в корзину еще на ххх руб. (например, [ десерт, или товар из той же категории, которая уже есть а корзине, или то, что человек уже покупал, или то, что покупал и хорошо оценил ])"


Составное комбо (Хотя можно по началу не усложнять и комбо типа как просто товар чтобы было, но потом проблемы обратной совместимости будут)
  - Фиксированный набор уже существующих товаров объединен в комбо-набор, и дается скидка на него


Добавить категорию "скрытые товары", которые нельзя купить отдельно, но они могут быть в комбо-наборе, или быть подарком. Или технические штуки типа "Салфетки", "Имбирь" и пр.


4,49 130
2,43 70


? Система ачивок для постоянных покупателей. Например:
 - покупал в 3-5-7-.. заведениях
 - Оценил ХХХ товаров
 - воспользовался Такими-то акциями в заведении
 - В точности повторил свой заказ
 ...
