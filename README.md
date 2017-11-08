# Article-list

**Vytvorenie tabuĺky produktov**

```
CREATE TABLE `article` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `description` text,
  `id_manufacturer` int(11) DEFAULT NULL,
  `price` float NOT NULL DEFAULT '0' COMMENT 'Cena',
  `q` int(11) DEFAULT NULL COMMENT 'Pocet kusov',
  `time_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Cas pridania produktu',
  `is_public` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Verejny / Sukromny',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Vymazany',
  PRIMARY KEY (`id_article`)
);

```

Tabulka obsahuje iba nevyhnutné údaje. Je možné ju rozšíriť o ďalšie stĺpce.