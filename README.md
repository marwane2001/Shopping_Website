<h1 align="center">🛒 Shopping Website Documentation 🛒</h1>

<p align="center">
  <img src="https://img.shields.io/badge/Project-Shopping%20Website-green" alt="Project Badge">
</p>

<h2>📋 Site Objective</h2>
<p>
  This shopping site allows users to browse and purchase products online. It offers features such as cart management, order processing, user authentication, and an admin panel.
</p>

<h2>🛠️ Technologies Used</h2>
<ul>
  <li><strong>Symfony</strong>: PHP framework for web development.</li>
  <li><strong>Twig</strong>: Template engine for PHP.</li>
  <li><strong>Bootstrap</strong>: CSS framework for a fast design.</li>
  <li><strong>Doctrine</strong>: ORM for database management.</li>
</ul>

<h2>⚙️ Installation and Configuration</h2>

<h3>📌 Pre-requirements</h3>
<ul>
  <li>PHP 8.0 or superior (currently working with PHP 8.2 bundled with XAMPP)</li>
  <li>Composer</li>
</ul>

<h3>📥 Installation</h3>
<pre>
<code>
git clone https://github.com/marwane2001/Shopping_Website.git
cd Shopping_Website
composer install
(configure the .env file according to your database)
php bin/console doctrine:database:create or symfony console d:d:c
php bin/console doctrine:migrations:migrate or symfony console d:m:m
symfony server:start
</code>
</pre>

<h2>🔗 Link</h2>
<p>
  <a href="https://shopping-webapp.reactive-chat.tech">https://shopping-webapp.reactive-chat.tech</a>
</p>

<h2>👤 Project Developer</h2>
<p>
  Marwane2001
</p>
