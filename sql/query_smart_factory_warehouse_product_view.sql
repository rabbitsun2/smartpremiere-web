SELECT smart_factory_warehouse.id AS 'id', smart_factory_warehouse.product_no AS 'product_no',
smart_product.product_name AS 'product_name', smart_factory_warehouse.product_cnt AS 'product_cnt',
smart_factory_warehouse.create_date AS 'create_date', smart_factory_warehouse.ip AS 'ip'
 FROM smart_factory_warehouse, smart_product 
 WHERE smart_factory_warehouse.product_no = smart_product.product_no AND 
  create_date BETWEEN CAST('2022-06-01' AS DATE) AND CAST('2022-06-31' AS DATE);