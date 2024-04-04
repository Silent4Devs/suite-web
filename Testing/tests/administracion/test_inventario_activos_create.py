from pages.administracion.configurar_organizacion.inventario_de_activos.create.inventario_activos_create_page import Create_Inventario_Activos
 
def test_create_inventario_de_activos(browser):
    
    create_inventario_activos = Create_Inventario_Activos(browser)
    create_inventario_activos.login()
    create_inventario_activos.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
    create_inventario_activos.add_inventario_activos(agregar_btn_xpath, guardar_xpath)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[3]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/activos'][text()='Inventario de Activos']"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"

