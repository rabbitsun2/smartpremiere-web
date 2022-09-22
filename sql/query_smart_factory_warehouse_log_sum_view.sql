SELECT SUM(smart_factory_warehouse_log.current_cnt) AS 'cnt'
 FROM smart_factory_warehouse_log 
 WHERE release_date BETWEEN CAST('2022-06-01' AS DATE) AND CAST('2022-06-31' AS DATE) 
 AND (current_type = '신규' OR current_type = '최근');