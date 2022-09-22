SELECT smart_factory_warehouse_log.id AS 'id', smart_factory_warehouse_log.w_id, 
smart_factory_warehouse.product_no, smart_product.product_name, 
smart_factory_warehouse_log.prev_w_id, smart_factory_warehouse_log.prev_cnt, 
smart_factory_warehouse_log.release_cnt, smart_factory_warehouse_log.current_cnt, 
smart_factory_warehouse_log.current_type, smart_factory_warehouse_log.release_type,
smart_factory_warehouse_log.release_date, smart_factory_warehouse_log.ip 
FROM smart_product, smart_factory_warehouse, smart_factory_warehouse_log 
WHERE smart_factory_warehouse.id = smart_factory_warehouse_log.w_id 
AND smart_factory_warehouse.product_no = smart_product.product_no 
AND smart_factory_warehouse_log.id = 1