Реализация проекта "Рабочий стол"

Демо: http://test1.berlinsky.ru/

логин Alex
пароль 123456

Техзадание

Необходимо реализовать так называемый "рабочий стол", первый экран, который будет видеть пользователь некой системы после прохождения процедуры авторизации, на который в режиме реального времени будет выводиться информация по событиям, произошедшим в этой некой системе. За события в данном случае можно взять все события CRUD какой-либо сущности этой системы.

 Предположим, что нас интересует сущность "клиент", у которого есть имя, фамилия, e-mail, возраст, дата рождения. На рабочий стол в таком случае в режиме реального времени должна выводиться информация при изменении какой-либо информации в карточке клиента, при удалении клиента, при добавлении клиента и при просмотре клиента.
Реализация как сущности, CRUD сущности, так и рабочего стола - Yii2 framework, СУБД - любая, поддерживаемая Yii2.

 На данный рабочий стол при наступлении события мы выводим:
 тип события;
 кто произвёл это событие (т.е. пользователю необходимо быть авторизированным в системе, для возможности работы с клиентами и просмотра рабочего стола);
что именно изменилось, если событие заключалось в изменении.
