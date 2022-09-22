SELECT smart_factory_warehouse.id AS 'w_id', smart_product.product_id, 
smart_product.product_name, smart_factory_warehouse.product_cnt, 
smart_factory_warehouse_barcode.rand_id, 
smart_factory_warehouse.create_date, smart_factory_warehouse.create_type, 
smart_factory_warehouse.ip 
FROM smart_factory_warehouse, smart_factory_warehouse_barcode, smart_product   
WHERE smart_factory_warehouse.product_id = smart_product.product_id AND 
smart_factory_warehouse.id = smart_factory_warehouse_barcode.id AND 
smart_factory_warehouse.id = 6  
ORDER BY smart_factory_warehouse.id;