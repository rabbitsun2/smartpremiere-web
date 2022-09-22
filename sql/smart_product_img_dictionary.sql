-- --------------------------------------------------------
-- 호스트:                          127.0.0.1
-- 서버 버전:                        10.4.25-MariaDB - mariadb.org binary distribution
-- 서버 OS:                        Win64
-- HeidiSQL 버전:                  11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- 테이블 hr.smart_product_img_dictionary 구조 내보내기
CREATE TABLE IF NOT EXISTS `smart_product_img_dictionary` (
  `product_id` int(11) DEFAULT NULL,
  `type` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `train_dir` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  `ip` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 내보낼 데이터가 선택되어 있지 않습니다.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
