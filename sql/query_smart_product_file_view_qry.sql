SELECT smart_product.product_no, smart_product.product_name, 
smart_product_file.uuid AS 'file_uuid', smart_product_file.original_name,
smart_product_file.file_ext, smart_product.description,
smart_product.regidate, smart_product.ip, smart_product.project_no 
 FROM smart_product, smart_product_file 
 WHERE smart_product.product_no = smart_product_file.product_id
 ORDER BY regidate;