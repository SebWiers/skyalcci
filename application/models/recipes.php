<?php
/*
 * Queries used to set up recipes table:
CREATE TABLE effects (
  id int(1) unsigned NOT NULL,
  `name` char(40) NOT NULL,
  harmful tinyint(1) unsigned NOT NULL,
  restoration tinyint(1) unsigned NOT NULL DEFAULT '0',
  val smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (id),
  KEY `restore` (restoration),
  KEY harmful (harmful)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE ingredients (
  id char(8) NOT NULL COMMENT '8 digit hex from game',
  `name` char(40) NOT NULL,
  weight char(5) NOT NULL,
  `value` int(2) unsigned NOT NULL,
  quest tinyint(1) unsigned NOT NULL DEFAULT '0',
  game tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  KEY `release` (game),
  KEY quest (quest)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE games (
  id tinyint(1) unsigned NOT NULL,
  game varchar(32) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY game (game)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

 CREATE TABLE ing_eff (
  eff_id tinyint(3) unsigned NOT NULL,
  ing_id char(8) NOT NULL,
  mag_mult decimal(5,2) DEFAULT '1.00',
  val_mod decimal(5,2) DEFAULT '1.00',
  eff_num tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (eff_id,ing_id),
  KEY val_mod (val_mod),
  KEY ing_id (ing_id),
  KEY eff_id (eff_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE recipes (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  ing1 varchar(8) NOT NULL,
  ing2 varchar(8) NOT NULL,
  ing3 varchar(8) DEFAULT NULL,
  benefit_val double unsigned DEFAULT NULL,
  restore_val double unsigned DEFAULT NULL,
  harm_val double unsigned DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY ing_combo (ing1,ing2,ing3),
  KEY ing2 (ing2),
  KEY ing3 (ing3),
  KEY ing1 (ing1),
  KEY benefit_val (benefit_val),
  KEY restore_val (restore_val),
  KEY harm_val (harm_val)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE recipe_effect (
  recipe_id mediumint(8) unsigned NOT NULL,
  eff_id tinyint(3) unsigned NOT NULL,
  UNIQUE KEY recipe_id (recipe_id,eff_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE recipe_effect_distinct (
  recipe_id mediumint(8) unsigned NOT NULL,
  eff_id tinyint(3) unsigned NOT NULL,
  UNIQUE KEY recipe_id (recipe_id,eff_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE recipe_eff_count (
  recipe_id mediumint(8) unsigned NOT NULL,
  eff123 tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (recipe_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE settings (
  id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `hash` varchar(64) NOT NULL,
  min_effs varchar(64) NOT NULL DEFAULT '',
  ing_num varchar(64) NOT NULL DEFAULT '',
  inventory varchar(4096) NOT NULL DEFAULT '',
  pref_ings varchar(4096) NOT NULL DEFAULT '',
  pref_ings_use varchar(64) NOT NULL DEFAULT '',
  pref_effs varchar(1024) NOT NULL DEFAULT '',
  pref_effs_use varchar(64) NOT NULL DEFAULT '',
  excl_effs varchar(1024) NOT NULL DEFAULT '',
  PRIMARY KEY (id),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE waste_recipes (
  recipe_id mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO effects (id, `name`, harmful, restoration, val) VALUES
(0, 'Cure Disease', 0, 0, 21),
(1, 'Damage Health', 1, 0, 3),
(2, 'Damage Magicka', 1, 0, 52),
(3, 'Damage Magicka Regen', 1, 0, 265),
(4, 'Damage Stamina', 1, 0, 43),
(5, 'Damage Stamina Regen', 1, 0, 159),
(6, 'Fear', 1, 0, 120),
(7, 'Fortify Alteration', 0, 0, 47),
(8, 'Fortify Barter', 0, 0, 48),
(9, 'Fortify Block', 0, 0, 118),
(10, 'Fortify Carry Weight', 0, 0, 208),
(11, 'Fortify Conjuration', 0, 0, 75),
(12, 'Fortify Destruction', 0, 0, 151),
(13, 'Fortify Enchanting', 0, 0, 14),
(14, 'Fortify Health', 0, 0, 82),
(15, 'Fortify Heavy Armor', 0, 0, 55),
(16, 'Fortify Illusion', 0, 0, 94),
(17, 'Fortify Light Armor', 0, 0, 55),
(18, 'Fortify Lockpicking', 0, 0, 25),
(19, 'Fortify Magicka', 0, 0, 71),
(20, 'Fortify Marksman', 0, 0, 118),
(21, 'Fortify One-handed', 0, 0, 118),
(22, 'Fortify Pickpocket', 0, 0, 118),
(23, 'Fortify Restoration', 0, 0, 118),
(24, 'Fortify Smithing', 0, 0, 82),
(25, 'Fortify Sneak', 0, 0, 118),
(26, 'Fortify Stamina', 0, 0, 71),
(27, 'Fortify Two-handed', 0, 0, 118),
(28, 'Frenzy', 1, 0, 107),
(29, 'Invisibility', 0, 0, 261),
(30, 'Lingering Damage Health', 1, 0, 86),
(31, 'Lingering Damage Magicka', 1, 0, 71),
(32, 'Lingering Damage Stamina', 1, 0, 12),
(33, 'Paralysis', 1, 0, 285),
(34, 'Ravage Health', 1, 0, 6),
(35, 'Ravage Magicka', 1, 0, 15),
(36, 'Ravage Stamina', 1, 0, 24),
(37, 'Regenerate Health', 0, 0, 177),
(38, 'Regenerate Magicka', 0, 0, 177),
(39, 'Regenerate Stamina', 0, 0, 177),
(40, 'Resist Fire', 0, 0, 86),
(41, 'Resist Frost', 0, 0, 86),
(42, 'Resist Magic', 0, 0, 51),
(43, 'Resist Poison', 0, 0, 118),
(44, 'Resist Shock', 0, 0, 86),
(45, 'Restore Health', 0, 1, 21),
(46, 'Restore Magicka', 0, 1, 25),
(47, 'Restore Stamina', 0, 1, 25),
(48, 'Slow', 1, 0, 247),
(49, 'Waterbreathing', 0, 0, 100),
(50, 'Weakness to Fire', 1, 0, 48),
(51, 'Weakness to Frost', 1, 0, 40),
(52, 'Weakness to Magic', 1, 0, 51),
(53, 'Weakness to Poison', 1, 0, 51),
(54, 'Weakness to Shock', 1, 0, 56);

INSERT INTO games (id, game) VALUES
(1, 'Dawnguard'),
(0, 'Skyrim');

INSERT INTO ingredients (id, `name`, weight, `value`, quest, game) VALUES
('000134aa', 'Thistle Branch', '0.1', 1, 0, 0),
('0001b3bd', 'Snowberries', '0.1', 4, 0, 0),
('0001bcbc', 'Jarrin Root', '0.5', 10, 1, 0),
('00023d6f', 'Pine Thrush Egg', '0.5', 2, 0, 0),
('00023d77', 'Chicken`s Egg', '0.5', 2, 0, 0),
('0002f44c', 'Nightshade', '0.1', 8, 0, 0),
('00034cdd', 'Bone Meal', '0.5', 5, 0, 0),
('00034cdf', 'Salt Pile', '0.2', 2, 0, 0),
('00034d22', 'Garlic', '0.25', 1, 0, 0),
('00034d31', 'Elves Ear', '0.1', 10, 0, 0),
('00034d32', 'Frost Mirriam', '0.1', 1, 0, 0),
('0003ad56', 'Chaurus Eggs', '0.2', 10, 0, 0),
('0003ad5b', 'Daedra Heart', '0.5', 250, 0, 0),
('0003ad5d', 'Falmer Ear', '0.2', 10, 0, 0),
('0003ad5e', 'Fire Salts', '0.25', 50, 0, 0),
('0003ad5f', 'Frost Salts', '0.25', 100, 0, 0),
('0003ad60', 'Void Salts', '0.2', 125, 0, 0),
('0003ad61', 'Briar Heart', '0.5', 20, 0, 0),
('0003ad63', 'Ectoplasm', '0.1', 25, 0, 0),
('0003ad64', 'Giant`s Toe', '1', 20, 0, 0),
('0003ad66', 'Hagraven Feathers', '0.1', 20, 0, 0),
('0003ad6a', 'Ice Wraith Teeth', '0.25', 30, 0, 0),
('0003ad6f', 'Skeever Tail', '0.2', 3, 0, 0),
('0003ad70', 'Slaughterfish Scales', '0.1', 3, 0, 0),
('0003ad71', 'Taproot', '0.5', 15, 0, 0),
('0003ad72', 'Troll Fat', '1', 15, 0, 0),
('0003ad73', 'Glow Dust', '0.5', 20, 0, 0),
('0003ad76', 'Vampire Dust', '0.2', 25, 0, 0),
('0003f7f8', 'Tundra Cotton', '0.1', 1, 0, 0),
('00045c28', 'Lavender', '0.1', 1, 0, 0),
('0004b0ba', 'Wheat', '0.1', 5, 0, 0),
('0004da00', 'Fly Amanita', '0.1', 2, 0, 0),
('0004da20', 'Bleeding Crown', '0.3', 10, 0, 0),
('0004da22', 'White Cap', '0.3', 0, 0, 0),
('0004da23', 'Imp Stool', '0.3', 0, 0, 0),
('0004da24', 'Namira`s Rot', '0.25', 0, 0, 0),
('0004da25', 'Blisterwort', '0.2', 12, 0, 0),
('0004da73', 'Torchbug Thorax', '0.1', 1, 0, 0),
('0005076e', 'Juniper Berries', '0.1', 1, 0, 0),
('000516c8', 'Deathbell', '0.1', 4, 0, 0),
('00052695', 'Charred Skeever Hide', '0.5', 1, 0, 0),
('00057f91', 'Hanging Moss', '0.25', 1, 0, 0),
('00059b86', 'Nirnroot', '0.2', 10, 0, 0),
('00063b5f', 'Spriggan Sap', '0.2', 15, 0, 0),
('0006abcb', 'Canis Root', '0.1', 5, 0, 0),
('0006ac4a', 'Jazbay Grapes', '0.2', 1, 0, 0),
('0006b689', 'Hagraven Claw', '0.25', 20, 0, 0),
('0006bc00', 'Mudcrab Chitin', '0.25', 2, 0, 0),
('0006bc02', 'Bear Claws', '0.1', 2, 0, 0),
('0006bc04', 'Sabre Cat Tooth', '0.1', 2, 0, 0),
('0006bc07', 'Eye of Sabre Cat', '0.1', 2, 0, 0),
('0006bc0a', 'Large Antlers', '0.1', 2, 0, 0),
('0006bc0b', 'Small Antlers', '0.1', 2, 0, 0),
('0006bc0e', 'Wisp Wrappings', '0.1', 2, 0, 0),
('0006bc10', 'Powdered Mammoth Tusk', '0.1', 2, 1, 0),
('0006f950', 'Scaly Pholiota', '0.25', 4, 0, 0),
('000705b7', 'Berit`s Ashes', '0.2', 5, 1, 0),
('000727de', 'Blue Butterfly Wing', '0.1', 2, 0, 0),
('000727df', 'Luna Moth Wing', '0.1', 5, 0, 0),
('000727e0', 'Butterfly Wing', '0.1', 3, 0, 0),
('00077e1c', 'Blue Mountain Flower', '0.1', 2, 0, 0),
('00077e1d', 'Red Mountain Flower', '0.1', 2, 0, 0),
('00077e1e', 'Purple Mountain Flower', '0.1', 2, 0, 0),
('0007e8b7', 'Swamp Fungal Pod', '0.25', 5, 0, 0),
('0007e8c1', 'Giant Lichen', '0.25', 5, 0, 0),
('0007e8c5', 'Slaughterfish Egg', '0.2', 3, 0, 0),
('0007e8c8', 'Rock Warbler Egg', '0.5', 2, 0, 0),
('0007edf5', 'Nordic Barnacle', '0.2', 5, 0, 0),
('0007ee01', 'Glowing Mushroom', '0.2', 5, 0, 0),
('00083e64', 'Grass Pod', '0.1', 1, 0, 0),
('000854fe', 'Pearl', '0.1', 2, 0, 0),
('00085500', 'Small Pearl', '0.1', 2, 0, 0),
('000889a2', 'Dragon`s Tongue', '0.1', 5, 0, 0),
('0009151b', 'Spider Egg', '0.2', 5, 0, 0),
('000a9191', 'Beehive Husk', '1', 5, 0, 0),
('000a9195', 'Bee', '0.1', 3, 0, 0),
('000b08c5', 'Honeycomb', '1', 5, 0, 0),
('000b18cd', 'Human Heart', '1', 0, 0, 0),
('000b2183', 'Creep Cluster', '0.2', 1, 0, 0),
('000b701a', 'Crimson Nirnroot', '0.2', 10, 1, 0),
('000bb956', 'Orange Dartwing', '0.1', 1, 0, 0),
('000d8e3f', 'Moon Sugar', '0.25', 50, 0, 0),
('000e4f0c', 'Blue Dartwing', '0.1', 1, 0, 0),
('000e7ebc', 'Hawk Beak', '0.25', 15, 0, 0),
('000e7ed0', 'Hawk Feathers', '0.1', 15, 0, 0),
('000ec870', 'Mora Tapinella', '0.25', 4, 0, 0),
('000f11c0', 'Dwarven Oil', '0.25', 15, 0, 0),
('001016b3', 'Human Flesh', '0.25', 1, 0, 0),
('00106e18', 'Histcarp', '0.25', 6, 0, 0),
('00106e19', 'Cyrodilic Spadetail', '0.25', 15, 0, 0),
('00106e1a', 'River Betty', '0.25', 15, 0, 0),
('00106e1b', 'Abecean Longfin', '0.5', 15, 0, 0),
('00106e1c', 'Silverside Perch', '0.25', 15, 0, 0),
('02002a78', 'Yellow Mountain Flower', '0.1', 2, 0, 1),
('020059ba', 'Ancestor Moth Wing', '0.1', 2, 0, 1),
('0200b097', 'Gleamblossom', '0.1', 5, 0, 1),
('020183b7', 'Chaurus Hunter Antennae', '0.1', 2, 0, 1),
('020185fb', 'Poison Bloom', '0.25', 5, 0, 1);

INSERT INTO ing_eff (eff_id, ing_id, mag_mult, val_mod, eff_num) VALUES
(0, '0003ad76', NULL, NULL, 4),
(0, '00052695', NULL, 0.36, 2),
(0, '0006bc00', NULL, NULL, 2),
(0, '000e7ed0', NULL, 0.36, 1),
(1, '0001bcbc', 100.00, NULL, 1),
(1, '0002f44c', NULL, NULL, 1),
(1, '0003ad5d', NULL, NULL, 1),
(1, '0003ad60', NULL, NULL, 3),
(1, '0003ad63', NULL, NULL, 4),
(1, '0003ad6f', NULL, NULL, 3),
(1, '0003ad72', NULL, NULL, 4),
(1, '0004da23', NULL, NULL, 1),
(1, '000516c8', 1.50, NULL, 1),
(1, '00059b86', NULL, 12.60, 1),
(1, '0006bc0b', NULL, NULL, 4),
(1, '00077e1d', NULL, NULL, 4),
(1, '000b18cd', NULL, NULL, 1),
(1, '000b701a', 3.00, NULL, 1),
(1, '001016b3', NULL, NULL, 1),
(1, '00106e1a', 2.50, NULL, 1),
(1, '020185fb', NULL, NULL, 1),
(2, '0001bcbc', NULL, NULL, 2),
(2, '0003ad56', NULL, NULL, 3),
(2, '0003ad5b', NULL, NULL, 3),
(2, '0003ad66', NULL, NULL, 1),
(2, '0003ad73', NULL, NULL, 1),
(2, '0004da24', NULL, NULL, 1),
(2, '00057f91', NULL, NULL, 1),
(2, '0006bc07', NULL, NULL, 3),
(2, '000727df', NULL, NULL, 1),
(2, '000727e0', NULL, NULL, 4),
(2, '0007edf5', NULL, NULL, 1),
(2, '000b18cd', NULL, NULL, 2),
(3, '0001bcbc', NULL, NULL, 4),
(3, '00023d77', NULL, NULL, 2),
(3, '0002f44c', NULL, NULL, 2),
(3, '0003ad73', NULL, NULL, 2),
(3, '00057f91', NULL, NULL, 3),
(3, '00063b5f', NULL, NULL, 1),
(3, '0006bc02', NULL, NULL, 4),
(3, '000727de', NULL, NULL, 3),
(3, '00077e1c', NULL, NULL, 4),
(3, '0009151b', NULL, NULL, 2),
(3, '000b18cd', NULL, NULL, 3),
(3, '020059ba', NULL, NULL, 3),
(3, '020183b7', NULL, NULL, 3),
(4, '0001bcbc', NULL, NULL, 3),
(4, '00034cdd', NULL, NULL, 1),
(4, '0003ad64', NULL, NULL, 1),
(4, '0004da25', NULL, NULL, 1),
(4, '00059b86', 3.00, NULL, 2),
(4, '0006abcb', NULL, NULL, 1),
(4, '000705b7', NULL, NULL, 1),
(4, '000727de', NULL, NULL, 1),
(4, '0007e8c8', NULL, NULL, 3),
(4, '0009151b', NULL, NULL, 1),
(4, '000b701a', NULL, NULL, 2),
(4, '00106e19', NULL, NULL, 1),
(4, '020059ba', NULL, NULL, 1),
(4, '020183b7', NULL, NULL, 1),
(5, '00034d32', NULL, NULL, 4),
(5, '0003ad5b', NULL, NULL, 2),
(5, '0003ad64', NULL, NULL, 4),
(5, '0003ad6f', NULL, NULL, 1),
(5, '0004b0ba', NULL, NULL, 3),
(5, '0005076e', NULL, NULL, 4),
(5, '0006bc0a', NULL, NULL, 4),
(5, '000b2183', NULL, NULL, 2),
(5, '00106e18', NULL, NULL, 3),
(5, '00106e1c', NULL, NULL, 2),
(5, '02002a78', NULL, NULL, 4),
(6, '0003ad5b', NULL, NULL, 4),
(6, '0004da24', NULL, NULL, 3),
(6, '0006bc10', NULL, NULL, 4),
(6, '000e4f0c', NULL, NULL, 4),
(6, '00106e19', NULL, NULL, 3),
(6, '0200b097', NULL, NULL, 2),
(6, '020185fb', NULL, NULL, 4),
(7, '00063b5f', NULL, NULL, 4),
(7, '00083e64', NULL, NULL, 3),
(7, '00106e1a', NULL, NULL, 2),
(8, '0003f7f8', NULL, NULL, 4),
(8, '0006b689', NULL, NULL, 4),
(8, '000727e0', NULL, NULL, 2),
(8, '000889a2', NULL, NULL, 2),
(9, '0003ad61', 0.50, NULL, 2),
(9, '0003ad70', NULL, NULL, 4),
(9, '0003f7f8', NULL, NULL, 3),
(9, '0004da20', NULL, NULL, 2),
(9, '000854fe', NULL, NULL, 2),
(9, '000b08c5', 0.50, NULL, 2),
(10, '0003ad64', NULL, NULL, 3),
(10, '0006bc0e', NULL, NULL, 3),
(10, '0006f950', NULL, NULL, 4),
(10, '000b2183', NULL, NULL, 3),
(10, '000e7ebc', NULL, NULL, 3),
(10, '00106e1a', NULL, NULL, 4),
(10, '020185fb', NULL, NULL, 3),
(11, '00034cdd', NULL, NULL, 3),
(11, '0003ad5f', NULL, NULL, 4),
(11, '0003ad66', NULL, NULL, 2),
(11, '00045c28', NULL, NULL, 4),
(11, '000705b7', NULL, NULL, 3),
(11, '000727de', NULL, NULL, 2),
(11, '00077e1c', NULL, NULL, 2),
(11, '020059ba', NULL, NULL, 2),
(11, '020183b7', NULL, NULL, 2),
(12, '0002f44c', 0.80, NULL, 4),
(12, '0003ad63', 0.80, NULL, 2),
(12, '0003ad73', NULL, NULL, 3),
(12, '0006bc0e', NULL, NULL, 2),
(12, '0007ee01', NULL, NULL, 2),
(12, '000a9191', NULL, NULL, 4),
(13, '0001b3bd', NULL, NULL, 2),
(13, '00063b5f', NULL, NULL, 2),
(13, '0006b689', NULL, NULL, 3),
(13, '000727de', NULL, NULL, 4),
(13, '020059ba', NULL, NULL, 4),
(13, '020183b7', NULL, NULL, 4),
(14, '0003ad64', NULL, 5.90, 2),
(14, '0004b0ba', NULL, NULL, 2),
(14, '00057f91', NULL, NULL, 2),
(14, '0006bc02', NULL, NULL, 2),
(14, '00077e1c', NULL, NULL, 3),
(14, '0007ee01', NULL, NULL, 4),
(14, '02002a78', NULL, NULL, 3),
(15, '000134aa', NULL, NULL, 4),
(15, '0003ad6a', NULL, NULL, 2),
(15, '0003ad70', NULL, NULL, 3),
(15, '0004da22', NULL, NULL, 2),
(15, '0006bc04', NULL, NULL, 2),
(16, '0003ad71', NULL, NULL, 2),
(16, '0006f950', NULL, NULL, 2),
(16, '000889a2', NULL, NULL, 3),
(16, '000ec870', NULL, NULL, 4),
(16, '000f11c0', NULL, NULL, 2),
(17, '0003ad6f', NULL, NULL, 4),
(17, '000727df', NULL, NULL, 2),
(17, '000a9191', NULL, NULL, 2),
(17, '000b08c5', NULL, NULL, 3),
(17, '000e7ed0', NULL, NULL, 2),
(18, '00023d6f', NULL, NULL, 2),
(18, '0003ad5d', NULL, NULL, 4),
(18, '0004da24', NULL, NULL, 2),
(18, '0009151b', NULL, NULL, 3),
(19, '0003ad60', NULL, NULL, 4),
(19, '0003ad61', NULL, NULL, 4),
(19, '0003ad63', NULL, NULL, 3),
(19, '0003f7f8', NULL, NULL, 2),
(19, '0006ac4a', NULL, NULL, 2),
(19, '00077e1d', NULL, NULL, 3),
(19, '00106e18', NULL, NULL, 2),
(20, '00034d31', NULL, NULL, 2),
(20, '0005076e', NULL, NULL, 2),
(20, '0006abcb', NULL, NULL, 3),
(20, '0009151b', NULL, NULL, 4),
(21, '00057f91', NULL, NULL, 4),
(21, '0006abcb', NULL, NULL, 2),
(21, '0006bc02', NULL, NULL, 3),
(21, '0007e8c8', NULL, NULL, 2),
(21, '00085500', NULL, NULL, 2),
(21, '000e7ed0', NULL, NULL, 3),
(22, '0007e8c5', NULL, NULL, 2),
(22, '0007edf5', NULL, NULL, 4),
(22, '000bb956', NULL, NULL, 3),
(22, '000e4f0c', NULL, NULL, 2),
(23, '00034cdf', NULL, NULL, 2),
(23, '0006bc0b', NULL, NULL, 2),
(23, '00085500', NULL, NULL, 3),
(23, '00106e19', NULL, NULL, 2),
(23, '00106e1b', NULL, NULL, 4),
(23, '02002a78', NULL, NULL, 2),
(24, '0004da25', NULL, NULL, 4),
(24, '00063b5f', NULL, NULL, 3),
(24, '0006bc04', NULL, NULL, 3),
(24, '0007ee01', NULL, NULL, 3),
(25, '00034d32', NULL, NULL, 2),
(25, '0006bc10', NULL, NULL, 2),
(25, '00077e1e', NULL, NULL, 2),
(25, '000a9191', NULL, NULL, 3),
(25, '000e7ed0', NULL, NULL, 4),
(25, '001016b3', NULL, NULL, 4),
(25, '00106e1b', NULL, NULL, 2),
(26, '00034d22', NULL, NULL, 2),
(26, '0003ad56', NULL, NULL, 2),
(26, '00045c28', NULL, NULL, 2),
(26, '0004da73', NULL, NULL, 4),
(26, '0006bc0a', NULL, NULL, 2),
(26, '0007e8c5', NULL, NULL, 4),
(27, '0003ad72', NULL, NULL, 2),
(27, '0004da00', NULL, NULL, 2),
(27, '000889a2', NULL, NULL, 4),
(28, '0003ad5d', NULL, NULL, 2),
(28, '0003ad66', NULL, NULL, 3),
(28, '0003ad72', NULL, NULL, 3),
(28, '0004da00', NULL, NULL, 3),
(28, '0004da25', NULL, NULL, 2),
(28, '000b18cd', NULL, NULL, 4),
(29, '0003ad56', NULL, NULL, 4),
(29, '0003ad6a', NULL, NULL, 3),
(29, '0003ad76', NULL, NULL, 1),
(29, '00059b86', NULL, NULL, 3),
(29, '000727df', NULL, NULL, 4),
(29, '000b701a', NULL, NULL, 3),
(30, '0003ad70', NULL, NULL, 2),
(30, '0004da23', NULL, NULL, 2),
(30, '0007e8c5', NULL, NULL, 3),
(30, '000bb956', NULL, NULL, 4),
(30, '000ec870', NULL, NULL, 2),
(31, '0004b0ba', NULL, NULL, 4),
(31, '0004da73', NULL, NULL, 2),
(31, '0006b689', NULL, NULL, 2),
(31, '00077e1e', NULL, NULL, 3),
(31, '0007e8b7', NULL, NULL, 2),
(32, '00023d77', NULL, NULL, 4),
(32, '0002f44c', NULL, NULL, 3),
(32, '0006bc0b', NULL, NULL, 3),
(32, '000727e0', NULL, NULL, 3),
(33, '0003ad61', NULL, NULL, 3),
(33, '0004da23', NULL, NULL, 3),
(33, '0006abcb', NULL, NULL, 4),
(33, '0007e8b7', NULL, NULL, 3),
(33, '001016b3', NULL, NULL, 2),
(33, '0200b097', NULL, NULL, 4),
(34, '0003ad6f', NULL, NULL, 2),
(34, '0006ac4a', NULL, NULL, 4),
(34, '0006bc07', NULL, NULL, 2),
(34, '0007e8c1', NULL, NULL, 2),
(34, '00106e19', NULL, NULL, 4),
(34, '00106e1c', NULL, NULL, 3),
(35, '00034d32', NULL, NULL, 3),
(35, '00045c28', NULL, NULL, 3),
(35, '0004da22', NULL, NULL, 4),
(35, '00077e1d', NULL, NULL, 2),
(35, '00083e64', NULL, NULL, 2),
(35, '000bb956', NULL, NULL, 2),
(36, '000134aa', NULL, NULL, 2),
(36, '00034cdd', NULL, NULL, 4),
(36, '000516c8', NULL, 2.10, 2),
(36, '000705b7', NULL, NULL, 4),
(36, '000a9195', NULL, NULL, 2),
(36, '000b08c5', NULL, NULL, 4),
(37, '00034d22', NULL, NULL, 4),
(37, '0003ad76', NULL, NULL, 3),
(37, '0004da24', NULL, NULL, 4),
(37, '0005076e', NULL, NULL, 3),
(37, '000727df', NULL, NULL, 3),
(37, '0007edf5', NULL, NULL, 3),
(37, '0200b097', NULL, NULL, 3),
(38, '00034cdf', NULL, NULL, 4),
(38, '00034d22', NULL, NULL, 3),
(38, '0003ad5e', NULL, NULL, 4),
(38, '0003ad71', NULL, NULL, 3),
(38, '0006ac4a', NULL, NULL, 3),
(38, '000d8e3f', NULL, NULL, 4),
(38, '000f11c0', NULL, NULL, 3),
(39, '0004da00', NULL, NULL, 4),
(39, '0006f950', NULL, NULL, 3),
(39, '000a9195', NULL, NULL, 3),
(39, '000ec870', NULL, NULL, 3),
(40, '0001b3bd', NULL, NULL, 1),
(40, '00034cdd', NULL, NULL, 2),
(40, '00034d31', NULL, NULL, 4),
(40, '0003ad5e', NULL, NULL, 2),
(40, '0004da00', NULL, NULL, 1),
(40, '0006bc00', NULL, NULL, 4),
(40, '000705b7', NULL, NULL, 2),
(40, '000889a2', NULL, NULL, 1),
(41, '000134aa', NULL, NULL, 1),
(41, '0001b3bd', NULL, NULL, 3),
(41, '00034d32', NULL, NULL, 1),
(41, '0003ad5f', NULL, NULL, 2),
(41, '0003ad70', NULL, NULL, 1),
(41, '00077e1e', NULL, NULL, 4),
(41, '00085500', NULL, NULL, 4),
(41, '000d8e3f', NULL, NULL, 2),
(41, '000e7ebc', NULL, NULL, 2),
(41, '00106e1c', NULL, NULL, 4),
(42, '00023d77', NULL, NULL, 1),
(42, '0003ad60', NULL, NULL, 2),
(42, '0003f7f8', NULL, NULL, 1),
(42, '00045c28', NULL, NULL, 1),
(42, '0004da20', NULL, NULL, 4),
(42, '00059b86', NULL, NULL, 4),
(42, '0006b689', NULL, NULL, 1),
(42, '0006bc0e', NULL, NULL, 4),
(42, '000b701a', NULL, NULL, 4),
(42, '0200b097', NULL, NULL, 1),
(43, '000134aa', 0.75, NULL, 3),
(43, '00034d22', NULL, NULL, 1),
(43, '0003ad5d', NULL, NULL, 3),
(43, '0003ad72', NULL, NULL, 1),
(43, '00052695', NULL, NULL, 3),
(43, '0006bc00', NULL, NULL, 3),
(43, '0007e8c5', NULL, NULL, 1),
(43, '00083e64', NULL, NULL, 1),
(43, '000a9191', 0.50, NULL, 1),
(43, '02002a78', NULL, NULL, 1),
(44, '0001b3bd', NULL, NULL, 4),
(44, '00023d6f', NULL, NULL, 4),
(44, '0003ad73', NULL, NULL, 4),
(44, '0007e8b7', NULL, NULL, 1),
(44, '0007ee01', NULL, NULL, 1),
(44, '000854fe', NULL, NULL, 4),
(44, '000e4f0c', NULL, NULL, 1),
(44, '000e7ebc', NULL, NULL, 4),
(45, '0003ad5b', NULL, NULL, 1),
(45, '0004b0ba', NULL, NULL, 1),
(45, '0004da23', 0.60, NULL, 4),
(45, '0004da25', 0.60, NULL, 3),
(45, '00052695', NULL, NULL, 4),
(45, '0006bc07', NULL, NULL, 4),
(45, '000727e0', NULL, NULL, 1),
(45, '00077e1c', NULL, NULL, 1),
(45, '0007e8b7', NULL, NULL, 4),
(45, '0007e8c8', NULL, NULL, 1),
(45, '000e4f0c', NULL, NULL, 3),
(46, '00034d31', NULL, NULL, 1),
(46, '0003ad5e', NULL, NULL, 3),
(46, '0003ad5f', NULL, NULL, 3),
(46, '0003ad61', NULL, NULL, 1),
(46, '0003ad63', NULL, NULL, 1),
(46, '0003ad71', NULL, NULL, 4),
(46, '0003ad76', NULL, NULL, 2),
(46, '0004da22', NULL, NULL, 3),
(46, '00077e1d', NULL, NULL, 1),
(46, '0007e8c1', NULL, NULL, 4),
(46, '00083e64', NULL, NULL, 4),
(46, '000854fe', NULL, NULL, 3),
(46, '000b2183', NULL, NULL, 1),
(46, '000d8e3f', NULL, NULL, 3),
(46, '000ec870', NULL, NULL, 1),
(46, '000f11c0', NULL, NULL, 4),
(46, '001016b3', NULL, NULL, 3),
(47, '00023d6f', NULL, NULL, 1),
(47, '0004da73', NULL, NULL, 1),
(47, '00052695', NULL, NULL, 1),
(47, '0006bc00', NULL, NULL, 1),
(47, '0006bc02', NULL, NULL, 1),
(47, '0006bc04', NULL, NULL, 1),
(47, '0006bc07', NULL, NULL, 1),
(47, '0006bc0a', NULL, NULL, 1),
(47, '0006bc0e', NULL, NULL, 1),
(47, '0006bc10', NULL, NULL, 1),
(47, '00077e1e', NULL, NULL, 1),
(47, '000854fe', NULL, NULL, 1),
(47, '00085500', NULL, NULL, 1),
(47, '000a9195', NULL, NULL, 1),
(47, '000b08c5', NULL, NULL, 1),
(47, '000bb956', NULL, NULL, 1),
(47, '000e7ebc', NULL, NULL, 1),
(47, '00106e18', NULL, NULL, 1),
(47, '00106e1c', NULL, NULL, 1),
(48, '00034cdf', NULL, NULL, 3),
(48, '000516c8', NULL, NULL, 3),
(48, '0006bc0a', NULL, NULL, 3),
(48, '00106e1a', NULL, NULL, 3),
(48, '020185fb', NULL, NULL, 2),
(49, '00023d77', NULL, NULL, 3),
(49, '0007edf5', NULL, NULL, 2),
(49, '00106e18', NULL, NULL, 4),
(50, '0003ad5f', NULL, NULL, 1),
(50, '0003ad6a', NULL, NULL, 4),
(50, '0004da20', NULL, NULL, 1),
(50, '0005076e', NULL, NULL, 1),
(50, '0006bc10', NULL, NULL, 3),
(50, '000d8e3f', NULL, NULL, 1),
(51, '00034d31', NULL, NULL, 3),
(51, '0003ad5e', NULL, NULL, 1),
(51, '0003ad6a', NULL, NULL, 1),
(51, '0004da22', NULL, NULL, 1),
(51, '00106e1b', NULL, NULL, 1),
(52, '00034cdf', NULL, NULL, 1),
(52, '0003ad71', NULL, NULL, 1),
(52, '0004da73', NULL, NULL, 3),
(52, '0006ac4a', NULL, NULL, 1),
(52, '0006f950', NULL, NULL, 1),
(52, '0007e8c8', NULL, NULL, 4),
(52, '000b2183', NULL, NULL, 4),
(52, '000f11c0', NULL, NULL, 1),
(53, '00023d6f', NULL, NULL, 3),
(53, '0003ad56', NULL, NULL, 1),
(53, '0004da20', NULL, NULL, 3),
(53, '000516c8', NULL, NULL, 4),
(53, '0006bc04', NULL, NULL, 4),
(53, '0006bc0b', NULL, NULL, 1),
(53, '0007e8c1', NULL, NULL, 3),
(53, '00106e1b', NULL, NULL, 3),
(54, '0003ad60', NULL, NULL, 1),
(54, '0003ad66', NULL, NULL, 4),
(54, '0007e8c1', NULL, NULL, 1),
(54, '000a9195', NULL, NULL, 4);


INSERT INTO recipes (ing1, ing2)
SELECT DISTINCT i1.id, i2.id
FROM
ingredients i1 INNER JOIN ing_eff ie1 ON i1.id=ie1.ing_id
INNER JOIN
ingredients i2 INNER JOIN ing_eff ie2 ON i2.id=ie2.ing_id
WHERE ie1.eff_id = ie2.eff_id AND i1.id < i2.id ;

INSERT INTO recipes (ing1, ing2, ing3)
SELECT DISTINCT i1.id , i2.id , i3.id
FROM
ingredients i1 INNER JOIN ing_eff ie1 ON i1.id=ie1.ing_id
INNER JOIN
ingredients i2 INNER JOIN ing_eff ie2 ON i2.id=ie2.ing_id
INNER JOIN
ingredients i3 INNER JOIN ing_eff ie3 ON i3.id=ie3.ing_id
WHERE (ie1.eff_id = ie2.eff_id OR ie1.eff_id = ie3.eff_id OR  ie2.eff_id = ie3.eff_id ) AND i1.id < i2.id AND  i2.id < i3.id;


INSERT INTO recipe_effect (recipe_id, eff_id)
SELECT DISTINCT r.id, ie2.eff_id
FROM recipes r
INNER JOIN ing_eff ie2 ON r.ing2 = ie2.ing_id
INNER JOIN ing_eff ie1 ON r.ing1 = ie1.ing_id
WHERE ie1.eff_id = ie2.eff_id;

INSERT INTO recipe_effect (recipe_id, eff_id)
SELECT DISTINCT r.id, ie2.eff_id
FROM recipes r
INNER JOIN ing_eff ie2 ON r.ing2 = ie2.ing_id
INNER JOIN ing_eff ie3 ON r.ing3 = ie3.ing_id
WHERE ie3.eff_id = ie2.eff_id;

INSERT INTO recipe_effect (recipe_id, eff_id)
SELECT DISTINCT r.id, ie1.eff_id
FROM recipes r
INNER JOIN ing_eff ie3 ON r.ing3 = ie3.ing_id
INNER JOIN ing_eff ie1 ON r.ing1 = ie1.ing_id
WHERE ie3.eff_id = ie1.eff_id;


INSERT INTO recipe_effect_distinct recipe_id, eff_id SELECT DISTINCT recipe_id, eff_id FROM recipe_effect;

INSERT INTO recipe_eff_count (recipe_id, eff123) SELECT recipe_id, COUNT(eff_id) FROM recipe_effect_distinct GROUP BY recipe_id;

INSERT INTO waste_recipes (recipe_id)
SELECT DISTINCT  r1.id
FROM recipes r1 INNER JOIN recipes r2 ON r1.ing1 = r2.ing1 AND r1.ing2 = r2.ing2
INNER JOIN recipe_eff_count rec1 ON rec1.recipe_id = r1.id
INNER JOIN recipe_eff_count rec2 ON rec2.recipe_id = r2.id
WHERE r1.ing3 IS NOT NULL AND r2.ing3 IS NULL AND rec1.eff123 <= rec2.eff123
ORDER BY r1.id;

DELETE FROM recipes WHERE id IN (SELECT recipe_id FROM waste_recipes);


 UPDATE recipes r2 INNER JOIN
(SELECT t1.id recipe_id, SUM(t1.eff_value)  eff_value FROM
(SELECT r.id id,
COALESCE(max(ie.mag_mult),1) * COALESCE(max(ie.val_mod,1) * e.val AS eff_value
FROM recipes r
JOIN recipe_effect re ON r.id = re.recipe_id
JOIN effects e ON re.eff_id = e.id
JOIN ing_eff ie ON ie.eff_id = e.id AND ie.ing_id IN (r.ing1, r.ing2, r.ing3)
WHERE e.restoration
GROUP BY r.id, e.id)
t1
GROUP BY t1.id) t
ON t.recipe_id = r2.id
SET restore_val = eff_value;

 UPDATE recipes r2 INNER JOIN
(SELECT t1.id recipe_id, SUM(t1.eff_value) eff_value FROM
(SELECT r.id id,
COALESCE(max(ie.mag_mult),1) * COALESCE(max(ie.val_mod,1) * e.val AS eff_value
FROM recipes r
JOIN recipe_effect re ON r.id = re.recipe_id
JOIN effects e ON re.eff_id = e.id
JOIN ing_eff ie ON ie.eff_id = e.id AND ie.ing_id IN (r.ing1, r.ing2, r.ing3)
WHERE e.harmful
GROUP BY r.id, e.id)
t1
GROUP BY t1.id) t
ON t.recipe_id = r2.id
SET harm_val = eff_value;

 UPDATE recipes r2 INNER JOIN
(SELECT t1.id recipe_id, SUM(t1.eff_value)  eff_value FROM
(SELECT r.id id,
COALESCE(max(ie.mag_mult),1) * COALESCE(max(ie.val_mod,1) * e.val AS eff_value
FROM recipes r
JOIN recipe_effect re ON r.id = re.recipe_id
JOIN effects e ON re.eff_id = e.id
JOIN ing_eff ie ON ie.eff_id = e.id AND ie.ing_id IN (r.ing1, r.ing2, r.ing3)
WHERE !e.restoration AND !e.harmful
GROUP BY r.id, e.id)
t1
GROUP BY t1.id) t
ON t.recipe_id = r2.id
SET benefit_val = eff_value;

 */
function compare_recipes($a,$b){
		if ($a->total_value < $b->total_value) return 1;
		if ($a->total_value > $b->total_value) return -1;
		if (implode($a->ing_names) < implode($a->ing_names) ) return 1;
		if (implode($a->ing_names) > implode($a->ing_names) ) return -1;
		return 0;
	}

class Recipes extends CI_Model {

	function get_effect_counts(){
		$sql="
			SELECT eff_num eff_count, count(eff_num) recipe_count FROM (
			SELECT r.id, count(eff_id) eff_num FROM recipe_effect re
			INNER JOIN recipes r ON r.id = re.recipe_id
			GROUP BY r.id
			ORDER BY count(eff_id) desc
			) t GROUP BY eff_num ORDER BY eff_num desc
		";
		$query = $this->db->query($sql);
		foreach($query->result() as $row){
			$results[$row->eff_count] = $row->recipe_count;
		}
		return $results;
	}


	function get_recipes($wb){
		$select =
			"
			r.id, r.harm_val, r.benefit_val, r.restore_val, r.ing1, r.ing2, r.ing3
			, i1.name AS ingname1, i2.name AS ingname2, i3.name AS ingname3
			, COUNT(r.id) AS n " ;

		$from =
			"recipes r
			INNER JOIN recipe_effect re ON r.id = re.recipe_id
			INNER JOIN ingredients i1 ON i1.id = r.ing1
			INNER JOIN ingredients i2 ON i2.id = r.ing2
			LEFT JOIN ingredients i3 ON i3.id = r.ing3
			" ;

		$where = array();

		$where['ing_num'] = in_array(3, $wb['ing_num']) ? ' 2=2 ' : ' r.ing3 IS NULL ' ;

		$where_outer['min_effs'] = " n >= {$wb['min_effs']} " ;

		$wb['inventory'][] = '00000000' ;
		$inventory = implode( "','" , $wb['inventory']) ;
		$where['inventory'] =
			" r.ing1 IN ('$inventory') AND r.ing2 in ('$inventory') AND COALESCE(r.ing3,'00000000') IN ('$inventory') " ;

		$ip = implode( "','" , $wb['pref_ings']) ;
		$where['pref_ings']  = "(
			COALESCE( r.ing1 IN ('$ip') , 0 ) +
			COALESCE( r.ing2 IN ('$ip') , 0 ) +
			COALESCE( r.ing3 IN ('$ip') , 0 )
			>= {$wb['pref_ings_use']} )
			" ;
		$where['pref_ings_use'] = '1=1' ;

		$pe = implode( "','" , $wb['pref_effs']) ;
		if (strlen($pe)) $where['pref_effs'] = "re.eff_id IN ('$pe')" ;
		;
		$where_outer['pref_effs_use'] = " n >= {$wb['pref_effs_use']} " ;

		$xe =  implode( "','" , $wb['excl_effs']) ;
		$where['excl_effs'] =
			" r.id NOT IN (SELECT recipe_id FROM recipe_effect WHERE eff_id IN ('$xe') ) "
		;

		$where_sql = implode(' AND ' , $where);
		$where_outer_sql = implode(' AND ' , $where_outer);
		$group = " r.id " ;
		$order = "r.benefit_val + r.harm_val + r.restore_val " ;

		$sqlCount = " SELECT * FROM (SELECT $select FROM $from WHERE $where_sql GROUP BY $group)t WHERE $where_outer_sql ";
		$queryCount = $this->db->query($sqlCount);
		$count_result=  $queryCount->num_rows() ;
		if ( $count_result > 10000 ) return $count_result;

		$sql =
		" SELECT * FROM (SELECT $select FROM $from WHERE $where_sql GROUP BY $group ORDER BY $order)t WHERE $where_outer_sql ";
		//echo "<hr>$sql<hr>";
		$query = $this->db->query($sql);
		$result=array();
		foreach($query->result() as $row){
			$result[$row->id] = $row ; // object, so is refference
			$result[$row->id]->ing_names = array($row->ingname1, $row->ingname2, $row->ingname3);
			sort($result[$row->id]->ing_names);
			$result[$row->id]->ing_names = array_diff($result[$row->id]->ing_names, array(null));
			$result[$row->id]->ing_ids = array($row->ing1, $row->ing2, $row->ing3);
			$result[$row->id]->total_value = round($row->harm_val + $row->benefit_val + $row->restore_val) ;
			$result[$row->id]->potion = $row->benefit_val + $row->restore_val > $row->harm_val ;
			$result[$row->id]->poison = $row->benefit_val + $row->restore_val < $row->harm_val ;
			// clean up array entry; works because of reference
			unset($row->ingname1);unset($row->ingname2);unset($row->ingname3);
			unset($row->ing1);unset($row->ing2);unset($row->ing3);
			unset($row->harm_val); unset($row->benefit_val); unset($row->restore_val);
			unset($row->id); unset($row->n);

		}
		if(!empty($result)){
			$recipe_ids = implode(',' , array_keys($result) );
			$eff_sql =
			"
			SELECT r.id recipe, e.name, e.harmful
			, COALESCE(max(ie.mag_mult),1) AS mag_mult
			, COALESCE(max(ie.mag_mult),1) * COALESCE(max(ie.val_mod),1) * e.val AS value
			FROM recipes r
			INNER JOIN recipe_effect re ON r.id = re.recipe_id
			INNER JOIN effects e ON e.id = re.eff_id
			INNER JOIN ing_eff ie ON ie.ing_id IN (r.ing1, r.ing2, r.ing3) AND ie.eff_id = e.id
			WHERE r.id IN ($recipe_ids)
			GROUP BY r.id, e.id
			";
			$eff_query = $this->db->query($eff_sql);
			foreach ($eff_query->result() AS $e){
				$result[$e->recipe]->effects_info[] = $e ;
				unset ($e->recipe);
			}
			usort($result,'compare_recipes');
		}
		$result['count']=$count_result;
		//echo '<pre>';var_dump($result);echo'</pre>';
		//echo $sql;
		return $result;
	}







}
/*
		$this->settings['ing_num'] = array(2); // number of ingredients in recipes, [] or  [2] or [3] or [2,3]
		$this->settings['min_effs'] = 1; // minimum number of effects, int 1-6
		$this->settings['inventory'] = array(); // inventory ingredients, ordered array ingredient ids
		$this->settings['pref_ings'] = array(); // preffered ingredients, ordered array ingredient ids
		$this->settings['pref_ings_use'] = 1; // number of preffered ingredients to use, int 0-3
		$this->settings['pref_effs'] = array(); // preffered effects, ordered array effect ids
		$this->settings['pref_effs_use'] = 1; // number of preffered effects to use, int 0-6
		$this->settings['excl_effs'] = array(); // excluded effects, ordered array effect ids
 *
 */
?>
