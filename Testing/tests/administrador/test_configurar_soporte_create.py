from pages.administrador.ajustes_de_sistema.configurar_soporte.create.configurar_soporte_create_page import Create_configurar_soporte
 
def test_clasificacion_create(browser):
    
 clasifiacion_create = Create_configurar_soporte(browser)
 clasifiacion_create.login()
 clasifiacion_create.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 clasifiacion_create.add_configurar_soporte(agregar_btn_xpath, guardar_xpath)
 

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[7]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/configurar-soporte'][text()='Configurar Soporte']"
agregar_btn_xpath = "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3 agregar']"
guardar_xpath = "//BUTTON[@class='btn btn-danger'][normalize-space(text())='Guardar']"
