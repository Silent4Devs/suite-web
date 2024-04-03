from pages.administracion.configurar_organizacion.macroprocesos.create.macroprocesos_create_page import Macroprocesos_Crear_Areas
 
def test_create_crear_areas(browser):
    
 create_macroprocesos = Macroprocesos_Crear_Areas(browser)
 create_macroprocesos.login()
 create_macroprocesos.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 create_macroprocesos.add_crear_macroprocesos(agregar_btn_xpath, guardar_xpath)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/macroprocesos'][text()='Macroprocesos']"
element_entrar_modulo = "(//A[@href='#'])[3]"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"

