
## Реализация ТЗ

1) Как основа реализации была создана artisan команда, которая, используя сервис, который работает с API, импортиртирует данные по ключевому слову с возможностью пагинации пришедшей информации.


2) Для добавления новой сущности для импорта и создания , достаточно :
- Создать соответствующий ресурс
- Создать таблицу в БД
- "Зарегистрировать" её в Enum файле, который перечисляет модели с которыми может работать
- Добавить front реализаци
