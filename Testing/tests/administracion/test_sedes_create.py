from pages.administracion.configurar_organizacion.sedes.create.sedes_create_page import Create_sedes
 
def test_create_sedes(browser):
    
 create_sedes = Create_sedes(browser)
 create_sedes.login()
 create_sedes.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 create_sedes.add_sedes(agregar_btn_xpath, guardar_xpath)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/sedes'][text()='Sedes']"
element_entrar_modulo = "(//A[@href='#'])[3]"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
guardar_xpath = "//BUTTON[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"


