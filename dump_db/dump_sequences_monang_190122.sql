-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               PostgreSQL 13.4, compiled by Visual C++ build 1914, 64-bit
-- Server OS:                    
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES  */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for view information_schema.sequences
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE "sequences" (
	"sequence_catalog" VARCHAR NULL COLLATE 'C',
	"sequence_schema" VARCHAR NULL COLLATE 'C',
	"sequence_name" VARCHAR NULL COLLATE 'C',
	"data_type" VARCHAR NULL COLLATE 'C',
	"numeric_precision" INTEGER NULL,
	"numeric_precision_radix" INTEGER NULL,
	"numeric_scale" INTEGER NULL,
	"start_value" VARCHAR NULL COLLATE 'C',
	"minimum_value" VARCHAR NULL COLLATE 'C',
	"maximum_value" VARCHAR NULL COLLATE 'C',
	"increment" VARCHAR NULL COLLATE 'C',
	"cycle_option" VARCHAR(3) NULL COLLATE 'C'
) ENGINE=MyISAM;

-- Dumping structure for view information_schema.sequences
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS "sequences";
CREATE VIEW "sequences" AS  SELECT (current_database())::sql_identifier AS sequence_catalog,
    (nc.nspname)::sql_identifier AS sequence_schema,
    (c.relname)::sql_identifier AS sequence_name,
    (format_type(s.seqtypid, NULL::integer))::character_data AS data_type,
    (_pg_numeric_precision(s.seqtypid, '-1'::integer))::cardinal_number AS numeric_precision,
    (2)::cardinal_number AS numeric_precision_radix,
    (0)::cardinal_number AS numeric_scale,
    (s.seqstart)::character_data AS start_value,
    (s.seqmin)::character_data AS minimum_value,
    (s.seqmax)::character_data AS maximum_value,
    (s.seqincrement)::character_data AS increment,
    (
        CASE
            WHEN s.seqcycle THEN 'YES'::text
            ELSE 'NO'::text
        END)::yes_or_no AS cycle_option
   FROM pg_namespace nc,
    pg_class c,
    pg_sequence s
  WHERE ((c.relnamespace = nc.oid) AND (c.relkind = 'S'::"char") AND (NOT (EXISTS ( SELECT 1
           FROM pg_depend
          WHERE ((pg_depend.classid = ('pg_class'::regclass)::oid) AND (pg_depend.objid = c.oid) AND (pg_depend.deptype = 'i'::"char"))))) AND (NOT pg_is_other_temp_schema(nc.oid)) AND (c.oid = s.seqrelid) AND (pg_has_role(c.relowner, 'USAGE'::text) OR has_sequence_privilege(c.oid, 'SELECT, UPDATE, USAGE'::text)));;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
