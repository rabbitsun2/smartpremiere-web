SELECT smart_factory_warehouse_barcode_bag.id, 
smart_factory_warehouse_barcode.rand_id, 
smart_product.project_id, 
smart_project.project_name, 
smart_factory_warehouse.product_id, 
smart_product.product_name, 
smart_factory_warehouse_log.current_cnt, 
smart_factory_warehouse_log.current_type, 
smart_factory_warehouse_log.release_type, 
smart_factory_warehouse_log.release_date, 
smart_factory_warehouse_log.release_cnt, 
smart_factory_warehouse.create_date, 
smart_factory_warehouse_barcode_bag.regidate, 
smart_factory_warehouse_barcode_bag.ip   
FROM smart_project, smart_product, 
smart_factory_warehouse, smart_factory_warehouse_log, 
smart_factory_warehouse_barcode, 
smart_factory_warehouse_barcode_bag 
WHERE 
smart_project.project_id = smart_product.project_id AND 
smart_product.product_id = smart_factory_warehouse.product_id AND 
smart_factory_warehouse_barcode.id = smart_factory_warehouse.id AND 
smart_factory_warehouse_barcode_bag.id = smart_factory_warehouse.id AND 
smart_factory_warehouse.id = smart_factory_warehouse_log.w_id AND 
(smart_factory_warehouse_log.current_type = '최근' OR 
smart_factory_warehouse_log.current_type = '신규') 
ORDER BY smart_factory_warehouse_barcode_bag.id;