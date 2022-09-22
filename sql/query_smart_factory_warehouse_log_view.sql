SELECT smart_factory_warehouse_log.id, w_id, smart_product.product_no AS 'product_no',
smart_product.project_no AS 'project_no',
smart_project.project_name AS 'project_name', product_name, 
prev_w_id, create_date, prev_cnt, release_cnt, 
current_cnt, current_type, release_type, release_date, smart_factory_warehouse_log.ip 
FROM smart_factory_warehouse_log, smart_factory_warehouse, smart_product, smart_project 
WHERE (smart_factory_warehouse.id = smart_factory_warehouse_log.w_id) 
AND (smart_factory_warehouse.product_no = smart_product.product_no) 
AND (smart_product.project_no = smart_project.project_id)
AND (current_type = '신규' OR current_type = '최근') 
 ORDER BY smart_factory_warehouse_log.w_id DESC LIMIT 10 OFFSET 0;