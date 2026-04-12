-- phpMyAdmin SQL Dump (FIXED VERSION - SAME FORMAT)

CREATE DATABASE IF NOT EXISTS enzymebase;
USE enzymebase;

-- =====================
-- TABLE STRUCTURES
-- =====================

CREATE TABLE `enzyme` (
  `enzyme_id` VARCHAR(10),
  `enzymec_no` VARCHAR(20),
  `enzyme_name` VARCHAR(50),
  `enzyme_function` VARCHAR(100),
  `uniprot_id` VARCHAR(20),
  `mol_weight` DECIMAL(10,2)
);

CREATE TABLE `organism` (
  `org_id` VARCHAR(10),
  `enzyme_id` VARCHAR(10),
  `sci_name` VARCHAR(50),
  `comm_name` VARCHAR(50),
  `tax_id` VARCHAR(20)
);

CREATE TABLE `reaction` (
  `reac_id` VARCHAR(10),
  `enzyme_id` VARCHAR(10),
  `substrate` VARCHAR(100),
  `product` VARCHAR(100),
  `reac_eqn` VARCHAR(150),
  `pathway` VARCHAR(100),
  `opt_ph` DECIMAL(5,2),
  `opt_temp` DECIMAL(5,2),
  `inhibitors` VARCHAR(100)
);

CREATE TABLE `kinetics` (
  `kin_id` VARCHAR(10),
  `enzyme_id` VARCHAR(10),
  `org_id` VARCHAR(10),
  `substrate` VARCHAR(100),
  `km_value` DECIMAL(10,2),
  `vmax_value` DECIMAL(10,2),
  `reac_id` VARCHAR(10)
);

CREATE TABLE `cofactor` (
  `cof_id` VARCHAR(10),
  `enzyme_id` VARCHAR(10),
  `cof_name` VARCHAR(50),
  `role` VARCHAR(100)
);

-- =====================
-- INSERT DATA (UNCHANGED)
-- =====================

INSERT INTO `enzyme` VALUES
('E06', 'EC 1.1.1.1', 'Alcohol dehydrogenase', 'Converts alcohol to aldehyde', 'P12345', 40.20),
('E07', 'EC 3.1.1.1', 'Lipase', 'Hydrolyzes fats', 'Q67890', 55.50),
('E08', 'EC 2.7.1.1', 'Hexokinase', 'Phosphorylates glucose', 'A11111', 50.30),
('E09', 'EC 1.1.1.27', 'Lactate dehydrogenase', 'Converts lactate to pyruvate', 'B22222', 35.80),
('E10', 'EC 4.2.1.1', 'Fumarase', 'Catalyzes fumarate to malate', 'C33333', 47.00),
('E11', 'EC 6.3.5.5', 'Argininosuccinate synthetase', 'Urea cycle enzyme', 'D44444', 54.60),
('E12', 'EC 5.3.1.9', 'Glucose-6-phosphate isomerase', 'Glycolysis enzyme', 'E55555', 61.40),
('E13', 'EC 2.4.1.1', 'Glycogen synthase', 'Synthesizes glycogen', 'F66666', 80.00),
('E14', 'EC 1.14.13.39', 'Tryptophan 2,3-dioxygenase', 'Breaks down tryptophan', 'G77777', 43.20),
('E15', 'EC 3.5.1.5', 'Glutaminase', 'Hydrolyzes glutamine', 'H88888', 33.10);

INSERT INTO `organism` VALUES
('O06','E06','Homo sapiens','Human','9606'),
('O07','E07','Mus musculus','Mouse','10090'),
('O08','E08','Saccharomyces cerevisiae','Yeast','4932'),
('O09','E09','Escherichia coli','E. coli','562'),
('O10','E10','Arabidopsis thaliana','Thale cress','3702'),
('O11','E11','Danio rerio','Zebrafish','7955'),
('O12','E12','Rattus norvegicus','Rat','10116'),
('O13','E13','Bos taurus','Cow','9913'),
('O14','E14','Caenorhabditis elegans','Worm','6239'),
('O15','E15','Drosophila melanogaster','Fruit fly','7227');

INSERT INTO `reaction` VALUES
('R06','E06','Ethanol','Acetaldehyde','Ethanol + NAD+ → Acetaldehyde + NADH','Alcohol metabolism',7.40,37.00,'Pyrazole'),
('R07','E07','Triglyceride','Glycerol + FA','TG + H2O → Glycerol + FA','Lipid metabolism',8.00,40.00,'Orlistat'),
('R08','E08','Glucose','Glucose-6-phosphate','Glucose + ATP → G6P + ADP','Glycolysis',7.00,37.00,'Glucose analogs'),
('R09','E09','Lactate','Pyruvate','Lactate + NAD+ → Pyruvate + NADH','Anaerobic glycolysis',6.50,38.00,'Oxamate'),
('R10','E10','Fumarate','Malate','Fumarate + H2O → Malate','TCA cycle',7.50,37.00,'None'),
('R11','E11','Citrulline','Argininosuccinate','Citrulline + Aspartate → Argininosuccinate','Urea cycle',7.20,37.00,'None'),
('R12','E12','G6P','F6P','G6P ↔ F6P','Glycolysis',7.40,37.00,'None'),
('R13','E13','UDP-glucose','Glycogen','UDP-glucose → Glycogen + UDP','Glycogenesis',7.00,37.00,'Glucagon'),
('R14','E14','Tryptophan','N-formylkynurenine','Tryptophan + O2 → N-formylkynurenine','Amino acid metabolism',7.40,37.00,'None'),
('R15','E15','Glutamine','Glutamate','Glutamine + H2O → Glutamate + NH3','Nitrogen metabolism',7.00,37.00,'DON');

INSERT INTO `kinetics` VALUES
('K06','E06','O06','Ethanol',0.05,120.00,'R06'),
('K07','E07','O07','Triglyceride',0.10,200.00,'R07'),
('K08','E08','O08','Glucose',0.03,300.00,'R08'),
('K09','E09','O09','Lactate',0.07,150.00,'R09'),
('K10','E10','O10','Fumarate',0.04,180.00,'R10'),
('K11','E11','O11','Citrulline',0.06,160.00,'R11'),
('K12','E12','O12','G6P',0.02,220.00,'R12'),
('K13','E13','O13','UDP-glucose',0.09,250.00,'R13'),
('K14','E14','O14','Tryptophan',0.08,110.00,'R14'),
('K15','E15','O15','Glutamine',0.11,190.00,'R15');

INSERT INTO `cofactor` VALUES
('C06','E06','NAD+','Electron acceptor'),
('C07','E07','Water','Hydrolytic agent'),
('C08','E08','ATP','Phosphate donor'),
('C09','E09','NAD+','Electron acceptor'),
('C10','E10','H2O','Hydration catalyst'),
('C11','E11','ATP','Energy source'),
('C12','E12','Mg2+','Stabilizes phosphate groups'),
('C13','E13','UDP-glucose','Substrate donor'),
('C14','E14','Oxygen','Oxidizing agent'),
('C15','E15','H2O','Hydrolysis medium');

-- =====================
-- KEYS (SAME AS YOUR FILE)
-- =====================

ALTER TABLE `enzyme`
  ADD PRIMARY KEY (`enzyme_id`);

ALTER TABLE `organism`
  ADD PRIMARY KEY (`org_id`),
  ADD KEY `org_forkey` (`enzyme_id`);

ALTER TABLE `reaction`
  ADD PRIMARY KEY (`reac_id`,`substrate`),
  ADD KEY `reac_forkey` (`enzyme_id`);

ALTER TABLE `kinetics`
  ADD PRIMARY KEY (`kin_id`),
  ADD KEY `kin_forkey` (`enzyme_id`),
  ADD KEY `kin2_forkey` (`org_id`);

ALTER TABLE `cofactor`
  ADD PRIMARY KEY (`cof_id`),
  ADD KEY `cof_forkey` (`enzyme_id`);

-- =====================
-- FOREIGN KEYS (FIXED)
-- =====================

ALTER TABLE `organism`
  ADD CONSTRAINT `org_forkey`
  FOREIGN KEY (`enzyme_id`) REFERENCES `enzyme`(`enzyme_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `reaction`
  ADD CONSTRAINT `reac_forkey`
  FOREIGN KEY (`enzyme_id`) REFERENCES `enzyme`(`enzyme_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `kinetics`
  ADD CONSTRAINT `kin_forkey`
  FOREIGN KEY (`enzyme_id`) REFERENCES `enzyme`(`enzyme_id`)
  ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kin2_forkey`
  FOREIGN KEY (`org_id`) REFERENCES `organism`(`org_id`)
  ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kin3_forkey`
  FOREIGN KEY (`reac_id`,`substrate`) REFERENCES `reaction`(`reac_id`,`substrate`)
  ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `cofactor`
  ADD CONSTRAINT `cof_forkey`
  FOREIGN KEY (`enzyme_id`) REFERENCES `enzyme`(`enzyme_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;