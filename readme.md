# portFolio Manager

Este es un proyecto académico de vinculación con una empresa que brinda servicios
a clientes como intermediario entre el cliente ejecutor de proyectos y consultores
especializados necesarios para la ejecución de proyectos. El desarrollo del
proyecto está a cargo del programa de Desarrollo de Negocios Web de la
Facultad de Ingeniería en Ciencias de la Computación del campus Sagrado Corazón
de Jesus.

Los componentes de este programa son:
  1. Esquema de Seguridad basado en Roles
  2. Definición y Gestión de Documentos por Portafolios
  3. Registro de Actividad de Documentos y Portafolios
  4. Alarmas basadas en documentos
  5. Control de Flujos por Documentos
  6. Control de Versión de Documentos
  7. Control de Consulta y Descarga de Documentos


 ## Requerimientos Técnicos para su Implementación

  1. Apache Web Server o Nginx
  2. PHP 5.6 o superior
  3. Mysql 5.5 o superior

## Instrucciones de Instalación en ubuntu server 16

  1. ```sudo apt-get update```
  2. ```sudo apt-get install apache2 mysql-server php php-mysql libapache2-mod-php```
  3. ```cd /var/www/html```
  4. ```git clone https://github.com/unicah/portfolioManager.git .```
  5. ```cd docs/scripts```
  6. ```mysql -u root -password=cambiaraqui portfoliomanager < 0*.sql```
  7. En el browser buscar la url http://ipohostname/setup.php
  8. Eliminar o quitar el script setup.php

  Puedes ver el video en https://youtu.be/uwqle5L2bGc

## Instrucciones de Instalación en WAMP server
  1. Instalar WAMP server
  2. Descargar del repositorio y descomprimirlo en la carpeta www
  3. correr en phpMyAdmin los scripts en la carpeta docs/scripts
  4. correr en el browser http://ipohostname/setup.php
