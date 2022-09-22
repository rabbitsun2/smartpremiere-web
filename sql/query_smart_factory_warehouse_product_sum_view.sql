SELECT SUM(smart_factory_warehouse.product_cnt) AS 'cnt'
 FROM smart_factory_warehouse, smart_product 
 WHERE smart_factory_warehouse.product_no = smart_product.product_no AND 
  create_date BETWEEN CAST('2022-06-01' AS DATE) AND CAST('2022-06-31' AS DATE);