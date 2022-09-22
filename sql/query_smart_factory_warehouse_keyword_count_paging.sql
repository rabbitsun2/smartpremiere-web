SELECT COUNT(*) as 'cnt' 
                                                    FROM smart_factory_warehouse_log, smart_factory_warehouse, 
                                                        smart_product, smart_project 
                                                    WHERE (smart_factory_warehouse.id = smart_factory_warehouse_log.w_id) 
                                                    AND (smart_factory_warehouse.product_no = smart_product.product_no) 
                                                    AND (smart_product.project_no = smart_project.project_id) 
                                                    AND (current_type = ? OR current_type = ?)
                                                    AND (smart_project.project_name like ? 
                                                    OR smart_product.product_name like ?)